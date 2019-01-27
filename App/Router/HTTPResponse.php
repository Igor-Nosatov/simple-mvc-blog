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
        http_response_code(404);
        $this->redirect('/404');
        exit;
    }

    public function addHeader(string $header): void
    {
        header($header);
    }
}
