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

    public function getSingle($id)
    {
        $db = $this->dbConnect();

        $sql = 'SELECT id, title, content, dateAdded FROM posts WHERE id = :id';

        $req = $db->prepare($sql);
        
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(PDO::FETCH_CLASS, 'Post');
        $post = $req->fetch();

        return $post;
    }
}
