<?php
namespace Controllers;

use Models\DbContext;

require_once __DIR__ . '/../Models/DbContext.php';

class ProductsController {
    private $conn;

    public function __construct() {
        $db = new DbContext();
        $this->conn = $db->getConnection();
    }

    // Fetch all products
    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch single product by ID (if needed later)
    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
