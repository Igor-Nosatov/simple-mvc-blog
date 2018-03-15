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
        header('Location: /404');
        exit;
    }

    public function addHeader(string $header)
    {
        header($header);
    }
}
