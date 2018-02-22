<?php

require_once('App/Model/PostManager.php');

class Controller
{
    private $postManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
    }

    public function listPosts()
    {
        $posts = $this->postManager->getPosts();

        require('App/View/listPosts.php');
    }
}
