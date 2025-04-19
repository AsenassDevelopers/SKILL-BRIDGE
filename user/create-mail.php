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
  <title>SkillBridge | Compose Message</title>
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
    
    .compose-card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      padding: 30px;
    }
    
    .form-control, .form-select {
      border-radius: 8px;
      padding: 12px 15px;
      border: 1px solid #e0e0e0;
      transition: var(--transition);
    }
    
    .form-control:focus, .form-select:focus {
      border-color: var(--primary-blue);
      box-shadow: 0 0 0 0.25rem rgba(26, 111, 201, 0.25);
    }
    
    .btn-primary {
      background-color: var(--primary-blue);
      border-color: var(--primary-blue);
      padding: 10px 25px;
      border-radius: 8px;
      font-weight: 500;
      transition: var(--transition);
    }
    
    .btn-primary:hover {
      background-color: var(--dark-blue);
      border-color: var(--dark-blue);
      transform: translateY(-2px);
    }
    
    .btn-outline-secondary {
      border-radius: 8px;
      padding: 10px 25px;
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
    
    h2 {
      color: var(--primary-blue);
      font-weight: 600;
      margin-bottom: 20px;
    }
    
    label {
      font-weight: 500;
      margin-bottom: 8px;
    }
    
    .tox-tinymce {
      border-radius: 8px !important;
      border: 1px solid #e0e0e0 !important;
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
              <a class="nav-link" href="edit-profile.php"><i class="fas fa-user-edit"></i> Edit Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php"><i class="fas fa-address-card"></i> My Applications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../jobs.php"><i class="fas fa-list-ul"></i> Jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="mailbox.php"><i class="fas fa-envelope"></i> Mailbox</a>
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
        <div class="compose-card">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"><i class="fas fa-pen-square me-2"></i>Compose Message</h2>
          </div>
          
          <form action="add-mail.php" method="post">
            <div class="mb-4">
              <label for="recipient" class="form-label">To</label>
              <select name="to" id="recipient" class="form-select">
                <?php 
                $sql = "SELECT * FROM apply_job_post INNER JOIN company ON apply_job_post.id_company=company.id_company WHERE apply_job_post.id_user='$_SESSION[id_user]' AND apply_job_post.status='2'";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row['id_company'].'">'.$row['companyname'].'</option>';
                  }
                }
                ?>
              </select>
            </div>
            
            <div class="mb-4">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
            </div>
            
            <div class="mb-4">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
            </div>
            
            <div class="d-flex justify-content-between">
              <a href="mailbox.php" class="btn btn-outline-secondary">
                <i class="fas fa-times me-2"></i>Discard
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane me-2"></i>Send Message
              </button>
            </div>
          </form>
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
  <!-- TinyMCE -->
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    // Initialize TinyMCE
    tinymce.init({
      selector: '#description',
      plugins: 'link lists help',
      toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link',
      menubar: false,
      statusbar: false,
      height: 300,
      skin: 'oxide',
      content_css: 'default',
      branding: false
    });
    
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