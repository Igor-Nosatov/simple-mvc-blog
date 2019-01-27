<?php
namespace App\Router;

class Router
{
    /**
     * @var Route[] $routes
     */
    private $routes;

    public function __construct()
    {
        $this->routes = $this->fetchRoutes();
    }

    /**
     * @return Route[]
     */
    private function fetchRoutes() : array
    {
        $configuredRoutes = require __DIR__ . '/../Config/routes.php';
        $routes = [];

        foreach ($configuredRoutes as $configuredRoute) {
            $routes[] = new Route($configuredRoute);
        }

        return $routes;
    }

    /**
     * @param string $url
     * @return Route|null
     */
    public function getRoute(string $url) : ?Route
    {
        foreach ($this->routes as $route) {
            if ($route->match($url)) {
                return $route;
            }
        }

        return null;
    }
}
