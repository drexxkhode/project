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
                <h5 class="card-header"> Users </h5>
                <div class="card-body">
                    <button data-bs-target="#basicModal"  data-bs-toggle="modal"  class="btn btn-success" > Add User</button>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Username</th>
                          <th>Fullname</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Date Created</th>
                          <th>Actions</th>
                        </tr>
                      </thead>

                      <tbody>
            <?php
$query = "SELECT * FROM users";
$result = $con->query($query); 

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["fullname"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["role"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>"; 
    echo "<td>" . 
         "<a href='edit_user.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-outline-primary'>Edit</a> " .
         "<button data-bs-target='#smallModal'  data-bs-toggle='modal' data-id=' {$row["id"]} '  class='btn btn-outline-danger'>Delete</button>" .
    "</td>"; 
    echo "</tr>";
  }
} else {
  echo '<tr><td colspan="6" class="text-center">No records found.</td></tr>';
}
?>


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--/ Bordered Table -->
  <!-- Default Modal -->
                    <div class="col-lg-4 col-md-6">
                      <div class="mt-3">
                        <!-- Modal -->
                        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1"> Add user </h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                             <form action="add_user.php"  method="POST" enctype="multipart/form-data" >

                              <div class="modal-body">
                                <div class="row">     
                                  <div class="col mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required />
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="fullname" class="form-label">Fullname</label>
                                    <input type="text"  name="fullname" id="fullname" class="form-control" placeholder="Fullname" required />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
                                  </div>
                                </div>
                                
                                <div class="row g-2">
                                    <div class="col mb-0">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-control" required >
                                        <option value="">select role</option>
                                        <option value="admin">Admin</option>
                                        <option value="support agent">Support Agent</option>
                                    </select>
                                    </div>
                                  
                                </div>
                                <div class="row">     
                                  <div class="col mb-3">
                                    <label for="profile_pic" class="form-label">Profile Picture</label>
                                    <input type="file" name="image" id="profile_pic" class="form-control"   />
                                  </div>
                                </div>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="submit" name="save"  class="btn btn-primary">Save </button>
                              </div>

                             </form>
                             </div>
                          </div>
                        </div>

                        <!-- Small Modal -->
                      <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true" data-target-input="delete_id" >
                        <div class="modal-dialog modal-sm" >
                          <form action="delete_user.php" method="POST" >
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
