<?php
session_start();

require_once('App/Controller/Controller.php');
require_once('App/Router/Route.php');
require_once('App/Router/Router.php');
require_once('App/Router/Authenticate.php');

$router = new Router();
$controller = new Controller();

$router->addRoute(new Route(
    [
        'url' => '/',
        'action' => 'listPosts',
        'middleware' => '',
        'vars' => []
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/post/[0-9]+',
        'action' => 'post',
        'middleware' => '',
        'vars' => [
            'id'
        ]
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/admin',
        'action' => 'adminPanel',
        'middleware' => 'Authenticate',
        'vars' => []
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/login',
        'action' => 'login',
        'middleware' => '',
        'vars' => []
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/addComment/[0-9]+',
        'action' => 'addComment',
        'middleware' => '',
        'vars' => [
            'id'
        ]
    ]
));

try {
    $route = $router->getRoute($_SERVER['REQUEST_URI']);
}
catch (Exception $e)
{
    echo $e;
}

if (!empty($middleware = $route->getMiddleware()))
{
    $middleware = new $middleware();
    $middleware();
}

$urlvars = explode('/', $_SERVER['REQUEST_URI']);
$urlvars = array_slice($urlvars, 2);

$_GET = array_combine($route->getVars(), $urlvars);

$action = $route->getAction();
$controller->$action();
