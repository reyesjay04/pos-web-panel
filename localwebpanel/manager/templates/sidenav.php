  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Innovention</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="data:image/png;base64,<?php echo $_SESSION["manager_user_profile"];?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["manager_user_fname"] . ' ' . $_SESSION["manager_user_lname"];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="?dashboard" class="nav-link  <?= ($_SERVER['REQUEST_URI']== $_POSURI."manager/?dashboard" || $_SERVER['REQUEST_URI']== $_POSURI."manager/" )?"active":"";?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?inbox" class="nav-link  <?= ($_SERVER['REQUEST_URI'] == $_POSURI."manager/?inbox")?"active":"";?>">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Inbox
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?outlets" class="nav-link <?= ($_SERVER['REQUEST_URI'] == $_POSURI."manager/?outlets")?"active":"";?>">
              <i class="nav-icon fas fa-store-alt"></i>
              <p>
                Outlets
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?users" class="nav-link <?= ($_SERVER['REQUEST_URI'] == $_POSURI."manager/?users")?"active":"";?>">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Employees
              </p>
            </a>
          </li>
          <li class="nav-header">Reports</li>
          <li class="nav-item">
            <a href="?sales" class="nav-link <?= ($_SERVER['REQUEST_URI'] == $_POSURI."manager/?sales" || $_SERVER['REQUEST_URI'] == $_POSURI."manager/?store=".$_GET['store'])?"active":"";?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Sales
              </p>
            </a>
          </li>       
          <li class="nav-item">
            <a href="?inventory" class="nav-link <?= ($_SERVER['REQUEST_URI']== $_POSURI."manager/?inventory" || $_SERVER['REQUEST_URI']== $_POSURI."manager/?viewinv=".$_GET['viewinv'])?"active":"";?>">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Inventory
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?logs" class="nav-link <?= ($_SERVER['REQUEST_URI']== $_POSURI."manager/?logs"|| $_SERVER['REQUEST_URI']== $_POSURI."manager/?syslogs=".$_GET['syslogs'])?"active":"";?>">
              <i class="nav-icon fas fa-bug"></i>
              <p>
                System Logs
              </p>
            </a>
          </li>
          <li class="nav-header">Informations</li>
          <li class="nav-item">
            <a href="?about"class="nav-link <?= ($_SERVER['REQUEST_URI']== $_POSURI."manager/?about")?"active":"";?>">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                About Us
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#"class="nav-link" onclick="contactus();">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Contact Us
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?faqs"class="nav-link <?= ($_SERVER['REQUEST_URI']== $_POSURI."manager/?faqs")?"active":"";?>">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                Faqs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?help"class="nav-link <?= ($_SERVER['REQUEST_URI']== $_POSURI."manager/?help")?"active":"";?>">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Help
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
