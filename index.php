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
        else if($_GET['action'] == 'post')
        {
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                $controller->post();
            }
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