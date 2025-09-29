<?php
namespace Models;
use Models\DbContext;
require_once __DIR__ . '/DbContext.php';

class Products {
    private $conn;

    public function __construct() {
        $db = new DbContext();
        $this->conn = $db->getConnection();
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
