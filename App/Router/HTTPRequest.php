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
        return $_POST[$key] ?? null;
    }

    public function getData($key)
    {
        return $_GET[$key] ?? null;
    }

    public function isAjax() : bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
