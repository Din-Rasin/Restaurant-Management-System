<?php
session_start();
include('config/config.php');
//login 
if (isset($_POST['addCustomer'])) {
    //Prevent Posting Blank Values
    if (empty($_POST["customer_phoneno"]) || empty($_POST["customer_name"]) || empty($_POST['customer_email']) || empty($_POST['customer_password'])) {
        $err = "Blank Values Not Accepted";
    } else {
        $customer_name = $_POST['customer_name'];
        $customer_phoneno = $_POST['customer_phoneno'];
        $customer_email = $_POST['customer_email'];
        $customer_password = sha1(md5($_POST['customer_password'])); //Hash This 
        $customer_id = $_POST['customer_id'];

        //Insert Captured information to a database table
        $postQuery = "INSERT INTO rpos_customers (customer_id, customer_name, customer_phoneno, customer_email, customer_password) VALUES(?,?,?,?,?)";
        $postStmt = $mysqli->prepare($postQuery);
        //bind paramaters
        $rc = $postStmt->bind_param('sssss', $customer_id, $customer_name, $customer_phoneno, $customer_email, $customer_password);
        $postStmt->execute();
        //declare a varible which will be passed to alert function
        if ($postStmt) {
            $success = "Customer Account Created" && header("refresh:1; url=index.php");
        } else {
            $err = "Please Try Again Or Try Later";
        }
    }
}
require_once('partials/_head.php');
require_once('config/code-generator.php');
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
  min-height: 100vh;
}

/* 3D Floating Particles */
body.bg-dark::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: 
    radial-gradient(circle at 20% 30%, rgba(255,255,255,0.08) 0%, transparent 25%) 0 0,
    radial-gradient(circle at 80% 70%, rgba(255,255,255,0.08) 0%, transparent 25%) 0 0,
    radial-gradient(circle at 40% 60%, rgba(255,255,255,0.08) 0%, transparent 25%) 0 0;
  background-size: 500px 500px;
  z-index: -1;
  animation: floatParticles 25s linear infinite;
}

/* 3D Grid Pattern */
body.bg-dark::after {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: 
    linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px),
    linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px);
  background-size: 50px 50px;
  z-index: -1;
  opacity: 0.5;
  animation: gridMove 60s linear infinite;
}

/* Animations */
@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes floatParticles {
  0% { background-position: 0 0, 0 0, 0 0; }
  100% { background-position: 500px 500px, -500px -500px, 250px -250px; }
}

@keyframes gridMove {
  0% { background-position: 0 0; }
  100% { background-position: 1000px 1000px; }
}

/* Card Styling */
.card {
  backdrop-filter: blur(8px);
  background-color: rgba(26, 32, 53, 0.85) !important;
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 12px;
  overflow: hidden;
  transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.card:hover {
  transform: translateY(-8px) scale(1.01);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25) !important;
}

/* Input Field Styling */
.input-group-alternative {
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  transition: all 0.3s ease;
  margin-bottom: 1.5rem;
  background: rgba(255, 255, 255, 0.05);
}

.input-group-alternative:focus-within {
  border-color: rgba(100, 150, 255, 0.4);
  box-shadow: 0 0 0 3px rgba(100, 150, 255, 0.15);
  background: rgba(255, 255, 255, 0.08);
}

.input-group-text {
  background: rgba(255, 255, 255, 0.05);
  border: none;
  color: rgba(255, 255, 255, 0.8);
}

.form-control {
  background: transparent;
  border: none;
  color: white;
  padding: 12px 15px;
}

.form-control::placeholder {
  color: rgba(255, 255, 255, 0.5);
}

/* Button Styling */
.btn-primary {
  background: linear-gradient(45deg, #667eea, #764ba2);
  border: none;
  border-radius: 8px;
  padding: 12px 30px;
  font-weight: 600;
  letter-spacing: 0.5px;
  position: relative;
  overflow: hidden;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(118, 75, 162, 0.4);
}

.btn-success {
  background: linear-gradient(45deg, #2ecc71, #27ae60);
  border: none;
  border-radius: 8px;
  padding: 12px 30px;
  font-weight: 600;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

.btn-success:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
}

/* Header Styling */
.header {
  position: relative;
  overflow: hidden;
}

.header::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at center, rgba(255,255,255,0.1) 0%, transparent 70%);
  transform: scale(1.5);
  animation: pulse 8s ease infinite;
}

@keyframes pulse {
  0% { opacity: 0.3; transform: scale(1); }
  50% { opacity: 0.1; transform: scale(1.2); }
  100% { opacity: 0.3; transform: scale(1); }
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
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control" required name="customer_name" placeholder="Full Name" type="text">
                                        <input class="form-control" value="<?php echo $cus_id;?>" required name="customer_id"  type="hidden">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input class="form-control" required name="customer_phoneno" placeholder="Phone Number" type="text">
                                    </div>
                                </div>
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

                                <div class="text-center">
                                </div>
                                <div class="form-group">
                                    <div class="text-left">
                                        <button type="submit" name="addCustomer" class="btn btn-primary my-4">Create Account</button>
                                        <a href="index.php" class=" btn btn-success pull-right">Log In</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a href="../admin/forgot_pwd.php" target="_blank" class="text-light"><small>Forgot password?</small></a>
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