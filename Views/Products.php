<?php
require_once __DIR__ . "/../Models/DbContext.php";


$db = new \Model\Database();
$conn = $db->getConnection();

if (!$conn) {
    die("Database connection failed.");
}

$result = $conn->query("SELECT * FROM products");

echo "
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f4f4f9;
    }
    h1 {
        text-align: center;
        color: #333;
    }
    table {
        border-collapse: collapse;
        width: 80%;
        margin: 20px auto;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
        padding: 10px 15px;
        text-align: center;
    }
    th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #eaf3ff;
    }
</style>
";

echo "<h1>Product List</h1>";
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Stock</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['product_id'] . "</td>";
    echo "<td>" . $row['product_name'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['stock'] . "</td>";
    echo "</tr>";
}
echo "</table>";

$conn->close();
?>