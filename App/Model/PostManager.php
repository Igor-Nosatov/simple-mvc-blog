<?php
namespace App\Model;

class PostManager extends Manager
{
    public function getPosts(array $params = []) : array
    {
        $sql = 'SELECT id, title, content, DATE_FORMAT(dateAdded, \'%d/%m/%Y\') AS dateAdded, dateModified FROM posts ORDER BY dateAdded';
        
        if (isset($params['order'])) {
            $sql .= ' ' . strtoupper($params['order']);
        }

        if (isset($params['limit'])) {
            $sql .= ' LIMIT ' . (int) $params['limit'];
        }
        
        if (isset($params['offset'])) {
            $sql .= ' OFFSET ' . (int) $params['offset'];
        }

        $req = $this->db->query($sql);
        
        return $req->fetchAll(\PDO::FETCH_CLASS, Post::class);
    }
    
    public function getSingle($id) : ?Post
    {
        $sql = 'SELECT id, title, content, dateAdded FROM posts WHERE id = :id';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        $post = $req->fetch();

        return $post ?: null;
    }
    
    public function getPrevious($id) : ?Post
    {
        $sql = 'SELECT id, title, content, dateAdded FROM posts WHERE id < :id ORDER BY id DESC LIMIT 1';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
        
        $req->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        $post = $req->fetch();

        return $post ?: null;
    }

    public function getNext($id) : ?Post
    {
        $sql = 'SELECT id, title, content, dateAdded FROM posts WHERE id > :id LIMIT 1';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
        
        $req->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        $post = $req->fetch();

        return $post ?: null;
    }

    public function add(Post $post): void
    {
        $sql = 'INSERT INTO posts SET title = :title, content = :content, dateAdded = NOW()';

        $req = $this->db->prepare($sql);

        $req->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':content', $post->getContent(), \PDO::PARAM_STR);
        $req->execute();
    }

    public function update(Post $post): void
    {
        $sql = 'UPDATE posts SET title = :title, content = :content, dateModified = NOW() WHERE id = :id';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $post->getId(), \PDO::PARAM_INT);
        $req->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':content', $post->getContent(), \PDO::PARAM_STR);
        $req->execute();
    }

    public function delete($id): void
    {
        $sql = 'DELETE FROM posts WHERE id = :id';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
    }

    public function count() : int
    {
        $sql = 'SELECT COUNT(id) FROM posts';

        $req = $this->db->query($sql);

        return (int) $req->fetchColumn();
    }
}
