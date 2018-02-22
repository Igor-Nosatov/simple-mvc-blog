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
}
