<?php

namespace Framework;

use PDO, PDOException, PDOStatement;

class Database
{
    private $connection;
    private  $stmt;

    public function __construct($driver, array $config, $username, $password)
    {

        $configString = http_build_query($config, "", ';');
        $dsn = "{$driver}:{$configString}";
        try {
            $this->connection = new PDO(
                $dsn,
                $username,
                $password,
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
        } catch (PDOException $e) {
            die("Could not connect to database");
        }
    }
    public function query($query, $params = [])
    {
        $this->stmt  = $this->connection->prepare($query);
        $this->stmt->execute($params);

        return $this;
    }
    public function count()
    {
        return $this->stmt->fetchColumn();
    }
    public function find()
    {
        return $this->stmt->fetch();
    }
    public function id()
    {
        return $this->connection->lastInsertId();
    }
    public function findAll()
    {
        return $this->stmt->fetchAll();
    }
}
