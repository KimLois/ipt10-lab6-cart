<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History</title>
</head>
<body>
    <h1>Your Order History</h1>

    <?php if (isset($_SESSION['orders']) && !empty($_SESSION['orders'])): ?>
        <?php foreach ($_SESSION['orders'] as $order): ?>
            <h3>Order Code: <?php echo $order['order_code']; ?></h3>
            <p>Date: <?php echo $order['date']; ?></p>
            <ul>
                <?php foreach ($order['items'] as $item): ?>
                    <li><?php echo $item['name']; ?> - <?php echo $item['price']; ?> PHP</li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Total Price: <?php echo $order['total_price']; ?> PHP</strong></p>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have no previous orders.</p>
    <?php endif; ?>

    <a href="index.php">Back to shopping</a>
</body>
</html>