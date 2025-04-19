<?php
//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SkillBridge | Job Details</title>
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
    
    .navbar-nav .nav-link {
      color: white !important;
      font-weight: 500;
    }
    
    .job-header {
      color: var(--primary-blue);
      border-bottom: 2px solid var(--accent-orange);
      padding-bottom: 10px;
      margin-bottom: 20px;
    }
    
    .company-thumbnail {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }
    
    .company-thumbnail:hover {
      transform: translateY(-5px);
    }
    
    .company-logo {
      width: 100%;
      height: 200px;
      object-fit: contain;
      background-color: #f8f9fa;
      padding: 20px;
    }
    
    .job-meta {
      color: #666;
      margin-bottom: 15px;
    }
    
    .job-meta i {
      color: var(--accent-orange);
      margin-right: 5px;
    }
    
    .job-description {
      line-height: 1.8;
      font-size: 16px;
    }
    
    .btn-apply {
      background-color: var(--accent-orange);
      border-color: var(--accent-orange);
      font-weight: 600;
      padding: 10px 25px;
    }
    
    .btn-apply:hover {
      background-color: #e05e00;
      border-color: #e05e00;
    }
    
    .action-links a {
      color: var(--primary-blue);
      text-decoration: none;
      transition: color 0.3s;
    }
    
    .action-links a:hover {
      color: var(--accent-orange);
    }
    
    .main-footer {
      background-color: #000;
      color: white;
      padding: 15px 0;
      margin-top: 30px;
    }
    
    .back-btn {
      background-color: var(--secondary-blue);
      border-color: var(--secondary-blue);
    }
    
    .back-btn:hover {
      background-color: #003d7a;
      border-color: #003d7a;
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
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="sign-up.php"><i class="fas fa-user-plus"></i> Sign Up</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="container my-4">
    <?php
    $sql = "SELECT * FROM job_post INNER JOIN company ON job_post.id_company=company.id_company WHERE id_jobpost='$_GET[id]'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
    ?>
    <div class="row">
      <div class="col-lg-9">
        <div class="card mb-4">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h1 class="job-header"><?php echo $row['jobtitle']; ?></h1>
              <a href="jobs.php" class="btn btn-primary back-btn"><i class="fas fa-arrow-left me-2"></i>Back to Jobs</a>
            </div>
            
            <div class="job-meta mb-4">
              <span class="me-4"><i class="fas fa-map-marker-alt"></i> <?php echo $row['city']; ?></span>
              <span><i class="fas fa-calendar-alt"></i> Posted on <?php echo date("d-M-Y", strtotime($row['createdat'])); ?></span>
            </div>
            
            <div class="job-description mb-4">
              <?php echo stripcslashes($row['description']); ?>
            </div>
            
            <?php if(isset($_SESSION["id_user"]) && empty($_SESSION['companyLogged'])) { ?>
            <div class="text-center mt-5">
              <a href="apply.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-apply btn-lg"><i class="fas fa-paper-plane me-2"></i>Apply Now</a>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      
      <div class="col-lg-3">
        <div class="card company-thumbnail">
          <img src="uploads/logo/<?php echo $row['logo']; ?>" alt="<?php echo $row['companyname']; ?> logo" class="company-logo card-img-top">
          <div class="card-body text-center">
            <h3 class="card-title"><?php echo $row['companyname']; ?></h3>
            <div class="action-links mt-4">
              <div class="row">
                <div class="col-12 mb-3">
                  <a href="#"><i class="fas fa-info-circle me-2"></i>About Company</a>
                </div>
                <div class="col-12 mb-3">
                  <a href="#"><i class="fas fa-flag me-2"></i>Report Job</a>
                </div>
                <div class="col-12">
                  <a href="#"><i class="fas fa-envelope me-2"></i>Contact</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php 
      }
    }
    ?>
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