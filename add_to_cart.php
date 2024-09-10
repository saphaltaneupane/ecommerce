<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $stock_check = $conn->query("SELECT stock FROM products WHERE id='$product_id'");
    $row = $stock_check->fetch_assoc();

    if ($row['stock'] >= $quantity) {
        $sql = "INSERT INTO cart (product_id, quantity) VALUES ('$product_id', '$quantity')";

        if ($conn->query($sql) === TRUE) {
            echo "Product added to cart.<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Insufficient stock.";
    }
}

$conn->close();
?>

<a href="index.php">Back to Products</a>
