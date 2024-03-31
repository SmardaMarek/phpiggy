<?php

namespace Framework;

use PDO, PDOException;

class Database
{
    private $connection;

    public function __construct($driver, array $config, $username, $password)
    {

        $configString = http_build_query($config, "", ';');
        $dsn = "{$driver}:{$configString}";
        try {
            $this->connection = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            die("Could not connect to database");
        }
    }
    public function query($query)
    {
        $this->connection->query($query);
    }
}
