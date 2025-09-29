<?php
require_once __DIR__ . '/Controllers/UsersController.php';
use Controllers\UsersController;

$controller = new UsersController();
$controller->register();
