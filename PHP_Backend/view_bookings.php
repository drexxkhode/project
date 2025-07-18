<?php
// Fetch user from DB using PHP only (no JavaScript)
require_once 'db.php'; // Your DB connection file

$user = [
  'id' => '',
  'name' => '',
  'email' => '',
  'phone' => '',
  'service_type' => '',
  'message' => '',
  'booking_date' => '',
  'booking_time' => '',
  'created_at' => ''
];

if (isset($_GET['id'])) {
  $user_id = intval($_GET['id']);
  $stmt = $con->prepare("SELECT id, name, email, phone, service_type, message, booking_date, booking_time, created_at FROM bookings WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr"
  data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>View message and reply</title>

  <?php include_once('partials/links.php'); ?>
  <style>
    .profile-card {
      max-width: 900px;
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .profile-header {
      background-color: #0d6efd;
      color: white;
      padding: 2rem;
      display: flex;
      align-items: center;
      gap: 2rem;
    }
    .profile-header img {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      border: 5px solid white;
      object-fit: cover;
    }
    .profile-body {
      padding: 2rem;
    }
    .profile-body h5 {
      font-weight: bold;
    }
    .info-label {
      font-weight: 500;
      color: #555;
    }
    .social-icons a {
      margin-right: 15px;
      color: #0d6efd;
      transition: color 0.3s;
    }
    .social-icons a:hover {
      color: #0a58ca;
    }
    #message-field{
      width: 100%;height: 70px; padding: 10px;
    }
  </style>
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <?php require_once('partials/sidebar.php'); ?>

      <div class="layout-page">
        <?php require_once('partials/navbar.php'); ?>

        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">

           <div class="card profile-card">
    <div class="profile-header">
      <img src="assets/img/profile.avif" alt="Profile Picture">
      <div>
        <h2><?= htmlspecialchars($user['name']) ?></h2>
        <p class="mb-1"><?= htmlspecialchars($user['email']) ?></p>
        <p class="mb-1"><?= htmlspecialchars($user['service_type']) ?></p>
        <div class="social-icons mt-2">
          <a href="#"><i class="fab fa-linkedin fa-lg"></i></a>
          <a href="#"><i class="fab fa-github fa-lg"></i></a>
          <a href="#"><i class="fab fa-twitter fa-lg"></i></a>
        </div>
      </div>
    </div>
    <div class="profile-body">
      <div class="row mb-3">
        <div class="col-md-6">
          <p><span class="info-label">ID:</span> <?= htmlspecialchars($user['id'] ?? $_GET['id']) ?></p>
        </div>
        <div class="col-md-6">
          <p><span class="info-label">Phone: </span> +233 <?= htmlspecialchars($user['phone']) ?></p>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <p><span class="info-label">Booking Date: </span> <?= htmlspecialchars($user['booking_date']) ?></p>
        </div>
        <div class="col-md-6">
          <p><span class="info-label">Booking Time: </span> <?= htmlspecialchars($user['booking_time']) ?></p>
        </div>
      </div>
      <div>
       <textarea class="form-control"  rows="6" id="message-field" readonly ><?= htmlspecialchars($user['message']) ?></textarea><br>

      </div>
       <div>
        <form action="../bookings_mail.php" method="POST">
          <input type="hidden" name="name" value="<?= htmlspecialchars($user['name']) ?>">
          <input type="hidden" name="email" value="<?= htmlspecialchars($user['email']) ?>">
          <textarea class="form-control" name="message" rows="6" placeholder="Reply to the user..." required></textarea><br>
          <button type="submit" class="btn btn-primary">Send Mail</button>
        </form>
     
      </div>
    </div>
  </div>

            </div>

          <?php require_once('partials/footer.php'); ?>
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  <?php require_once('partials/scripts.php'); ?>
</body>
</html>
