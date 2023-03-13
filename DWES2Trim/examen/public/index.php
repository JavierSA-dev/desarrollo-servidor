<?php 
include '../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Router;
use App\Controllers\MultasController;
use App\Controllers\AuthController;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

define('DBHOST', $_ENV['DB_HOST']);
define('DBNAME', $_ENV['DB_NAME']);
define('DBUSER', $_ENV['DB_USER']);
define('DBPASS', $_ENV['DB_PASS']);
define('DBPORT', $_ENV['DB_PORT']);

session_start();
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = 'guest';
    // $_SESSION['id'] = 0;
}

if (isset($_SESSION["estado"])) {
    if ($_SESSION["estado"] == "Bloqueado") {
        $_SESSION['error'] = 'Usuario bloqueado';
        header('Location: http://examen.localhost/');
    }
}

$router = new Router();
$router->add(array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action' => [MultasController::class, 'IndexAction']
));

$router->add(array(
    'name' => 'addMulta',
    'path' => '/addMulta\/?$/',
    'action' => [MultasController::class, 'addMultaAction']
));

$router->add(array(
    'name' => 'pagarMulta',
    'path' => '/pagar\/[0-9]*$/',
    'action' => [MultasController::class, 'pagarAction']
));

$router->add(array(
    'name' => 'admin',
    'path' => '/admin\/?$/',
    'action' => [MultasController::class, 'adminAction']
));

// listmultas
$router->add(array(
    'name' => 'listmultas',
    'path' => '/listmultas\/?$/',
    'action' => [MultasController::class, 'listmultasAction']
));

// $router->add(array(
//     'name' => 'deleteReceta',
//     'path' => '/delete\/[0-9]*$/',
//     'action' => [RecetasController::class, 'deleteRecetaAction']
// ));

// $router->add(array(
//     'name' => 'search',
//     'path' => '/search\/?$/',
//     'action' => [MultasController::class, 'searchAction']
// ));

$router->add(array(
    'name' => 'logout',
    'path' => '/logout\/?$/',
    'action' => [AuthController::class, 'logoutAction']
));

$request = $_SERVER['REQUEST_URI'];

$route = $router->match($request);
if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
}
