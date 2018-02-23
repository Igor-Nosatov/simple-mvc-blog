<?php

require_once('App/Model/User.php');

class UserManager extends Manager
{
    public function get($username, $password)
    {
        $db = $this->dbConnect();

        $sql = 'SELECT id, username, password FROM users WHERE username = :username';

        $req = $db->prepare($sql);
        
        $req->bindValue(':username', $username, PDO::PARAM_STR);
        $req->execute();

        $req->setFetchMode(PDO::FETCH_CLASS, 'User');
        $user = $req->fetch();

        return $user; 
    }
}
