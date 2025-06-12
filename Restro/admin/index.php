<?php
session_start();
include('config/config.php');
//login 
if (isset($_POST['login'])) {
  $admin_email = $_POST['admin_email'];
  $admin_password = sha1(md5($_POST['admin_password'])); //double encrypt to increase security
  $stmt = $mysqli->prepare("SELECT admin_email, admin_password, admin_id  FROM   rpos_admin WHERE (admin_email =? AND admin_password =?)"); //sql to log in user
  $stmt->bind_param('ss',  $admin_email, $admin_password); //bind fetched parameters
  $stmt->execute(); //execute bind 
  $stmt->bind_result($admin_email, $admin_password, $admin_id); //bind result
  $rs = $stmt->fetch();
  $_SESSION['admin_id'] = $admin_id;
  if ($rs) {
    //if its sucessfull
	//Visit codeastro.com for more projects
    header("location:dashboard.php");
  } else {
    $err = "Incorrect Authentication Credentials ";
  }
}
require_once('partials/_head.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant POS System - Login</title>

    <!-- Bootstrap 4 CSS (Assuming Argon uses Bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Argon CSS (Approximated via CDN; replace with actual if available) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/argon-design-system/1.2.2/argon.min.css">
    <!-- Font Awesome for Icons (ni classes approximated) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        html, body {
            height: 100vh;
            margin: 0;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2b2b4b, #1a1a2e);
        }

        #particle-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .main-content {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .header {
            background: linear-gradient(45deg, #ff6f61, #ff9f68);
            padding: 3rem 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: fadeInHeader 1.5s ease-out;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
            transform: perspective(1000px) rotateX(5deg);
            transition: transform 0.4s ease, text-shadow 0.4s ease;
        }

        .header h1:hover {
            transform: perspective(1000px) rotateX(0deg) translateY(-5px);
            text-shadow: 2px 2px 12px rgba(0, 0, 0, 0.6);
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            transform: perspective(1000px) rotateX(5deg);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            animation: slideInCard 1.2s ease-out;
        }

        .card:hover {
            transform: perspective(1000px) rotateX(0deg) translateY(-10px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5);
        }

        .card-body {
            padding: 2.5rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
            animation: fadeInForm 1.5s ease-out;
            animation-delay: calc(0.2s * var(--i));
        }

        .form-group:nth-child(1) { --i: 1; }
        .form-group:nth-child(2) { --i: 2; }
        .form-group:nth-child(3) { --i: 3; }

        .input-group {
            transition: transform 0.3s ease;
        }

        .input-group:hover {
            transform: translateY(-3px);
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
            transition: background 0.3s ease;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #ff6f61;
            box-shadow: 0 0 10px rgba(255, 111, 97, 0.5);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #ff6f61;
            border-color: #ff6f61;
        }

        .custom-control-label {
            color: rgba(255, 255, 255, 0.7);
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff6f61, #ff9f68);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            transform: perspective(500px) rotateX(0deg);
            transition: all 0.4s ease;
            animation: pulseButton 2s infinite ease-in-out;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #ff9f68, #ff6f61);
            transform: perspective(500px) rotateX(5deg) translateY(-5px);
            box-shadow: 0 8px 20px rgba(255, 111, 97, 0.5);
        }

        /* Keyframe Animations */
        @keyframes fadeInHeader {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInCard {
            from { opacity: 0; transform: perspective(1000px) rotateX(20deg) translateY(50px); }
            to { opacity: 1; transform: perspective(1000px) rotateX(5deg); }
        }

        @keyframes fadeInForm {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulseButton {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body class="bg-dark">
    <canvas id="particle-canvas"></canvas>
    <div class="main-content">
        <div class="header py-7">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1>Restaurant Point Of Sale System</h1>
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
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control" required name="admin_email" placeholder="Email" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input class="form-control" required name="admin_password" placeholder="Password" type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="customCheckLogin" type="checkbox">
                                        <label class="custom-control-label" for="customCheckLogin">
                                            <span class="text-muted" style="color:back;">Remember Me</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="login" class="btn btn-primary my-4">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <!-- <a href="forgot_pwd.php" class="text-light"><small>Forgot password?</small></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Argon JS (Approximated; replace with actual if available) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/argon-design-system/1.2.2/argon.min.js"></script>

    <!-- JavaScript for 3D Particle Background with Color Change -->
    <script>
        const canvas = document.getElementById('particle-canvas');
        const ctx = canvas.getContext('2d');

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.z = Math.random() * 1500;
                this.size = Math.random() * 3 + 1;
                this.speedX = (Math.random() - 0.5) * 1;
                this.speedY = (Math.random() - 0.5) * 1;
                this.speedZ = (Math.random() - 0.5) * 2;
                this.hue = Math.random() * 360;
            }

            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                this.z += this.speedZ;
                this.hue += 0.5; // Gradual color shift

                if (this.x < 0 || this.x > canvas.width) this.speedX = -this.speedX;
                if (this.y < 0 || this.y > canvas.height) this.speedY = -this.speedY;
                if (this.z < 0 || this.z > 1500) this.speedZ = -this.speedZ;
            }

            draw() {
                const scale = 1500 / (1500 + this.z);
                const x2d = this.x * scale + canvas.width / 2 - (canvas.width / 2) * scale;
                const y2d = this.y * scale + canvas.height / 2 - (canvas.height / 2) * scale;
                const size = this.size * scale;

                ctx.beginPath();
                ctx.arc(x2d, y2d, size, 0, Math.PI * 2);
                ctx.fillStyle = `hsl(${this.hue}, 70%, 60%)`;
                ctx.globalAlpha = 1 - this.z / 1500;
                ctx.fill();
            }
        }

        const particles = [];
        for (let i = 0; i < 100; i++) {
            particles.push(new Particle());
        }

        function animate() {
            ctx.fillStyle = 'rgba(43, 43, 75, 0.1)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            particles.forEach(particle => {
                particle.update();
                particle.draw();
            });
            requestAnimationFrame(animate);
        }

        animate();
    </script>
</body>
</html>