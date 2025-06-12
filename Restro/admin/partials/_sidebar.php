<?php
$admin_id = $_SESSION['admin_id'];
//$login_id = $_SESSION['login_id'];
$ret = "SELECT * FROM  rpos_admin  WHERE admin_id = '$admin_id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute();
$res = $stmt->get_result();
while ($admin = $res->fetch_object()) {

?>
<style>
    #sidenav-main {
      background: linear-gradient(-45deg, #ffd700, #daa520, #b8860b, #ffd700);
      background-size: 400% 400%;
      animation: gradient 150s ease infinite;
      /* position: relative; */
      overflow: hidden;
      perspective: 1000px; /* Adds 3D perspective for child elements */
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
    /* Falling Particle Animation */
    #sidenav-main::before,
    #sidenav-main::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      pointer-events: none;
    }
    #sidenav-main::before {
      background: transparent;
      animation: particles-fall 10s linear infinite;
      background-image: radial-gradient(circle, rgba(255, 215, 0, 0.6) 2px, transparent 3px),
                        radial-gradient(circle, rgba(255, 215, 0, 0.4) 1px, transparent 2px);
      background-size: 50px 50px, 30px 30px;
      background-position: 0 0, 25px 25px;
    }
    #sidenav-main::after {
      background: transparent;
      animation: particles-fall-slow 15s linear infinite;
      background-image: radial-gradient(circle, rgba(218, 165, 32, 0.5) 1.5px, transparent 2.5px),
                        radial-gradient(circle, rgba(184, 134, 11, 0.3) 1px, transparent 2px);
      background-size: 40px 40px, 20px 20px;
      background-position: 10px 10px, 15px 15px;
    }
    @keyframes particles-fall {
      0% {
        transform: translateY(-100%) translateZ(0);
      }
      100% {
        transform: translateY(100%) translateZ(50px);
      }
    }
    @keyframes particles-fall-slow {
      0% {
        transform: translateY(-100%) translateZ(-50px);
      }
      100% {
        transform: translateY(100%) translateZ(0);
      }
    }
    .navbar-brand-img {
      filter: brightness(0) invert(1);
      transition: transform 0.5s ease, filter 0.5s ease;
      z-index: 1;
      position: relative;
      transform-style: preserve-3d;
    }
    .navbar-brand-img:hover {
      transform: scale(1.1) rotateY(180deg); /* 3D flip effect */
      filter: brightness(1) invert(0);
    }
    .navbar-nav .nav-link {
      color: #fff !important;
      position: relative;
      transition: color 0.3s ease, transform 0.5s ease;
      z-index: 1;
      transform-style: preserve-3d;
      display: inline-block;
    }
    .navbar-nav .nav-link:hover {
      color: #f0e68c !important;
      transform: rotateX(20deg) translateZ(20px); /* 3D tilt effect */
    }
    .navbar-nav .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -2px;
      left: 0;
      background: linear-gradient(to right, #f0e68c, #ffd700);
      transition: width 0.4s ease-in-out;
      animation: line-flow 3s linear infinite paused;
      z-index: 1;
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
      transition: color 0.3s ease, transform 0.5s ease;
      z-index: 1;
      transform-style: preserve-3d;
    }
    .navbar-nav .nav-link i:hover {
      color: #f0e68c !important;
      transform: rotateY(360deg); /* 3D icon spin */
    }
    .navbar-heading {
      color: #fff !important;
      position: relative;
      animation: pulse-3d 2s ease-in-out infinite;
      z-index: 1;
      transform-style: preserve-3d;
    }
    @keyframes pulse-3d {
      0% {
        transform: scale(1) translateZ(0);
        text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
      }
      50% {
        transform: scale(1.05) translateZ(20px);
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
      }
      100% {
        transform: scale(1) translateZ(0);
        text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
      }
    }
</style>
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="dashboard.php">
        <img src="assets/img/brand/repos.png" class="navbar-brand-img" alt="...">
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
                <img alt="Image placeholder" src="assets/img/theme/team-1-800x800.jpg">
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
                <img src="assets/img/brand/repos.png">
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
            <a class="nav-link" href="hrm.php">
              <i class="fas fa-user-tie text-primary"></i> HRM
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