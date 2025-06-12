<footer class="py-5 animated-footer">
  <style>
    .animated-footer {
      opacity: 0;
      transform: translateY(20px);
      animation: footerEntrance 0.8s cubic-bezier(0.22, 1, 0.36, 1) forwards;
      animation-delay: 0.3s;
      background: linear-gradient(to right, #2c3e50, #4a6491);
      color: white;
    }
    
    @keyframes footerEntrance {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .nav-footer .nav-item {
      transition: all 0.4s ease;
    }
    
    .nav-footer .nav-link {
      position: relative;
      color: rgba(255,255,255,0.8) !important;
      padding: 0.25rem 0.5rem;
      transition: all 0.3s ease;
    }
    
    .nav-footer .nav-link:hover {
      color: white !important;
      transform: translateY(-2px);
    }
    
    .nav-footer .nav-link::before {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -2px;
      left: 50%;
      transform: translateX(-50%);
      background-color: white;
      transition: width 0.3s ease, left 0.3s ease;
    }
    
    .nav-footer .nav-link:hover::before {
      width: 100%;
      left: 0;
      transform: translateX(0);
    }
    
    .copyright {
      transition: all 0.3s ease;
      color: rgba(255,255,255,0.8) !important;
    }
    
    .copyright:hover {
      color: white !important;
      text-shadow: 0 0 8px rgba(255,255,255,0.3);
    }
  </style>
  
  <div class="container">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6">
        <div class="copyright text-center text-xl-left text-muted">
          &copy; 2020 - <?php echo date('Y'); ?> - Developed By Martin Mbithi Nzilani
        </div>
      </div>
      <div class="col-xl-6">
        <ul class="nav nav-footer justify-content-center justify-content-xl-end">
          <li class="nav-item">
            <a href="" class="nav-link" target="_blank">Restaurant POS</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>