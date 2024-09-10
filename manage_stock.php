<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update stock functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_stock'])) {
    $product_id = $_POST['product_id'];
    $new_stock = $_POST['new_stock'];

    $sql = "UPDATE products SET stock = '$new_stock' WHERE id = '$product_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Stock updated successfully</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Stock - E-commerce Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>My E-Commerce Store</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="add_product.php">Add Product</a></li>
            <li><a href="manage_stock.php">Manage Stock</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <section>
        <h2>Update Stock</h2>
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>
                        <span class='product-title'>" . $row['name'] . "</span><br>
                        Current Stock: " . $row['stock'] . "<br>
                        <form method='POST' action=''>
                            <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                            <label>New Stock:</label>
                            <input type='number' name='new_stock' required>
                            <input type='submit' name='update_stock' value='Update Stock'>
                        </form>
                      </div>";
            }
        } else {
            echo "No products available.";
        }
        ?>
    </section>
</div>

</body>
</html>