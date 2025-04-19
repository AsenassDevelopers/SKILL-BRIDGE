<?php
session_start();

if(empty($_SESSION['id_company'])) {
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
  <title>Company Dashboard | SkillBridge</title>
  
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
    
    .company-dashboard {
      padding-top: 30px;
      min-height: calc(100vh - 120px);
    }
    
    .sidebar {
      position: sticky;
      top: 20px;
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
    }
    
    .sidebar-menu .active a {
      background-color: rgba(26, 115, 232, 0.1);
      color: var(--primary-color);
      font-weight: 500;
      border-left: 3px solid var(--accent-color);
    }
    
    .dashboard-content {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      padding: 30px;
      margin-bottom: 30px;
    }
    
    .dashboard-title {
      color: var(--primary-dark);
      font-weight: 600;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .dashboard-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 3px;
      background: var(--accent-color);
    }
    
    .stats-card {
      border-radius: 8px;
      color: var(--white);
      padding: 20px;
      margin-bottom: 20px;
      text-align: center;
      transition: var(--transition);
      box-shadow: var(--card-shadow);
    }
    
    .stats-card:hover {
      transform: translateY(-5px);
    }
    
    .stats-icon {
      font-size: 2.5rem;
      margin-bottom: 15px;
    }
    
    .stats-number {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 5px;
    }
    
    .stats-label {
      font-size: 1rem;
      opacity: 0.9;
    }
    
    .alert-info {
      background-color: rgba(26, 115, 232, 0.1);
      border-color: rgba(26, 115, 232, 0.2);
      color: var(--primary-dark);
    }
    
    .alert-icon {
      font-size: 1.2rem;
      margin-right: 10px;
      color: var(--primary-color);
    }
    
    .main-footer {
      background: var(--dark-bg);
      color: var(--white);
      padding: 30px 0;
      margin-top: 40px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .sidebar {
        position: static;
        margin-bottom: 30px;
      }
      
      .dashboard-content {
        padding: 20px;
      }
      
      .stats-card {
        margin-bottom: 15px;
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
              <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Dashboard Content -->
  <div class="company-dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="sidebar-card">
            <div class="sidebar-header">
              Welcome <b><?php echo htmlspecialchars($_SESSION['name']); ?></b>
            </div>
            <div class="sidebar-body">
              <ul class="sidebar-menu">
                <li class="active"><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="edit-company.php"><i class="fas fa-building"></i> My Company</a></li>
                <li><a href="create-job-post.php"><i class="fas fa-file-alt"></i> Create Job Post</a></li>
                <li><a href="my-job-post.php"><i class="fas fa-list-ul"></i> My Job Posts</a></li>
                <li><a href="job-applications.php"><i class="fas fa-users"></i> Job Applications</a></li>
                <li><a href="mailbox.php"><i class="fas fa-envelope"></i> Mailbox</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="resume-database.php"><i class="fas fa-database"></i> Resume Database</a></li>
              </ul>
            </div>
          </div>
        </div>
        
        <div class="col-md-9">
          <div class="dashboard-content">
            <h3 class="dashboard-title">Company Dashboard</h3>
            
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <i class="fas fa-info-circle alert-icon"></i>
              <span>In this dashboard you can manage your company profile, post jobs, and review applications from Africa's top talent.</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="stats-card" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));">
                  <div class="stats-icon">
                    <i class="fas fa-briefcase"></i>
                  </div>
                  <div class="stats-number">
                    <?php
                    $sql = "SELECT * FROM job_post WHERE id_company='$_SESSION[id_company]'";
                    $result = $conn->query($sql);
                    echo $result->num_rows > 0 ? $result->num_rows : '0';
                    ?>
                  </div>
                  <div class="stats-label">Active Job Posts</div>
                </div>
              </div>
              
              <div class="col-md-6 mb-4">
                <div class="stats-card" style="background: linear-gradient(135deg, #28a745, #218838);">
                  <div class="stats-icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="stats-number">
                    <?php
                    $sql = "SELECT * FROM apply_job_post WHERE id_company='$_SESSION[id_company]'";
                    $result = $conn->query($sql);
                    echo $result->num_rows > 0 ? $result->num_rows : '0';
                    ?>
                  </div>
                  <div class="stats-label">Total Applications</div>
                </div>
              </div>
            </div>
            
            <div class="motivational-quote mt-4 p-4 bg-light rounded">
              <p class="quote-text mb-2"><i class="fas fa-quote-left text-primary me-2"></i> Africa's workforce is young, talented, and ready to innovate. Your company can be at the forefront of this transformation by finding the right talent through SkillBridge.</p>
              <p class="quote-author text-end mb-0">- SkillBridge Team</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container text-center">
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="../index.php">SkillBridge</a>.</strong> All rights reserved.
    </div>
  </footer>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>