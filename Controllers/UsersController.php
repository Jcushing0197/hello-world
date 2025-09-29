<?php
namespace Controllers;
use Models\Users;

require_once __DIR__ . '/../Models/Users.php';

class UsersController {
    private $usersModel;

    public function __construct() {
        $this->usersModel = new Users();
        session_start();
    }

    public function showLoginForm() {
        include __DIR__ . '/../Views/Login.php';
    }

    public function showRegisterForm() {
        include __DIR__ . '/../Views/Register.php';
    }

    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->usersModel->login($username, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: /hello-world/Views/Products.php");
            exit;
        } else {
            $error = "Invalid username or password";
            include __DIR__ . '/../Views/Login.php';
        }
    }

    public function register() {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->usersModel->register($username, $email, $password)) {
            header("Location: /hello-world/Views/Products.php");
            exit;
        } else {
            $error = "Username already exists or registration failed.";
            include __DIR__ . '/../Views/Register.php';
        }
    }

}
