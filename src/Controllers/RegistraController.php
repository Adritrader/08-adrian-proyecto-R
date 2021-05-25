<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Core\Exception\ModelException;
use App\Core\Router;
use App\Entity\Registra;
use App\Core\App;
use App\Model\RegistraModel;
use App\Model\ServicioModel;
use App\Model\UsuarioModel;
use App\Utils\MyLogger;
use DateTime;
use Exception;
use PDOException;

/**
 * Class ProductoController
 * @package App\Controllers
 */
class RegistraController extends Controller {


    public function index(): string
    {

        $title = "BackOffice | Reservas";
        $errors = [];
        $registraModel = App::getModel(RegistraModel::class);
        $registra = $registraModel->findAll();
        $servicioModel = App::getModel(ServicioModel::class);
        $servicios = $servicioModel->findAll();

        $order = filter_input(INPUT_GET, "order", FILTER_SANITIZE_STRING);

        if (!empty($_GET['order'])) {
            $orderBy = [$_GET["order"] => $_GET["tipo"]];
            try {
                $registra = $registraModel->findAll($orderBy);
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }

        $router = App::get(Router::class);

        $message = App::get("flash")::get("message");


        return $this->response->renderView("back/back-reservas", "back", compact('title', 'registra', "servicios",
            'registraModel', 'errors', 'router', 'message'));

    }

    /**
     * @return string
     * @throws ModelException
     */
    public function filterRegistra(): string
    {
        // S'executa amb el POST
        $title = "BackOffice | Reservas";
        $errors = [];
        $registraModel = null;
        $registra = null;

        $router = App::get(Router::class);

        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

        $tipo_busqueda = filter_input(INPUT_POST, "optradio", FILTER_SANITIZE_STRING);

        if (!empty($text)) {
            $registraModel = App::getModel(RegistraModel::class);
            if ($tipo_busqueda == "both") {
                $registra = $registraModel->executeQuery("SELECT * FROM registra WHERE hora LIKE :text OR fecha LIKE :text",
                    ["text" => "%$text%"]);

            }
            if ($tipo_busqueda == "hora") {
                $registra = $registraModel->executeQuery("SELECT * FROM registra WHERE hora LIKE :text",
                    ["text" => "%$text%"]);

            }
            if ($tipo_busqueda == "fecha") {
                $registra = $registraModel->executeQuery("SELECT * FROM registra WHERE fecha LIKE :text",
                    ["text" => "%$text%"]);
            }

        } else {
            $error = "Debe introducir una palabra de búsqueda";
        }

        return $this->response->renderView("back/back-reservas", "back", compact('title', 'registra',
            'registraModel', 'errors', 'router'));
    }

    public function createRegistra(): string
    {

        $title = "Reserva cita";
        $errors = [];
        $servicioModel = App::getModel(ServicioModel::class);
        $servicios= $servicioModel->findAll();
        $router = App::get(Router::class);
        $usuarioModel = App::getModel(UsuarioModel::class);
        $user = $usuarioModel->find($_SESSION["loggedUser"]);

        return $this->response->renderView("reservas-create-form", "my", compact('title', 'router', 'servicios', 'errors', 'user', 'router'));
    }


    /**
     * @return string
     * @throws Exception
     */
    public function storeRegistra(): string
    {
        $errors = [];


        $USUARIO_id = filter_input(INPUT_POST, "USUARIO_id", FILTER_VALIDATE_INT);
        $SERVICIO_id = filter_input(INPUT_POST, "SERVICIO_id", FILTER_VALIDATE_INT);
        $hora_cita = filter_input(INPUT_POST, "hora_cita");



        if (empty($USUARIO_id)) {
            $errors[] = "El nombre es obligatorio";
        }
        if (empty($SERVICIO_id)) {
            $errors[] = "El servicio es obligatorios";
        }

        $fecha_cita = DateTime::createFromFormat("Y-m-d", $_POST["fecha_cita"]);

        if (empty($fecha_cita)) {
            $errors[] = "La fecha es obligatoria";
        }

        $hora_cita = DateTime::createFromFormat("H:i:s", $_POST["hora_cita"]);

        if (empty($hora_cita)) {
            $errors[] = "La hora es obligatoria";
        }


        if (empty($errors)) {
            try {
                $registraModel = App::getModel(RegistraModel::class);
                $registra = new Registra();

                $registra->setUSUARIOId($USUARIO_id);
                $registra->setSERVICIOId($SERVICIO_id);
                $registra->setFechaCita($fecha_cita);
                $registra->setHoraCita($hora_cita);


                $registraModel->saveTransaction($registra);
                App::get(MyLogger::class)->info("Se ha creado una nueva reserva");
                App::get('flash')->set("message", "La reserva se ha creado correctamente");
                $message = "La reserva se ha creado correctamente";

            } catch (PDOException | ModelException | Exception $e) {
                $errors[] = "Error: " . $e->getMessage();
            }
        }

        if (!empty($errors)) {
            App::get('flash')->set("message", "La reserva no se ha podido crear");
            $message = "No se ha podido crear la reserva";
            App::get(Router::class)->redirect("login");

        }

        return $this->response->renderView("auth/login", "my", compact(
             'errors', "message"));
    }

}