<?php
namespace Controllers;
use Models\Products;
require_once __DIR__ . '/../Models/Products.php';

class ProductsController {
    private $productsModel;

    public function __construct() {
        $this->productsModel = new Products();
    }

    public function getAllProducts() {
        return $this->productsModel->getAllProducts();
    }

    public function getProductById($id) {
        return $this->productsModel->getProductById($id);
    }
}

