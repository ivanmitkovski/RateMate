<?php

class Employee
{
    private $conn;
    private $table = 'employees';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllEmployees()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getEmployeeById($id)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }
}
