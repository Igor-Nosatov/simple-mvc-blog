<?php
namespace App\Model;

class User extends Entity
{
    private $username;
    private $password;

    private const PASSWORD_INVALID = 'Mot de passe invalide';
    private const PASSWORD_TOO_SHORT = 'Le mot de passe doit contenir au moins 5 caractères';
    private const PASSWORD_EMPTY = 'Le mot de passe ne peut pas être vide';
    
    public function login(): void
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

    public function setUsername($username): void
    {
        if (is_string($username)) {
            $this->username = $username;
        }
    }

    public function setPassword($password): void
    {
        if (!is_string($password)) {
            $this->errors[] = self::PASSWORD_INVALID;
        } elseif (empty($password)) {
            $this->errors[] = self::PASSWORD_EMPTY;
        } elseif (strlen($password) < 5) {
            $this->errors[] = self::PASSWORD_TOO_SHORT;
        } else {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
    }
}
