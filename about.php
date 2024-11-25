<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- google font -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading-about">
    <h3>about us</h3>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/bg4.jpg" alt="">
        </div>

        <div class="content">
            <h3>About</h3>
            <p>TrailFit is dedicated to providing high-quality hiking apparel and barefoot shoes for outdoor enthusiasts who prioritize comfort and performance.

</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>Contact</h3>
            <p>At TrailFit, we value your feedback and inquiries. Whether you have questions about our products or need assistance, we're here to help!</p>
            <a href="contact.php" class="btn">contact us</a>
        </div>

        <div class="image">
            <img src="images/bg3.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/bg5.jpg" alt="">
        </div>

        <div class="content">
            <h3>Community</h3>
            <p>At TrailFit, we believe in fostering a vibrant community of outdoor enthusiasts. Our platform connects hikers, adventurers, and nature lovers to share experiences, tips, and inspiration. Join us to engage with fellow adventurers, participate in discussions, and access exclusive content that enhances your outdoor journeys.</p>
            <a href="#reviews" class="btn">clients reviews</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">Reviews</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>"I recently purchased hiking gear from TrailFit, and I couldn't be happier! The website is user-friendly, making it easy to find exactly what I needed. The product quality is top-notch, and my new shoes are incredibly comfortable on the trails and hikes!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>John Mathew Dedal</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>"The community aspect of TrailFit is fantastic! I love connecting with other outdoor enthusiasts and sharing tips and experiences. The forums are active, and I've gained so much knowledge from fellow hikers. Just wish there were more local meetups!"</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Kisha </h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>"TrailFit's shop has a great selection of products at reasonable prices. I appreciate the detailed descriptions and customer reviews that help in making informed choices. My order arrived quickly, and everything was packaged well. Highly recommend!"</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Eric Mark Sy</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>"I like the concept of TrailFit and the community vibe. However, I encountered some issues navigating the website initially. Once I got used to it, shopping was a breeze. Looking forward to more features and updates!"</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Lulu Dela Naga</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>"TrailFit has become my go-to for all hiking needs! The quality of the apparel is impressive, and the blog section is filled with helpful tips and inspiring stories. It’s great to have a place dedicated to hikers like me!"</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Troy Imman Pablo</h3>
        </div>

        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>"I’ve been a member of the TrailFit community for a few months now, and it has been a fantastic experience. The support and encouragement from fellow hikers are incredible. Plus, the shop offers everything I need for my adventures!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Sarrah Dutirte</h3>
        </div>

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>