<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT cart.id, products.name, products.price, cart.quantity FROM cart JOIN products ON cart.product_id = products.id";
$result = $conn->query($sql);
$total = 0;

echo "<h2>Checkout</h2>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subtotal = $row["price"] * $row["quantity"];
        $total += $subtotal;
        echo "<div class='cart-item'>
                Product: " . $row["name"] . "<br>
                Quantity: " . $row["quantity"] . "<br>
                Subtotal: $" . $subtotal . "
              </div>";
    }
    echo "<div class='cart-total'>Total: $" . $total . "</div>";

    $conn->query("DELETE FROM cart");
    echo "<p>Checkout complete! Thank you for your purchase.</p>";
} else {
    echo "Your cart is empty.";
}

$conn->close();
?>

<a href="index.php">Back to Products</a>
