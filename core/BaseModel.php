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

    public function create(array $data)
    {
        $columns = implode(',', array_keys($data));
        $bindValues = implode(',:', array_keys($data));
        $query = "INSERT INTO {$this->table} ($columns) VALUES (:$bindValues)";
        $stmt = $this->pdo->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    private function prepareData(array $data)
    { }
}
