<?php
namespace App\Router;

/**
 * Represents a single route
 */
class Route
{
    private $url,
            $action,
            $middleware,
            $vars;

    public function __construct(array $data)
    {
        $this->setUrl($data['url']);
        $this->setAction($data['action']);
        $this->setMiddleware($data['middleware']);
        $this->setVars($data['vars']);
    }

    /**
     * Uses regex to check if the route matches the url
     *
     * @param string $url
     * @return array|null
     */
    public function match(string $url) : ?array
    {
        if (preg_match('#^' . $this->url . '$#', $url, $matches))
        {
            return $matches;
        }
        else
        {
            return null;
        }
    }

    public function setUrl($url)
    {
        if (is_string($url))
        {
            $this->url = $url;
        }
    }

    public function setAction($action)
    {
        if (is_string($action))
        {
            $this->action = $action;
        }
    }

    public function setMiddleware($middleware)
    {
        if (is_string($middleware))
        {
            $this->middleware = $middleware;
        }
    }

    public function setVars($vars)
    {
        $this->vars = $vars;
    }

    public function getUrl() : string
    {
        return $this->url;
    }

    public function getAction() : string
    {
        return $this->action;
    }

    public function getMiddleware() : string
    {
        return $this->middleware;
    }

    public function getVars() : array
    {
        return $this->vars;
    }
}
