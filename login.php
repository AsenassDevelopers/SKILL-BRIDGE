<?php 
session_start();

if(isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) { 
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SkillBridge | Professional Services Platform</title>
  <meta name="description" content="Connect with skilled professionals across Africa">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --primary-blue: #1a73e8;
      --dark-blue: #0d47a1;
      --light-blue: #e8f0fe;
      --gradient-blue: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
      --shadow-sm: 0 2px 8px rgba(0,0,0,0.1);
      --shadow-md: 0 4px 12px rgba(0,0,0,0.15);
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      padding-top: 70px;
      background-color: #f8f9fa;
      color: #333;
    }
    
    /* Header Styles */
    .main-header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1030;
      background: var(--gradient-blue);
      box-shadow: var(--shadow-sm);
      transition: var(--transition);
    }
    
    .logo {
      padding: 0 1.5rem;
      height: 70px;
      display: flex;
      align-items: center;
      transition: var(--transition);
      text-decoration: none;
    }
    
    .logo:hover {
      background-color: rgba(0,0,0,0.1) !important;
    }
    
    .logo-mini {
      display: inline-flex;
      width: 40px;
      height: 40px;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      background-color: var(--dark-blue);
      color: white;
      font-size: 1.1rem;
      font-weight: 600;
      margin-right: 12px;
      box-shadow: var(--shadow-sm);
    }
    
    .logo-lg {
      font-size: 1.4rem;
      font-weight: 600;
      color: white;
      letter-spacing: 0.5px;
    }
    
    .logo-lg b {
      font-weight: 700;
    }
    
    .navbar-nav {
      align-items: center;
    }

    .sb-navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
        }
        
        .sb-navbar-brand span {
            color: #ff6b00;
        }
    
    .navbar-nav .nav-link {
      color: white !important;
      font-weight: 500;
      padding: 0.8rem 1.2rem;
      margin: 0 0.2rem;
      border-radius: 8px;
      transition: var(--transition);
    }
    
    .navbar-nav .nav-link:hover {
      background-color: rgba(255,255,255,0.15);
      transform: translateY(-2px);
    }
    
    .navbar-nav .btn-signup {
      background-color: white;
      color: var(--primary-blue) !important;
      padding: 0.5rem 1.5rem;
      border-radius: 50px;
      font-weight: 600;
      transition: var(--transition);
      box-shadow: var(--shadow-sm);
    }
    
    .navbar-nav .btn-signup:hover {
      transform: translateY(-2px) scale(1.02);
      box-shadow: var(--shadow-md);
    }
    
    /* Content Styles */
    .content-header {
      padding: 3rem 0 1rem;
    }
    
    .auth-card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: var(--shadow-md);
      transition: var(--transition);
      height: 100%;
    }
    
    .auth-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .auth-card .card-body {
      padding: 2rem;
    }
    
    .auth-card .card-title {
      font-weight: 600;
      color: var(--dark-blue);
    }
    
    .auth-card.candidate {
      border-top: 4px solid #FFC107;
    }
    
    .auth-card.company {
      border-top: 4px solid #F44336;
    }
    
    .auth-link {
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 500;
      color: var(--primary-blue);
      text-decoration: none;
      transition: var(--transition);
    }
    
    .auth-link:hover {
      color: var(--dark-blue);
      transform: translateX(5px);
    }
    
    .auth-link i {
      margin-left: 8px;
      transition: var(--transition);
    }
    
    .auth-link:hover i {
      transform: translateX(3px);
    }
    
    /* Footer Styles */
    .main-footer {
      background-color: #fff;
      padding: 2rem 0;
      box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
      margin-top: 3rem;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 992px) {
      .navbar-nav .nav-link {
        padding: 0.8rem;
      }
    }
    
    @media (max-width: 768px) {
      body {
        padding-top: 60px;
      }
      
      .logo {
        height: 60px;
        padding: 0 1rem;
      }
      
      .logo-lg {
        font-size: 1.2rem;
      }
      
      .auth-card {
        margin-bottom: 1.5rem;
      }
    }
  </style>
</head>
<body>
<div class="wrapper">

<!-- Header Section -->
<header class="main-header">
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
      <!-- Logo -->
      <a class="navbar-brand sb-navbar-brand" href="/skillbridge/public/index.php">
                Skill<span>Bridge</span>
            </a>

      <!-- Main Navigation -->
      <nav class="navbar navbar-expand-lg">
        <div class="navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="services.php">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="providers.php">Providers</a>
            </li>
            <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn-signup" href="sign-up.php">Sign Up</a>
            </li>  
            <?php } else { 
              if(isset($_SESSION['id_user'])) { 
            ?>        
            <li class="nav-item">
              <a class="nav-link" href="user/index.php">Dashboard</a>
            </li>
            <?php
            } else if(isset($_SESSION['id_company'])) { 
            ?>        
            <li class="nav-item">
              <a class="nav-link" href="company/index.php">Dashboard</a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <?php } ?>          
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>

<!-- Main Content -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 text-center mb-5">
          <h1 class="display-5 fw-bold text-dark">Join SkillBridge Today</h1>
          <p class="lead text-muted">Connect with Africa's top professionals or find quality services</p>
        </div>
        
        <div class="col-md-6 mb-4">
          <div class="auth-card candidate h-100">
            <div class="card-body text-center">
              <h3 class="card-title mb-4">For Professionals</h3>
              <p class="card-text mb-4">Showcase your skills and connect with clients across Africa</p>
              <a href="login-candidates.php" class="auth-link">
                Professional Login <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 mb-4">
          <div class="auth-card company h-100">
            <div class="card-body text-center">
              <h3 class="card-title mb-4">For Businesses</h3>
              <p class="card-text mb-4">Find skilled professionals for your business needs</p>
              <a href="login-company.php" class="auth-link">
                Business Login <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Footer -->
<footer class="main-footer">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <p class="mb-0">
          <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="index.php" class="text-primary">SkillBridge</a>.</strong> 
          All rights reserved.
        </p>
      </div>
    </div>
  </div>
</footer>

</div>
<!-- ./wrapper -->

<!-- JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/smooth-scroll@16.1.3/dist/smooth-scroll.polyfills.min.js"></script>

<script>
  // Enhanced Header Scroll Behavior
  document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.main-header');
    let lastScroll = 0;
    const scrollThreshold = 100;
    const headerHeight = header.offsetHeight;
    
    // Set initial header state
    header.style.transform = 'translateY(0)';
    
    // Scroll event listener with debounce
    let ticking = false;
    window.addEventListener('scroll', function() {
      if (!ticking) {
        window.requestAnimationFrame(function() {
          const currentScroll = window.pageYOffset;
          
          // Only transform header if scrolled past threshold
          if (Math.abs(currentScroll - lastScroll) > 5) {
            if (currentScroll <= scrollThreshold) {
              // At top of page
              header.style.transform = 'translateY(0)';
              header.style.boxShadow = 'none';
              header.style.background = 'var(--gradient-blue)';
            } else if (currentScroll > lastScroll && currentScroll > headerHeight) {
              // Scrolling down
              header.style.transform = `translateY(-${headerHeight}px)`;
            } else {
              // Scrolling up
              header.style.transform = 'translateY(0)';
              header.style.boxShadow = 'var(--shadow-sm)';
              header.style.background = 'rgba(26, 115, 232, 0.95)';
            }
            lastScroll = currentScroll;
          }
          ticking = false;
        });
        ticking = true;
      }
    });
    
    // Initialize SmoothScroll for anchor links
    const scroll = new SmoothScroll('a[href*="#"]', {
      speed: 800,
      speedAsDuration: true,
      offset: headerHeight + 20
    });
    
    // Mobile menu toggle functionality
    const navbarToggler = document.querySelector('.navbar-toggler');
    if (navbarToggler) {
      navbarToggler.addEventListener('click', function() {
        document.querySelector('.navbar-collapse').classList.toggle('show');
      });
    }
  });
</script>
</body>
</html>