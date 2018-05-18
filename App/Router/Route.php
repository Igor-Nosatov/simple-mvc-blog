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
    private $params = [];

    public function __construct(array $data)
    {
        $this->setUrl($data['url']);
        $this->setController($data['controller']);
        $this->setAction($data['action']);
        $this->setMiddleware($data['middleware']);
    }

    public function setUrl($url)
    {
        if (is_string($url)) {
            $this->url = $url;
        }
    }
    
    public function setController($controller)
    {
        if (is_string($controller)) {
            $this->controller = $controller;
        }
    }

    public function setAction($action)
    {
        if (is_string($action)) {
            $this->action = $action;
        }
    }

    public function setMiddleware($middleware)
    {
        if (is_string($middleware)) {
            $this->middleware = $middleware;
        }
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

    public function getMiddleware() : string
    {
        return $this->middleware;
    }

    public function getParams() : array
    {
        return $this->params;
    }
    
    /**
     * Tries to match the route with the provided url.
     * Compare both urls part by part then set the variables and notifies the router
     * the route matches if everything checks out.
     *
     * @param string $url
     * @return boolean
     */
    public function get(string $url) : bool
    {
        $keys = [];
        $values = [];
       
        if (!$this->hasVars()) {
            if ($this->url == $url) {
                return true;
            } else {
                return false;
            }
        }

        $urlParts = explode('/', $this->url);
        $url = explode('/', $url);

        // If both urls don't have the same number of parts, we can return now
        if (count($urlParts) !== count($url)) {
            return false;
        }

        // The first element is always empty
        for ($i = 1; $i < count($urlParts); $i++) {
            // If an opening bracket is found, retrieve the parameter
            if ($urlParts[$i][0] === '{') {
                // Split the key and pattern
                $keyPattern = explode(':', $urlParts[$i]);
                // Remove the opening bracket
                $keys[] = substr($keyPattern[0], 1);
                // Remove the closing bracket
                $pattern = substr($keyPattern[1], 0, -1);

                // Try to match the pattern with the provided url in the same position
                if (!preg_match('#' . $pattern . '#', $url[$i], $matches)) {
                    return false;
                } else {
                    $values[] = $url[$i];
                }
            } else // If there is no variable in the current position, do a simple string comparison
            {
                if ($url[$i] !== $urlParts[$i]) {
                    return false;
                }
            }
        }
        
        $this->params = array_combine($keys, $values);

        return true;
    }

    private function hasVars()
    {
        return strpos($this->url, '{');
    }
}
