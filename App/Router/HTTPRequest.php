<?php
namespace App\Router;

class HTTPRequest
{
    public function getURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function postData($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public function getData($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }
}