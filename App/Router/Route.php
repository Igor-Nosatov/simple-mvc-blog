<?php

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

    public function match(string $url)
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

    public function getUrl()
    {
        return $this->url;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getMiddleware()
    {
        return $this->middleware;
    }

    public function getVars()
    {
        return $this->vars;
    }
}
