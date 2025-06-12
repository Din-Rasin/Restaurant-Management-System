<?php
session_start();
include('config/config.php');
//login 
if (isset($_POST['login'])) {
  $staff_email = $_POST['staff_email'];
  $staff_password = sha1(md5($_POST['staff_password'])); //double encrypt to increase security
  $stmt = $mysqli->prepare("SELECT staff_email, staff_password, staff_id  FROM   rpos_staff WHERE (staff_email =? AND staff_password =?)"); //sql to log in user
  $stmt->bind_param('ss',  $staff_email, $staff_password); //bind fetched parameters
  $stmt->execute(); //execute bind 
  $stmt->bind_result($staff_email, $staff_password, $staff_id); //bind result
  $rs = $stmt->fetch();
  $_SESSION['staff_id'] = $staff_id;
  if ($rs) {
    //if its sucessfull
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Point Of Sale - Login</title>
  
  <!-- CSS Styles -->
  <style>
    /* Base Styles */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      overflow-x: hidden;
      background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    }

    /* Particle Canvas */
    #particle-canvas {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }

    /* 3D Card Animation */
    .card-3d {
      transition: all 0.5s ease;
      transform-style: preserve-3d;
      perspective: 1000px;
      border: none;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
    }

    .card-3d:hover {
      transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }

    /* Floating Animation for Header */
    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-15px); }
      100% { transform: translateY(0px); }
    }

    .header {
      animation: float 6s ease-in-out infinite;
      text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
    }

    /* Button Effects */
    .btn-primary {
      background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 50px;
      padding: 12px 30px;
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
      box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(118, 75, 162, 0.6);
    }

    .btn-primary:active {
      transform: translateY(1px);
    }

    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: 0.5s;
    }

    .btn-primary:hover::before {
      left: 100%;
    }

    /* Input Fields */
    .input-group {
      margin-bottom: 20px;
    }

    .form-control {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      border-radius: 50px;
      color: white;
      padding: 15px 20px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.2);
      box-shadow: 0 0 10px rgba(102, 126, 234, 0.5);
      color: white;
    }

    .input-group-text {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      border-radius: 50px 0 0 50px;
      color: rgba(255, 255, 255, 0.8);
    }

    /* Custom Checkbox */
    .custom-checkbox .custom-control-label::before {
      background-color: rgba(255, 255, 255, 0.1);
      border: none;
    }

    .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
      background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .card-3d {
        margin-top: 50px;
      }
    }
  </style>
</head>
<body class="bg-dark">
  <!-- Particle Canvas -->
  <canvas id="particle-canvas"></canvas>

  <div class="main-content">
    <div class="header bg-gradient-primary py-7">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white" style="font-size: 2.5rem; font-weight: 500;">Restaurant Point Of Sale</h1>
              <p class="text-light" style="opacity: 0.8;">Welcome back! Please login to continue</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card card-3d bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form method="post" role="form">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                 <input class="form-control" required name="staff_email" placeholder="Email" type="email" style="color: black;">

                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                   <input class="form-control" required name="staff_password" placeholder="Password" type="password" style="color: black;">

                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                  <input class="custom-control-input" id="customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for="customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" name="login" class="btn btn-primary my-4">Log In</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php require_once('partials/_footer.php'); ?>

  <!-- JavaScript Libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  
  <!-- Custom JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Three.js Particle System
      const canvas = document.getElementById('particle-canvas');
      const renderer = new THREE.WebGLRenderer({ canvas, alpha: true });
      renderer.setSize(window.innerWidth, window.innerHeight);
      
      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
      camera.position.z = 5;
      
      // Create particles
      const particlesGeometry = new THREE.BufferGeometry();
      const particleCount = 1500;
      
      const posArray = new Float32Array(particleCount * 3);
      const colorArray = new Float32Array(particleCount * 3);
      
      for(let i = 0; i < particleCount * 3; i++) {
        posArray[i] = (Math.random() - 0.5) * 10;
        colorArray[i] = Math.random();
      }
      
      particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
      particlesGeometry.setAttribute('color', new THREE.BufferAttribute(colorArray, 3));
      
      const particlesMaterial = new THREE.PointsMaterial({
        size: 0.02,
        vertexColors: true,
        transparent: true,
        opacity: 0.8,
        blending: THREE.AdditiveBlending
      });
      
      const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
      scene.add(particlesMesh);
      
      // 3D Card Tilt Effect
      const card = document.querySelector('.card-3d');
      if (card) {
        card.addEventListener('mousemove', (e) => {
          const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
          const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
          card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg) translateY(-10px)`;
        });
        
        card.addEventListener('mouseenter', () => {
          card.style.transition = 'all 0.1s ease';
        });
        
        card.addEventListener('mouseleave', () => {
          card.style.transition = 'all 0.5s ease';
          card.style.transform = 'rotateY(0deg) rotateX(0deg)';
        });
      }
      
      // Animation loop
      function animate() {
        requestAnimationFrame(animate);
        particlesMesh.rotation.x += 0.0005;
        particlesMesh.rotation.y += 0.0007;
        renderer.render(scene, camera);
      }
      animate();
      
      // Handle window resize
      window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
      });
      
      // Button ripple effect
      const buttons = document.querySelectorAll('.btn-primary');
      buttons.forEach(button => {
        button.addEventListener('click', function(e) {
          const x = e.clientX - e.target.getBoundingClientRect().left;
          const y = e.clientY - e.target.getBoundingClientRect().top;
          
          const ripple = document.createElement('span');
          ripple.classList.add('ripple');
          ripple.style.left = `${x}px`;
          ripple.style.top = `${y}px`;
          this.appendChild(ripple);
          
          setTimeout(() => {
            ripple.remove();
          }, 1000);
        });
      });
    });
  </script>
  
  <!-- Your existing scripts -->
  <?php require_once('partials/_scripts.php'); ?>
</body>
</html>