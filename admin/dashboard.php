<?php
session_start();

if(empty($_SESSION['id_admin'])) {
  header("Location: index.php");
  exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SkillBridge | Admin Dashboard</title>
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
    }
    
    .sb-navbar-brand {
      font-weight: 700;
      font-size: 1.8rem;
      letter-spacing: -0.5px;
      display: flex;
      align-items: center;
    }
    
    .sb-navbar-brand span {
      color: var(--accent-orange);
    }
    
    .main-header {
      background-color: var(--primary-blue);
      padding: 10px 0;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .sidebar {
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    
    .sidebar .nav-link {
      color: #333;
      padding: 12px 15px;
      border-left: 3px solid transparent;
      transition: all 0.3s;
    }
    
    .sidebar .nav-link:hover {
      background-color: rgba(0,0,0,0.03);
      border-left: 3px solid var(--accent-orange);
    }
    
    .sidebar .nav-link.active {
      background-color: rgba(0,102,204,0.1);
      border-left: 3px solid var(--primary-blue);
      color: var(--primary-blue);
    }
    
    .sidebar .nav-link i {
      margin-right: 8px;
      color: var(--primary-blue);
    }
    
    .dashboard-container {
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      padding: 25px;
    }
    
    .dashboard-title {
      color: var(--primary-blue);
      border-bottom: 2px solid var(--accent-orange);
      padding-bottom: 10px;
      margin-bottom: 20px;
    }
    
    .stat-card {
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      color: white;
      transition: transform 0.3s;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
    }
    
    .stat-card.companies {
      background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
    }
    
    .stat-card.candidates {
      background: linear-gradient(135deg, #28a745, #218838);
    }
    
    .stat-card.jobs {
      background: linear-gradient(135deg, #17a2b8, #138496);
    }
    
    .stat-card.applications {
      background: linear-gradient(135deg, #ffc107, #e0a800);
    }
    
    .stat-icon {
      font-size: 2.5rem;
      margin-bottom: 15px;
    }
    
    .stat-number {
      font-size: 1.8rem;
      font-weight: 700;
    }
    
    .stat-text {
      font-size: 1rem;
      opacity: 0.9;
    }
    
    .welcome-box {
      background-color: var(--primary-blue);
      color: white;
      border-radius: 5px;
      padding: 15px;
      margin-bottom: 20px;
    }
    
    .main-footer {
      background-color: #000;
      color: white;
      padding: 15px 0;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <header class="main-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand sb-navbar-brand" href="index.php">
            Skill<span>Bridge</span>
          </a>
          <div class="navbar-collapse">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="container my-4">
    <div class="row">
      <div class="col-md-3">
        <div class="sidebar p-3">
          <div class="welcome-box">
            <h5>Welcome <b>Admin</b></h5>
          </div>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="active-jobs.php"><i class="fas fa-briefcase"></i> Active Jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="applications.php"><i class="fas fa-address-card"></i> Applications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="companies.php"><i class="fas fa-building"></i> Companies</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-9">
        <div class="dashboard-container">
          <h2 class="dashboard-title"><i class="fas fa-tachometer-alt me-2"></i>Portal Statistics</h2>
          
          <div class="row">
            <!-- Active Companies -->
            <div class="col-md-6">
              <div class="stat-card companies">
                <div class="stat-icon"><i class="fas fa-building"></i></div>
                <div class="stat-number">
                  <?php
                    $sql = "SELECT * FROM company WHERE active='1'";
                    $result = $conn->query($sql);
                    echo $result->num_rows > 0 ? $result->num_rows : 0;
                  ?>
                </div>
                <div class="stat-text">Active Companies</div>
              </div>
            </div>
            
            <!-- Pending Companies -->
            <div class="col-md-6">
              <div class="stat-card companies">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-number">
                  <?php
                    $sql = "SELECT * FROM company WHERE active='2'";
                    $result = $conn->query($sql);
                    echo $result->num_rows > 0 ? $result->num_rows : 0;
                  ?>
                </div>
                <div class="stat-text">Pending Approvals</div>
              </div>
            </div>
            
            <!-- Registered Candidates -->
            <div class="col-md-6">
              <div class="stat-card candidates">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-number">
                  <?php
                    $sql = "SELECT * FROM users WHERE active='1'";
                    $result = $conn->query($sql);
                    echo $result->num_rows > 0 ? $result->num_rows : 0;
                  ?>
                </div>
                <div class="stat-text">Registered Candidates</div>
              </div>
            </div>
            
            <!-- Pending Candidates -->
            <div class="col-md-6">
              <div class="stat-card candidates">
                <div class="stat-icon"><i class="fas fa-user-clock"></i></div>
                <div class="stat-number">
                  <?php
                    $sql = "SELECT * FROM users WHERE active='0'";
                    $result = $conn->query($sql);
                    echo $result->num_rows > 0 ? $result->num_rows : 0;
                  ?>
                </div>
                <div class="stat-text">Pending Candidates</div>
              </div>
            </div>
            
            <!-- Total Job Posts -->
            <div class="col-md-6">
              <div class="stat-card jobs">
                <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
                <div class="stat-number">
                  <?php
                    $sql = "SELECT * FROM job_post";
                    $result = $conn->query($sql);
                    echo $result->num_rows > 0 ? $result->num_rows : 0;
                  ?>
                </div>
                <div class="stat-text">Total Job Posts</div>
              </div>
            </div>
            
            <!-- Total Applications -->
            <div class="col-md-6">
              <div class="stat-card applications">
                <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                <div class="stat-number">
                  <?php
                    $sql = "SELECT * FROM apply_job_post";
                    $result = $conn->query($sql);
                    echo $result->num_rows > 0 ? $result->num_rows : 0;
                  ?>
                </div>
                <div class="stat-text">Total Applications</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container text-center">
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#" style="color: var(--accent-orange);">SkillBridge</a>.</strong> All rights reserved.
      <div class="mt-2">
        <small>Empowering African Talent Worldwide</small>
      </div>
    </div>
  </footer>

  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>