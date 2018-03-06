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
        'middleware' => '\App\Router\Authenticate',
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
        'middleware' => '\App\Router\Authenticate',
        'vars' => []
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/updatePost/[0-9]+',
        'action' => 'updatePost',
        'middleware' => '\App\Router\Authenticate',
        'vars' => [
            'id'
        ]
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/executeUpdatePost/[0-9]+',
        'action' => 'executeUpdatePost',
        'middleware' => '\App\Router\Authenticate',
        'vars' => [
            'id'
        ]
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/deletePost/[0-9]+',
        'action' => 'deletePost',
        'middleware' => '\App\Router\Authenticate',
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
        'middleware' => '\App\Router\Authenticate',
        'vars' => [
            'id'
        ]
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/unflagComment/[0-9]+',
        'action' => 'unflagComment',
        'middleware' => '\App\Router\Authenticate',
        'vars' => [
            'id'
        ]
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/writePost',
        'action' => 'writePost',
        'middleware' => '\App\Router\Authenticate',
        'vars' => []
    ]
));

$router->addRoute(new Route(
    [
        'url' => '/posts/[0-9]+',
        'action' => 'listPosts',
        'middleware' => '',
        'vars' => [
            'page'
        ]
    ]
));

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
