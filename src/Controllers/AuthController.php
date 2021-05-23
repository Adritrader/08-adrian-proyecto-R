<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Router;
use App\Core\App;
use App\Model\UsuarioModel;



class AuthController extends Controller
{
    public function login()
    {
        $message = App::get('flash')::get('message');
        return $this->response->renderView('auth/login', 'my', compact('message'));
    }

    public function checkLogin()
    {
        $messages = [];
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        if (password_verify("contrenya-errònia", $pass_hash)) {
            // Contrasenya correcta
        } else {
            // Contrasenya incorrecta
        }

        if (!empty($username) && !empty($password)) {
            $pdo = App::get("DB");
            $usuarioModel = new UsuarioModel($pdo);
            $router = App::get(Router::class);
            $usuario = $usuarioModel->findOneBy(['username' => $username]);

            if(empty($usuario)){

                App::get('flash')->set("message", "No se ha podido conectar");
                App::get("redirect")->redirect("login");

            }

            if ($usuario->getUsername() == $username && $usuario->getPassword() == $password){

                $_SESSION["loggedUser"] = $usuario->getId();
                session_regenerate_id(true);

                App::get('flash')->set("message", "Se ha conectado correctamente");
                App::get("redirect")->redirect("login");

            }


        }
        App::get('flash')->set("message", "No se ha podido iniciar sesion");
        App::get("redirect")->redirect("login");
    }

    public function logout()
    {


        session_unset();
        unset($_SESSION);
        session_destroy();
        setcookie(session_name());
        $message = "Se ha desconectado";
        return $this->response->renderView('auth/login', 'my', compact('message'));

    }
}