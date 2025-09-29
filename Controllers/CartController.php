<?php
namespace Controllers;
use Models\Cart;
require_once __DIR__ . '/../Models/Cart.php';

class CartController {
    private $cartModel;

    public function __construct() {
        $this->cartModel = new Cart();
        session_start();
    }

    // Get all cart items from session
    public function getCart() {
        return $_SESSION['cart'] ?? [];
    }

    // Add items to the cart (session only)
    public function addToCart($items) {
        $_SESSION['cart'] = $items;
    }

    // Remove item by ID from session
    public function removeItem($id) {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }

    // Get product details from DB for given IDs
    public function getProducts($productIds) {
        return $this->cartModel->getProducts($productIds);
    }
}

