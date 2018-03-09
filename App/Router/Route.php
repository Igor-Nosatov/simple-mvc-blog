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
            $params = [];

    public function __construct(array $data)
    {
        $this->setUrl($data['url']);
        $this->setAction($data['action']);
        $this->setMiddleware($data['middleware']);
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

    public function getParams() : array
    {
        return $this->params;
    }
    
    /**
     * Try to match the route with the provided url
     * Compare both urls part by part then return true and set the variables if
     * everything matches.
     *
     * @param string $url
     * @return boolean|null
     */
    public function get(string $url) : ?bool
    {
        $keys = [];
        $values = [];
       
        if (!$this->hasVars())
        {
            if ($this->url == $url)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        $urlParts = explode('/', $this->url);
        $url = explode('/', $url);

        // If both urls don't have the same number of parts, we can return now
        if (count($urlParts) !== count($url))
        {
            return null;
        }

        // The first element is always empty
        for ($i = 1; $i < count($urlParts); $i++)
        {
            // If an opening bracket is found, retrieve the parameter
            if ($urlParts[$i][0] === '{')
            {
                // Split the key and pattern
                $keyPattern = explode(':', $urlParts[$i]);
                // Remove the opening bracket
                $keys[] = substr($keyPattern[0], 1);
                // Remove the closing bracket
                $pattern = substr($keyPattern[1], 0, -1);

                // Try to match the pattern with the provided url in the same position
                if(!preg_match('#' . $pattern . '#', $url[$i], $matches))
                {
                    return null;
                }
                else
                {
                    $values[] = $url[$i];
                }
            }
            else // If there is no variable in the current position, do a simple string comparison
            {
                if ($url[$i] !== $urlParts[$i])
                {
                    return null;
                }
            }
        }
        
        $this->params= array_combine($keys, $values);

        return true;
    }

    private function hasVars()
    {
        return strpos($this->url, '{');
    }
}
