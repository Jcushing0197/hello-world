<?php
namespace Controllers;

use Models\DbContext;

require_once __DIR__ . '/../Models/DbContext.php';

class CheckoutController {
    private $conn;

    public function __construct() {
        $db = new DbContext();
        $this->conn = $db->getConnection();
        session_start();
    }

    // Get current cart
    public function getCart() {
        return $_SESSION['cart'] ?? [];
    }

    // Fetch product details for the cart
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

    // Confirm the order and reduce stock
    public function confirmOrder($cart, $productMap) {
        foreach ($cart as $id => $qty) {
            if ($qty > 0 && isset($productMap[$id])) {
                $update = $this->conn->prepare("UPDATE products SET stock = stock - ? WHERE product_id = ?");
                $update->bind_param("ii", $qty, $id);
                $update->execute();
            }
        }
        unset($_SESSION['cart']);
    }
}
