<?php
namespace App\Router;

class router
{
    private $routes = [];

    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getRoute(string $url)
    {
        foreach ($this->routes as $route)
        {
            if ($route->match($url))
            {
                return $route;
            }
        }
        throw new Exception('No route');
    }
}
