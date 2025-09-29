<?php
namespace Controllers;
use Models\Checkout;

require_once __DIR__ . '/../Models/Checkout.php';

class CheckoutController {
    private $checkoutModel;

    public function __construct() {
        $this->checkoutModel = new Checkout();
        session_start();
    }

    public function getCart() {
        return $_SESSION['cart'] ?? [];
    }

    public function getProducts($productIds) {
        return $this->checkoutModel->getProducts($productIds);
    }

    public function confirmOrder($cart, $productMap) {
        $this->checkoutModel->confirmOrder($cart, $productMap);
        unset($_SESSION['cart']); // Clear cart after order
    }
}
