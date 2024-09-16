<?php
session_start();
require 'products.php';

// Add to cart logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Find the product by its ID
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            $_SESSION['cart'][] = $product;  // Add product to cart
            break;
        }
    }
}

// Redirect to the cart page
header("Location: cart.php");
exit();
?>