<?php
require_once('../config/config.php');

class DatabaseOperations extends Config
{

    public function insert($fName, $lName, $email, $phone)
    {
        $query = "INSERT INTO users(first_name,last_name,email,phone_number) VALUES (:fName,:lName,:email,:phone)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['fName' => $fName, 'lName' => $lName, 'email' => $email, 'phone' => $phone]);
        return true;
    }

    public function read()
    {
        // data empty arr, to be used later
        $data = [];
        $query = "SELECT * FROM users";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        // get the results in associative array format
        // use fetchAll to fetch multiple records
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['id' => $id]);
        // store the results in a result variable
        // use fetch to get single record
        $result = $stmt->fetch();
        return $result;
    }

    public function update($id, $fName, $lName, $email, $phone)
    {
        $query = "UPDATE users SET first_name = :fName, last_name = :lName, email = :email, phone_number = :phone WHERE id = :id LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['id' => $id, 'fName' => $fName, 'lName' => $lName, 'email' => $email, 'phone' => $phone]);
        return true;
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['id' => $id]);
        return true;
    }

    public function totalRowCount()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $totalRows = $stmt->rowCount();
        return $totalRows;
    }
};