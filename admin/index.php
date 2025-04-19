<?php
session_start();

if(isset($_SESSION['id_admin'])) {
  header("Location: dashboard.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SkillBridge | Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Custom CSS -->
  <style>
    :root {
      --primary-blue: #0066cc;
      --secondary-blue: #004d99;
      --accent-orange: #ff6b00;
      --dark-bg: #343a40;
      --light-bg: #f8f9fa;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    
    .login-container {
      max-width: 400px;
      width: 100%;
      padding: 2rem;
    }
    
    .login-card {
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      overflow: hidden;
      border: none;
    }
    
    .login-header {
      background-color: var(--primary-blue);
      color: white;
      padding: 1.5rem;
      text-align: center;
    }
    
    .sb-navbar-brand {
      font-weight: 700;
      font-size: 1.8rem;
      letter-spacing: -0.5px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }
    
    .sb-navbar-brand span {
      color: var(--accent-orange);
    }
    
    .login-body {
      padding: 2rem;
      background-color: white;
    }
    
    .login-title {
      color: var(--primary-blue);
      text-align: center;
      margin-bottom: 1.5rem;
      font-weight: 600;
    }
    
    .form-control {
      height: 45px;
      border-radius: 5px;
      border: 1px solid #ddd;
      padding-left: 40px;
    }
    
    .form-control:focus {
      border-color: var(--primary-blue);
      box-shadow: 0 0 0 0.25rem rgba(0,102,204,0.25);
    }
    
    .input-group-text {
      position: absolute;
      z-index: 4;
      height: 45px;
      background: transparent;
      border: none;
      color: #666;
    }
    
    .btn-login {
      background-color: var(--primary-blue);
      border-color: var(--primary-blue);
      height: 45px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    .btn-login:hover {
      background-color: var(--secondary-blue);
      border-color: var(--secondary-blue);
    }
    
    .error-message {
      color: #dc3545;
      text-align: center;
      margin-top: 1rem;
      font-weight: 500;
    }
    
    .main-footer {
      text-align: center;
      margin-top: 2rem;
      color: #666;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="card login-card">
      <div class="login-header">
        <a class="sb-navbar-brand" href="../index.php">
          Skill<span>Bridge</span>
        </a>
      </div>
      <div class="card-body login-body">
        <h3 class="login-title"><i class="fas fa-lock me-2"></i>Admin Login</h3>
        
        <form action="checklogin.php" method="post">
          <div class="mb-3 position-relative">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
              <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
          </div>
          
          <div class="mb-4 position-relative">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
          </div>
          
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-login">
              <i class="fas fa-sign-in-alt me-2"></i>Sign In
            </button>
          </div>
          
          <?php 
          if(isset($_SESSION['loginError'])) {
            echo '<div class="error-message mt-3">
                  <i class="fas fa-exclamation-circle me-2"></i>Invalid Username/Password! Try Again!
                </div>';
            unset($_SESSION['loginError']); 
          }
          ?>
        </form>
      </div>
    </div>
    
    <div class="main-footer">
      <p>Copyright &copy; <?php echo date('Y'); ?> <a href="#" style="color: var(--accent-orange);">SkillBridge</a></p>
      <small>Empowering African Talent Worldwide</small>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>