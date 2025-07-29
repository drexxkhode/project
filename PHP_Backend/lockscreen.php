
<?php 
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/lockscreen.css" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../PHP_Frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
    <title>Nanamonfarmsltd - Lock Screen </title>
    <body class="lockscreen bg-body-secondary">

    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="lockscreen.php"><b>Nanamon</b> Farms Ltd.</a>

      </div>

      <div class="lockscreen-name"><?php echo $_SESSION['username'] ; ?> </div>

      <div class="lockscreen-item">
        <div class="lockscreen-image">
      <?php if (!empty($_SESSION['image_data']) && !empty($_SESSION['image_type'])): ?>
  <img src="data:<?= htmlspecialchars($_SESSION["image_type"]) ?>;base64,<?= base64_encode($_SESSION['image_data']) ?>" alt="User Image"  >
<?php else: ?>
  <img src="assets/img/profile2.webp" alt="Default Avatar"  > <!-- fallback image -->
<?php endif; ?>      
      </div>

        <form class="lockscreen-credentials" method="POST" action="auth/auth_lockscreen.php" >
          <div class="input-group">
            <input type="password" name="password" class="form-control shadow-none" placeholder="password" />
            <div class="input-group-text border-0 bg-transparent px-1">
              <button type="submit" class="btn shadow-none">
                <i class="bi bi-box-arrow-right text-body-secondary"></i>
              </button>
              <?php

                 if (isset($_SESSION['error'])): ?>
                 <div class="error-message" style="color:red;">
                    <?= htmlspecialchars($_SESSION['error']); ?>
                    </div>
                            <?php unset($_SESSION['error']);
                            endif; ?>
            </div>
          </div>
        </form>
      </div>

      <div class="help-block text-center">Enter your password to retrieve your session</div>
      <div class="text-center">
        <a href="logout.php" class="text-decoration-none">Or sign in as a different user</a>
      </div>
      <div class="lockscreen-footer text-center">
        Copyright © <script> document.write(new Date().getFullYear()); </script> &nbsp;
        <b
          ><a
            href="https://adminlte.io"
            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
            >AdminLTE.io</a
          ></b
        >
        <br />
        All rights reserved
      </div>
    </div>

    
    
  </body>
  <!--end::Body-->
</html>
