<?php

require_once("../vendor/autoload.php");
// require_once("../app/Config/config.php");
// include_once("./Data/datoscomment.php");
// include_once("./Data/datosblog.php");
use App\Core\Router;
use App\Core\Bootstrap;
use Illuminate\Database\Capsule\Manager as Capsule;
use Laminas\Diactoros\ServerRequestFactory;
use Aura\Router\RouterContainer;

Bootstrap::getEnvData();


$capsule = new Capsule;
$routerContainer = new RouterContainer();

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => DBHOST,
    'database' => DBNAME,
    'username' => DBUSER,
    'password' => DBPASS,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);
session_start();

if (!isset($_SESSION['perfil'])) {
    $_SESSION['perfil'] = 'guest';
}
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = 'Anonimo';
}

$map = $routerContainer->getMap();


$map->get('index', "/", [
    'controller' => 'App\Controllers\IndexController',
    'action' => 'index'
]);

$map->get("about", "/about", [
    'controller' => 'App\Controllers\IndexController',
    'action' => 'about'
]);

$map->get("contact", "/contact", [
    'controller' => 'App\Controllers\IndexController',
    'action' => 'contact'
]);

// logout
$map->get("logout", "/logout", [
    'controller' => 'App\Controllers\UserController',
    'action' => 'logoutAction'
]);

$map->get('addBlog', "/blogs/add", [
    'controller' => 'App\Controllers\BlogController',
    'action' => 'addBlogAction',
    'auth' => true
]);
$map->post("comentar", "/comment/save", [
    'controller' => 'App\Controllers\CommentController',
    'action' => 'saveCommentAction',
]);

$map->post('saveBlog', "/blogs/add", [  
    'controller' => 'App\Controllers\BlogController',
    'action' => 'addBlogAction',
    'auth' => true
]);
$map->get('getBlog','/blog/{id}', [
    'controller' => 'App\Controllers\BlogController',
    'action' => 'getBlogAction'
])->tokens(['id' => '\d+']);

$map->get('addUser', "/users/add", [
    'controller' => 'App\Controllers\UserController',
    'action' => 'addUserAction',
    'auth' => true
]);
$map->post('saveUser', "/users/save", [
    'controller' => 'App\Controllers\UserController',
    'action' => 'addUserAction',
    'auth' => true
]);
$map->get('getLogin', "/auth", [
    'controller' => 'App\Controllers\UserController',
    'action' => 'loginAction'
]);
$map->post('login', "/auth", [
    'controller' => 'App\Controllers\UserController',
    'action' => 'loginAction'
]);
$map->get('admin', "/admin", [
    'controller' => 'App\Controllers\AdminController',
    'action' => 'adminDashboard',
    'auth' => true
]);



// $map->get('about', "/about", [
//     'controller' => 'App\Controllers\IndexController',
//     'action' => 'about'
// ]);

$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);

if (!$route) {
    echo "No route";
} else {
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];

    $needsAuth = $handlerData['auth'] ?? false;
    $sessionUserId = $_SESSION['userId'] ?? null;
    if ($needsAuth && !$sessionUserId) {
        header('Location: /auth');
    } else {
        $controller = new $controllerName;
        $response = $controller->$actionName($request);
        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }
        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }
}
