<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'] ?? null; 

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['add_to_wishlist'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    // Escape the product name to prevent SQL injection
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $check_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_wishlist) > 0) {
        $message[] = 'Already added to wishlist';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist` (user_id, pid, name, price, image) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $message[] = 'Product added to wishlist';
    }
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    // Escape the product name to prevent SQL injection
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart) > 0) {
        $message[] = 'Already added to cart';
    } else {
        // Optional: Check and remove from wishlist if it exists
        $check_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        
        if (mysqli_num_rows($check_wishlist) > 0) {
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart` (user_id, pid, name, price, quantity, image) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Product added to cart';
    }
}

// Fetch categories for the filter
$categories = mysqli_query($conn, "SELECT DISTINCT category FROM products") or die('query failed');

$sort_option = isset($_POST['sort_option']) ? $_POST['sort_option'] : 'name';
$filter_category = isset($_POST['filter_category']) ? $_POST['filter_category'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search Page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Search Page</h3>
</section>

<section class="search-form">
    <form action="" method="POST">
        <input type="text" class="box" placeholder="Search products..." name="search_box">
        
        <!-- Category Filter Dropdown -->
        <select name="filter_category" class="box">
            <option value="">Select Category</option>
            <?php while($row = mysqli_fetch_assoc($categories)): ?>
                <option value="<?php echo $row['category']; ?>" <?php echo ($row['category'] == $filter_category) ? 'selected' : ''; ?>>
                    <?php echo $row['category']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        
        <select name="sort_option" class="box">
            <option value="name" <?php echo ($sort_option == 'name') ? 'selected' : ''; ?>>Sort by Name</option>
            <option value="price" <?php echo ($sort_option == 'price') ? 'selected' : ''; ?>>Sort by Price</option>
        </select>
        
        <input type="submit" class="btn" value="Search" name="search_btn">
    </form>
</section>

<section class="products" style="padding-top: 0;">

   <div class="box-container">

      <?php
        if(isset($_POST['search_btn'])){
            $search_box = mysqli_real_escape_string($conn, $_POST['search_box']);
            $filter_query = $filter_category ? " AND category = '$filter_category'" : "";
            $order_by = $sort_option == 'price' ? "ORDER BY price" : "ORDER BY name";

            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_box}%' $filter_query $order_by") or die('query failed');

            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <div class="price">₱<?php echo $fetch_products['price']; ?>/-</div>
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <input type="submit" value="Add to Wishlist" name="add_to_wishlist" class="option-btn">
         <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
      </form>
      <?php
                }
            } else {
                echo '<p class="empty">No result found!</p>';
            }
        } else {
            echo '<p class="empty">Search something!</p>';
        }
      ?>

   </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>