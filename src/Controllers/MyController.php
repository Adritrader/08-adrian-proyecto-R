<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Core\App;
use App\Core\Controller;
use App\Core\Exception\NotFoundException;
use App\Core\Router;
use App\Entity\Producto;
use App\Model\ProductoModel;
use App\Model\RegistraModel;
use App\Model\ServicioModel;
use App\Model\UsuarioModel;
use App\Utils\MyMail;
use DateTime;
use Exception;
use App\Entity\Movie;

/**
 * Class DefaultController
 * @package App\Controllers
 */
class MyController extends Controller
{
    /**
     * @return string
     * @throws Exception
     */
    public function index(): string
    {

            return $this->response->renderView("myindex", "my");


    }
    public function servicios(): string
    {

        return $this->response->renderView("servicios", "my");


    }

    public function quienesSomos(): string
    {

        return $this->response->renderView("quienes-somos", "my");


    }
    public function galeria(): string
    {

        return $this->response->renderView("galeria", "my");


    }
    public function blog(): string
    {

        return $this->response->renderView("blog", "my");


    }
    public function reservaCita(): string
    {
        $errors = [];
        $servicioModel = App::getModel(ServicioModel::class);
        $servicios= $servicioModel->findAll();


        return $this->response->renderView("reservas-create-form", "my", compact("servicios", "errors"));


    }
    public function contacto(): string
    {

        return $this->response->renderView("contacto", "my");


    }
    public function tienda(): string
    {
        try {
        $errors = [];
        $productoModel = App::getModel(ProductoModel::class);
        $producto = $productoModel->findAll();
        $router = App::get(Router::class);

        $pdo = App::get("DB");

        $numberOfRecordsPerPage = 4;


        $consulta = $pdo->query("SELECT COUNT(*) as total_productos FROM producto");

        $productos = $consulta->fetch();


        $totalPaginas = $productos["total_productos"];

        $totalPaginas = ceil($totalPaginas /$numberOfRecordsPerPage);

        $currentPage = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
        if (empty($currentPage))
            $currentPage = 1;

        $limit = $numberOfRecordsPerPage;

        $productos = $productoModel->findAllPaginated($currentPage, $limit);



        } catch (Exception $PDOException) {
            echo $PDOException->getMessage();
        }


        return $this->response->renderView("tienda", "my", compact("producto","productos","totalPaginas","router", "errors"));


    }

    public function signup(): string
    {

        return $this->response->renderView("signup", "my");


    }




    public function singlePage(): string
    {



        return $this->response->renderView("single-page", "my");


    }

    /**
     * @return string
     * @throws Exception
     */
    public function contact(): string
    {
        // 2. S'ha enviat el formulari

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 3. Validar
            $name = filter_input(INPUT_POST, "name");
            $subject = filter_input(INPUT_POST, "subject");
            $message = filter_input(INPUT_POST, "message");
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $date = DateTime::createFromFormat("Y-m-d", filter_input(INPUT_POST, "date"));

            if (empty($name)) {
                $errors[] = "No has posat el nom i cognom";
            }

            if (empty($date)) {
                $errors[] = "No has posat la data";
            }

            if (empty($email)) {
                $errors[] = "No has posat el correu o és incorrecte";
            }

            if (empty($subject)) {
                $errors[] = "No has posat l'assumpte";
            }

            if (empty($message)) {
                $errors[] = "No has posat el missatge";
            }

            if (empty($errors)) {
                $fullMessage = "$name ($email)\n $subject\n $message";
                App::get(MyMail::class)->send("contact form", "vjorda.pego@gmail.com", "Vicent", $fullMessage);
            }

            return $this->response->renderView("contact", "default", compact('errors',
                'name', 'date', 'subject', 'message', 'email'));
        } else
            return $this->response->renderView("contact", "default");

    }

    /**
     * @return string
     * @throws \App\Core\Exception\ModelException
     */
    public function demo(): string
    {
        $movieModel = App::getModel(MovieModel::class);
        $movies = $movieModel->findAllPaginated(1, 8,
            ["release_date" => "DESC", "title" => "ASC"]);
        return $this->response->jsonResponse($movies);

    }
}