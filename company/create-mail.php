<?php
//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
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
  <title>SkillBridge | Compose Mail</title>
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
    
    .content-container {
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      padding: 20px;
    }
    
    .box-primary {
      border-top: 3px solid var(--primary-blue);
    }
    
    .main-footer {
      background-color: #000;
      color: white;
      padding: 15px 0;
      margin-top: 20px;
    }
    
    .btn-primary {
      background-color: var(--primary-blue);
      border-color: var(--primary-blue);
    }
    
    .btn-primary:hover {
      background-color: var(--secondary-blue);
      border-color: var(--secondary-blue);
    }
    
    .welcome-box {
      background-color: var(--primary-blue);
      color: white;
      border-radius: 5px;
      padding: 15px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <header class="main-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand sb-navbar-brand" href="/skillbridge/public/index.php">
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
            <h5>Welcome <b><?php echo $_SESSION['name']; ?></b></h5>
          </div>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="edit-company.php"><i class="fas fa-building"></i> My Company</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create-job-post.php"><i class="fas fa-file-alt"></i> Create Job Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="my-job-post.php"><i class="fas fa-list"></i> My Job Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="job-applications.php"><i class="fas fa-users"></i> Applications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="mailbox.php"><i class="fas fa-envelope"></i> Mailbox</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="settings.php"><i class="fas fa-cog"></i> Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="resume-database.php"><i class="fas fa-database"></i> Resumes</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-9">
        <div class="content-container">
          <form action="add-mail.php" method="post">
            <div class="card box-primary">
              <div class="card-header bg-white">
                <h3 class="card-title">Compose New Message</h3>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label class="form-label">Recipient</label>
                  <select name="to" class="form-select">
                    <?php 
                    $sql = "SELECT * FROM apply_job_post INNER JOIN users ON apply_job_post.id_user=users.id_user WHERE apply_job_post.id_company='$_SESSION[id_company]' AND apply_job_post.status='2'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['id_user'].'">'.$row['firstname'].' '.$row['lastname'].'</option>';
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Subject</label>
                  <input class="form-control" name="subject" placeholder="Subject:">
                </div>
                <div class="mb-3">
                  <label class="form-label">Message</label>
                  <textarea class="form-control" id="description" name="description" rows="8" placeholder="Your message..."></textarea>
                </div>
              </div>
              <div class="card-footer bg-white">
                <div class="d-flex justify-content-between">
                  <a href="mailbox.php" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Discard</a>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send Message</button>
                </div>
              </div>
            </div>
          </form>
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
  <!-- TinyMCE -->
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#description',
      height: 300,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
      ],
      toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
      content_style: 'body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; font-size: 14px }'
    });
  </script>
</body>
</html>