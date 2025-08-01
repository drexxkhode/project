<?php

require_once '../PHP_Backend/db.php'; // Your DB connection file

$products = [];
$stmt = $con->prepare("SELECT id, service_name, description, price, image, image_type FROM products ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title> nananomfarmsltd.com - Products </title>
  <meta name="description" content="">
  <meta name="keywords" content="">
<!--links-->
<?php
require_once('partials/links.php');
?>
</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:nanamonfarmsltd66@gmail.com">nanamonfarmsltd66@gmail.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+233 5589 55488</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
          
           <img src="assets/img/logo.png" alt=""> 
          <h3 class="sitename">Nananom Farms Ltd.</h3>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="index.php" >Home</a></li>
            <li><a href="aboutUs.php">About</a></li>
            <li><a href="book_service.php">Service Booking</a></li>
            <li><a href="products.php" class="active" >Products</a></li>
            <li><a href="enquiries.php">General Enquiries</a></li>
            <li><a href="contactUs.php">Contact Us</a></li></ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </div>

    </div>

  </header>

  <!--Products section-->
  <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Products</h2>
        <p><span>Check Our&nbsp;</span> <span class="description-title">Products</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
  <?php foreach ($products as $product): ?>
    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
      <img src="data:<?= $product['image_type'] ?>;base64,<?= base64_encode($product['image']) ?>" class="img-fluid" alt="">
      <div class="portfolio-info">
        <h4><?= htmlspecialchars($product['service_name']) ?></h4>
        <p><?= htmlspecialchars($product['description']) ?></p>
        </a>
        <h3 title="Price" class="details-link"><sup>&#8373</sup><?= htmlspecialchars($product['price']) ?></h3>
      </div>
    </div>
  <?php endforeach; ?>
</div>

        </div>

      </div>

    </section><!-- /product Section -->
<!-- Footer -->
<?php
require_once('partials/footer.php');
?>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    </div>

    <!--scripts -->
    <?php 
    require_once('partials/scripts.php');
    ?>

</body>

</html>