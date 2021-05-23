<?php
declare(strict_types=1);

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Exception\ModelException;
use App\Core\Exception\NotFoundException;
use App\Core\Router;
use App\Entity\Contiene;
use App\Entity\Pedido;
use App\Entity\Realiza;
use App\Exception\UploadedFileException;
use App\Exception\UploadedFileNoFileException;
use App\Model\ContieneModel;
use App\Core\App;
use App\Model\PedidoModel;
use App\Model\ProductoModel;
use App\Model\RealizaModel;
use App\Model\ServicioModel;
use App\Model\UsuarioModel;
use App\Utils\MyLogger;
use App\Utils\UploadedFile;
use DateTime;
use Exception;
use PDOException;

/**
 * Class MovieController
 * @package App\Controllers
 */
class PedidoController extends Controller
{
    /**
     * @return string
     * @throws Exception
     */
    public function index(): string
    {

        $title = "Pedidos";
        $errors = [];

        $pedidoModel = App::getModel(PedidoModel::class);
        $realiza_usuarioModel = App::getModel( RealizaModel::class);
        $contieneModel = App::getModel(ContieneModel::class);

        $realizaUsuario = $realiza_usuarioModel->findAll();
        $pedidos = $pedidoModel->findAll();
        $contiene = $contieneModel->findAll();


        $order = filter_input(INPUT_GET, "order", FILTER_SANITIZE_STRING);

        if (!empty($_GET['order'])) {
            $orderBy = [$_GET["order"] => $_GET["tipo"]];
            try {
                $realizaUsuario = $realiza_usuarioModel->findAll($orderBy);

            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }
        $router = App::get(Router::class);

        $message = App::get("flash")::get("message");

        return $this->response->renderView("back/back-pedidos", "back", compact('title', 'pedidos', 'realizaUsuario',
            'pedidoModel', 'realiza_usuarioModel', 'contiene','contieneModel', 'errors', 'router', 'message'));
    }

    /**
     * @return string
     * @throws ModelException
     */
    public function filterPedido(): string
    {
        // S'executa amb el POST
        $title = "Movies - Movie FX";
        $errors = [];
        $pedidoModel = null;
        $pedido = null;

        $router = App::get(Router::class);

        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

        $tipo_busqueda = filter_input(INPUT_POST, "optradio", FILTER_SANITIZE_STRING);

        if (!empty($text)) {

            $pedidoModel = App::getModel(PedidoModel::class);
            if ($tipo_busqueda == "both") {
                $pedido = $pedidoModel->executeQuery("SELECT * FROM pedido WHERE precio LIKE :text OR estado LIKE :text",
                    ["text" => "%$text%"]);

            }
            if ($tipo_busqueda == "precio") {
                $pedido = $pedidoModel->executeQuery("SELECT * FROM pedido WHERE precio LIKE :text",
                    ["text" => "%$text%"]);

            }
            if ($tipo_busqueda == "estado") {
                $pedido = $pedidoModel->executeQuery("SELECT * FROM pedido WHERE estado LIKE :text",
                    ["text" => "%$text%"]);
            }

        } else {
            $error = "Debes introducir una palabra de búsqueda";
        }

        return $this->response->renderView("pedidos", "back", compact('title', 'pedido',
            'movieModel', 'errors', 'router'));
    }

    /**
     * @return string
     * @throws Exception
     */
    public function createPedido(): string
    {

        $router = App::get(Router::class);
        $usuarioModel = App::getModel(UsuarioModel::class);
        $usuario = $usuarioModel->find($_SESSION["loggedUser"]);
        $errors = $_SESSION["errors"] ?? "";

        return $this->response->renderView("carrito", "my", compact( 'router', 'usuario', 'errors'));

    }

    /**
     * @return string
     * @throws Exception
     */
    public function storePedido(): string
    {

        $errors = [];
        $totalCart = $_SESSION["totalCart"];
        $cartProducts = $_SESSION["shoppingCart"];
        $estado = "Preparando";
        $fecha = date("Y-m-d", time());

        $realiza_usuarioModel = App::getModel(RealizaModel::class);
        $pedidoModel = App::getModel(PedidoModel::class);
        $usuarioModel = App::getModel(UsuarioModel::class);
        $contieneModel = App::getModel(ContieneModel::class);

        $usuario = $usuarioModel->find($_SESSION["loggedUser"]);
        $fechaPedido = DateTime::createFromFormat("Y-m-d", $fecha);
        $usuariosRealiza = $realiza_usuarioModel->findAll();
        $pedidos = $pedidoModel->findAll();


        $numeroId = end($usuariosRealiza);
        $numeroPedidoId = end($pedidos);



        if (empty($errors)) {
            try {

                //Insercion en la tabla realiza

                $realiza = new Realiza();
                $realiza->setUSUARIOId($usuario->getId());
                $realiza_usuarioModel->save($realiza);
                App::get(MyLogger::class)->info("Se ha registrado un usuario que realiza un pedido");

                //Insercion en la tabla pedido

                $pedido = new Pedido();
                $pedido->setPrecio($totalCart);
                $pedido->setEstado($estado);
                $pedido->setFechaPedido($fechaPedido);
                $pedido->setRealizaId($numeroId->getId());
                $pedido->setREALIZAUSUARIOId($usuario->getId());

                $pedidoModel->save($pedido);
                App::get(MyLogger::class)->info("Se ha creado un nuevo pedido");

                //Insercion tabla contiene


                foreach($cartProducts as $product){

                    $contienePro = $contieneModel->findAll();

                    $numeroIdcontienePro = end($contienePro);
                    $contiene = new Contiene();

                    $contiene->setId($numeroIdcontienePro->getId() + 1);
                    $contiene->setPedidoId($numeroPedidoId->getId());
                    $contiene->setProductoId($product->getId());
                    $contieneModel->save($contiene);

                    App::get(MyLogger::class)->info("Se han guardado los productos en el pedido");


                }

                //Borrar los productos del carrito

                unset($_SESSION);
                session_unset();

            } catch (PDOException | ModelException | Exception $e) {
                $errors[] = "Error: " . $e->getMessage();
            }
        }

        if (empty($errors)) {

            App::get('flash')->set("message", "El pedido se ha creado correctamente");
            $message = "El pedido se ha creado correctamente";


        } else {

            var_dump($errors);
            App::get('flash')->set("message", "No se ha podido registrar el pedido");
            $message = "No se ha podido registrar el pedido";

        }

        return $this->response->renderView("auth/login", "my", compact(
            "errors", "message"));

    }

        /**
     * @param int $id
     * @return string
     * @throws Exception
     */
    public function delete(int $id): string
    {
        $errors = [];
        $movie = null;
        $movieModel = App::getModel(MovieModel::class);

        if (empty($id)) {
            $errors[] = '404 Not Found';
        } else {
            try {
                $movie = $movieModel->find($id);
            } catch (NotFoundException $e) {
                $errors[] = '404 Movie Not Found';
            }
        }

        $router = App::get(Router::class);
        $moviesPath = App::get("config")["posters_path"];

        return $this->response->renderView("movies-delete", "default", compact(
            "errors", "movie", 'moviesPath', 'router'));
    }

    /**
     * @return string
     * @throws ModelException
     * @throws NotFoundException
     */
    public function destroy(): string
    {
        $errors = [];
        $movieModel = App::getModel(MovieModel::class);
        $movie = null;

        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        if (empty($id)) {
            $errors[] = '404 Not Found';
        } else {
            $movie = $movieModel->find($id);
        }
        $userAnswer = filter_input(INPUT_POST, "userAnswer");
        if ($userAnswer === 'yes') {
            if (empty($errors)) {
                try {
                    $movie = $movieModel->find($id);
                    $result = $movieModel->delete($movie);
                } catch (PDOException $e) {
                    $errors[] = "Error: " . $e->getMessage();
                }
            }
        }
        else
            App::get(Router::class)->redirect('movies');

        if (empty($errors))
            App::get(Router::class)->redirect('movies');
        else
            return $this->response->renderView("movies-destroy", "default",
                compact("errors", "movie"));

        return "";
    }

    /**
     * @param int $id
     * @return string
     * @throws ModelException
     * @throws NotFoundException
     */

    public function edit(int $id): string
    {
        $isGetMethod = true;
        $errors = [];
        $movieModel = App::getModel(MovieModel::class);
        $movie = null;

        if (empty($id)) {
            $errors[] = '404 Not Found';
        } else {
            $movie = $movieModel->find($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isGetMethod = false;

            $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
            if (empty($id)) {
                $errors[] = "Wrong ID";
            }

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (empty($title)) {
                $errors[] = "The title is mandatory";
            }

            $overview = filter_input(INPUT_POST, "overview", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (empty($overview)) {
                $errors[] = "The overview is mandatory";
            }

            $tagline = filter_input(INPUT_POST, "tagline", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $releaseDate = DateTime::createFromFormat("Y-m-d", $_POST["release_date"]);
            if (empty($releaseDate)) {
                $errors[] = "The release date is mandatory";
            }

            $poster = filter_input(INPUT_POST, "poster");


            if (empty($errors)) {
                //Gestion de la imagen si se ha subido
                try {
                    $image = new UploadedFile('poster', 300000, ['image/jpg', 'image/jpeg']);
                    if ($image->validate()) {
                        $image->save(Movie::POSTER_PATH);
                        $poster = $image->getFileName();
                    }
                    //Al estar editando no nos interesa que se muestre este error ya que puede ser que no suba archivo
                } catch (UploadedFileNoFileException $uploadFileNoFileException) {
                    //$errors[] = $uploadFileNoFileException->getMessage();
                } catch (UploadedFileException $uploadFileException) {
                    $errors[] = $uploadFileException->getMessage();
                }
            }

            if (empty($errors)) {
                try {
                    // Instead of creating a new object we load the current data object.
                    $movie = $movieModel->find($id);

                    //then we set the new values
                    $movie->setTitle($title);
                    $movie->setOverview($overview);
                    $movie->setReleaseDate($releaseDate);
                    $movie->setTagline($tagline);
                    $movie->setPoster($poster);

                    $movieModel->update($movie);

                } catch (PDOException $e) {
                    $errors[] = "Error: " . $e->getMessage();
                }
            }
        }

        return $this->response->renderView("movies-edit", "default", compact("isGetMethod",
            "errors", "movie"));
    }

    /**
     * @param int $id
     * @return string
     * @throws Exception
     */
    public function show(int $id): string
    {
        $errors = [];
        if (!empty($id)) {
            try {
                $movieModel = new MovieModel(App::get("DB"));
                $movie = $movieModel->find($id);
                $title = $movie->getTitle() . " (" . $movie->getReleaseDate()->format("Y") . ") - Movie FX";
                return $this->response->renderView("single-page", "default", compact(
                    "errors", "movie"));

            } catch (NotFoundException $notFoundException) {
                $errors[] = $notFoundException->getMessage();
            }
        }
        else
            return $this->response->renderView("single-page", "default", compact(
                "errors"));

        return "";
    }
}