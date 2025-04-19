<?php 
session_start();

if(isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) { 
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Join SkillBridge - Unlock Your Potential</title>
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #1a73e8;
      --primary-dark: #0d47a1;
      --accent-color: #ff6b00;
      --text-color: #333;
      --light-bg: #f8f9fa;
      --dark-bg: #212529;
      --white: #ffffff;
      --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s ease;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      color: var(--text-color);
      background-color: var(--light-bg);
      line-height: 1.6;
    }
    
    .sb-navbar {
      background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .sb-navbar-brand {
      font-weight: 700;
      font-size: 1.8rem;
      letter-spacing: -0.5px;
      display: flex;
      align-items: center;
      color: var(--white);
      text-decoration: none;
    }
    
    .sb-navbar-brand span {
      color: var(--accent-color);
    }
    
    .sb-navbar-brand:hover {
      color: var(--white);
    }
    
    .nav-link {
      color: rgba(255, 255, 255, 0.85);
      font-weight: 500;
      padding: 0.5rem 1rem;
      transition: var(--transition);
    }
    
    .nav-link:hover, .nav-link:focus {
      color: var(--white);
      transform: translateY(-2px);
    }
    
    .hero-section {
      background: linear-gradient(135deg, 
        rgba(26, 115, 232, 0.85) 0%, 
        rgba(13, 71, 161, 0.9) 100%),
        url('img/africa-tech.jpg') center/cover no-repeat;
      color: var(--white);
      padding: 80px 0 60px;
      text-align: center;
      margin-bottom: 40px;
    }
    
    .hero-title {
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 15px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .hero-subtitle {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto 30px;
      opacity: 0.9;
    }
    
    .registration-section {
      padding: 40px 0;
    }
    
    .section-title {
      font-weight: 600;
      color: var(--primary-dark);
      margin-bottom: 30px;
      position: relative;
      text-align: center;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: var(--accent-color);
    }
    
    .registration-card {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      padding: 30px;
      margin-bottom: 30px;
      height: 100%;
      transition: var(--transition);
      text-align: center;
      border: none;
    }
    
    .registration-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    
    .card-icon {
      font-size: 3rem;
      color: var(--primary-color);
      margin-bottom: 20px;
    }
    
    .card-title {
      font-weight: 600;
      margin-bottom: 15px;
      color: var(--primary-dark);
    }
    
    .card-description {
      margin-bottom: 25px;
      color: #555;
    }
    
    .btn-card {
      background-color: var(--primary-color);
      color: var(--white);
      padding: 10px 25px;
      border-radius: 4px;
      font-weight: 500;
      transition: var(--transition);
      border: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    
    .btn-card:hover {
      background-color: var(--primary-dark);
      color: var(--white);
      transform: translateY(-2px);
    }
    
    .btn-card i {
      margin-left: 8px;
    }
    
    .motivational-quote {
      background: rgba(26, 115, 232, 0.1);
      padding: 30px;
      border-radius: 8px;
      margin: 40px 0;
      text-align: center;
      border-left: 4px solid var(--accent-color);
    }
    
    .quote-text {
      font-size: 1.2rem;
      font-style: italic;
      margin-bottom: 10px;
      color: var(--primary-dark);
    }
    
    .quote-author {
      font-weight: 600;
      color: var(--accent-color);
    }
    
    .main-footer {
      background: var(--dark-bg);
      color: var(--white);
      padding: 30px 0;
      margin-top: 60px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .hero-subtitle {
        font-size: 1rem;
      }
      
      .registration-card {
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-expand-lg sb-navbar">
      <div class="container">
        <a class="navbar-brand sb-navbar-brand" href="index.php">
          Skill<span>Bridge</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="jobs.php"><i class="fas fa-briefcase me-1"></i> Jobs</a>
            </li>
            <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="sign-up.php"><i class="fas fa-user-plus me-1"></i> Sign Up</a>
            </li>  
            <?php } else { 
              if(isset($_SESSION['id_user'])) { 
            ?>        
            <li class="nav-item">
              <a class="nav-link" href="user/index.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
            </li>
            <?php
            } else if(isset($_SESSION['id_company'])) { 
            ?>        
            <li class="nav-item">
              <a class="nav-link" href="company/index.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
            </li>
            <?php } ?>          
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <h1 class="hero-title">Join Africa's Premier Talent Network</h1>
      <p class="hero-subtitle">Connect with opportunities across the continent and take your career to new heights</p>
    </div>
  </section>

  <!-- Registration Section -->
  <section class="registration-section">
    <div class="container">
      <h2 class="section-title">Create Your Account</h2>
      
      <div class="motivational-quote">
        <p class="quote-text">"Africa's youth are not just the leaders of tomorrow - they are the innovators of today. SkillBridge provides the platform to showcase your talents to the world."</p>
        <p class="quote-author">- SkillBridge Team</p>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="registration-card">
            <div class="card-icon">
              <i class="fas fa-user-graduate"></i>
            </div>
            <h3 class="card-title">Job Seeker Registration</h3>
            <p class="card-description">
              Join thousands of African professionals finding their dream jobs. Showcase your skills, connect with top employers, and fast-track your career growth.
            </p>
            <a href="register-candidates.php" class="btn btn-card">
              Register as Candidate <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="registration-card">
            <div class="card-icon">
              <i class="fas fa-building"></i>
            </div>
            <h3 class="card-title">Employer Registration</h3>
            <p class="card-description">
              Access Africa's brightest talent pool. Post jobs, manage applications, and find the perfect candidates to drive your business forward.
            </p>
            <a href="register-company.php" class="btn btn-card">
              Register as Employer <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      
      <div class="text-center mt-4">
        <p>Already have an account? <a href="login.php" class="text-primary">Sign in here</a></p>
      </div>
    </div>
  </section>

  <footer class="main-footer">
    <div class="container text-center">
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="index.php">SkillBridge</a>.</strong> All rights reserved.
    </div>
  </footer>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>