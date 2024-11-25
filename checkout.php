<?php
@include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

$messages = [];

// Handle order placement
if (isset($_POST['order'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products = [];

    // Retrieve cart items
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query Failed: ' . mysqli_error($conn));
    
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ')';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);
    $total_products = mysqli_real_escape_string($conn, $total_products); // Escape special characters in total_products

    // Prepare the order check query
    $order_query = "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'";

    // Print the query for debugging (optional)
    // echo $order_query; // Uncomment this line to debug

    $order_result = mysqli_query($conn, $order_query) or die('Query Failed: ' . mysqli_error($conn));

    if ($cart_total == 0) {
        $messages[] = 'Your cart is empty!';
    } elseif (mysqli_num_rows($order_result) > 0) {
        $messages[] = 'Order has already been placed!';
    } else {
        // Insert the new order
        $insert_query = "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')";
        
        if (mysqli_query($conn, $insert_query)) {
            // Clear the cart
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Query Failed: ' . mysqli_error($conn));
            $messages[] = 'Order placed successfully!';
        } else {
            $messages[] = 'Failed to place the order: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Checkout Order</h3>
</section>

<section class="display-order">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query Failed: ' . mysqli_error($conn));
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $total_price;
    ?>    
    <p><?php echo htmlspecialchars($fetch_cart['name']); ?> <span>(₱<?php echo htmlspecialchars($fetch_cart['price']); ?> x <?php echo htmlspecialchars($fetch_cart['quantity']); ?>)</span></p>
    <?php
            }
        } else {
            echo '<p class="empty">Your cart is empty</p>';
        }
    ?>
    <div class="grand-total">Grand Total: <span>₱<?php echo $grand_total; ?>/-</span></div>
</section>

<section class="checkout">
    <form action="" method="POST">
        <h3>Place Your Order</h3>
        <div class="flex">
            <div class="inputBox">
                <span>Your Name:</span>
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>
            <div class="inputBox">
                <span>Your Number:</span>
                <input type="number" name="number" min="0" placeholder="Enter your number" required>
            </div>
            <div class="inputBox">
                <span>Your Email:</span>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="inputBox">
                <span>Payment Method:</span>
                <select name="method" required>
                    <option value="cash on delivery">Cash on Delivery</option>
                    <option value="credit card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="paytm">Paytm</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Address Line 01:</span>
                <input type="text" name="flat" placeholder="e.g. Flat No." required>
            </div>
            <div class="inputBox">
                <span>Address Line 02:</span>
                <input type="text" name="street" placeholder="e.g. Street Name">
            </div>
            <div class="inputBox">
                <span>City:</span>
                <input type="text" name="city" placeholder="e.g. Mumbai" required>
            </div>
            <div class="inputBox">
                <span>State:</span>
                <input type="text" name="state" placeholder="e.g. Maharashtra" required>
            </div>
            <div class="inputBox">
                <span>Country:</span>
                <input type="text" name="country" placeholder="e.g. India" required>
            </div>
            <div class="inputBox">
                <span>Pin Code:</span>
                <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" required>
            </div>
        </div>
        <input type="submit" name="order" value="Order Now" class="btn">
    </form>
</section>

<div class="messages">
    <?php
    // Display messages
    if (!empty($messages)) {
        foreach ($messages as $msg) {
            echo "<p class='message'>" . htmlspecialchars($msg) . "</p>";
        }
    }
    ?>
</div>

<?php @include 'footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>