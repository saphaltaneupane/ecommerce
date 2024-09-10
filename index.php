<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Store</title>
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
    <div class="content">
        <!-- Display Products Section -->
        <section class="products">
            <h2>All Products</h2>

            <?php
            // Display all products
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>
                            <span class='product-title'>" . $row['name'] . "</span><br>
                            Price: Rs" . $row['price'] . "<br>
                            Description: " . $row['description'] . "<br>
                            Stock: " . $row['stock'] . "<br>
                            <form method='POST' action='add_to_cart.php'>
                                <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                                <label>Quantity:</label>
                                <input type='number' name='quantity' required>
                                <input type='submit' value='Add to Cart'>
                            </form>
                          </div>";
                }
            } else {
                echo "No products available.";
            }
            ?>
        </section>
    </div>

    <aside class="sidebar">
        <!-- Search Products Section -->
        <section class="search">
            <h2>Search Products</h2>
            <form method="POST" action="">
                <input type="text" name="search_term" placeholder="Enter product name or description" required>
                <input type="submit" name="search" value="Search">
            </form>

            <?php
            // Search functionality
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                $search_term = $_POST['search_term'];
                $sql = "SELECT * FROM products WHERE name LIKE '%$search_term%' OR description LIKE '%$search_term%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h3>Search Results:</h3>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='product'>
                                <span class='product-title'>" . $row['name'] . "</span><br>
                                Price: $" . $row['price'] . "<br>
                                Description: " . $row['description'] . "<br>
                                Stock: " . $row['stock'] . "
                              </div>";
                    }
                } else {
                    echo "No products found.";
                }
            }
            ?>
        </section>
    </aside>
</div>

</body>
</html>