<?php

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
}