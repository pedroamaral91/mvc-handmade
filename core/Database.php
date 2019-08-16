<?php

namespace Core;

use PDO;

class Database
{
    public static function createConnection()
    {
        $configuration = require_once __DIR__ . '/../config/database.php';
        if ($configuration['driver'] === 'mysql') {
            return self::getConnectionMysql($configuration['mysql']);
        }
    }

    public function getConnectionMysql($config)
    {
        try {
            $connection = "mysql:host={$config['host']}:{$config['port']};dbname={$config['database']}";
            $pdo = new PDO($connection, $config['user'], $config['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        } catch (Exception $er) {
            return $er->getMessage();
        }
    }
}
