<?php
namespace App;

use \App\Router\Router;
use \App\Router\Route;
use \App\Router\HTTPRequest;
use \App\Router\HTTPResponse;

class App
{
    private $router;
    private $controller;
    private $httpRequest;
    private $httpResponse;

    public function __construct()
    {
        $this->router = new Router();
        $this->httpRequest = new HTTPRequest();
        $this->httpResponse = new HTTPResponse();
    }

    public function run(): void
    {
        session_start();

        $routes = require __DIR__ . '/Config/routes.php';
       
        foreach ($routes as $route) {
            $this->router->addRoute(new Route($route));
        }
        
        try {
            $route = $this->router->getRoute($this->httpRequest->getURI());
        } catch (\Exception $e) {
            if ($e->getCode() === '404') {
                $this->httpResponse->redirect404();
            }
        }

        if (!empty($middleware = $route->getMiddleware())) {
            $middleware = new $middleware();
            $middleware($route->getUrl(), $this->httpResponse);
        }

        $_GET = $route->getParams();

        $action = $route->getAction();
        $controller = __NAMESPACE__ . '\Controller\\' . $route->getController();
        $this->controller = new $controller();
        $this->controller->$action($this->httpRequest);
    }
}
