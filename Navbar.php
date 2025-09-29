<div class="navbar">
    <a href="Index.php">Home</a>
    <a href="Products.php">Products</a>
    <a href="Cart.php">Cart</a>
    <a href="Checkout.php">Checkout</a>

    <?php if (!empty($_SESSION['user'])): ?>
        <span>Welcome, <?= htmlspecialchars($_SESSION['user']['username']); ?></span>
        <a href="Logout.php">Logout</a>
    <?php else: ?>
        <a href="Login.php">Login</a>
        <a href="Register.php">Register</a>
    <?php endif; ?>
</div>

