<?php
namespace App\Model;

abstract class Entity
{
    protected $id;

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
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $id = (int) $id;

        if ($id > 0)
        {
            $this->id = $id;
        }
    }
}
