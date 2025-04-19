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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SkillBridge | Business Login</title>
  <meta name="description" content="Login to your SkillBridge business account">
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
      background-color: #f8f9fa;
      color: #333;
      display: flex;
      min-height: 100vh;
      align-items: center;
      justify-content: center;
      background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      background-blend-mode: overlay;
      background-color: rgba(255,255,255,0.8);
    }
    
    .login-container {
      max-width: 450px;
      width: 100%;
      margin: 2rem;
    }
    
    .login-card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: var(--shadow-md);
      transition: var(--transition);
      background-color: white;
    }
    
    .login-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    .login-header {
      background: var(--gradient-blue);
      color: white;
      padding: 2rem;
      text-align: center;
    }
    
    .login-logo {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }
    
    .login-logo b {
      font-weight: 800;
    }
    
    .login-subtitle {
      font-size: 1rem;
      opacity: 0.9;
    }
    
    .login-body {
      padding: 2rem;
    }
    
    .form-control {
      height: 50px;
      border-radius: 8px;
      border: 1px solid #e0e0e0;
      padding-left: 45px;
      transition: var(--transition);
    }
    
    .form-control:focus {
      border-color: var(--primary-blue);
      box-shadow: 0 0 0 0.25rem rgba(26, 115, 232, 0.25);
    }
    
    .input-group-text {
      position: absolute;
      z-index: 4;
      height: 50px;
      width: 50px;
      background: transparent;
      border: none;
      color: #757575;
    }
    
    .btn-login {
      background: var(--gradient-blue);
      border: none;
      height: 50px;
      font-weight: 600;
      border-radius: 8px;
      transition: var(--transition);
    }
    
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }
    
    .forgot-link {
      color: var(--primary-blue);
      text-decoration: none;
      transition: var(--transition);
    }
    
    .forgot-link:hover {
      color: var(--dark-blue);
      text-decoration: underline;
    }
    
    .alert-message {
      border-radius: 8px;
      padding: 0.75rem 1.25rem;
      margin-bottom: 1rem;
    }
    
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    
    .alert-error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    
    .alert-warning {
      background-color: #fff3cd;
      color: #856404;
      border: 1px solid #ffeeba;
    }
    
    /* Responsive adjustments */
    @media (max-width: 576px) {
      .login-container {
        margin: 1rem;
      }
      
      .login-header {
        padding: 1.5rem;
      }
      
      .login-body {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>
<div class="login-container">
  <div class="login-card">
    <div class="login-header">
      <h1 class="login-logo"><b>Skill</b>Bridge</h1>
      <p class="login-subtitle">Business Services Platform</p>
    </div>
    
    <div class="login-body">
      <h2 class="text-center mb-4">Business Login</h2>
      
      <?php 
      // Success message for registration
      if(isset($_SESSION['registerCompleted'])) {
      ?>
        <div class="alert-message alert-warning text-center">
          <i class="fas fa-info-circle me-2"></i> You have registered successfully! Your account approval is pending by admin.
        </div>
      <?php
        unset($_SESSION['registerCompleted']); 
      }
      
      // Login error message
      if(isset($_SESSION['loginError'])) {
      ?>
        <div class="alert-message alert-error text-center">
          <i class="fas fa-exclamation-circle me-2"></i> Invalid Email/Password! Try Again!
        </div>
      <?php
        unset($_SESSION['loginError']); 
      }
      
      // Company login error
      if(isset($_SESSION['companyLoginError'])) {
      ?>
        <div class="alert-message alert-error text-center">
          <i class="fas fa-exclamation-circle me-2"></i> <?php echo $_SESSION['companyLoginError']; ?>
        </div>
      <?php
        unset($_SESSION['companyLoginError']); 
      }
      ?>
      
      <form method="post" action="checkcompanylogin.php">
        <div class="mb-3 position-relative">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          <input type="email" class="form-control ps-5" name="email" placeholder="Email" required>
        </div>
        
        <div class="mb-4 position-relative">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" class="form-control ps-5" name="password" placeholder="Password" required>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <a href="#" class="forgot-link">Forgot password?</a>
          </div>
          <div>
            <button type="submit" class="btn btn-login btn-primary px-4">
              Sign In <i class="fas fa-arrow-right ms-2"></i>
            </button>
          </div>
        </div>
      </form>
      
      <div class="text-center mt-4">
        <p class="mb-2">Don't have an account? <a href="register-company.php" class="forgot-link">Register here</a></p>
        <p class="mb-0">Are you a professional? <a href="login-candidates.php" class="forgot-link">Professional login</a></p>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/smooth-scroll@16.1.3/dist/smooth-scroll.polyfills.min.js"></script>

<script>
  // Initialize SmoothScroll for anchor links
  document.addEventListener('DOMContentLoaded', function() {
    const scroll = new SmoothScroll('a[href*="#"]', {
      speed: 800,
      speedAsDuration: true
    });
    
    // Auto-hide alert messages after 8 seconds
    const alertMessages = document.querySelectorAll('.alert-message');
    alertMessages.forEach(message => {
      setTimeout(() => {
        message.style.opacity = '0';
        setTimeout(() => {
          message.style.display = 'none';
        }, 300);
      }, 8000);
    });
    
    // Add focus effects to form inputs
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
      const icon = input.previousElementSibling;
      
      input.addEventListener('focus', () => {
        icon.style.color = 'var(--primary-blue)';
      });
      
      input.addEventListener('blur', () => {
        icon.style.color = '#757575';
      });
    });
  });
</script>
</body>
</html>