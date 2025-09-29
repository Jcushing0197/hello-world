<?php
namespace Models;
use Models\DbContext;

require_once __DIR__ . '/DbContext.php';

class Users {
    private $conn;

    public function __construct() {
        $db = new DbContext();
        $this->conn = $db->getConnection();
    }

    // Find user by username
    public function findByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Register new user
    // Register new user without hashing
    public function register($username, $email, $password) {
        // Check if user already exists
        if ($this->findByUsername($username)) {
            return false;
        }

    // Store password as plain text
    $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    return $stmt->execute();
}


    // Verify login
    public function login($username, $password) {
        $user = $this->findByUsername($username);
        if ($user && $password === $user['password']) {
            return $user;
        }
        return false;
    }
}
