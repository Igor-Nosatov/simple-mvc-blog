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

$router->addRoute(new Route(
    [
        'url' => '/authenticate',
        'action' => 'authenticate',
        'middleware' => '',
        'vars' => []
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/addPost',
        'action' => 'addPost',
        'middleware' => 'Authenticate',
        'vars' => []
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/updatePost/[0-9]+',
        'action' => 'updatePost',
        'middleware' => 'Authenticate',
        'vars' => [
            'id'
        ]
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/executeUpdatePost',
        'action' => 'executeUpdatePost',
        'middleware' => 'Authenticate',
        'vars' => []
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/deletePost/[0-9]+',
        'action' => 'deletePost',
        'middleware' => 'Authenticate',
        'vars' => [
            'id'
        ]
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/flagComment/[0-9]+',
        'action' => 'flagComment',
        'middleware' => '',
        'vars' => [
            'id'
        ]
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/deleteComment/[0-9]+',
        'action' => 'deleteComment',
        'middleware' => 'Authenticate',
        'vars' => [
            'id'
        ]
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/unflagComment/[0-9]+',
        'action' => 'unflagComment',
        'middleware' => 'Authenticate',
        'vars' => [
            'id'
        ]
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/writePost',
        'action' => 'writePost',
        'middleware' => 'Authenticate',
        'vars' => []
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
    $middleware($route->getUrl());
}

$urlvars = explode('/', $_SERVER['REQUEST_URI']);
$urlvars = array_slice($urlvars, 2);

$_GET = array_combine($route->getVars(), $urlvars);

$action = $route->getAction();
$controller->$action();
