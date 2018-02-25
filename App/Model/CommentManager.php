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

    public function update(Comment $comment)
    {
        $db = $this->dbConnect();

        $sql = 'UPDATE comments SET content = :content WHERE id = :id';

        $req = $db->prepare($sql);
        
        $req->bindValue(':id', $comment->getId(), PDO::PARAM_INT);
        $req->bindValue(':content', $comment->getContent(), PDO::PARAM_STR);
        $req->execute();
    }

    public function delete($id)
    {
        $db = $this->dbConnect();
        
        $sql = 'DELETE FROM comments WHERE id = :id';

        $req = $db->prepare($sql);
        
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function flag($id)
    {
        $db = $this->dbConnect();

        $sql = 'UPDATE comments SET flag = 1 WHERE id = :id';
        
        $req = $db->prepare($sql);

        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

    }
    
    public function unflag($id)
    {
        $db = $this->dbConnect();

        $sql = 'UPDATE comments SET flag = 0 WHERE id = :id';
        
        $req = $db->prepare($sql);

        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function getFlagged()
    {
        $db = $this->dbConnect();

        $sql = 'SELECT * FROM comments WHERE flag > 0';

        $req = $db->prepare($sql);
        $req->execute();

        $req->setFetchMode(PDO::FETCH_CLASS, 'Comment');
        $comments = $req->fetchAll();

        return $comments;
    }
}
