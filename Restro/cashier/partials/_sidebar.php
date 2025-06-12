<?php
$staff_id = $_SESSION['staff_id'];
//$login_id = $_SESSION['login_id'];
$ret = "SELECT * FROM  rpos_staff  WHERE staff_id = '$staff_id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute();
$res = $stmt->get_result();
while ($staff_id = $res->fetch_object()) {

?>
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <style>
    #sidenav-main {
      background: linear-gradient(-45deg, #007bff, #0056b3, #003087, #007bff);
      background-size: 400% 400%;
      animation: gradient 15s ease infinite;
      /* position: relative; */
      overflow: hidden;
    }
    @keyframes gradient {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }
    /* Shapes Motion Background */
    #sidenav-main::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: transparent;
      z-index: 0;
      animation: shapes-motion 20s linear infinite;
    }
    @keyframes shapes-motion {
      0% {
        background: radial-gradient(circle, rgba(0, 123, 255, 0.2) 10%, transparent 11%),
                    radial-gradient(circle at 80% 20%, rgba(0, 86, 179, 0.2) 10%, transparent 11%),
                    radial-gradient(circle at 30% 70%, rgba(0, 48, 135, 0.2) 10%, transparent 11%);
        background-size: 50px 50px, 70px 70px, 60px 60px;
        background-position: 0 0, 50px 50px, 100px 100px;
      }
      100% {
        background-position: 100px 100px, 150px 150px, 200px 200px;
      }
    }
    .navbar-brand-img {
      filter: brightness(0) invert(1);
      transition: transform 0.3s ease, filter 0.3s ease;
      z-index: 1;
      position: relative;
    }
    .navbar-brand-img:hover {
      transform: scale(1.1) rotate(5deg);
      filter: brightness(1) invert(0);
    }
    .navbar-nav .nav-link {
      color: #fff !important;
      position: relative;
      transition: color 0.3s ease, transform 0.3s ease;
      z-index: 1;
    }
    .navbar-nav .nav-link:hover {
      color: #a3cffa !important; /* Light blue for hover */
      transform: translateY(-2px);
    }
    /* Dynamic Line Animation for Nav Links */
    .navbar-nav .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -2px;
      left: 0;
      background: linear-gradient(to right, #a3cffa, #007bff);
      transition: width 0.4s ease-in-out;
      animation: line-flow 3s linear infinite paused;
    }
    .navbar-nav .nav-link:hover::after {
      width: 100%;
      animation-play-state: running;
    }
    @keyframes line-flow {
      0% {
        transform: translateX(0);
      }
      50% {
        transform: translateX(10px);
      }
      100% {
        transform: translateX(0);
      }
    }
    .navbar-nav .nav-link i {
      color: #fff !important;
      transition: color 0.3s ease, transform 0.3s ease;
      z-index: 1;
    }
    .navbar-nav .nav-link i:hover {
      color: #a3cffa !important;
      transform: rotate(360deg);
    }
    .navbar-heading {
      color: #fff !important;
      position: relative;
      animation: pulse 2s ease-in-out infinite;
      z-index: 1;
    }
    @keyframes pulse {
      0% {
        transform: scale(1);
        text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
      }
      50% {
        transform: scale(1.05);
        text-shadow: 0 0 10px rgba(0, 123, 255, 0.8);
      }
      100% {
        transform: scale(1);
        text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
      }
    }
</style>
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="dashboard.php">
        <img src="../admin/assets/img/brand/repos.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="../assets/img/">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="change_profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="dashboard.php">
                <img src="../admin/assets/img/brand/repos.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customes.php">
              <i class="fas fa-users text-primary"></i> Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">
              <i class="ni ni-bullet-list-67 text-primary"></i>Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="orders.php">
              <i class="ni ni-cart text-primary"></i> Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="payments.php">
              <i class="ni ni-credit-card text-primary"></i> Payments
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="receipts.php">
              <i class="fas fa-file-invoice-dollar text-primary"></i> Receipts
            </a>
          </li>
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Reporting</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="orders_reports.php">
              <i class="fas fa-shopping-basket"></i> Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="payments_reports.php">
              <i class="fas fa-funnel-dollar"></i> Payments
            </a>
          </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="fas fa-sign-out-alt text-danger"></i> Log Out
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<?php } ?>