<?php

require_once('App/Model/PostManager.php');
require_once('App/Model/CommentManager.php');
require_once('App/Model/UserManager.php');

class Controller
{
    private $postManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->userManager = new UserManager();
    }

    public function listPosts()
    {
        $posts = $this->postManager->getPosts();

        require('App/View/listPosts.php');
    }

    public function post()
    {
        $post = $this->postManager->getSingle($_GET['id']);
        $comments = $this->commentManager->getComments($_GET['id']);

        require('App/View/post.php');
    }

    public function addComment($postId, $author, $content)
    {
        $this->commentManager->add($postId, $author, $content);

        header('Location: index.php?action=post&id=' . $postId);
    }

    public function authenticate($username, $password)
    {
        $user = $this->userManager->get($username, $password);

        if(!$user)
        {
            throw new Exception('Login ou mot de passe invalide');
        }
        else
        {
            $user->login();
            header('Location: index.php?action=admin');
        }
    }
}
