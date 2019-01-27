<?php
namespace App\Router;

class HTTPResponse
{
    public function redirect(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }

    public function redirect404(): void
    {
        header('HTTP/1.0 404 Not Found');
        header('Location: /404');
        exit;
    }

    public function addHeader(string $header): void
    {
        header($header);
    }
}
