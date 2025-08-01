
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title> nananomfarmsltd.com - Service </title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Links -->
    <?php require_once('partials/links.php'); ?>
</head>

<body class="index-page">
    <header id="header" class="header sticky-top">
        <div class="topbar d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope d-flex align-items-center">
                        <a href="mailto:nanamonfarmsltd@gmail.com">nanamonfarmsltd@gmail.com</a>
                    </i>
                    <i class="bi bi-phone d-flex align-items-center ms-4">
                        <span>+233 50914 1585</span>
                    </i>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="aboutUs.php">About</a></li>
                        <li><a href="book_service.php" class="active">Service Booking</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="enquiries.php">General Enquiries</a></li>
                        <li><a href="contactUs.php">Contact Us </a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services" class="services section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Services</h2>
            <p><span>Book a </span> <span class="description-title">Service</span></p>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="col-lg-12">
                <form action="../PHP_Backend/add_booking.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <label for="name-field" class="pb-2">Your Name</label>
                            <input type="text" name="name" id="name-field" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email-field" class="pb-2">Your Telephone</label>
                            <input type="tel" class="form-control" name="tel" id="tel-field" required pattern="[0-9]{10}">
                        </div>
                        <div class="col-md-6">
                            <label for="email-field" class="pb-2">Your Email</label>
                            <input type="email" class="form-control" name="email" id="email-field" required>
                        </div>
                        <div class="col-md-6">
                            <label for="subject-field" class="pb-2">Services</label>
                            <select name="service_type" class="form-control">
                                <option value="">Select a Service</option>
                                <option value="Palm Oil Retail Sales">Palm Oil Retail Sales</option>
                                <option value="Bulk Purchase & Delivery ">Bulk Purchase & Delivery </option>
                                <option value="Farm Tour / Site Visit">Farm Tour / Site Visit</option>
                                <option value="Consultation Services">Consultation Services</option>
                            </select>
                        </div>
                        <div class="col-md-10">
                            <label for="message-field" class="pb-2">Message</label>
                            <textarea class="form-control" name="message" placeholder="Any Message (Optional)" rows="6" id="message-field"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="email-field" class="pb-2">Date</label>
                            <input type="date" class="form-control" name="date" id="date-field" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email-field" class="pb-2">Time</label>
                            <input type="time" class="form-control" name="time" id="time-field" required>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                            <button type="submit" name="booknow" class="book-btn">Book Now</button>
                        </div>
                    </div>
                </form>
            </div><!-- End Contact Form -->
        </div>
    </section><!-- /Services Section -->

    <!-- Footer -->
    <?php require_once("partials/footer.php"); ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader">
        <div></div>
        <div></div>
    </div>

    <!-- scripts -->
    <?php require_once('partials/scripts.php'); ?>
</body>

</html>