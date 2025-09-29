<?php
namespace Models;
use Models\DbContext;
require_once __DIR__ . '/DbContext.php';

class Cart {
    private $conn;

    public function __construct() {
        $db = new DbContext();
        $this->conn = $db->getConnection();
    }

    // Get product details for given IDs
    public function getProducts($productIds) {
        if (empty($productIds)) return [];

        $placeholders = implode(',', array_fill(0, count($productIds), '?'));
        $sql = "SELECT product_id, product_name, price FROM products WHERE product_id IN ($placeholders)";
        $stmt = $this->conn->prepare($sql);

        $types = str_repeat('i', count($productIds));
        $stmt->bind_param($types, ...$productIds);

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
