<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add product functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO products (name, price, description, stock) VALUES ('$name', '$price', '$description', '$stock')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>New product added successfully</p>";
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
    <title>Add Product - E-commerce Store</title>
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
        <h2>Add New Product</h2>
        <form method="POST" action="">
            <label for="name">Product Name:</label>
            <input type="text" name="name" required>

            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" required>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea>

            <label for="stock">Stock:</label>
            <input type="number" name="stock" required>

            <input type="submit" name="add_product" value="Add Product">
        </form>
    </section>
</div>

</body>
</html>