
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.php" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="assets/img/icons/brands/icon.jpg" alt="" style="width: 30px;height: 20px;">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Nananom</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
             <!-- Admin-only links -->
                       <!-- Dashboard -->
            <li class="menu-item ">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
          
         <?php if ($_SESSION["role"] === "admin"): ?>

          <!-- Layouts -->
            <li class="menu-item">
              <a href="report.php" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-line-chart"></i> <!-- Line chart -->
                <div data-i18n="Layouts">Reports & Finances</div>
              </a>
            </li>
<?php endif; ?>
            <!-- Layouts -->
            <li class="menu-item">
              <a href="manage_products.php" class="menu-link ">
                <i class="menu-icon tf-icons  bx bx-box"></i> <!-- Box/package -->
                <div data-i18n="Layouts">Manage Products</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="user_bookings.php" class="menu-link">
                <i class=" menu-icon tf-icons bx bx-calendar-check"></i> <!-- Calendar with checkmark -->
                <div data-i18n="Account Settings">Service Bookings</div>
              </a>

              </li>

            <li class="menu-item">
              <a href="user_enquiries.php" class="menu-link ">
                <i class="menu-icon tf-icons  bx bx-message-dots"></i> <!-- Message with dots -->
                <div data-i18n="Authentications">Client Enquiries</div>
              </a>

             </li>
              
            <li class="menu-item">
              <a href="replied_msgs.php" class="menu-link">
                <i class="menu-icon ft-icons  bx bx-message-rounded-dots"></i> <!-- Message with dots -->
                <div data-i18n="Basic"> Replied Messages </div>
              </a>
            </li>
             <!-- Admin-only links -->
            <?php if ($_SESSION["role"] === "admin"): ?>
            <li class="menu-item">
              <a href="users_home.php" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="User interface">Access Control</div>
              </a>
              </li>
              <?php endif; ?>
            
           </ul>
        </aside>
