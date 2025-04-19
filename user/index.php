<?php
//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SkillBridge | User Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Font: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --primary-blue: #1a6fc9;
      --dark-blue: #0d4b8a;
      --light-blue: #e6f0fa;
      --accent-orange: #ff6b00;
      --transition: all 0.3s ease;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }
    
    .navbar {
      background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .sb-navbar-brand {
      font-weight: 700;
      font-size: 1.8rem;
      letter-spacing: -0.5px;
      display: flex;
      align-items: center;
      color: white !important;
    }
    
    .sb-navbar-brand span {
      color: var(--accent-orange);
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
      background-color: rgba(255, 255, 255, 0.1);
    }
    
    .sidebar {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }
    
    .sidebar .nav-link {
      color: #555;
      font-weight: 500;
      padding: 12px 20px;
      border-radius: 8px;
      margin-bottom: 5px;
      transition: var(--transition);
    }
    
    .sidebar .nav-link:hover, .sidebar .nav-link.active {
      background-color: var(--light-blue);
      color: var(--primary-blue);
    }
    
    .sidebar .nav-link i {
      margin-right: 10px;
      color: var(--primary-blue);
    }
    
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      transition: var(--transition);
      margin-bottom: 20px;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .attachment-block {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      transition: var(--transition);
    }
    
    .attachment-block:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }
    
    .text-orange {
      color: var(--accent-orange) !important;
    }
    
    footer {
      background-color: #000;
      color: white;
      padding: 20px 0;
      margin-top: 40px;
    }
    
    .welcome-box {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }
    
    .welcome-box h3 {
      color: var(--primary-blue);
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand sb-navbar-brand" href="/SkillBridge/public/index.php">
        Skill<span>Bridge</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="../jobs.php">Jobs</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <div class="row">
      <div class="col-md-3">
        <div class="sidebar p-3">
          <div class="welcome-box mb-4">
            <h3 class="mb-0">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
          </div>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="edit-profile.php"><i class="fas fa-user"></i> Edit Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="index.php"><i class="fas fa-address-card"></i> My Applications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../jobs.php"><i class="fas fa-list-ul"></i> Jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="mailbox.php"><i class="fas fa-envelope"></i> Mailbox</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="settings.php"><i class="fas fa-cog"></i> Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title"><i class="fas fa-file-alt me-2"></i>Recent Applications</h2>
            <p class="card-text">Below you will find job roles you have applied for</p>

            <?php
            $sql = "SELECT * FROM job_post INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost WHERE apply_job_post.id_user='$_SESSION[id_user]'";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {     
            ?>
            <div class="attachment-block">
              <h4 class="mb-3">
                <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>" class="text-decoration-none">
                  <?php echo $row['jobtitle']; ?>
                </a>
              </h4>
              <div class="d-flex justify-content-between align-items-center">
                <div><i class="far fa-calendar me-2"></i> <?php echo $row['createdat']; ?></div>
                <?php 
                if($row['status'] == 0) {
                  echo '<div><span class="badge bg-warning">Pending</span></div>';
                } else if ($row['status'] == 1) {
                  echo '<div><span class="badge bg-danger">Rejected</span></div>';
                } else if ($row['status'] == 2) {
                  echo '<div><span class="badge bg-success">Under Review</span></div>';
                }
                ?>
              </div>
            </div>
            <?php
              }
            } else {
              echo '<div class="alert alert-info">You have not applied to any jobs yet.</div>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer mt-auto py-3">
    <div class="container text-center">
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="/SkillBridge" class="text-white">SkillBridge</a>.</strong> All rights reserved.
    </div>
  </footer>

  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script>
    // Auto-dismiss alerts after 8 seconds
    document.addEventListener('DOMContentLoaded', function() {
      setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
          let fadeEffect = setInterval(() => {
            if (!alert.style.opacity) {
              alert.style.opacity = 1;
            }
            if (alert.style.opacity > 0) {
              alert.style.opacity -= 0.1;
            } else {
              clearInterval(fadeEffect);
              alert.remove();
            }
          }, 200);
        });
      }, 8000);
    });
  </script>
</body>
</html>