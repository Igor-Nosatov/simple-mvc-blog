<?php
namespace App;

use \App\Router\{Router, Route, HTTPRequest, HTTPResponse};

class App
{
    private $router;
    private $controller;
    private $httpRequest;
    private $httpResponse;

    public function __construct()
    {
        $this->router = new Router();
        $this->httpRequest= new HTTPRequest();
        $this->httpResponse = new HTTPResponse();
    }

    public function run()
    {
        session_start();

        $routes = require('../App/Config/routes.php');
       
        foreach ($routes as $route) {
            $this->router->addRoute(new Route($route));
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
