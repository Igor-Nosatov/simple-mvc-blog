<?php

session_start();

class User
{
    private $id,
            $username,
            $password;
    
    public function __construct(array $data = [])
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function login()
    {
        $_SESSION['id'] = $this->id;
    }

    // GETTERS
    
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // SETTERS

    public function setId($id)
    {
        if ($id > 0 && is_int($id))
        {
            $this->id = $id;
        }
    }

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
