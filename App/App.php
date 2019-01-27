<?php
namespace App;

use \App\Router\Router;
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

        $route = $this->router->getRoute($this->httpRequest->getURI());

        if ($route === null) {
            $this->httpResponse->redirect404();
        }

        $_GET = $route->getVars();

        if (($middleware = $route->getMiddleware()) !== null) {
            $middleware = new $middleware();
            $middleware($route->getUrl(), $this->httpResponse);
        }

        $action = $route->getAction();
        $controller = __NAMESPACE__ . '\Controller\\' . $route->getController();
        $this->controller = new $controller();
        $this->controller->$action($this->httpRequest);
    }
}
