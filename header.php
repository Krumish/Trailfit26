<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

 <!-- remix icon -->
 <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"rel="stylesheet"/>
    <div class="flex">

        <a href="home.php" class="logo">Trail Fit</a>

        <nav class="navbar">
            <ul>
                <li><a href="home.php">home</a></li>
                </li>
                <li><a href="shop.php">shop</a></li>
                <li><a href="orders.php">orders</a></li>
                <li><a href="#">More ▼</a>
                    <ul>
                        <li><a href="about.php">about</a></li>
                        <li><a href="contact.php">contact</a></li>
                    </ul>
                <li><a href="#">account ▼</a>
                    <ul>
                        <li><a href="index.php">Signup/Login</a></li>
                        
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="ri-search-line"></div>
            <a href="search_page.php"><i class="ri-search-line"></i></a>
            <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="ri-heart-line"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="ri-shopping-cart-line"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
            <div id="user-btn" class="fas fa-user-circle"></div>
        </div>
        

        <div class="account-box">
            <p>User: <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="index.php" class="delete-btn">logout</a>
        </div>

    </div>

</header>