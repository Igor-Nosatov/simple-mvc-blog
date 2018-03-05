<?php
namespace App\Router;

class HTTPResponse
{
    public function redirect(string $location)
    {
        header('Location: ' . $location);
        exit;
    }
}