<?php
declare(strict_types=1);

namespace App\Controllers;


use App\Core\Controller;
use App\Core\Exception\ModelException;
use App\Core\Exception\NotFoundException;
use App\Core\Router;
use App\Entity\Producto;
use App\Entity\Usuario;
use App\Core\App;
use App\Model\producteModel;
use App\Model\UserModel;
use App\Model\UsuarioModel;
use App\Utils\MyLogger;
use App\Utils\UploadedFile;
use Exception;
use PDOException;

/**
 * Class MovieController
 * @package App\Controllers
 */
class UsuarioController extends Controller
{
    /**
     * @return string
     * @throws Exception
     */
    public function index(): string
    {

        $title = "BackOffice | Usuarios";
        $errors = [];
        $usuarioModel = App::getModel(UsuarioModel::class);
        $usuarios = $usuarioModel->findAll();

        $order = filter_input(INPUT_GET, "order", FILTER_SANITIZE_STRING);

        if (!empty($_GET['order'])) {
            $orderBy = [$_GET["order"] => $_GET["tipo"]];
            try {
                $usuarios = $usuarioModel->findAll($orderBy);
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }

        $router = App::get(Router::class);

        $message = App::get("flash")::get("message");


        return $this->response->renderView("back/back-usuarios", "back", compact('title', 'usuarios',
            'usuarioModel', 'errors', 'router', 'message'));
    }

    public function perfilUsuario(int $id): string
    {

        $usuarioModel = App::getModel(UsuarioModel::class);
        $user = $usuarioModel->find($_SESSION["loggedUser"]);

        $errors = [];
        $router = App::get(Router::class);
        /*
        if (!empty($id)) {
            try {


                $usuarioModel = App::getModel(UsuarioModel::class);
                $usuario = $usuarioModel->find($id);

            } catch (NotFoundException $notFoundException) {
                $errors[] = $notFoundException->getMessage();
            }
        }*/


        return $this->response->renderView("perfil", "my", compact( 'user', 'errors', 'router' ));
    }

    /**
     * @return string
     * @throws ModelException
     */
    public function filterUsuario(): string
    {
        // S'executa amb el POST
        $title = "BackOffice | Usuarios";
        $errors = [];
        $usuarioModel = null;
        $usuarios = null;

        $router = App::get(Router::class);

        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

        $tipo_busqueda = filter_input(INPUT_POST, "optradio", FILTER_SANITIZE_STRING);

        if (!empty($text)) {
            $usuarioModel = App::getModel(UsuarioModel::class);

            if ($tipo_busqueda == "both") {
                $usuarios = $usuarioModel->executeQuery("SELECT * FROM usuario WHERE username LIKE :text OR email LIKE :text",
                    ["text" => "%$text%"]);


            }
            if ($tipo_busqueda == "username") {
                $usuarios = $usuarioModel->executeQuery("SELECT * FROM usuario WHERE username LIKE :text",
                    ["text" => "%$text%"]);


            }
            if ($tipo_busqueda == "email") {
                $usuarios = $usuarioModel->executeQuery("SELECT * FROM usuario WHERE email LIKE :text",
                    ["text" => "%$text%"]);
            }

        } else {
            $error = "Hay que introducir una palabra de búsqueda";
        }

        return $this->response->renderView("back/back-usuarios", "back", compact('title', 'usuarios',
            'usuarioModel', 'errors', 'router'));
    }

public function createUsuario(): string
{

    $title = "SignUp";
    $router = App::get(Router::class);

    return $this->response->renderView("usuarios-create-form", "my", compact('title', 'router'));
}




    /**
     * @return string
     * @throws Exception
     */
    public function storeUsuario(): string
    {
        $errors = [];


        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $telefono = filter_input(INPUT_POST, "telefono", FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");
        $repitePassword = filter_input(INPUT_POST, "repitePassword");
        $avatar = filter_input(INPUT_POST, "avatar");

        if (empty($nombre)) {
            $errors[] = "El nombre es obligatorio";
        }
        if (empty($apellidos)) {
            $errors[] = "Los apellidos son obligatorios";
        }

        if (empty($telefono)) {
            $errors[] = "El teléfono es obligatorio";
        }

        if (empty($email)) {
            $errors[] = "El email es obligatorio";
        }

        if (empty($username)) {
            $errors[] = "El username es obligatorio";
        }

        if (empty($password)) {
            $errors[] = "El password es obligtorio";
        }

        if(empty($repitePassword)){

            $errors[] = "Debe repetir el password";
        }

        if($repitePassword !== $password){

            $errors[] = "Debe introcir el mismo password";
        }

        // Si hay errores no necesitamos subir la imagen
        if (empty($errors)) {
            try {
                $uploadedFile = new UploadedFile("avatar", 2000 * 1024, ["image/jpeg", "image/jpg", "image/png"]);
                if ($uploadedFile->validate()) {
                    $uploadedFile->save(Usuario::AVATAR_PATH);
                    $avatar = $uploadedFile->getFileName();
                }
            } catch (Exception $exception) {
                $errors[] = "Error uploading file ($exception)";
            }
        }


        if (empty($errors)) {


            try {
                $usuarioModel = App::getModel(UsuarioModel::class);
                $usuario = new Usuario();

                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setTelefono($telefono);
                $usuario->setEmail($email);
                $usuario->setUsername($username);
                $usuario->setPassword($password);
                $usuario->setAvatar($avatar);
                $usuario->setRole("ROLE_USER");



                $usuarioModel->saveTransaction($usuario);
                App::get(MyLogger::class)->info("Se ha creado un nuevo usuario");

            } catch (PDOException | ModelException | Exception $e) {
                $errors[] = "Error: " . $e->getMessage();
            }
        }

        if (empty($errors)) {
            App::get('flash')->set("message", "Se ha registrado correctamente");
            App::get(Router::class)->redirect("login");
        }

        return $this->response->renderView("auth/login", "my", compact(
            "errors", "nombre"));
    }

    public function registrarUsuario(): string
    {
        $errors = [];

        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $telefono = filter_input(INPUT_POST, "telefono", FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");
        $repitePassword = filter_input(INPUT_POST, "repitePassword");

        if (empty($nombre)) {
            $errors[] = "El nombre es obligatorio";
        }
        if (empty($apellidos)) {
            $errors[] = "Los apellidos son obligatorios";
        }

        if (empty($telefono)) {
            $errors[] = "El teléfono es obligatorio";
        }

        if (empty($email)) {
            $errors[] = "El email es obligatorio";
        }

        if (empty($username)) {
            $errors[] = "El username es obligatorio";
        }

        if (empty($password)) {
            $errors[] = "El password es obligtorio";
        }

        if(empty($repitePassword)){

            $errors[] = "Debe repetir el password";
        }

        if($repitePassword !== $password){

            $errors[] = "Debe introcir el mismo password";
        }

        $password = App::get("security")->encode($password);

        if (empty($errors)) {
            try {
                $usuarioModel = App::getModel(UsuarioModel::class);
                $usuario = new Usuario();

                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setTelefono($telefono);
                $usuario->setEmail($email);
                $usuario->setUsername($username);
                $usuario->setPassword($password);
                $usuario->setRole("ROLE_USER");

                $usuarioModel->saveTransaction($usuario);
                App::get(MyLogger::class)->info("Se ha registrado un nuevo usuario");

            } catch (PDOException | ModelException | Exception $e) {
                $errors[] = "Error: " . $e->getMessage();

            }
        }

        if (empty($errors)) {
            App::get('flash')->set("message", "Se ha registrado correctamente");
            //App::get(Router::class)->redirect("login");

        } else {

            App::get('flash')->set("message", "No se ha podido registrar");


        }

        return $this->response->renderView("", "my", compact(
            "errors", "nombre", "message"));
    }

    /**
     * @param int $id
     * @return string
     * @throws Exception
     */
    public function updateUsuario(int $id): string
    {

        $errors = [];
        $isGetMethod = false;
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $telefono = filter_input(INPUT_POST, "telefono", FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $username = filter_input(INPUT_POST, "username");
        $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_STRING);
        $avatar = filter_input(INPUT_POST, "avatar");


        if (empty($nombre)) {
            $errors[] = "El nombre es obligatorio";
        }
        if (empty($apellidos)) {
            $errors[] = "Los apellidos son obligatorios";
        }

        if (empty($telefono)) {
            $errors[] = "El teléfono es obligatorio";
        }

        if (empty($email)) {
            $errors[] = "El email es obligatorio";
        }

        if (empty($username)) {
            $errors[] = "El username es obligatorio";
        }

        if (empty($role)) {
            $errors[] = "El rol es obligatorio";
        }

        // Si hay errores no necesitamos subir la imagen
        if (empty($errors)) {
            try {
                $uploadedFile = new UploadedFile("avatar", 2000 * 1024, ["image/jpeg", "image/jpg", "image/png"]);
                if ($uploadedFile->validate()) {
                    $uploadedFile->save(Usuario::AVATAR_PATH);
                    $avatar = $uploadedFile->getFileName();
                }
            } catch (Exception $exception) {
                $errors[] = "Error uploading file ($exception)";
            }
        }

        if (empty($errors)) {

            try {

                $usuarioModel = App::getModel(UsuarioModel::class);
                // getting the partner by its identifier
                $usuario = $usuarioModel->find($id);
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setTelefono($telefono);
                $usuario->setEmail($email);
                $usuario->setUsername($username);
                $usuario->setRole($role);
                $usuario->setAvatar($avatar);

                // updating changes
                $usuarioModel->update($usuario);
            } catch (Exception $e) {
                $errors[] = 'Error: ' . $e->getMessage();
            }
        }
        return $this->response->renderView("usuarios-edit-back", "back", compact(
            "errors", "isGetMethod", "usuario"));
    }



    public function editUsuario(int $id): string
    {
        $isGetMethod = true;
        $errors = [];
        $usuarioModel = App::getModel(UsuarioModel::class);
        $usuario = null;

        if (empty($id)) {
            $errors[] = '404 No encontrado';
        } else {
            $usuario = $usuarioModel->find($id);

        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isGetMethod = false;

            $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
            if (empty($id)) {
                $errors[] = "ID Erronea";
            }

            $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $telefono = filter_input(INPUT_POST, "telefono", FILTER_VALIDATE_INT);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $username = filter_input(INPUT_POST, "username");

            if (empty($nombre)) {
                $errors[] = "El nombre es obligatorio";
            }
            if (empty($apellidos)) {
                $errors[] = "Los apellidos son obligatorios";
            }

            if (empty($telefono)) {
                $errors[] = "El teléfono es obligatorio";
            }

            if (empty($email)) {
                $errors[] = "El email es obligatorio";
            }

            if (empty($username)) {
                $errors[] = "El username es obligatorio";
            }


            if (empty($errors)) {
                try {
                    // Instead of creating a new object we load the current data object.
                    $usuario = $usuarioModel->find($id);

                    //then we set the new values
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellidos);
                    $usuario->setTelefono($telefono);
                    $usuario->setEmail($email);
                    $usuario->setUsername($username);

                    $usuario->update($usuario);

                } catch (PDOException $e) {
                    $errors[] = "Error: " . $e->getMessage();
                }
            }
        }

        return $this->response->renderView("usuarios-edit-back", "back", compact(
            "errors", "isGetMethod", "usuario"));
    }


    public function editPerfilUsuario(int $id): string
    {
        $isGetMethod = true;
        $errors = [];
        $usuarioModel = App::getModel(UsuarioModel::class);
        $usuario = null;

        if (empty($id)) {
            $errors[] = '404 No encontrado';
        } else {
            $usuario = $usuarioModel->find($id);

        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isGetMethod = false;

            $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
            if (empty($id)) {
                $errors[] = "ID Erronea";
            }

            $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $telefono = filter_input(INPUT_POST, "telefono", FILTER_VALIDATE_INT);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $username = filter_input(INPUT_POST, "username");

            if (empty($nombre)) {
                $errors[] = "El nombre es obligatorio";
            }
            if (empty($apellidos)) {
                $errors[] = "Los apellidos son obligatorios";
            }

            if (empty($telefono)) {
                $errors[] = "El teléfono es obligatorio";
            }

            if (empty($email)) {
                $errors[] = "El email es obligatorio";
            }

            if (empty($username)) {
                $errors[] = "El username es obligatorio";
            }


            if (empty($errors)) {
                try {
                    // Instead of creating a new object we load the current data object.
                    $usuario = $usuarioModel->find($id);

                    //then we set the new values
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellidos);
                    $usuario->setTelefono($telefono);
                    $usuario->setEmail($email);
                    $usuario->setUsername($username);

                    $usuario->update($usuario);

                } catch (PDOException $e) {
                    $errors[] = "Error: " . $e->getMessage();
                }
            }
        }

        return $this->response->renderView("usuarios-edit", "my", compact(
            "errors", "isGetMethod", "usuario"));
    }


    /**
     * @param int $id
     * @return string
     * @throws Exception
     */
    public function updatePerfilUsuario(int $id): string
    {

        $errors = [];
        $isGetMethod = false;
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $telefono = filter_input(INPUT_POST, "telefono", FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $username = filter_input(INPUT_POST, "username");
        $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_STRING);
        $avatar = filter_input(INPUT_POST, "avatar");


        if (empty($nombre)) {
            $errors[] = "El nombre es obligatorio";
        }
        if (empty($apellidos)) {
            $errors[] = "Los apellidos son obligatorios";
        }

        if (empty($telefono)) {
            $errors[] = "El teléfono es obligatorio";
        }

        if (empty($email)) {
            $errors[] = "El email es obligatorio";
        }

        if (empty($username)) {
            $errors[] = "El username es obligatorio";
        }

        if(!empty($user) && $user->getRole() === "ROLE_ADMIN") {
            if (empty($role)) {
                $errors[] = "El rol es obligatorio";
            } else {

            }
        }

        // Si hay errores no necesitamos subir la imagen
        if (empty($errors)) {
            try {
                $uploadedFile = new UploadedFile("avatar", 2000 * 1024, ["image/jpeg", "image/jpg", "image/png"]);
                if ($uploadedFile->validate()) {
                    $uploadedFile->save(Usuario::AVATAR_PATH);
                    $avatar = $uploadedFile->getFileName();
                }
            } catch (Exception $exception) {
                $errors[] = "Error uploading file ($exception)";
            }
        }

        if (empty($errors)) {

            try {

                $usuarioModel = App::getModel(UsuarioModel::class);
                // getting the partner by its identifier
                $usuario = $usuarioModel->find($id);
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setTelefono($telefono);
                $usuario->setEmail($email);
                $usuario->setUsername($username);
                $usuario->setAvatar($avatar);
                if(!empty($user) && $user->getRole() === "ROLE_ADMIN") {
                    $usuario->setRole($role);
                }

                // updating changes
                $usuarioModel->update($usuario);
            } catch (Exception $e) {
                $errors[] = 'Error: ' . $e->getMessage();
            }
        }
        return $this->response->renderView("usuarios-edit", "my", compact(
            "errors", "isGetMethod", "usuario"));
    }

    public function editPassUsuario(int $id): string
    {
        $isGetMethod = true;
        $errors = [];
        $usuarioModel = App::getModel(UsuarioModel::class);
        $usuario = null;

        if (empty($id)) {
            $errors[] = '404 No encontrado';
        } else {
            $usuario = $usuarioModel->find($id);

        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isGetMethod = false;

            $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
            if (empty($id)) {
                $errors[] = "ID Erronea";
            }

            $password = filter_input(INPUT_POST, "password");
            $repitePassword = filter_input(INPUT_POST, "repitePassword");

            if (empty($password)) {
                $errors[] = "El password es obligtorio";
            }

            if(empty($repitePassword)){

                $errors[] = "Debe repetir el password";
            }

            if($repitePassword !== $password){

                $errors[] = "Debe introcir el mismo password";
            }


            if (empty($errors)) {
                try {
                    // Instead of creating a new object we load the current data object.
                    $usuario = $usuarioModel->find($id);

                    //then we set the new values
                    $usuario->setPassword($password);

                    $usuario->update($usuario);

                } catch (PDOException $e) {
                    $errors[] = "Error: " . $e->getMessage();
                }
            }
        }

        return $this->response->renderView("usuarios-edit-pass", "my", compact(
            "errors", "isGetMethod", "usuario"));
    }

    public function updatePassUsuario(int $id): string
    {

        $errors = [];
        $isGetMethod = false;
        $password = filter_input(INPUT_POST, "password");
        $repitePassword = filter_input(INPUT_POST, "repitePassword");

        if (empty($password)) {
            $errors[] = "El password es obligtorio";
        }

        if(empty($repitePassword)){

            $errors[] = "Debe repetir el password";
        }

        if($repitePassword !== $password){

            $errors[] = "Debe introcir el mismo password";
        }



        if (empty($errors)) {

            try {

                $usuarioModel = App::getModel(UsuarioModel::class);
                // Instead of creating a new object we load the current data object.
                $usuario = $usuarioModel->find($id);

                //then we set the new values
                $usuario->setPassword($password);

                // updating changes
                $usuarioModel->update($usuario);
            } catch (Exception $e) {
                $errors[] = 'Error: ' . $e->getMessage();
            }
        }
        return $this->response->renderView("usuarios-edit", "my", compact(
            "errors", "isGetMethod", "usuario"));
    }


    public function deleteUsuario(int $id): string
    {
        $errors = [];
        $usuario = null;
        $usuarioModel = App::getModel(UsuarioModel::class);

        if (empty($id)) {
            $errors[] = '404 Not Found';
        } else {
            try {
                $usuario = $usuarioModel->find($id);
            } catch (NotFoundException $e) {

                $errors[] = '404 Usuario no encontrado';

            }
        }

        $router = App::get(Router::class);
        $avatarPath = App::get("config")["avatar_path"];

        return $this->response->renderView("usuarios-delete", "back", compact(
            "errors", "usuario", 'router', 'avatarPath'));
    }

    /**
     * @return string
     * @throws ModelException
     * @throws NotFoundException
     */
    public function destroyUsuario(): string
    {
        $errors = [];
        $usuarioModel = App::getModel(UsuarioModel::class);
        $usuario = null;

        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        if (empty($id)) {
            $errors[] = '404 Not Found';
        } else {
            $usuario = $usuarioModel->find($id);
        }
        $userAnswer = filter_input(INPUT_POST, "userAnswer");


        if ($userAnswer === 'yes') {
            if (empty($errors)) {
                try {
                    $usuario = $usuarioModel->find($id);
                    $result = $usuarioModel->delete($usuario);

                } catch (PDOException $e) {
                    $errors[] = "Error: " . $e->getMessage();
                }
            }
        }
        else
            App::get(Router::class)->redirect('back-usuarios');

        if (!empty($errors))

            App::get(Router::class)->redirect('back-usuarios');
        else

            return $this->response->renderView("usuarios-destroy", "back",
                compact("errors", "usuario"));

        return "";
    }
}