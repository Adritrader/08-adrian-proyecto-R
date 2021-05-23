<?php

require_once __DIR__ . '/../vendor/autoload.php';



use App\Core\App;
use App\Core\Response;
use App\Database;
use App\Entity\Usuario;
use App\Model\UserModel;
use App\Model\RealizaModel;
use App\Utils\MyLogger;
use App\Utils\MyMail;
use App\Core\Helpers\FlashMessage;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use App\Core\Router;

ini_set('session.cookie_secure', "0");
ini_set('session.cookie_httponly', true);
session_start();

$sessionKey = "error";



$errors = $_SESSION[$sessionKey]??[];



if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    // last request was more than 15 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
    session_regenerate_id(true);
    header("Location: /login");

}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

$config = require_once __DIR__ . '/../config/config.php';

$_flash = new FlashMessage();
$redirect = new Router();
$usuario = new Usuario();

App::bind("redirect", $redirect);
App::bind("usuario", $usuario);
App::bind("flash", $_flash);
App::bind("config", $config);
App::bind("DB", Database::getConnection());
App::bind(Response::class, new Response());

$myLogger = new MyLogger("app");
$myLogger->pushHandler(new StreamHandler(__DIR__."/../{$config["logfile"]}", $config["loglevel"]));
App::bind(MyLogger::class, $myLogger);

// The load method acts as a factory. We pass the config
// data and returns a myMail object
$myMail = MyMail::load($config["mailer"]);
App::bind(MyMail::class, $myMail);

// we use the coalesce operator to check if loggedUser is set
// if not we assign 0 to $loggedUser.

$loggedUser = $_SESSION["loggedUser"] ?? 0;

//we check if loggedUser is a valid integer

$id = filter_var($loggedUser, FILTER_VALIDATE_INT);
if (!empty($id)) {
    try {
        App::bind('user', App::getModel(UserModel::class)->find($id));            
    } 
    catch (NotFoundException $notFoundException) {
        App::bind('user',null);            
    }
}
else
    App::bind('user', null);


// we use the coalesce operator to check if shoppingCart is set
// if not we assign an empty array to $shoppigCart.


$shoppingCart = $_SESSION["shoppingCart"] ?? [];

$cart = filter_var($shoppingCart);

if (!empty($cart)) {
    try {
        App::bind('cart', App::getModel(RealizaModel::class)->find($id));
    }
    catch (NotFoundException $notFoundException) {
        App::bind('cart',null);
    }
}
else
    App::bind('cart', null);

?>