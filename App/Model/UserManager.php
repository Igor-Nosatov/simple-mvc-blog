<?php
namespace App\Model;

class UserManager extends Manager
{
    public function get($username, $password) : ?User
    {
        $sql = 'SELECT id, username, password FROM users WHERE username = :username';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':username', $username, \PDO::PARAM_STR);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS, '\App\Model\User');
        $user = $req->fetch();

        return $user ? $user : null;
    }
}
