<?php
require_once 'auth/authenticate.php';
require_once 'db.php';
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

    <title> Nananomfarmsltd - Reports & Finances </title>

    <!-- links -->
        <?php include_once('partials/links.php'); ?>
        <!-- End links -->
         <!-- Sweet Alert helper js  -->
 <link rel="stylesheet" href="libs/sweetAlert2/sweetalert2.min.css">

    <meta name="description" content="" />
<!-- Sweet Alert helper js  -->
 <script src="handler/alert-handler.js"></script>   
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
<?php include_once('partials/navbar.php'); ?>
        
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
           <div class="container py-4">
            
        <?php
       
        // Function to count table items
        function getCount($con, $table) {
            $sql = "SELECT COUNT(*) AS total FROM $table";
            $result = $con->query($sql);
            if ($result && $row = $result->fetch_assoc()) {
                return $row['total'];
            }
            return 0;
        }

        // Get counts
        $enquiriesCount = getCount($con, 'enquiries');
        $userCount = getCount($con, 'users');
        $productCount = getCount($con, 'products');
        $bookingCount = getCount($con, 'bookings');

        ?>

  <div class="row g-4">

   <!-- Total Revenue -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h6 class="text-muted">Total Revenue</h6>
          <h3 class="text-success">&#8373 87000</h3>
          <small class="text-muted">All Wages</small>
          <div class="progress mt-2" style="height: 5px;">
            <div class="progress-bar bg-success" style="width: 25%"></div>
          </div>
          <small class="text-muted">Change 25%</small>
        </div>
      </div>
    </div>


    <!-- Today's Income -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h6 class="text-muted">Total Users</h6>
          <h3 class="text-primary"><?php echo $userCount; ?></h3>
          <small class="text-muted">Users Activeness</small>
          <div class="progress mt-2" style="height: 5px;">
            <div class="progress-bar bg-primary" style="width: 75%"></div>
          </div>
          <small class="text-muted">Change 75%</small>
        </div>
      </div>
    </div>

        <!-- New Orders -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h6 class="text-muted">Total Enquiries</h6>
          <h3 class="text-danger"><?php echo $enquiriesCount; ?></h3>
          <small class="text-muted">Fresh Products</small>
          <div class="progress mt-2" style="height: 5px;">
            <div class="progress-bar bg-danger" style="width: 50%"></div>
          </div>
          <small class="text-muted">Change 50%</small>
        </div>
      </div>
    </div>

    <!-- New Users -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h6 class="text-muted">Total bookings</h6>
          <h3 class="text-info"><?php echo $bookingCount; ?></h3>
          <small class="text-muted">Services</small>
          <div class="progress mt-2" style="height: 5px;">
            <div class="progress-bar bg-info" style="width: 25%"></div>
          </div>
          <small class="text-muted">Change 25%</small>
        </div>
      </div>
    </div>

  </div>
</div>

              <div class="row">
               <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Total Products</h5>
                        <small class="text-muted">Palm Oil in Stock</small>
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="orederStatistics"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                          <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                          <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                          <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                          <h2 class="mb-2">8,258</h2>
                          <span>Available</span>
                        </div>
                        <div id="orderStatisticsChart"></div>
                      </div>
                      <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary">
                              <i class="bx bx-cylinder"></i> <!-- Best match for a drum shape -->
                            </span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Drums</h6>
                              <small class="text-muted"> 50L, 60L, 70L </small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">8.2k</small>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success">
                              <i class="bx bx-droplet"></i>  <!-- To symbolize liquid content -->
                            </span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Gallons</h6>
                              <small class="text-muted"> 25L, 30L, 35L </small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">2.8k</small>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info">
                               <i class="bx bx-layer"></i>      <!-- Stack of items: good for bundled/all-in-one -->
                            </span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">All in 1</h6>
                              <small class="text-muted">[2L,4L,10L], [10L,15L,20L]</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">8.4k</small>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-secondary">
                              <i class="bx bx-collection"></i>
                            </span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Others</h6>
                              <small class="text-muted">All sizes</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">9.9k</small>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Yearly Revenues</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                            <div class="dropdown">
                              <button
                                class="btn btn-sm btn-outline-primary dropdown-toggle"
                                type="button"
                                id="growthReportId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                2025
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                <a class="dropdown-item" href="javascript:void(0);">2025</a>
                                <a class="dropdown-item" href="javascript:void(0);">2024</a>
                                <a class="dropdown-item" href="javascript:void(0);">2023</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                            </div>
                            <div class="d-flex flex-column">
                              <small>2025</small>
                              <h6 class="mb-0">&#8373 32.5k</h6>
                            </div>
                          </div>
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                            </div>
                            <div class="d-flex flex-column">
                              <small>2024</small>
                              <h6 class="mb-0">&#8373 29.3k</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->

              </div>
              <hr><hr>
              <!-- Bordered Table -->
              <div class="card">
                <h5 class="card-header"> Daily Payments Reports </h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="dataTable" >
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Client Name</th>
                          <th>Telephone</th>
                          <th>National ID</th>
                          <th>Payment Type</th>
                          <th>Bank Name</th>
                          <th>Momo Number</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Created At</th>
                          <th>Actions</th>
                        </tr>
                      </thead>

                      <tbody>
           <?php
$query = "SELECT * FROM payments";
$result = $con->query($query); 

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["number"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["national_id"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["payment_type"]) . "</td>";

    // Check bank_type (bank_name)
    if (empty($row["bank_type"])) {
      echo "<td class='text-danger text-center'>❌</td>";
    } else {
      echo "<td>" . htmlspecialchars($row["bank_type"]) . "</td>";
    }

    // Check momo_num
    if (empty($row["momo_num"])) {
      echo "<td class='text-danger text-center'>❌</td>";
    } else {
      echo "<td>" . htmlspecialchars($row["momo_num"]) . "</td>";
    }

    echo "<td>" . htmlspecialchars($row["amount"]) . "</td>"; 
    echo "<td>" . htmlspecialchars($row["date"]) . "</td>"; 
    echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>"; 

    // Delete button
    echo "<td><button data-bs-target='#smallModal' title='delete' data-bs-toggle='modal' data-id='{$row["id"]}' class='btn btn-outline-danger btn-sm'><i class='fa-solid fa-trash'></button></td>";
    echo "</tr>";
  }
} else {
  echo '<tr><td colspan="11" class="text-center">No records found.</td></tr>';
}
?>



                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--/ Bordered Table -->

                  <!-- Delete Modal -->
                      <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true" data-target-input="delete_id" >
                        <div class="modal-dialog modal-sm" >
                          <form action="delete_payment.php" method="POST" >
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
<script src="libs/sweetAlert2/sweetalert2.min.js"></script>

    <?php
    // Ensure alert is displayed after all JS is loaded
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (file_exists('handler/alert-handler.php')) {
        include 'handler/alert-handler.php';
        if (function_exists('displayAlert')) {
            displayAlert();
        }
    }
    ?>


    </body>
