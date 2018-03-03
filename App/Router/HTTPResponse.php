<?php

class HTTPResponse
{
    public function redirect(string $location)
    {
        header('Location: ' . $location);
        exit;
    }
}