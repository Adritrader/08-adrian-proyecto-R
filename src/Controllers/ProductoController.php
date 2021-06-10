<?php
declare(strict_types=1);

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Exception\ModelException;
use App\Core\Exception\NotFoundException;
use App\Core\Router;
use App\Entity\Producto;
use App\Exception\UploadedFileException;
use App\Exception\UploadedFileNoFileException;
use App\Model\ProductoModel;
use App\Core\App;
use App\Utils\MyLogger;
use App\Utils\UploadedFile;
use Exception;
use PDOException;

/**
 * Class ProductoController
 * @package App\Controllers
 */
class ProductoController extends Controller {
    

    public function index(): string
    {

        $title = "BackOffice | Productos";
        $errors = [];
        $productoModel = App::getModel(ProductoModel::class);
        $productos = $productoModel->findAll();


        $order = filter_input(INPUT_GET, "order", FILTER_SANITIZE_STRING);

        if (!empty($_GET['order'])) {
            $orderBy = [$_GET["order"] => $_GET["tipo"]];
            try {
                $productos = $productoModel->findAll($orderBy);
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }

        $router = App::get(Router::class);

        $message = App::get("flash")::get("message");

        return $this->response->renderView("back/back-productos", "back", compact('title', 'productos',
            'productoModel', 'errors', 'router', 'message'));

    }

    /**
     * @return string
     * @throws ModelException
     */
    public function filterProducto(): string
    {
        // S'executa amb el POST
        $title = "BackOffice | Productos";
        $errors = [];
        $productoModel = null;
        $productos = null;

        $router = App::get(Router::class);

        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

        $tipo_busqueda = filter_input(INPUT_POST, "optradio", FILTER_SANITIZE_STRING);

        if (!empty($text)) {

            $productoModel = App::getModel(ProductoModel::class);

            if ($tipo_busqueda == "both") {
                $productos = $productoModel->executeQuery("SELECT * FROM producto WHERE nombre LIKE :text OR descripcion LIKE :text",
                    ["text" => "%$text%"]);

            }
            if ($tipo_busqueda == "nombre") {
                $productos = $productoModel->executeQuery("SELECT * FROM producto WHERE nombre LIKE :text",
                    ["text" => "%$text%"]);

            }
/*

            if($tipo_busqueda == "dato"){

                $productos = $productoModel->executeQuery("SELECT * FROM producto WHERE dato LIKE :text", ["text" =>"%$text%"]);
            }

*/

            if ($tipo_busqueda == "descripcion") {
                $productos = $productoModel->executeQuery("SELECT * FROM producto WHERE descripcion LIKE :text",
                    ["text" => "%$text%"]);
            }

        } else {
            $error = "Debe introducir una palabra de búsqueda";
        }


        return $this->response->renderView("back/back-productos", "back", compact('title', 'productos',
            'productoModel', 'errors', 'router'));


    }

    public function createProducto(): string
    {
        return $this->response->renderView("productos-create-form", "back");
    }


    /**
     * @return string
     * @throws Exception
     */
    public function storeProducto(): string
    {
        $errors = [];


        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $precio = filter_input(INPUT_POST, "precio", FILTER_VALIDATE_INT);
        $descripcion = filter_input(INPUT_POST, "descripcion", FILTER_SANITIZE_SPECIAL_CHARS);
        $imagen = "nofoto.jpg";

        if (empty($nombre)) {
            $errors[] = "El nombre es obligatorio";
        }
        if (empty($categoria)) {
            $errors[] = "La categoria es obligatorios";
        }

        if (empty($precio)) {
            $errors[] = "El precio es obligatorio";
        }

        if (empty($descripcion)) {
            $errors[] = "La descripcion es obligatoria";
        }

        // Si hay errores no necesitamos subir la imagen
        if (empty($errors)) {
            try {
                $uploadedFile = new UploadedFile("imagen", 2000 * 1024, ["image/jpeg", "image/jpg"]);
                if ($uploadedFile->validate()) {
                    $uploadedFile->save(Producto::IMAGEN_PATH);
                    $imagen = $uploadedFile->getFileName();
                }
            } catch (Exception $exception) {
                $errors[] = "Error uploading file ($exception)";
            }
        }


        if (empty($errors)) {
            try {
                $productoModel = App::getModel(ProductoModel::class);
                $producto = new Producto();

                $producto->setNombre($nombre);
                $producto->setCategoria($categoria);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setImagen($imagen);


                $productoModel->saveTransaction($producto);
                App::get(MyLogger::class)->info("Se ha creado un nuevo producto");

            } catch (PDOException | ModelException | Exception $e) {
                $errors[] = "Error: " . $e->getMessage();
            }
        }

        if (!empty($errors)) {

            App::get(Router::class)->redirect("back-productos");
        }

        return $this->response->renderView("productos-create", "back", compact(
            "errors", "nombre"));
    }

    public function showProducto(int $id): string
    {
        $errors = [];

        if (!empty($id)) {

            try {
                $productoModel = App::getModel(ProductoModel::class);
                $producto = $productoModel->find($id);
                $productos = $productoModel->findAll();
                $nombre = $producto->getNombre() . "" . $producto->getDescripcion();

                return $this->response->renderView("single-page", "my", compact(
                    "errors", "producto", "productos", "nombre"));

            } catch (NotFoundException $notFoundException) {
                $errors[] = $notFoundException->getMessage();
            }
        }
        else
            return $this->response->renderView("single-page", "my", compact(
                "errors", "producto", "productos"));
    }

    /*

    public function showProducto(int $id){

        $errors = [];

        if(!empty($id)){

            try{

                $productoModel = App::getModel(ProductoModel::class);
                $producto = $productoModel->find($id);

                return $this->response->renderView("single-page", "layout", compact("producto", "productoModel"));

            } catch (NotFoundException $notFoundException){

                $errors[] = $notFoundException->getMessage();

            }

        }

    }
    */





    public function editProducto(int $id): string
    {
        $isGetMethod = true;
        $errors = [];
        $productoModel = App::getModel(ProductoModel::class);
        $producto = null;

        if (empty($id)) {
            $errors[] = '404 Not Found';
        } else {
            $producto = $productoModel->find($id);

        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isGetMethod = false;

            $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
            if (empty($id)) {
                $errors[] = "Wrong ID";
            }

            $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $precio = filter_input(INPUT_POST, "precio", FILTER_VALIDATE_INT);
            $descripcion = filter_input(INPUT_POST, "descripcion", FILTER_SANITIZE_SPECIAL_CHARS);
            $imagen = "nofoto.jpg";

            if (empty($nombre)) {
                $errors[] = "El nombre es obligatorio";
            }
            if (empty($categoria)) {
                $errors[] = "La categoria es obligatorios";
            }

            if (empty($precio)) {
                $errors[] = "El precio es obligatorio";
            }

            if (empty($descripcion)) {
                $errors[] = "La descripcion es obligatoria";
            }
            $imagen = filter_input(INPUT_POST, "imagen");


            if (empty($errors)) {
                //Gestion de la imagen si se ha subido
                try {
                    $image = new UploadedFile('poster', 300000, ['image/jpg', 'image/jpeg']);
                    if ($image->validate()) {
                        $image->save(Movie::POSTER_PATH);
                        $imagen = $image->getFileName();
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
                    $producto = $productoModel->find($id);

                    //then we set the new values
                    $producto->setNombre($nombre);
                    $producto->setCategoria($categoria);
                    $producto->setDescripcion($descripcion);
                    $producto->setPrecio($precio);
                    $producto->setImagen($imagen);;

                    $producto->update($producto);

                } catch (PDOException $e) {
                    $errors[] = "Error: " . $e->getMessage();
                }
            }
        }

        return $this->response->renderView("productos-edit", "back", compact(
            "errors", "isGetMethod", "producto"));
    }

    public function updateProducto(int $id): string
    {
        $errors = [];
        $isGetMethod = false;
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $precio = filter_input(INPUT_POST, "precio", FILTER_VALIDATE_INT);
        $descripcion = filter_input(INPUT_POST, "descripcion", FILTER_SANITIZE_SPECIAL_CHARS);
        $imagen = filter_input(INPUT_POST, "imagen");

        if (empty($nombre)) {
            $errors[] = "El nombre es obligatorio";
        }
        if (empty($categoria)) {
            $errors[] = "La categoria es obligatorios";
        }

        if (empty($precio)) {
            $errors[] = "El precio es obligatorio";
        }

        if (empty($descripcion)) {
            $errors[] = "La descripcion es obligatoria";
        }

        // Si hay errores no necesitamos subir la imagen
        if (empty($errors)) {
            try {
                $imagenSubida = new UploadedFile('imagen', 300000, ['image/jpg', 'image/jpeg']);
                if ($imagenSubida->validate()) {
                    $imagenSubida->save(Producto::IMAGEN_PATH, uniqid("PRO"));
                    $imagen = $imagenSubida->getFileName();
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
                $productoModel = App::getModel(ProductoModel::class);
                // getting the partner by its identifier
                $producto = $productoModel->find($id);
                $producto->setNombre($nombre);
                $producto->setCategoria($categoria);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setImagen($imagen);
                // updating changes
                $productoModel->update($producto);
            } catch (Exception $e) {
                $errors[] = 'Error: ' . $e->getMessage();
            }
        }
        return $this->response->renderView("productos-edit", "back", compact(
            "errors", "isGetMethod"));
    }

    public function deleteProducto(int $id): string
    {
        $errors = [];
        $producto = null;
        $productoModel = App::getModel(ProductoModel::class);

        if (empty($id)) {
            $errors[] = '404 Not Found';
        } else {
            try {
                $producto = $productoModel->find($id);
            } catch (NotFoundException $e) {
                $errors[] = '404 Movie Not Found';
            }
        }

        $router = App::get(Router::class);
        $productosPath = App::get("config")["imagen_path"];

        return $this->response->renderView("productos-delete", "back", compact(
            "errors", "producto", 'productosPath', 'router'));
    }

    /**
     * @return string
     * @throws ModelException
     * @throws NotFoundException
     */
    public function destroyProducto(): string
    {
        $errors = [];
        $productoModel = App::getModel(ProductoModel::class);
        $producto = null;

        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        if (empty($id)) {
            $errors[] = '404 Not Found';
        } else {
            $producto = $productoModel->find($id);
        }
        $userAnswer = filter_input(INPUT_POST, "userAnswer");
        if ($userAnswer === 'yes') {
            if (empty($errors)) {
                try {
                    $producto = $productoModel->find($id);
                    $result = $productoModel->delete($producto);
                } catch (PDOException $e) {
                    $errors[] = "Error: " . $e->getMessage();
                }
            }
        }
        else
            App::get(Router::class)->redirect('back-productos');

        if (!empty($errors))
            App::get(Router::class)->redirect('back-productos');
        else
            return $this->response->renderView("productos-destroy", "back",
                compact("errors", "producto"));

        return "";
    }
}