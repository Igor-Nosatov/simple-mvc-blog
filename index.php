<?php
session_start();

spl_autoload_register(function($class) {
    $class = str_replace('\\', '/', $class);
    require_once(__DIR__ . '/' . $class . '.php');
});

$router = new App\Router\Router();
$controller = new App\Controller\Controller();
$httpRequest= new App\Router\HTTPRequest();
$httpResponse = new App\Router\HTTPResponse();

use App\Router\Route;

require('App/Config/routes.php');

foreach ($routes as $route)
{
    $router->addRoute(new Route($route));
}

try {
    $route = $router->getRoute($httpRequest->getURI());
}
catch (\Exception $e)
{
    if ($e->getCode() == '404')
    {
        $httpResponse->redirect404();
    }
}

if (!empty($middleware = $route->getMiddleware()))
{
    $middleware = new $middleware();
    $middleware($route->getUrl(), $httpResponse);
}

$urlvars = explode('/', $_SERVER['REQUEST_URI']);
$urlvars = array_slice($urlvars, 2);

$_GET = array_combine($route->getVars(), $urlvars);

$action = $route->getAction();
$controller->$action($httpRequest);
