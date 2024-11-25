<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

// Initialize a message variable for feedback
$message = []; // Ensure this is an array

// Handle adding stock
if (isset($_POST['add_stock'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $additional_stock = mysqli_real_escape_string($conn, $_POST['additional_stock']);

    // Update the stock quantity in the database
    $update_query = "UPDATE `products` SET stock = stock + '$additional_stock' WHERE id = '$product_id'";
    if (mysqli_query($conn, $update_query)) {
        $message[] = 'Stock updated successfully!'; // Correctly appending to the array
    } else {
        $message[] = 'Failed to update stock!';
    }
}

// Handle setting stock to zero (deleting stock)
if (isset($_POST['delete_stock'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    
    // Set stock to zero in the database
    $delete_query = "UPDATE `products` SET stock = 0 WHERE id = '$product_id'";
    if (mysqli_query($conn, $delete_query)) {
        $message[] = 'Stock deleted successfully!';
    } else {
        $message[] = 'Failed to delete stock!';
    }
}

// Fetch all products with stock levels
$select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Inventory Management</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php @include 'admin_header.php'; ?>

<section class="inventory-management">

    <?php
    // Debugging line to check the type of $message
    //var_dump($message); // Temporarily add line for debugging

    // Display messages (if any)
    if (!empty($message) && is_array($message)) {
        foreach ($message as $msg) {
            echo "<p class='message'>" . htmlspecialchars($msg) . "</p>";
        }
    }
    ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Current Stock</th>
                    <th>Price</th>
                    <th>Add Stock</th>
                    <th>Delete Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($select_products) > 0) {
                    while ($product = mysqli_fetch_assoc($select_products)) {
                        $stock = isset($product['stock']) ? $product['stock'] : 'N/A';
                        $low_stock_warning = $stock < 10 ? "style='color:red;'" : "";
                ?>
                <tr <?php echo $low_stock_warning; ?>>
                    <td class="name"><?php echo htmlspecialchars($product['name']); ?></td>
                    <td class="box"><?php echo htmlspecialchars($stock); ?></td>
                    <td class="price">₱<?php echo htmlspecialchars($product['price']); ?>/-</td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <input type="number" name="additional_stock" min="1" required placeholder="Add Stock" class="box">
                            <input type="submit" name="add_stock" value="Update Stock" class="btn">
                        </form>
                    </td>
                    <td>
                        <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete the stock for this product?');">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <input type="submit" name="delete_stock" value="Delete Stock" class="btn" style="background-color: red;">
                        </form>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="5">No products found!</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<script src="js/admin_script.js"></script>
</body>
</html>