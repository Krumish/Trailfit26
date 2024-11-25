<?php
@include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

// Initialize messages array for feedback
$messages = [];

// Handle order placement
if (isset($_POST['place_order'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $order_quantity = mysqli_real_escape_string($conn, $_POST['order_quantity']);

    // Check product stock
    $product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'") or die('query failed');
    $product = mysqli_fetch_assoc($product_query);

    if ($product) {
        $current_stock = $product['stock'];

        if ($current_stock >= $order_quantity) {
            // Proceed with order placement
            $total_price = $order_quantity * $product['price']; // Calculate total price
            $order_query = "INSERT INTO `orders` (user_id, product_id, total_products, total_price, payment_status, placed_on)
                            VALUES ('$user_id', '$product_id', '$order_quantity', '$total_price', 'pending', NOW())";

            if (mysqli_query($conn, $order_query)) {
                // Update stock
                $new_stock = $current_stock - $order_quantity;
                mysqli_query($conn, "UPDATE `products` SET stock = '$new_stock' WHERE id = '$product_id'");
                $messages[] = 'Order placed successfully! Stock updated.';
            } else {
                $messages[] = 'Failed to place order!';
            }
        } else {
            $messages[] = 'Not enough stock available!';
        }
    } else {
        $messages[] = 'Product not found!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Your Orders</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Your Orders</h3>
</section>

<section class="placed-orders">
    <h1 class="title">Placed Orders</h1>

    <div class="messages">
        <?php
        // Display messages if any
        if (!empty($messages)) {
            foreach ($messages as $msg) {
                echo "<p class='message'>$msg</p>";
            }
        }
        ?>
    </div>

    <div class="box-container">
        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
        ?>
        <div class="box">
            <p>Order ID: <span><?php echo htmlspecialchars($fetch_orders['id']); ?></span></p>
            <p>Products Ordered: <span><?php echo htmlspecialchars($fetch_orders['total_products']); ?></span></p>
            <p>Payment Status: <span><?php echo htmlspecialchars($fetch_orders['payment_status']); ?></span></p>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">No orders placed yet!</p>';
        }
        ?>
    </div>
</section>

<?php @include 'footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>