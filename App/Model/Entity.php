<?php
namespace App\Model;

abstract class Entity
{
    protected $id;
    protected $errors = [];

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $id = (int) $id;

        if ($id > 0) {
            $this->id = $id;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
