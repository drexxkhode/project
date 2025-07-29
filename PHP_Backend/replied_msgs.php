<?php
require_once 'db.php';
require_once 'auth/authenticate.php'; // Ensure the user is authenticated

?>

<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title> Nanamonfarmsltd - Replied Messages </title>

    <!-- links -->
        <?php include_once('partials/links.php'); ?>
        <!-- End links -->
    <meta name="description" content="" />

   
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Sidebar -->
<?php require_once('partials/sidebar.php'); ?>
        <!--  Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
<?php require_once('partials/navbar.php'); ?>
        
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
             <!-- Bordered Table -->
              <div class="card">
                <h5 class="card-header">Replied Messages</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="dataTable" >
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Client ID</th>
                          <th>Email</th>
                          <th>Name</th>
                          <th>Message</th>
                          <th>Date</th>
                          <th>Actions</th>
                        </tr>
                      </thead>

                      <tbody>
            <?php
$query = "SELECT * FROM replies";
$result = $con->query($query); 

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["clients_id"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
     echo "<td>" . "<a class='btn btn-outline-primary' href='view_replied_msg.php?id=" . urlencode($row["id"]) . "'>view</a>" . "</td>";
    echo "<td>" . htmlspecialchars($row["replied_at"]) . "</td>"; 
    echo "<td>" . "<button data-bs-target='#smallModal'  data-bs-toggle='modal' data-id=' {$row["id"]} '  class='btn btn-outline-danger'>Delete</button>" .
    "</td>";
    echo "</tr>";
  }
} else {
  echo '<tr><td colspan="7" class="text-center">No records found.</td></tr>';
}
?>


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--/ Bordered Table -->

            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php require_once('partials/footer.php'); ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
<?php require_once('partials/scripts.php'); ?>

    </body>
</html>
