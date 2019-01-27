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

        $req->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $user = $req->fetch();

        return $user ?: null;
    }

    public function getById($id) : ?User
    {
        $sql = 'SELECT id, username, password FROM users WHERE id = :id';

        $req = $this->db->prepare($sql);
        
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $user = $req->fetch();

        return $user ?: null;
    }

    public function updatePassword(User $user): void
    {
        $sql = 'UPDATE users SET password = :password WHERE id = :id';

        $req = $this->db->prepare($sql);

        $req->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        $req->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $req->execute();
    }
}
