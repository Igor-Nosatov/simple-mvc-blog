<?php
namespace App\Router;

class HTTPResponse
{
    public function redirect(string $location)
    {
        header('Location: ' . $location);
        exit;
    }

    public function redirect404()
    {
        header('HTTP/1.0 404 Not Found');
        require('App/View/404.php');
        exit;
    }
}
