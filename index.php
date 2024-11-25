<?php

@include 'config.php';

session_start();

// Check if the register form is submitted
if (isset($_POST['register'])) {
    // Sanitize and validate user input for registration
    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, md5($filter_pass)); // Consider using password_hash() instead of md5()

    // Check if the email already exists in the database
    $check_email = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($check_email) > 0) {
        $message[] = 'Email already exists!';
    } else {
        // Insert new user into the database
        $insert_user = mysqli_query($conn, "INSERT INTO `users` (name, email, password, user_type) VALUES ('$name', '$email', '$pass', 'user')") or die('query failed');
        if ($insert_user) {
            $message[] = 'Registration successful! You can now log in.';
        } else {
            $message[] = 'Registration failed. Please try again.';
        }
    }

} elseif (isset($_POST['login'])) { // Check if the login form is submitted
    // Login logic starts here
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);
        $filter_pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $pass = mysqli_real_escape_string($conn, md5($filter_pass)); // Consider using password_hash() instead of md5()

        $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if (mysqli_num_rows($select_users) > 0) {
            $row = mysqli_fetch_assoc($select_users);

            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_page.php');
                exit();
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location:home.php');
                exit();
            } else {
                $message[] = 'No user found!';
            }
        } else {
            $message[] = 'Incorrect email or password!';
        }
    } else {
        // Handle case when 'email' or 'password' is not set
        $message[] = 'Please enter email and password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="register.css">

</head>
<body>

<?php
if (isset($message)) {
   foreach ($message as $msg) {
      echo '
      <div class="message">
         <span>' . $msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<section>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form name="myForm" onsubmit="return validateForm()" method="post">
                <div class="social-icons">
                    <img src="trailfit.png" />
                </div>

                <h1>Create Account</h1>

                <input type="text" placeholder="Name" name="name" required />
                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="password" required />

                <button type="submit" name="register">Sign Up</button>

            </form>
        </div>
        <!-- CREATE ACCOUNT ENDS HERE -->

        <!--LOGIN STARTS HERE -->

        <div class="form-container sign-in">
            <form name="myForm2" onsubmit="return validateForm()" method="POST">
                <div class="social-icons">
                    <img src="trailfit.png" />
                </div>

                <h1>Login</h1>

                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="password" required />

                <button type="submit" name="login">Login</button>

            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Hi, New User!</h1>
                    <p>Register Now</p>
                    <button class="hidden" id="login-toggle">Log In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Welcome Back!</h1>
                    <p>
                    Log in to browse your favorite Hiking Gears!
                    </p>
                    <button class="hidden" id="register-toggle">Sign Up</button>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    const toggleForm = () => {
        const container = document.getElementById('container');
        container.classList.toggle('active');
    };

    document.getElementById('login-toggle').addEventListener('click', toggleForm);
    document.getElementById('register-toggle').addEventListener('click', toggleForm);
</script>

</body>
</html>
