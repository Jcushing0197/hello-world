<?php
namespace Controllers;

use Models\DbContext;

class CartController {
    private $conn;

    public function __construct() {
        $db = new DbContext();
        $this->conn = $db->getConnection();
        session_start();
    }

    // Get all cart items
    public function getCart() {
        return $_SESSION['cart'] ?? [];
    }

    // Add items to the cart
    public function addToCart($items) {
        $_SESSION['cart'] = $items;
    }

    // Remove item by ID
    public function removeItem($id) {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }

    // Fetch product details for given IDs
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
