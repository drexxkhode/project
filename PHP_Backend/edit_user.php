<?php
require_once 'auth/authenticate.php'; // Ensure the user is authenticated
require_once 'db.php'; // Your DB connection file

$user = [
  'id' => '',
  'username' => '',
  'fullname' => '',
  'email' => '',
  'role' => '',
  'image_data' => '',
  'image_type' => '',
  'created_at' => ''
];

if (isset($_GET['id'])) {
  $user_id = intval($_GET['id']);
  $stmt = $con->prepare("SELECT id, username, fullname,email, role,image_data,image_type, created_at FROM users WHERE id = ?");
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
  <title>Nanamonfarmsltd - Edit User </title>
<!-- Page CSS -->

  <?php include_once('partials/links.php'); ?>
  
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
  <?php if (!empty($user['image_data']) && !empty($user['image_type'])): ?>
  <img src="data:<?= htmlspecialchars($user['image_type']) ?>;base64,<?= base64_encode($user['image_data']) ?>" alt="User Image">
<?php else: ?>
  <img src="assets/img/profile.avif" alt="Default Avatar"> <!-- fallback image -->
<?php endif; ?>

      <div>
        <h2><?= htmlspecialchars($user['fullname']) ?></h2>
        <p class="mb-1"><?= htmlspecialchars($user['created_at']) ?></p>
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
          <p><span class="info-label">Role: </span> <strong><?= htmlspecialchars($user['role']) ?></strong></p>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <p><span class="info-label">Username: </span> <strong><?= htmlspecialchars($user['username']) ?></strong></p>
        </div>
        
        <div class="col-md-6">
          <p><span class="info-label">Email: </span> <?= htmlspecialchars($user['email']) ?></p>
        </div>
        
      </div>
       <div class="col-lg-8" >
        <form action="update_user.php" method="POST" enctype="multipart/form-data" >
            <div class="col-md-12 " > 
                <input type="hidden" class="form-control" name="id" value="<?= htmlspecialchars($user['id']) ?>"><br>
            </div>
            <div class="col-md-12 " >
                
                <input type="text"  class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>" required ><br>
            </div>
          <div class="col-md-12 " >
                
              <input type="text" class="form-control" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required ><br>
            </div>
          <div class="col-md-12 " >  
              <input class="form-control"  type="email" name="email" value="<?= htmlspecialchars($user['email']) ?> " required ><br>
            </div>
          <div class="col-md-12" >
                <select class="form-select" name="role" class="form-control" required > 
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="support agent" <?= $user['role'] === 'support agent' ? 'selected' : '' ?> >Support Agent</option>
                </select><br>
                </div>
          </div>
          <div class="col-md-12 " >  
              <input class="form-control"  type="file" name="image" ><br>
            </div>
          <button type="submit" class="btn btn-primary"> Save changes </button>
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
