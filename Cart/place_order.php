<?php
session_start();
require 'products.php';

// Generate a random order code
$order_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

// Get the current date and time
$order_date = date('Y-m-d H:i:s');

// Get the cart items
$cart_items = $_SESSION['cart'];

// Calculate the total price
$total_price = 0;
foreach ($cart_items as $item) {
    $total_price += $item['price'];
}

// Create the order file
$order_file = fopen("orders-{$order_code}.txt", "w");
fwrite($order_file, "Order Code: {$order_code}\n");
fwrite($order_file, "Date: {$order_date}\n");
fwrite($order_file, "Items:\n");

foreach ($cart_items as $item) {
    fwrite($order_file, "- Product ID: {$item['id']} | Name: {$item['name']} | Price: {$item['price']} PHP\n");
}

fwrite($order_file, "Total Price: {$total_price} PHP\n");
fclose($order_file);

// Save the order to session for order history
if (!isset($_SESSION['orders'])) {
    $_SESSION['orders'] = [];
}

$_SESSION['orders'][] = [
    'order_code' => $order_code,
    'date' => $order_date,
    'items' => $cart_items,
    'total_price' => $total_price
];

// Clear the cart after placing the order
$_SESSION['cart'] = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <p>Your order code is: <strong><?php echo $order_code; ?></strong></p>
    <p>Total Price: <strong><?php echo $total_price; ?> PHP</strong></p>
    <a href="index.php">Go back to shopping</a> | <a href="order_history.php">View Order History</a>
</body>
</html>