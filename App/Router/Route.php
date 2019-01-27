<?php
namespace App\Router;

/**
 * Represents a single route
 */
class Route
{
    private $url;
    private $controller;
    private $action;
    private $middleware;
    private $constraints;
    private $vars = [];

    public function __construct(array $routeParams)
    {
        foreach ($routeParams as $key => $routeParam) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($routeParam);
            }
        }
    }

    public function setUrl($url): void
    {
        if (is_string($url)) {
            $this->url = $url;
        }
    }
    
    public function setController($controller): self
    {
        if (is_string($controller)) {
            $this->controller = $controller;
        }

        return $this;
    }

    public function setConstraints(array $constraints) : self
    {
        $this->constraints = $constraints;

        return $this;
    }

    public function setAction($action): self
    {
        if (is_string($action)) {
            $this->action = $action;
        }

        return $this;
    }

    public function setMiddleware($middleware): self
    {
        if (is_string($middleware)) {
            $this->middleware = $middleware;
        }

        return $this;
    }

    public function getUrl() : string
    {
        return $this->url;
    }

    public function getAction() : string
    {
        return $this->action;
    }

    public function getController() : string
    {
        return $this->controller;
    }

    public function getMiddleware() : ?string
    {
        return $this->middleware;
    }

    public function getConstraints() : array
    {
        return $this->constraints;
    }

    public function getVars() : array
    {
        return $this->vars;
    }

    private function isVar($urlFragment) : bool
    {
        return strpos($urlFragment, '{') !== false;
    }

    private function matchVar(string $regex, string $urlFragment) : bool
    {
        return preg_match('/^' . $regex . '$/', $urlFragment) === 1;
    }

    private function varName($urlFragment) : string
    {
        return trim($urlFragment, '{}');
    }

    private function addVar(string $name, string $data) : void
    {
        $this->vars[$name] = $data;
    }

    /**
     * @param string $url
     * @return boolean
     */
    public function match(string $url) : bool
    {
        if (!$this->constraints) {
            return $this->url === $url;
        }

        $partsProvided = explode('/', trim($url, '/'));
        $partsToMatch = explode('/', trim($this->url, '/'));

        if (count($partsToMatch) !== count($partsProvided)) {
            return false;
        }

        foreach ($partsToMatch as $key => $toMatch) {
            if ($partsProvided[$key] !== $toMatch && !$this->isVar($toMatch)) {
                return false;
            }

            if ($this->isVar($toMatch)) {
                $var = $this->varName($toMatch);

                if (!$this->matchVar($this->constraints[$var], $partsProvided[$key])) {
                    return false;
                }

                $this->addVar($var, $partsProvided[$key]);
            }
        }

        return true;
    }
}
