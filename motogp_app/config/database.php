<?php

class Database {
    private $host = "localhost";
    private $db_name = "db_motogp"; 
    private $username = "root";     // Default XAMPP
    private $password = "";         // Default XAMPP kosong
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Menggunakan PDO (PHP Data Objects) karena lebih aman & modern dibanding mysqli
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            
            // Set error mode ke exception biar ketahuan kalau ada error query
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>