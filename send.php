<?php
// inbox.php

// Gmail IMAP config
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'nanamonfarmsltd@gmail.com'; // Replace with your Gmail
$password = 'nqwqwtnoasfqtxpc'; // Use App Password

// Connect to Gmail
$inbox = imap_open($hostname, $username, $password) or die('IMAP connection failed: ' . imap_last_error());

// Search for replies related to your auto-reply subject
$emails = imap_search($inbox, 'ALL ');

echo "<h2>Client Replies to Nanamon Farms</h2>";
echo "<hr>";

if ($emails) {
    rsort($emails); // Newest first

    foreach ($emails as $email_number) {
        $overview = imap_fetch_overview($inbox, $email_number, 0)[0];
        $message = imap_fetchbody($inbox, $email_number, 1);
        $subject = htmlspecialchars($overview->subject);
        $from = htmlspecialchars($overview->from);
        $date = htmlspecialchars($overview->date);
        $body = nl2br(htmlentities($message));

        echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:15px'>";
        echo "<strong>From:</strong> $from<br>";
        echo "<strong>Subject:</strong> $subject<br>";
        echo "<strong>Date:</strong> $date<br><br>";
        echo "<div style='background:#f9f9f9; padding:10px'>$body</div>";
        echo "</div>";
    }
} else {
    echo "<p><em>No client replies found.</em></p>";
}

imap_close($inbox);
?>


            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/masonry-portfolio/pm.jpg"  class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>1L<?= htmlspecialchars($user['service_name'] ) ?></h4>
                <p>Essential for every authentic African dish. <?= htmlspecialchars($user['description'] ) ?> </p>
                <a href="assets/img/masonry-portfolio/pm.jpg" title="<?= htmlspecialchars($user['service_name'] ) ?>" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i id="zoom" class="bi bi-zoom-in"></i></a>
                <h3  title="Price" class="details-link"><sup>&#8373</sup><?= htmlspecialchars($user['price'] ) ?></h3>
              </div>
            </div><!-- End product Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/masonry-portfolio/palmoil5L.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>6L</h4>
                <p>Rich color, deep flavor, pure quality.</p>
                <a href="assets/img/masonry-portfolio/palmoil5L.png" title="6L" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i  id="zoom" class="bi bi-zoom-in"></i></a>
                <h3  title="Price" class="details-link"><sup>&#8373</sup>75</h3>
              </div>
            </div><!-- End product Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/masonry-portfolio/palmoil1G.webp" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>10L</h4>
                <p>100% natural palm oil</p>
                <a href="assets/img/masonry-portfolio/palmoil1G.webp" title="10L" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i id="zoom" class="bi bi-zoom-in"></i></a>
                <h3  title="Price" class="details-link"><sup>&#8373</sup>450</h3>
              </div>
            </div><!-- End product Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/masonry-portfolio/palmoil1.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>All</h4>
                <p>All for this price, pure and affordable.</p>
                <a href="assets/img/masonry-portfolio/palmoil1.png" title="All" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i  id="zoom" class="bi bi-zoom-in"></i></a>
                <h3 title="Price" class="details-link"><sup>&#8373</sup>3500</h3>
              </div>
            </div><!-- End product Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/masonry-portfolio/palmoil3.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>1 Gallon</h4>
                <p>Nature’s Gift for Tasty & Healthy Cooking.</p>
                <a href="assets/img/masonry-portfolio/palmoil3.jpg" title="Product 2" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i  id="zoom" class="bi bi-zoom-in"></i></a>
                <h3 title="Price" class="details-link"> <sup> &#8373</sup>550</h3>
              </div>
            </div><!-- End product Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/masonry-portfolio/palmoil4.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>500ml</h4>
                <p>Rich in Flavor, Rich in Tradition.</p>
                <a href="assets/img/masonry-portfolio/palmoil4.jpg" title="500ml" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i id="zoom" class="bi bi-zoom-in"></i></a>
                <h3 title="Price" class="details-link"> <sup> &#8373</sup>35</h3>
              </div>
            </div><!-- End product Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/masonry-portfolio/palmoil20L.webp" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>20L</h4>
                <p>From Farm to Kitchen – 100% Natural Palm Oil.</p>
                <a href="assets/img/masonry-portfolio/palmoil20L.webp" title="20L" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i  id="zoom" class="bi bi-zoom-in"></i></a>
                <h3 title="Price" class="details-link"><sup>&#8373</sup> 1200</h3>
              </div>
            </div><!-- End product Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/masonry-portfolio/drum2.avif" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>500L</h4>
                <p>Pure Goodness, Naturally Red.</p>
                <a href="assets/img/masonry-portfolio/drum2.avif" title="drum" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i id="zoom" class="bi bi-zoom-in"></i></a>
                <h5 title="Price" class="details-link"> <sup> &#8373</sup>2600</h5>
              </div>
            </div><!-- End product Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/masonry-portfolio/palm-oil.webp" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>1.5L</h4>
                <p>Taste the Tradition in Every Drop.</p>
                <a href="assets/img/masonry-portfolio/palm-oil.webp" title="1.5L" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i id="zoom" class="bi bi-zoom-in"></i></a>
                <h5 title="Price" class="details-link"> <sup> &#8373</sup>50</h5>
              </div>
            </div><!-- End product Item -->
