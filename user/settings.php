<?php
// To Handle Session Variables on This Page
session_start();

// If user Not logged in then redirect them back to homepage. 
if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Account Settings | SkillBridge</title>
  
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
    
    .main-header {
      position: sticky;
      top: 0;
      z-index: 1030;
    }
    
    .content-wrapper {
      padding-top: 20px;
      min-height: calc(100vh - 120px);
    }
    
    .user-sidebar {
      position: sticky;
      top: 80px;
    }
    
    .sidebar-card {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      overflow: hidden;
      margin-bottom: 20px;
    }
    
    .sidebar-header {
      background: var(--primary-color);
      color: var(--white);
      padding: 15px;
      font-weight: 600;
    }
    
    .sidebar-body {
      padding: 0;
    }
    
    .sidebar-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .sidebar-menu li {
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .sidebar-menu li:last-child {
      border-bottom: none;
    }
    
    .sidebar-menu a {
      display: block;
      padding: 12px 15px;
      color: var(--text-color);
      text-decoration: none;
      transition: var(--transition);
    }
    
    .sidebar-menu a:hover {
      background-color: rgba(0, 0, 0, 0.03);
      color: var(--primary-color);
      padding-left: 20px;
    }
    
    .sidebar-menu i {
      width: 20px;
      margin-right: 10px;
      color: var(--accent-color);
      text-align: center;
    }
    
    .sidebar-menu .active a {
      background-color: rgba(26, 115, 232, 0.1);
      color: var(--primary-color);
      font-weight: 500;
      border-left: 3px solid var(--accent-color);
    }
    
    .settings-card {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      padding: 25px;
      margin-bottom: 30px;
    }
    
    .settings-title {
      color: var(--primary-dark);
      font-weight: 600;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid var(--accent-color);
    }
    
    .form-label {
      font-weight: 500;
      color: var(--primary-dark);
    }
    
    .form-control {
      padding: 10px 15px;
      border-radius: 4px;
      border: 1px solid #ddd;
      transition: var(--transition);
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(26, 115, 232, 0.25);
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      padding: 10px 20px;
      font-weight: 500;
      transition: var(--transition);
    }
    
    .btn-primary:hover {
      background-color: var(--primary-dark);
      border-color: var(--primary-dark);
      transform: translateY(-2px);
    }
    
    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
      padding: 10px 20px;
      font-weight: 500;
      transition: var(--transition);
    }
    
    .btn-danger:hover {
      background-color: #bb2d3b;
      border-color: #bb2d3b;
      transform: translateY(-2px);
    }
    
    .password-error {
      color: #dc3545;
      font-size: 0.9rem;
      margin-top: 5px;
      display: none;
    }
    
    .main-footer {
      background: var(--dark-bg);
      color: var(--white);
      padding: 20px 0;
      margin-top: 40px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .user-sidebar {
        position: static;
        margin-bottom: 30px;
      }
      
      .settings-card {
        padding: 15px;
      }
    }
  </style>
</head>
<body>
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-expand-lg sb-navbar">
      <div class="container">
        <a class="navbar-brand sb-navbar-brand" href="/skillbridge/public/index.php">
          Skill<span>Bridge</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="../jobs.php"><i class="fas fa-briefcase me-1"></i> Jobs</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-3 user-sidebar">
          <div class="sidebar-card">
            <div class="sidebar-header">
              Welcome <b><?php echo htmlspecialchars($_SESSION['name']); ?></b>
            </div>
            <div class="sidebar-body">
              <ul class="sidebar-menu">
                <li><a href="edit-profile.php"><i class="fas fa-user"></i> Edit Profile</a></li>
                <li><a href="index.php"><i class="fas fa-address-card"></i> My Applications</a></li>
                <li><a href="../jobs.php"><i class="fas fa-list-ul"></i> Jobs</a></li>
                <li><a href="mailbox.php"><i class="fas fa-envelope"></i> Mailbox</a></li>
                <li class="active"><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
        
        <div class="col-md-9">
          <div class="settings-card">
            <h2 class="settings-title"><i class="fas fa-key me-2"></i>Change Password</h2>
            <p class="mb-4">Type in new password that you want to use</p>
            
            <div class="row">
              <div class="col-lg-6 mb-4">
                <form id="changePassword" action="change-password.php" method="post">
                  <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                  </div>
                  <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" autocomplete="new-password" required>
                    <div id="passwordError" class="password-error">
                      Passwords do not match!
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Change Password
                  </button>
                </form>
              </div>
              
              <div class="col-lg-6">
                <div class="border-start ps-4" style="border-color: rgba(0,0,0,0.1) !important;">
                  <h3 class="h5 mb-3"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Account Deactivation</h3>
                  <form action="deactivate-account.php" method="post">
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" id="confirmDeactivate" required>
                      <label class="form-check-label" for="confirmDeactivate">
                        I want to deactivate my account
                      </label>
                    </div>
                    <button type="submit" class="btn btn-danger">
                      <i class="fas fa-user-slash me-1"></i> Deactivate My Account
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container text-center">
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="/skillbridge/public/index.php">SkillBridge</a>.</strong> All rights reserved.
    </div>
  </footer>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function() {
    // Password match validation
    $('#changePassword').on('submit', function(e) {
      if($('#password').val() != $('#cpassword').val()) {
        e.preventDefault();
        $('#passwordError').show();
        $('#cpassword').focus();
      }
    });
    
    // Hide error when user starts typing
    $('#password, #cpassword').on('input', function() {
      if($('#password').val() == $('#cpassword').val()) {
        $('#passwordError').hide();
      }
    });
  });
</script>
</body>
</html>