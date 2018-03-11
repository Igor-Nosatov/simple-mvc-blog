<?php
namespace App\Model;

class UserManager extends Manager
{
    public function getByUsername($username) : ?User
    {
        $sql = 'SELECT id, username, password FROM users WHERE username = :username';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':username', $username, \PDO::PARAM_STR);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS, '\App\Model\User');
        $user = $req->fetch();

        return $user ? $user : null;
    }

    public function getById($id) : ?User
    {
        $sql = 'SELECT id, username, password FROM users WHERE id = :id';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS, '\App\Model\User');
        $user = $req->fetch();

        return $user ? $user : null;
    }

    public function updatePassword($id, $hash)
    {
        $sql = 'UPDATE users SET password = :hash WHERE id = :id';

        $req = $this->db->prepare($sql);

        $req->bindValue(':hash', $hash, \PDO::PARAM_STR);
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
    }
}
