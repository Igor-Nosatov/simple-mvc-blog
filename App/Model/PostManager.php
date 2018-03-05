<?php
namespace App\Model;

require_once('App/Model/Manager.php');
require_once('App/Model/Post.php');

class PostManager extends Manager
{
    public function getPosts($limit = -1, $offset = -1)
    {
        $sql = 'SELECT id, title, content, dateAdded, dateModified FROM posts';

        if ($limit != -1 || $offset != -1)
        {
            $sql .= ' LIMIT ' . (int) $limit . ' OFFSET ' . (int) $offset;
        }

        $req = $this->db->query($sql);
        
        $posts = $req->fetchAll(\PDO::FETCH_CLASS, '\App\Model\Post');

        return $posts;
    }

    public function getSingle($id)
    {
        $sql = 'SELECT id, title, content, dateAdded FROM posts WHERE id = :id';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS, '\App\Model\Post');
        $post = $req->fetch();

        return $post;
    }

    public function add(Post $post)
    {
        $sql = 'INSERT INTO posts SET title = :title, content = :content, dateAdded = NOW()';

        $req = $this->db->prepare($sql);

        $req->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':content', $post->getContent(), \PDO::PARAM_STR);
        $req->execute();
    }

    public function update(Post $post)
    {
        $sql = 'UPDATE posts SET title = :title, content = :content, dateModified = NOW() WHERE id = :id';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $post->getId(), \PDO::PARAM_INT);
        $req->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':content', $post->getContent(), \PDO::PARAM_STR);
        $req->execute();
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM posts WHERE id = :id';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
    }

    public function count()
    {
        $sql = 'SELECT COUNT(*) FROM posts';

        $req = $this->db->query($sql);

        $rows = $req->fetchColumn();

        return $rows; 
    }
}
