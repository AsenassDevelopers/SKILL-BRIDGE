<?php
// To Handle Session Variables on This Page
session_start();

// If user Not logged in then redirect them back to homepage. 
if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

// Including Database Connection From db.php file to avoid rewriting in all files  
require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SkillBridge | My Job Posts</title>
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
    
    .table-responsive {
      border-radius: 8px;
      overflow: hidden;
    }
    
    .table {
      margin-bottom: 0;
    }
    
    .table thead {
      background-color: var(--skillbridge-blue);
      color: white;
    }
    
    .table th {
      padding: 15px;
      font-weight: 500;
    }
    
    .table td {
      padding: 12px 15px;
      vertical-align: middle;
    }
    
    .table-hover tbody tr:hover {
      background-color: rgba(26, 62, 114, 0.05);
    }
    
    .action-btn {
      color: var(--skillbridge-blue);
      transition: all 0.3s ease;
      font-size: 1.1rem;
    }
    
    .action-btn:hover {
      color: var(--skillbridge-light-blue);
      transform: scale(1.1);
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
    
    .job-count-badge {
      background-color: var(--skillbridge-accent);
      color: white;
      font-weight: 600;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 0.9rem;
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
              <a class="nav-link active" href="my-job-post.php"><i class="fas fa-list"></i> My Job Posts</a>
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
          <h3><i class="fas fa-chart-line me-2"></i>Track Your Success</h3>
          <p>Monitor your job posts and connect with Africa's top talent. Our platform helps you find the perfect candidates for your open positions.</p>
        </div>
      </div>
      
      <!-- Main Content Area -->
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h2 class="card-title mb-0"><i class="fas fa-list text-primary me-2"></i>My Job Posts</h2>
              <?php
                $sql = "SELECT COUNT(*) AS total FROM job_post WHERE id_company='$_SESSION[id_company]'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo '<span class="job-count-badge">' . $row['total'] . ' Active Posts</span>';
              ?>
            </div>
            
            <p class="text-muted">In this section you can view all job posts created by you. Click on any job to view details and applications.</p>
            
            <div class="table-responsive mt-4">
              <table id="jobPostsTable" class="table table-hover">
                <thead>
                  <tr>
                    <th>Job Title</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM job_post WHERE id_company='$_SESSION[id_company]' ORDER BY createdat DESC";
                  $result = $conn->query($sql);

                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      $statusClass = ($row['active'] == 1) ? 'text-success' : 'text-secondary';
                      $statusText = ($row['active'] == 1) ? 'Active' : 'Inactive';
                  ?>
                  <tr>
                    <td><?php echo $row['jobtitle']; ?></td>
                    <td><?php echo date("M d, Y", strtotime($row['createdat'])); ?></td>
                    <td><span class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></span></td>
                    <td>
                      <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>" class="action-btn me-3" title="View Details">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a href="edit-job-post.php?id=<?php echo $row['id_jobpost']; ?>" class="action-btn me-3" title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="delete-job-post.php?id=<?php echo $row['id_jobpost']; ?>" class="action-btn text-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this job post?')">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                  <?php
                    }
                  } else {
                  ?>
                  <tr>
                    <td colspan="4" class="text-center py-4">
                      <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                      <h5>No Job Posts Found</h5>
                      <p class="text-muted">You haven't created any job posts yet. Get started by creating your first job post.</p>
                      <a href="create-job-post.php" class="btn btn-skillbridge">
                        <i class="fas fa-plus-circle me-2"></i>Create Job Post
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <!-- Stats Card -->
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-chart-pie text-primary me-2"></i>Job Post Statistics</h5>
            <div class="row text-center">
              <?php
              // Get active job count
              $sql = "SELECT COUNT(*) AS active FROM job_post WHERE id_company='$_SESSION[id_company]' AND active=1";
              $result = $conn->query($sql);
              $active = $result->fetch_assoc()['active'];
              
              // Get inactive job count
              $sql = "SELECT COUNT(*) AS inactive FROM job_post WHERE id_company='$_SESSION[id_company]' AND active=0";
              $result = $conn->query($sql);
              $inactive = $result->fetch_assoc()['inactive'];
              
              // Get total applications
              $sql = "SELECT COUNT(*) AS applications FROM job_post INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost WHERE job_post.id_company='$_SESSION[id_company]'";
              $result = $conn->query($sql);
              $applications = $result->fetch_assoc()['applications'];
              ?>
              <div class="col-md-4 mb-3 mb-md-0">
                <div class="border p-3 rounded">
                  <h3 class="text-primary"><?php echo $active; ?></h3>
                  <p class="mb-0 text-muted">Active Jobs</p>
                </div>
              </div>
              <div class="col-md-4 mb-3 mb-md-0">
                <div class="border p-3 rounded">
                  <h3 class="text-secondary"><?php echo $inactive; ?></h3>
                  <p class="mb-0 text-muted">Inactive Jobs</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="border p-3 rounded">
                  <h3 class="text-success"><?php echo $applications; ?></h3>
                  <p class="mb-0 text-muted">Total Applications</p>
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
          <p class="mb-0">Empowering African talent with global opportunities</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  
  <!-- Custom JS -->
  <script>
    $(document).ready(function() {
      $('#jobPostsTable').DataTable({
        "responsive": true,
        "language": {
          "emptyTable": "No job posts available",
          "info": "Showing _START_ to _END_ of _TOTAL_ jobs",
          "infoEmpty": "Showing 0 to 0 of 0 jobs",
          "infoFiltered": "(filtered from _MAX_ total jobs)",
          "lengthMenu": "Show _MENU_ jobs per page",
          "search": "Search jobs:",
          "paginate": {
            "first": "First",
            "last": "Last",
            "next": "Next",
            "previous": "Previous"
          }
        },
        "columnDefs": [
          { "orderable": false, "targets": [3] }
        ]
      });
      
      // Add hover effect to table rows
      $('table tbody tr').hover(
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