<?php
// To Handle Session Variables on This Page
session_start();

// If user Not logged in then redirect them back to homepage. 
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SkillBridge | Create Job Post</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- TinyMCE -->
  <script src="../js/tinymce/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'#description', height: 300 });</script>
  
  <style>
    :root {
      --skillbridge-blue: #1a3e72;
      --skillbridge-light-blue: #3a6ea5;
      --skillbridge-accent: #ff7e33;
      --skillbridge-light: #f8f9fa;
      --skillbridge-dark: #212529;
      --skillbridge-success: #28a745;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f5f7fa;
    }
    
    .gradient-header {
      background: linear-gradient(135deg, var(--skillbridge-blue), var(--skillbridge-light-blue));
      color: white;
    }
    
    .sidebar {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .sidebar .nav-link {
      color: var(--skillbridge-dark);
      border-radius: 4px;
      margin-bottom: 5px;
      font-weight: 500;
    }
    
    .sidebar .nav-link:hover, .sidebar .nav-link.active {
      background-color: rgba(26, 62, 114, 0.1);
      color: var(--skillbridge-blue);
    }
    
    .sidebar .nav-link i {
      margin-right: 10px;
      color: var(--skillbridge-light-blue);
    }
    
    .card {
      border: none;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }
    
    .form-control, .form-select {
      border-radius: 6px;
      padding: 10px 15px;
      border: 1px solid #ced4da;
    }
    
    .form-control:focus, .form-select:focus {
      border-color: var(--skillbridge-light-blue);
      box-shadow: 0 0 0 0.25rem rgba(26, 62, 114, 0.25);
    }
    
    .btn-skillbridge {
      background-color: var(--skillbridge-blue);
      color: white;
      border-radius: 6px;
      padding: 10px 25px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-skillbridge:hover {
      background-color: var(--skillbridge-light-blue);
      color: white;
      transform: translateY(-2px);
    }
    
    .motivation-card {
      background: linear-gradient(135deg, rgba(26, 62, 114, 0.9), rgba(58, 110, 165, 0.9));
      color: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 30px;
    }
    
    .motivation-card h3 {
      font-weight: 600;
    }
    
    .motivation-card p {
      opacity: 0.9;
    }
    
    .footer {
      background-color: var(--skillbridge-dark);
      color: white;
      padding: 20px 0;
    }
    
    .company-name {
      font-weight: 600;
      color: var(--skillbridge-blue);
    }
    
    .welcome-box {
      background-color: white;
      border-radius: 8px;
      padding: 15px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .welcome-box h3 {
      color: var(--skillbridge-blue);
      font-weight: 600;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="gradient-header py-3">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <a href="index.php" class="text-decoration-none">
          <h1 class="h3 mb-0 text-white">
            <i class="fas fa-handshake me-2"></i>SkillBridge
          </h1>
        </a>
        <div class="d-flex align-items-center">
          <span class="text-white me-3 d-none d-sm-inline">Welcome, <?php echo $_SESSION['name']; ?></span>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container my-4">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-lg-3 mb-4">
        <div class="sidebar p-3">
          <div class="welcome-box mb-4">
            <h3 class="h5"><?php echo $_SESSION['name']; ?></h3>
            <p class="mb-0 text-muted small">Company Dashboard</p>
          </div>
          
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="edit-company.php"><i class="fas fa-building"></i> My Company</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="create-job-post.php"><i class="fas fa-file-alt"></i> Create Job Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="my-job-post.php"><i class="fas fa-list"></i> My Job Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="job-applications.php"><i class="fas fa-users"></i> Applications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="mailbox.php"><i class="fas fa-envelope"></i> Mailbox</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="settings.php"><i class="fas fa-cog"></i> Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="resume-database.php"><i class="fas fa-database"></i> Resume Database</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link text-danger" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
          </ul>
        </div>
        
        <!-- Motivation Card -->
        <div class="motivation-card mt-4">
          <h3><i class="fas fa-bullhorn me-2"></i>Find Top Talent</h3>
          <p>Africa's brightest minds are ready to join your team. Post your opportunity today and connect with skilled professionals across the continent.</p>
        </div>
      </div>
      
      <!-- Main Content Area -->
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title mb-4"><i class="fas fa-file-alt text-primary me-2"></i>Create Job Post</h2>
            
            <form method="post" action="addpost.php">
              <div class="row g-3">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="jobtitle" name="jobtitle" placeholder="Job Title" required>
                    <label for="jobtitle">Job Title</label>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <label for="description" class="form-label">Job Description</label>
                  <textarea class="form-control" id="description" name="description" rows="6" placeholder="Detailed job description, responsibilities, and requirements" required></textarea>
                </div>
                
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="number" class="form-control" id="minimumsalary" name="minimumsalary" min="1000" placeholder="Minimum Salary" required>
                    <label for="minimumsalary">Minimum Salary ($)</label>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="number" class="form-control" id="maximumsalary" name="maximumsalary" placeholder="Maximum Salary" required>
                    <label for="maximumsalary">Maximum Salary ($)</label>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="number" class="form-control" id="experience" name="experience" placeholder="Experience Required" required>
                    <label for="experience">Experience Required (Years)</label>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification Required" required>
                    <label for="qualification">Qualification Required</label>
                  </div>
                </div>
                
                <div class="col-12 mt-3">
                  <button type="submit" class="btn btn-skillbridge">
                    <i class="fas fa-plus-circle me-2"></i>Create Job Post
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        
        <!-- Additional Info Card -->
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-lightbulb text-warning me-2"></i>Why Post on SkillBridge?</h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item border-0"><i class="fas fa-check-circle text-success me-2"></i> Access to Africa's top talent pool</li>
              <li class="list-group-item border-0"><i class="fas fa-check-circle text-success me-2"></i> Competitive hiring process</li>
              <li class="list-group-item border-0"><i class="fas fa-check-circle text-success me-2"></i> Diverse and skilled professionals</li>
              <li class="list-group-item border-0"><i class="fas fa-check-circle text-success me-2"></i> Simple and effective recruitment tools</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center text-md-start">
          <p class="mb-0">&copy; <?php echo date("Y"); ?> <span class="company-name">SkillBridge</span>. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <p class="mb-0">Connecting African talent with global opportunities</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom JS -->
  <script>
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
      const minSalary = document.getElementById('minimumsalary').value;
      const maxSalary = document.getElementById('maximumsalary').value;
      
      if (parseInt(minSalary) > parseInt(maxSalary)) {
        alert('Maximum salary must be greater than minimum salary');
        e.preventDefault();
      }
    });
    
    // Input formatting
    document.querySelectorAll('.form-control').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
      });
      
      input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
      });
    });
  </script>
</body>
</html>