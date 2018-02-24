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
        else if ($_GET['action'] == 'addComment')
        {
            if (!empty($_POST['author']) && !empty($_POST['content']))
            {
                $controller->addComment($_GET['id'], $_POST['author'], $_POST['content']);
            }
            else
            {
                throw new Exception('Tous les champs ne sont pas remplis');
            }
        }
        else if ($_GET['action'] == 'authenticate')
        {
            if (!empty($_POST['username'] && !empty($_POST['password'])))
            {
                $controller->authenticate($_POST['username'], $_POST['password']);
            }
        }
        else if ($_GET['action'] == 'admin')
        {
            if (!isset($_SESSION['id']))
            {
                require('App/View/login.php');
            }
            else
            {
                require('App/View/adminPanel.php');
            }
        }
        else if (isset($_SESSION['id']))
        {
            if($_GET['action'] == 'writePost')
            {
                require('App/View/writePost.php');
            }
            else if($_GET['action'] == 'addPost')
            {
                if(!empty($_POST['title']) && !empty($_POST['content']))
                {
                    $controller->addPost($_POST['title'], $_POST['content']);
                }
            }
            else if($_GET['action'] == 'updatePost')
            {
                if (isset($_GET['id']) && $_GET['id'] > 0)
                {
                    $controller->updatePost($_GET['id']);
                }
            }
            else if($_GET['action'] == 'executeUpdatePost')
            {
                if (isset($_GET['id']) && $_GET['id'] > 0)
                {
                    $controller->executeUpdatePost($_GET['id'], $_POST['title'], $_POST['content']);
                }
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
    echo $e;
}