<?php
session_start();
include('config/config.php');
//login 
if (isset($_POST['login'])) {
    $customer_email = $_POST['customer_email'];
    $customer_password = sha1(md5($_POST['customer_password'])); //double encrypt to increase security
    $stmt = $mysqli->prepare("SELECT customer_email, customer_password, customer_id  FROM  rpos_customers WHERE (customer_email =? AND customer_password =?)"); //sql to log in user
    $stmt->bind_param('ss',  $customer_email, $customer_password); //bind fetched parameters
    $stmt->execute(); //execute bind 
    $stmt->bind_result($customer_email, $customer_password, $customer_id); //bind result
    $rs = $stmt->fetch();
    $_SESSION['customer_id'] = $customer_id;
    if ($rs) {
        //if its sucessfull
        header("location:dashboard.php");
    } else {
        $err = "Incorrect Authentication Credentials ";
    }
}
require_once('partials/_head.php');
?>

<body class="bg-dark">
    <style>
        /* 3D Animated Background */
body.bg-dark {
  background: linear-gradient(-45deg, #1a1a2e, #16213e, #0f3460, #533d7b);
  background-size: 400% 400%;
  animation: gradientBG 15s ease infinite;
  overflow: hidden;
  position: relative;
}

/* 3D Floating Shapes */
body.bg-dark::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: 
    radial-gradient(circle at 20% 30%, rgba(255,255,255,0.1) 0%, transparent 20%),
    radial-gradient(circle at 80% 70%, rgba(255,255,255,0.1) 0%, transparent 20%);
  z-index: -1;
  animation: float 25s linear infinite;
}

/* 3D Floating Cubes */
body.bg-dark::after {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: 
    linear-gradient(45deg, transparent 65%, rgba(255,255,255,0.05) 65%) 0 0,
    linear-gradient(-45deg, transparent 65%, rgba(255,255,255,0.05) 65%) 0 0;
  background-size: 30px 30px;
  z-index: -1;
  opacity: 0.5;
  animation: pattern 60s linear infinite;
}

/* Animations */
@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes float {
  0% { transform: translateY(0) rotate(0deg); }
  100% { transform: translateY(-100px) rotate(5deg); }
}

@keyframes pattern {
  0% { background-position: 0 0; }
  100% { background-position: 1000px 1000px; }
}

/* Card Enhancement */
.card {
  backdrop-filter: blur(10px);
  background-color: rgba(26, 32, 53, 0.8) !important;
  border: 1px solid rgba(255, 255, 255, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3) !important;
}

/* Input Field Enhancement */
.input-group-alternative {
  border: 1px solid rgba(255, 255, 255, 0.1);
  transition: all 0.3s ease;
}

.input-group-alternative:focus-within {
  border-color: rgba(255, 255, 255, 0.3);
  box-shadow: 0 0 0 2px rgba(100, 150, 255, 0.25);
}

/* Button Enhancement */
.btn-primary {
  background: linear-gradient(45deg, #667eea, #764ba2);
  border: none;
  position: relative;
  overflow: hidden;
}

.btn-primary::after {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(
    to bottom right,
    rgba(255,255,255,0) 45%,
    rgba(255,255,255,0.3) 50%,
    rgba(255,255,255,0) 55%
  );
  transform: rotate(30deg);
  animation: shine 3s infinite;
}

@keyframes shine {
  0% { left: -50%; }
  100% { left: 150%; }
}
    </style>
    <div class="main-content">
        <div class="header bg-gradient-primar py-7">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1 class="text-white">Restaurant Point Of Sale</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form method="post" role="form">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" required name="customer_email" placeholder="Email" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" required name="customer_password" placeholder="Password" type="password">
                                    </div>
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                    <label class="custom-control-label" for=" customCheckLogin">
                                        <span class="text-muted">Remember me</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="text-left">
                                        <button type="submit" name="login" class="btn btn-primary my-4">Log In</button>
                                        <a href="create_account.php" class=" btn btn-success pull-right">Create Account</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <!-- <a href="../admin/forgot_pwd.php" target="_blank" class="text-light"><small>Forgot password?</small></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php
    require_once('partials/_footer.php');
    ?>
    <!-- Argon Scripts -->
    <?php
    require_once('partials/_scripts.php');
    ?>
</body>

</html>