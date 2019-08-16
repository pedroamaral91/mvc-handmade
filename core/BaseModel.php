<?php

namespace Core;

abstract class BaseModel
{
    private $pdo;
    protected $table;
    public function __construct()
    {
        $this->pdo = Database::createConnection();
    }

    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table} LIMIT 10";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
}
