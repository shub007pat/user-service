<?php
class Database {
    private $host = 'user-db';
    private $db_name = 'user_db';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }

    public function addUser($user) {
        $query = 'INSERT INTO users (username, password, email, address) VALUES (:username, :password, :email, :address)';
        $stmt = $this->getConnection()->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':username', $user['username']);
        $stmt->bindParam(':password', $user['password']);
        $stmt->bindParam(':email', $user['email']);
        $stmt->bindParam(':address', $user['address']);
    
        // Execute the query
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    }
    
    public function loginUser($credentials) {
        $query = 'SELECT id, username, email, address FROM users WHERE username = :username AND password = :password';
        $stmt = $this->getConnection()->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':username', $credentials['username']);
        $stmt->bindParam(':password', $credentials['password']);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch the user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function getUserDetails($id) {
        $query = 'SELECT id, username, email, address FROM users WHERE id = :id';
        $stmt = $this->getConnection()->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':id', $id);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch the user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }
    
}
