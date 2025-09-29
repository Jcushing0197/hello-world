<?php
require_once __DIR__ . '/../Controllers/CheckoutController.php';
use Controllers\CheckoutController;

$checkoutController = new CheckoutController();
$cart = $checkoutController->getCart();
$productMap = [];
$total = 0;
$orderPlaced = false;

if (!empty($cart)) {
    $productIds = array_keys($cart);
    $products = $checkoutController->getProducts($productIds);

    foreach ($products as $product) {
        $productMap[$product['product_id']] = $product;
    }

    foreach ($cart as $id => $qty) {
        if ($qty > 0 && isset($productMap[$id])) {
            $total += $productMap[$id]['price'] * $qty;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    $checkoutController->confirmOrder($cart, $productMap);
    $orderPlaced = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php include __DIR__ . '/../navbar.php'; ?>

<div class="sweep"></div>
<div class="sweep sweep2"></div>

<div class="content">
    <?php if ($orderPlaced): ?>
        <h1>Thank you! Your order has been placed.</h1>
        <a href="Products.php" class="btn">Back to Products</a>

    <?php elseif (empty($cart) || array_sum($cart) == 0): ?>
        <h1>You have no items to checkout :(</h1>
        <a href="Products.php" class="btn">Continue Shopping</a>

    <?php else: ?>
        <h1>Checkout</h1>

        <div class="table-container">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Price ($)</th>
                    <th>Quantity</th>
                    <th>Subtotal ($)</th>
                </tr>
                <?php foreach ($cart as $id => $qty): ?>
                    <?php if ($qty > 0 && isset($productMap[$id])): 
                        $name = htmlspecialchars($productMap[$id]['product_name']);
                        $price = $productMap[$id]['price'];
                        $subtotal = $price * $qty;
                    ?>
                    <tr>
                        <td><?= $name ?></td>
                        <td><?= number_format($price, 2) ?></td>
                        <td><?= $qty ?></td>
                        <td><?= number_format($subtotal, 2) ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="total">Total</td>
                    <td class="total"><?= number_format($total, 2) ?></td>
                </tr>
            </table>
        </div>

        <a href="Cart.php" class="btn">← Back to Cart</a>

        <form method="POST">
            <button type="submit" name="confirm" class="btn">Confirm Order</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
