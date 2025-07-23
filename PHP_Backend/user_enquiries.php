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

    <title> Nanamonfarmsltd - Enquiries </title>

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
                <h5 class="card-header">Enquiries</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Message</th>
                          <th>Time</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
               <?php
$query = "SELECT * FROM enquiries";
$result = $con->query($query); 


if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $status = $row["status"]; // don't sanitize for logic
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["subject"]) . "</td>";
    echo "<td>" . "<a class='btn btn-outline-primary' href='view_enquirie_msg.php?id=" . urlencode($row["id"]) . "'>view</a>" . "</td>";
    echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
    echo "<td>" . htmlspecialchars($status) . "</td>";
    
    echo "<td>";
    if ($status !== 'replied') {
      echo "<a class='btn btn-outline-primary' href='view_enquiries.php?id=" . urlencode($row["id"]) . "'>Reply</a> <br>",
      "<button data-bs-target='#smallModal'  data-bs-toggle='modal' data-id=' {$row["id"]} '  class='btn btn-outline-danger'>Delete</button>";
    } else {
      echo "<em>Replied</em> <br>" ,
      "<button data-bs-target='#smallModal'  data-bs-toggle='modal' data-id=' {$row["id"]} '  class='btn btn-outline-danger'>Delete</button>";
    }
    echo "</td>";
    echo "</tr>";
  } 
  }
else {
  echo '<tr><td colspan="6" class="text-center">No records found.</td></tr>';
}
?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

                        <!-- Small Modal -->
                      <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true" data-target-input="delete_id" >
                        <div class="modal-dialog modal-sm" >
                          <form action="delete_enquirie.php" method="POST" >
                            <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel2">Confirm Delete </h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete this record?
                              <div class="row">
                                <div class="col mb-3">
                                  <input type="hidden"  name="delete_id" id="delete_id" class="form-control"  />
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                              </button>
                              <button type="submit" name="delete" class="btn btn-primary">Delete</button>
                            </div>
                          </div>
                          </form>
                        </div>
                      </div>
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
