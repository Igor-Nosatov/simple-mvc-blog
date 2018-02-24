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

    public function add($title, $content)
    {
        $db = $this->dbConnect();

        $sql = 'INSERT INTO posts SET title = :title, content = :content, dateAdded = NOW()';

        $req = $db->prepare($sql);

        $req->bindValue(':title', $title, PDO::PARAM_STR);
        $req->bindValue(':content', $content, PDO::PARAM_STR);
        $req->execute();
    }

    public function update(Post $post)
    {
        $db = $this->dbConnect();

        $sql = 'UPDATE posts SET title = :title, content = :content WHERE id = :id';

        $req = $db->prepare($sql);
        
        $req->bindValue(':id', $post->getId(), PDO::PARAM_INT);
        $req->bindValue(':title', $post->getTitle(), PDO::PARAM_STR);
        $req->bindValue(':content', $post->getContent(), PDO::PARAM_STR);
        $req->execute();

    }

    public function delete($id)
    {
        $db = $this->dbConnect();
        
        $sql = 'DELETE FROM posts WHERE id = :id';

        $req = $db->prepare($sql);
        
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}
