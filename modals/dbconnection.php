<?php

class DatabaseConnection
{
    // dsn = data source network
    private $dsn = "mysql:host=localhost;dbname=crud_oop";
    private $dbUserName = "root";
    private $dbPassword = '';
    public $connection;


    public function __construct()
    {
        try {
            $this->connection = new PDO($this->dsn, $this->dbUserName, $this->dbPassword);
            // echo "connected";
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
}

// $newConnection = new DatabaseConnection();
