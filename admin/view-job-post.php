<?php
//To Handle Session Variables on This Page
session_start();

if(empty($_SESSION['id_admin'])) {
  header("Location: ../index.php");
  exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");

$sql1 = "SELECT * FROM job_post INNER JOIN company ON job_post.id_company=company.id_company WHERE id_jobpost='$_GET[id]'";
$result1 = $conn->query($sql1);
if($result1->num_rows > 0) {
  $row = $result1->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SkillBridge | Admin - View Job Post</title>
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
    
    .content-container {
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      padding: 25px;
    }
    
    .company-card {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }
    
    .company-card:hover {
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
    
    .btn-back {
      background-color: var(--secondary-blue);
      border-color: var(--secondary-blue);
      font-weight: 600;
    }
    
    .btn-back:hover {
      background-color: #003d7a;
      border-color: #003d7a;
    }
    
    .main-footer {
      background-color: #000;
      color: white;
      padding: 15px 0;
      margin-top: 30px;
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
      <div class="col-lg-9">
        <div class="content-container mb-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="job-header"><?php echo $row['jobtitle']; ?></h1>
            <a href="active-jobs.php" class="btn btn-primary btn-back">
              <i class="fas fa-arrow-left me-2"></i>Back to Jobs
            </a>
          </div>
          
          <div class="job-meta mb-4">
            <span class="me-4"><i class="fas fa-map-marker-alt"></i> <?php echo $row['city']; ?></span>
            <span><i class="fas fa-calendar-alt"></i> Posted on <?php echo date("d-M-Y", strtotime($row['createdat'])); ?></span>
          </div>
          
          <div class="job-description">
            <?php echo stripcslashes($row['description']); ?>
          </div>
        </div>
      </div>
      
      <div class="col-lg-3">
        <div class="card company-card">
          <img src="../uploads/logo/<?php echo $row['logo']; ?>" alt="<?php echo $row['companyname']; ?> logo" class="company-logo card-img-top">
          <div class="card-body text-center">
            <h3 class="card-title"><?php echo $row['companyname']; ?></h3>
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