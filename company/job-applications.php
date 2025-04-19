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
  <title>SkillBridge | Job Applications</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  
  <!-- Google Fonts - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --skillbridge-blue: #1a3e72;
      --skillbridge-light-blue: #3a6ea5;
      --skillbridge-accent: #ff7e33;
      --skillbridge-light: #f8f9fa;
      --skillbridge-dark: #212529;
      --skillbridge-success: #28a745;
      --skillbridge-warning: #ffc107;
      --skillbridge-danger: #dc3545;
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
    
    .application-card {
      border-left: 4px solid var(--skillbridge-light-blue);
      transition: all 0.3s ease;
      margin-bottom: 15px;
    }
    
    .application-card:hover {
      transform: translateX(5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .status-pending {
      color: var(--skillbridge-warning);
    }
    
    .status-rejected {
      color: var(--skillbridge-danger);
    }
    
    .status-reviewed {
      color: var(--skillbridge-success);
    }
    
    .status-under-review {
      color: var(--skillbridge-light-blue);
    }
    
    .application-date {
      color: #6c757d;
      font-size: 0.9rem;
    }
    
    .btn-skillbridge {
      background-color: var(--skillbridge-blue);
      color: white;
      border-radius: 6px;
      padding: 8px 20px;
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
    
    .empty-state {
      text-align: center;
      padding: 40px 20px;
    }
    
    .empty-state i {
      font-size: 3rem;
      color: var(--skillbridge-light-blue);
      margin-bottom: 20px;
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
              <a class="nav-link" href="create-job-post.php"><i class="fas fa-file-alt"></i> Create Job Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="my-job-post.php"><i class="fas fa-list"></i> My Job Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="job-applications.php"><i class="fas fa-users"></i> Applications</a>
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
          <h3><i class="fas fa-users me-2"></i>Discover Talent</h3>
          <p>Africa's brightest professionals are applying to your jobs. Review applications and find your next team member today.</p>
        </div>
      </div>
      
      <!-- Main Content Area -->
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h2 class="card-title mb-0"><i class="fas fa-users text-primary me-2"></i>Job Applications</h2>
              <div>
                <?php
                $sql = "SELECT COUNT(*) AS total FROM apply_job_post WHERE id_company='$_SESSION[id_company]'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo '<span class="badge bg-primary rounded-pill">' . $row['total'] . ' Applications</span>';
                ?>
              </div>
            </div>
            
            <p class="text-muted">Review and manage all applications for your job posts. Click on any application to view details.</p>
            
            <div class="row mt-4">
              <div class="col-md-12">
                <?php
                $sql = "SELECT job_post.jobtitle, users.firstname, users.lastname, users.id_user, 
                        apply_job_post.id_jobpost, apply_job_post.createdat, apply_job_post.status 
                        FROM job_post 
                        INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost  
                        INNER JOIN users ON users.id_user=apply_job_post.id_user 
                        WHERE apply_job_post.id_company='$_SESSION[id_company]'
                        ORDER BY apply_job_post.createdat DESC";
                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    $statusClass = '';
                    $statusText = '';
                    
                    switch($row['status']) {
                      case 0:
                        $statusClass = 'status-pending';
                        $statusText = 'Pending';
                        break;
                      case 1:
                        $statusClass = 'status-rejected';
                        $statusText = 'Rejected';
                        break;
                      case 2:
                        $statusClass = 'status-under-review';
                        $statusText = 'Under Review';
                        break;
                      case 3:
                        $statusClass = 'status-reviewed';
                        $statusText = 'Reviewed';
                        break;
                    }
                ?>
                <div class="card application-card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                      <div>
                        <h5 class="card-title mb-1">
                          <a href="user-application.php?id=<?php echo $row['id_user']; ?>&id_jobpost=<?php echo $row['id_jobpost']; ?>" class="text-decoration-none">
                            <?php echo $row['jobtitle']; ?> <small class="text-muted">- <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></small>
                          </a>
                        </h5>
                        <div class="application-date mb-2">
                          <i class="far fa-calendar-alt me-1"></i> Applied on <?php echo date("M d, Y", strtotime($row['createdat'])); ?>
                        </div>
                      </div>
                      <div>
                        <span class="badge rounded-pill <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                      <a href="user-application.php?id=<?php echo $row['id_user']; ?>&id_jobpost=<?php echo $row['id_jobpost']; ?>" class="btn btn-sm btn-skillbridge">
                        <i class="fas fa-eye me-1"></i> View Application
                      </a>
                      <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item" href="mailbox.php"><i class="fas fa-envelope me-2"></i>Send Message</a></li>
                          <li><a class="dropdown-item" href="../uploads/resume/<?php echo $row['id_user']; ?>.pdf" target="_blank"><i class="fas fa-file-pdf me-2"></i>View Resume</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash-alt me-2"></i>Delete Application</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                  }
                } else {
                ?>
                <div class="empty-state">
                  <i class="fas fa-user-tie"></i>
                  <h4>No Applications Yet</h4>
                  <p class="text-muted">You haven't received any applications yet. Promote your job posts to attract more candidates.</p>
                  <a href="my-job-post.php" class="btn btn-skillbridge mt-3">
                    <i class="fas fa-bullhorn me-2"></i>View Job Posts
                  </a>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Application Stats -->
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-chart-pie text-primary me-2"></i>Application Statistics</h5>
            <div class="row text-center">
              <?php
              // Get pending applications count
              $sql = "SELECT COUNT(*) AS pending FROM apply_job_post WHERE id_company='$_SESSION[id_company]' AND status=0";
              $result = $conn->query($sql);
              $pending = $result->fetch_assoc()['pending'];
              
              // Get under review applications count
              $sql = "SELECT COUNT(*) AS under_review FROM apply_job_post WHERE id_company='$_SESSION[id_company]' AND status=2";
              $result = $conn->query($sql);
              $under_review = $result->fetch_assoc()['under_review'];
              
              // Get rejected applications count
              $sql = "SELECT COUNT(*) AS rejected FROM apply_job_post WHERE id_company='$_SESSION[id_company]' AND status=1";
              $result = $conn->query($sql);
              $rejected = $result->fetch_assoc()['rejected'];
              ?>
              <div class="col-md-4 mb-3 mb-md-0">
                <div class="border p-3 rounded">
                  <h3 class="text-warning"><?php echo $pending; ?></h3>
                  <p class="mb-0 text-muted">Pending Review</p>
                </div>
              </div>
              <div class="col-md-4 mb-3 mb-md-0">
                <div class="border p-3 rounded">
                  <h3 class="text-primary"><?php echo $under_review; ?></h3>
                  <p class="mb-0 text-muted">Under Review</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="border p-3 rounded">
                  <h3 class="text-danger"><?php echo $rejected; ?></h3>
                  <p class="mb-0 text-muted">Rejected</p>
                </div>
              </div>
            </div>
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

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom JS -->
  <script>
    $(document).ready(function() {
      // Add hover effect to application cards
      $('.application-card').hover(
        function() {
          $(this).css('cursor', 'pointer');
        },
        function() {
          $(this).css('cursor', 'auto');
        }
      );
    });
  </script>
</body>
</html>