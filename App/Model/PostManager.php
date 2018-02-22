<?php

require_once('App/Model/Manager.php');
require_once('App/Model/Post.php');

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT id, title, content, dateAdded FROM posts');
        
        $posts = $req->fetchAll(PDO::FETCH_CLASS, 'Post');

        return $posts;
    }
}
