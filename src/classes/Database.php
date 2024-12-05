<?php
class Database
{
    private $host = 'localhost';
    private $dbname = 'rate_mate';
    private $username = 'root'; // put your own db username here
    private $password = 'admin'; // put your own db password here
    private $conn;

    public function connect()
    {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Failed: ' . $e->getMessage();
            }
        }
        return $this->conn;
    }
}
