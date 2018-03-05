<?php
namespace App\Router;

class Authenticate
{
    public function __invoke(string $url, HTTPResponse $httpResponse)
    {
        if (!isset($_SESSION['id']))
        {
            if ($url === '/admin')
            {
                $httpResponse->redirect('/login');
            }
            else
            {
                $httpResponse->redirect('/');
            }
        }
    }
}
