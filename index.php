<?php
require_once('App/Controller/Controller.php');

$controller = new Controller();

try
{
    if (isset($_GET['action']))
    {
        if ($_GET['action'] == 'listPosts')
        {
            $controller->listPosts();
        }
    }
    else
    {
        $controller->listPosts();
    }
}
catch (Exception $e)
{

}