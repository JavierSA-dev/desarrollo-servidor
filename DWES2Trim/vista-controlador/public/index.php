<?php
require_once('../app/Config/parametros.php');
require_once('../vendor/autoload.php');

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\NumberController;


$router = new Router();
$router->add(array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action' => [IndexController::class, 'IndexAction']
));

$router->add(array(
    'name' => 'saludo',
    'path' => '/\/saludo\/./',
    'action' => [IndexController::class, 'SaludoAction']

));

$router->add(array(
    'name' => 'numeros',
    'path' => '/\/numeros\//',
    'action' => [NumberController::class, 'paresAction']

));

$request = str_replace(DIRBASEURL, '', $_SERVER['REQUEST_URI']);
$route = $router->match($request);
if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
}
