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

    <title> Nananomfarmsltd - Dashboard </title>
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
        $paymentCount = getCount($con, 'payments');

        ?>

  <div class="row g-4">

   <!-- Total Revenue -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h6 class="text-muted">Total Payments</h6>
          <h3 class="text-success"><?php echo  $paymentCount ?> </h3>
          <small class="text-muted">Daily </small>
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
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4 ">
                  <div class="card">
                    
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Payment Input</h5>
                        <div class="px-2"></div>
                      </div>

      <form action="add_payments.php" method="POST">
  <!-- Client Name -->
  <div class="col-md-10 px-4">
    <div class="col mb-3">
      <label for="clientName" class="form-label">Client Name</label>
      <input type="text" class="form-control" id="clientName" name="name" required>
    </div>
  </div>

  <!-- National ID -->
  <div class="col-md-10 px-4">
    <div class="col mb-3">
      <label for="nationalId" class="form-label">National ID</label>
      <input type="text" class="form-control" id="nationalId" name="nid" required >
    </div>
  </div>

  <!-- Telephone -->
  <div class="col-md-10 px-4">
    <div class="col mb-3">
      <label for="phoneNumber" class="form-label">Client's Telephone</label>
      <input type="text" class="form-control" id="phoneNumber" name="number" required >
    </div>
  </div>

  <!-- Payment Type -->
  <div class="col-md-10 mb-3 px-4">
    <label for="paymentType" class="form-label">Payment Type</label>
    <input
      class="form-control"
      list="datalistOptions"
      id="paymentType"
      name="payment_type"
      placeholder="Payment Type"
      required
    />
    <datalist id="datalistOptions">
      <option value="MTN Mobile Money"></option>
      <option value="Cash on Delivery"></option>
      <option value="Bank"></option>
    </datalist>
  </div>

  <!-- Bank Select (shown only when "Bank" is selected) -->
  <div id="bank_select" class="col-md-10 mb-3 px-4" style="display: none;">
    <label for="bank_dropdown" class="form-label">Select Bank</label>
    <select name="bank_name" id="bank_dropdown" class="form-control"  >
      <option value="">Select Bank</option>
      <option value="GBC">GBC</option>
      <option value="Ecobank">Ecobank</option>
      <option value="Fidelity">Fidelity</option>
      <option value="Stanbic">Stanbic Bank</option>
      <option value="CBG">CBG</option>
      <option value="Access">Access Bank</option>
      <option value="ADB">ADB</option>
      <option value="Zenit">Zenit Bank</option>
      <option value="Republic">Republic Bank</option>
      <option value="FNB">First National Bnak</option>
      <option value="UBA">United Bank of Africa</option>
      <option value="ABSA">ABSA</option>
      <option value="UMB">Universal Merchant Bank</option>
      <option value="FBN">First Bank of Nigeria</option>
      <option value="NIB">National Investment Bank</option>
      <option value="FAB">First Atlantic Bank</option>
    </select>
  </div>
<!-- MTN Mobile Money Input (Hidden Initially) -->
<div id="mtn_input" class="col-md-10 mb-3 px-4" style="display: none;">
  <label for="mtn_number" class="form-label">MTN MoMo Number</label>
  <input type="text" class="form-control" id="mtn_number" name="mtn_number" placeholder="e.g. 024xxxxxxx"  >
</div>

  <!-- Payment Amount -->
  <div class="col-md-10 px-4">
    <div class="col mb-3">
      <label for="amount" class="form-label"> Payment Amount </label>
      <input type="text" class="form-control" id="amount" name="amount"  >
    </div>
  </div>

  <!-- Date of Payment -->
  <div class="col-md-10 px-4">
    <div class="col mb-3">
      <label for="dop" class="form-label">Date of Payment</label>
      <input type="date" class="form-control" id="dop" name="dop"  >
    </div>
  </div>

  <!-- Submit Button -->
  <div class="col-md-10 px-4 mb-4">
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</form>

               
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->

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
</html>