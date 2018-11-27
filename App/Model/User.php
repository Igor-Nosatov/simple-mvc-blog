<?php
namespace App\Model;

class User extends Entity
{
    private $username;
    private $password;

    const PASSWORD_INVALID = 'Mot de passe invalide';
    const PASSWORD_TOO_SHORT = 'Le mot de passe doit contenir au moins 5 caractères';
    const PASSWORD_EMPTY = 'Le mot de passe ne peut pas être vide';
    
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

    public function setUsername($username)
    {
        if (is_string($username)) {
            $this->username = $username;
        }
    }

    public function setPassword($password)
    {
        if (!is_string($password)) {
            $this->errors[] = self::PASSWORD_INVALID;
        } elseif (empty($password)) {
            $this->errors[] = self::PASSWORD_EMPTY;
        } elseif (mb_strlen($password) < 5) {
            $this->errors[] = self::PASSWORD_TOO_SHORT;
        } else {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
    }
}
