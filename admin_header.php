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

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin <span><?php echo $_SESSION['admin_name']; ?></span></a>

      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_inventory.php">Product Inventory</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_contacts.php">Messages</a>
         <a href="admin_users.php">Users</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user-circle"></div>
      </div>

      <div class="account-box">
         <p>User: <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="index.php" class="delete-btn">logout</a>
         <div><a href="index.php">Signup</a> </div>
      </div>

   </div>

</header>