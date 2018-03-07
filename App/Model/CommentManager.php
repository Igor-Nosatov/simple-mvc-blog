<?php
namespace App\Model;

class CommentManager extends Manager
{
    public function getComments($postId) : array
    {
        $sql = 'SELECT id, postId, author, content, dateAdded FROM comments WHERE postId = :postId';

        $req = $this->db->prepare($sql);

        $req->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS, '\App\Model\Comment');
        $comments = $req->fetchAll();

        return $comments;
    }

    public function getSingle($id) : ?Comment
    {
        $sql = 'SELECT id, postId, author, content, dateAdded FROM comments WHERE id = :id';

        $req = $this->db->prepare($sql);

        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS, '\App\Model\Comment');
        $comment = $req->fetch();

        return $comment ? $comment : null;
    }

    public function add(Comment $comment)
    {
        $sql = 'INSERT INTO comments SET postId = :postId, author = :author, content = :content, dateAdded = NOW()';

        $req = $this->db->prepare($sql);

        $req->bindValue(':postId', $comment->getPostId(), \PDO::PARAM_INT);
        $req->bindValue(':author', $comment->getAuthor(), \PDO::PARAM_STR);
        $req->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
        $req->execute();
    }

    public function update(Comment $comment)
    {
        $sql = 'UPDATE comments SET content = :content WHERE id = :id';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
        $req->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
        $req->execute();
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM comments WHERE id = :id';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
    }

    public function flag($id)
    {
        $sql = 'UPDATE comments SET flag = 1 WHERE id = :id';
        
        $req = $this->db->prepare($sql);

        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
    }
    
    public function unflag($id)
    {
        $sql = 'UPDATE comments SET flag = 0 WHERE id = :id';
        
        $req = $this->db->prepare($sql);

        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
    }

    public function getFlagged() : array
    {
        $sql = 'SELECT * FROM comments WHERE flag > 0';

        $req = $this->db->prepare($sql);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS, '\App\Model\Comment');
        $comments = $req->fetchAll();

        return $comments;
    }
}
