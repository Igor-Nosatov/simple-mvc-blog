<?php

require_once('App/Model/Manager.php');
require_once('App/Model/Comment.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();

        $sql = 'SELECT id, postId, author, content, dateAdded FROM comments WHERE postId = :postId';

        $req = $db->prepare($sql);

        $req->bindValue(':postId', $postId, PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(PDO::FETCH_CLASS, 'Comment');
        $comments = $req->fetchAll();

        return $comments;
    }

    public function add($postId, $author, $content)
    {
        $db = $this->dbConnect();

        $sql = 'INSERT INTO comments SET postId = :postId, author = :author, content = :content, dateAdded = NOW()';

        $req = $db->prepare($sql);

        $req->bindValue(':postId', $postId, PDO::PARAM_INT);
        $req->bindValue(':author', $author, PDO::PARAM_STR);
        $req->bindValue(':content', $content, PDO::PARAM_STR);
        $req->execute();
    }
}
