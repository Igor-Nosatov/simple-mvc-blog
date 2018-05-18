<?php
namespace App;

class App
{
    private $router;
    private $controller;
    private $httpRequest;
    private $httpResponse;

    public function __construct()
    {
        $this->router = new \App\Router\Router();
        $this->httpRequest= new \App\Router\HTTPRequest();
        $this->httpResponse = new \App\Router\HTTPResponse();
    }

    public function run()
    {
        session_start();

        $routes = require('../App/Config/routes.php');
       
        foreach ($routes as $route) {
            $this->router->addRoute(new \App\Router\Route($route));
        }
        
        try {
            $route = $this->router->getRoute($this->httpRequest->getURI());
        } catch (\Exception $e) {
            if ($e->getCode() == '404') {
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
