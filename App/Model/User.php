<?php
namespace App\Model;

class User extends Entity
{
    private $username,
            $password;
    
    public function login()
    {
        $_SESSION['id'] = $this->id;
    }

    // GETTERS
    
    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // SETTERS

    public function setUsername($userame)
    {
        if (is_string($username))
        {
            $this->username = $username;
        }
    }

    public function setPassword($password)
    {
        if (is_string($password))
        {
            $this->username = $password;
        }
    }
}
