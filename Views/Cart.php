<link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../style.css">

<?php
include __DIR__ . '/../navbar.php'; 
require_once __DIR__ . '/../Controllers/CartController.php';

use Controllers\CartController;

$cartController = new CartController();

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $cartController->removeItem(intval($_POST['delete_id']));
    header("Location: Cart.php");
    exit;
}

// Handle adding items from products page
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['qty'])) {
    $cartController->addToCart($_POST['qty']);
}

$cart = $cartController->getCart();
$productMap = [];
$total = 0;

// Fetch product details if cart is not empty
if (!empty($cart) && max($cart) > 0) {
    $productIds = array_keys($cart);
    $products = $cartController->getProducts($productIds);

    foreach ($products as $product) {
        $productMap[$product['product_id']] = $product;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
</head>
<body>
<div class="sweep"></div>
<div class="sweep sweep2"></div>

<div class="content">
    <?php if (empty($cart) || max($cart) == 0): ?>
        <h1>Uh Oh... Your Cart is Empty :(</h1>
        <a href="Products.php" class="btn">Continue Shopping</a>
    <?php else: ?>
        <h1>Your Cart</h1>
        <div class="table-container">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Price ($)</th>
                    <th>Quantity</th>
                    <th>Subtotal ($)</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($cart as $id => $qty): ?>
                    <?php if ($qty > 0 && isset($productMap[$id])): 
                        $name = htmlspecialchars($productMap[$id]['product_name']);
                        $price = $productMap[$id]['price'];
                        $subtotal = $price * $qty;
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?= $name ?></td>
                        <td><?= number_format($price, 2) ?></td>
                        <td><?= $qty ?></td>
                        <td><?= number_format($subtotal, 2) ?></td>
                        <td>
                            <form action="Cart.php" method="POST" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?= $id ?>">
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="total">Total</td>
                    <td class="total"><?= number_format($total, 2) ?></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <a href="Products.php" class="btn">Continue Shopping</a>
        <form action="Checkout.php" method="POST">
            <button type="submit" class="btn">Proceed to Checkout</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
