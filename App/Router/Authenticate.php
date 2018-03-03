<?php

class Authenticate
{
    public function __invoke(string $url)
    {
        if (!isset($_SESSION['id']))
        {
            if ($url === '/admin')
            {
                header('Location: /login');
            }
            else
            {
                header('Location: /');
            }
        }
    }
}
