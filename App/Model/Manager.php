<?php
namespace App\Model;

class Manager
{
    protected $db;
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../Config/database.php';
        $this->db = $this->dbConnect();
    }

    private function dbConnect(): \PDO
    {
        return new \PDO(
            'mysql:host=' . $this->config['host'] . ';dbname=' . $this->config['dbname'] . ';charset=utf8',
            $this->config['username'],
            $this->config['password']
        );
    }
}
