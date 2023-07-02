<?php
/**
 * Database Configuration using PDO
 */
class Config
{
    // dsn = data source network
    private $dsn = "mysql:host=localhost;dbname=crud_oop";
    private const dbUserName = "root";
    private const dbPassword = '';
    protected $connection;


    public function __construct()
    {
        try {
            $this->connection = new PDO($this->dsn, self::dbUserName, self::dbPassword);
            // echo "connected";
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
}

// $newConnection = new DatabaseConnection();
