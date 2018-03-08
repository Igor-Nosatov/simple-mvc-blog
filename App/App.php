<?php
namespace App;

class App
{
    private $router,
            $controller,
            $httpRequest,
            $httpResponse;

    public function __construct()
    {
        $this->router = new \App\Router\Router();
        $this->controller = new \App\Controller\Controller();
        $this->httpRequest= new \App\Router\HTTPRequest();
        $this->httpResponse = new \App\Router\HTTPResponse();
    }

    public function run()
    {
        session_start();
       
        require('App/Config/routes.php');
       
        foreach ($routes as $route)
        {
            $this->router->addRoute(new \App\Router\Route($route));
        }
        
        try {
            $route = $this->router->getRoute($this->httpRequest->getURI());
        }
        catch (\Exception $e)
        {
            if ($e->getCode() == '404')
            {
                $this->httpResponse->redirect404();
            }
        }

        if (!empty($middleware = $route->getMiddleware()))
        {
            $middleware = new $middleware();
            $middleware($route->getUrl(), $this->httpResponse);
        }

        $urlvars = explode('/', $this->httpRequest->getURI());
        $urlvars = array_slice($urlvars, 2);

        $_GET = array_combine($route->getVars(), $urlvars);

        $action = $route->getAction();
        $this->controller->$action($this->httpRequest);
    }
}
