<?php

class Manager
{
    function dbConnect()
    {
        require_once('App/Config/database.php');
       
        $db = new PDO('mysql:host=' . dbConfig['host'] . ';dbname=' . dbConfig['dbname'] . ';charset=utf8', $username, $password);

        return $db;
    }
}