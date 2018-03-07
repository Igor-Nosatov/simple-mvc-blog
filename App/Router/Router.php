<?php
namespace App\Router;

class router
{
    private $routes = [];

    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * Checks all the routes for one matching the url
     *
     * @param string $url
     * @return Route the matching route
     */
    public function getRoute(string $url) : Route
    {
        foreach ($this->routes as $route)
        {
            if ($route->match($url))
            {
                return $route;
            }
        }
        throw new \Exception('No route', 404);
    }
}
