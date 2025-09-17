<?php
require_once __DIR__ . '/../Controllers/ProductsController.php';
use Controllers\ProductsController;

$productsController = new ProductsController();
$products = $productsController->getAllProducts();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Products - Cush's Components</title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php include __DIR__ . '/../navbar.php'; ?> <!-- Navbar is here -->

<div class="sweep"></div>
<div class="sweep sweep2"></div>

<div class="content">
    <div class="table-container">
        <form action="Cart.php" method="POST">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price ($)</th>
                    <th>Stock</th>
                    <th>Quantity</th>
                </tr>
                <?php foreach ($products as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['product_id']) ?></td>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= number_format($row['price'], 2) ?></td>
                        <td><?= htmlspecialchars($row['stock']) ?></td>
                        <td>
                            <input type="number" name="qty[<?= $row['product_id'] ?>]" min="0" max="<?= $row['stock'] ?>" value="0">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <button type="submit" class="btn">Add to Cart</button>
        </form>
    </div>
</div>

</body>
</html>
