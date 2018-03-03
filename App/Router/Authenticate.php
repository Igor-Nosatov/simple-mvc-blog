<?php

class Authenticate
{
    public function __invoke()
    {
        if (!isset($_SESSION['id']))
        {
            header('Location: /login');
        }
    }
}
