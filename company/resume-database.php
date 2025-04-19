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
  <title>SkillBridge | Resume Database</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
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
      padding: 25px;
    }
    
    .database-header {
      color: var(--primary-blue);
      border-bottom: 2px solid var(--accent-orange);
      padding-bottom: 10px;
      margin-bottom: 20px;
    }
    
    .skill-badge {
      background-color: var(--primary-blue);
      color: white;
      margin-right: 5px;
      margin-bottom: 5px;
      display: inline-block;
    }
    
    .main-footer {
      background-color: #000;
      color: white;
      padding: 15px 0;
      margin-top: 20px;
    }
    
    .table th {
      background-color: var(--primary-blue);
      color: white;
    }
    
    .table-hover tbody tr:hover {
      background-color: rgba(0,102,204,0.05);
    }
    
    .download-btn {
      color: var(--primary-blue);
      transition: all 0.3s;
    }
    
    .download-btn:hover {
      color: var(--accent-orange);
      transform: scale(1.2);
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
              <a class="nav-link" href="mailbox.php"><i class="fas fa-envelope"></i> Mailbox</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="settings.php"><i class="fas fa-cog"></i> Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="resume-database.php"><i class="fas fa-database"></i> Resume Database</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-9">
        <div class="content-container">
          <h2 class="database-header"><i class="fas fa-user-graduate me-2"></i>Talent Database</h2>
          <p class="mb-4">Browse and download resumes of candidates who applied to your job posts</p>
          
          <div class="table-responsive">
            <table id="resumeTable" class="table table-hover table-striped">
              <thead>
                <tr>
                  <th>Candidate</th>
                  <th>Highest Qualification</th>
                  <th>Skills</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Resume</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT users.* FROM job_post INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost INNER JOIN users ON users.id_user=apply_job_post.id_user WHERE apply_job_post.id_company='$_SESSION[id_company]' GROUP BY users.id_user";
                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {     
                    $skills = $row['skills'];
                    $skills = explode(',', $skills);
                ?>
                <tr>
                  <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                  <td><?php echo $row['qualification']; ?></td>
                  <td>
                    <?php
                    foreach ($skills as $value) {
                      echo '<span class="badge skill-badge">'.$value.'</span>';
                    }
                    ?>
                  </td>
                  <td><?php echo $row['city']; ?></td>
                  <td><?php echo $row['state']; ?></td>
                  <td class="text-center">
                    <a href="../uploads/resume/<?php echo $row['resume']; ?>" download="<?php echo $row['firstname'].' Resume'; ?>" class="download-btn">
                      <i class="fas fa-file-pdf fa-lg"></i>
                    </a>
                  </td>
                </tr>
                <?php
                  }
                }
                ?>
              </tbody>
            </table>
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

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#resumeTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
          "search": "_INPUT_",
          "searchPlaceholder": "Search candidates...",
          "lengthMenu": "Show _MENU_ candidates per page",
          "zeroRecords": "No matching candidates found",
          "info": "Showing _START_ to _END_ of _TOTAL_ candidates",
          "infoEmpty": "No candidates available",
          "infoFiltered": "(filtered from _MAX_ total candidates)"
        }
      });
    });
  </script>
</body>
</html>