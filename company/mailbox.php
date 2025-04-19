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
  <title>SkillBridge | Mailbox</title>
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
    
    .mail-card {
      border-left: 4px solid var(--skillbridge-light-blue);
      transition: all 0.3s ease;
      margin-bottom: 15px;
    }
    
    .mail-card:hover {
      transform: translateX(5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .mail-unread {
      border-left-color: var(--skillbridge-accent);
      background-color: rgba(255, 126, 51, 0.05);
    }
    
    .mail-important {
      border-left-color: var(--skillbridge-warning);
    }
    
    .mail-date {
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
    
    .btn-skillbridge-accent {
      background-color: var(--skillbridge-accent);
      color: white;
    }
    
    .btn-skillbridge-accent:hover {
      background-color: #ff6a1a;
      color: white;
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
    
    .mail-subject {
      font-weight: 500;
      color: var(--skillbridge-dark);
      text-decoration: none;
    }
    
    .mail-subject:hover {
      color: var(--skillbridge-blue);
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
              <a class="nav-link" href="job-applications.php"><i class="fas fa-users"></i> Applications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="mailbox.php"><i class="fas fa-envelope"></i> Mailbox</a>
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
          <h3><i class="fas fa-comments me-2"></i>Stay Connected</h3>
          <p>Effective communication is key to building strong relationships with candidates and colleagues across Africa.</p>
        </div>
      </div>
      
      <!-- Main Content Area -->
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h2 class="card-title mb-0"><i class="fas fa-envelope text-primary me-2"></i>Mailbox</h2>
              <div>
                <?php
                $sql = "SELECT COUNT(*) AS total FROM mailbox WHERE id_fromuser='$_SESSION[id_company]' OR id_touser='$_SESSION[id_company]'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo '<span class="badge bg-primary rounded-pill">' . $row['total'] . ' Messages</span>';
                ?>
              </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="text-muted mb-0">Manage your communications with candidates and colleagues</p>
              <a href="create-mail.php" class="btn btn-skillbridge-accent">
                <i class="fas fa-plus-circle me-2"></i>New Message
              </a>
            </div>
            
            <div class="table-responsive">
              <table id="mailboxTable" class="table table-hover">
                <thead>
                  <tr>
                    <th>Subject</th>
                    <th>From/To</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT m.*, 
                          u1.firstname AS from_firstname, u1.lastname AS from_lastname,
                          u2.firstname AS to_firstname, u2.lastname AS to_lastname
                          FROM mailbox m
                          LEFT JOIN users u1 ON m.id_fromuser = u1.id_user
                          LEFT JOIN users u2 ON m.id_touser = u2.id_user
                          WHERE m.id_fromuser='$_SESSION[id_company]' OR m.id_touser='$_SESSION[id_company]'
                          ORDER BY m.createdAt DESC";
                  $result = $conn->query($sql);

                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      $isSent = ($row['id_fromuser'] == $_SESSION['id_company']);
                      $name = $isSent ? 
                        "To: " . $row['to_firstname'] . " " . $row['to_lastname'] : 
                        "From: " . $row['from_firstname'] . " " . $row['from_lastname'];
                  ?>
                  <tr class="<?php echo ($row['is_read'] == 0 && !$isSent) ? 'mail-unread' : ''; ?>">
                    <td>
                      <a href="read-mail.php?id_mail=<?php echo $row['id_mailbox']; ?>" class="mail-subject">
                        <?php echo $row['subject']; ?>
                        <?php if($row['is_important']) echo '<i class="fas fa-star text-warning ms-2"></i>'; ?>
                      </a>
                    </td>
                    <td><?php echo $name; ?></td>
                    <td class="mail-date"><?php echo date("M d, Y h:i a", strtotime($row['createdAt'])); ?></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item" href="read-mail.php?id_mail=<?php echo $row['id_mailbox']; ?>"><i class="fas fa-eye me-2"></i>View</a></li>
                          <li><a class="dropdown-item" href="create-mail.php?reply=<?php echo $row['id_mailbox']; ?>"><i class="fas fa-reply me-2"></i>Reply</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item text-danger" href="delete-mail.php?id=<?php echo $row['id_mailbox']; ?>" onclick="return confirm('Are you sure you want to delete this message?')"><i class="fas fa-trash-alt me-2"></i>Delete</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php
                    }
                  } else {
                  ?>
                  <tr>
                    <td colspan="4" class="text-center py-4">
                      <div class="empty-state">
                        <i class="fas fa-envelope-open-text"></i>
                        <h4>No Messages Found</h4>
                        <p class="text-muted">Your mailbox is empty. Start a conversation with candidates or colleagues.</p>
                        <a href="create-mail.php" class="btn btn-skillbridge-accent mt-3">
                          <i class="fas fa-plus-circle me-2"></i>Compose Message
                        </a>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-chart-bar text-primary me-2"></i>Mailbox Statistics</h5>
            <div class="row text-center">
              <?php
              // Get unread messages count
              $sql = "SELECT COUNT(*) AS unread FROM mailbox WHERE id_touser='$_SESSION[id_company]' AND is_read=0";
              $result = $conn->query($sql);
              $unread = $result->fetch_assoc()['unread'];
              
              // Get sent messages count
              $sql = "SELECT COUNT(*) AS sent FROM mailbox WHERE id_fromuser='$_SESSION[id_company]'";
              $result = $conn->query($sql);
              $sent = $result->fetch_assoc()['sent'];
              
              // Get important messages count
              $sql = "SELECT COUNT(*) AS important FROM mailbox WHERE (id_fromuser='$_SESSION[id_company]' OR id_touser='$_SESSION[id_company]') AND is_important=1";
              $result = $conn->query($sql);
              $important = $result->fetch_assoc()['important'];
              ?>
              <div class="col-md-4 mb-3 mb-md-0">
                <div class="border p-3 rounded">
                  <h3 class="text-primary"><?php echo $unread; ?></h3>
                  <p class="mb-0 text-muted">Unread Messages</p>
                </div>
              </div>
              <div class="col-md-4 mb-3 mb-md-0">
                <div class="border p-3 rounded">
                  <h3 class="text-success"><?php echo $sent; ?></h3>
                  <p class="mb-0 text-muted">Sent Messages</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="border p-3 rounded">
                  <h3 class="text-warning"><?php echo $important; ?></h3>
                  <p class="mb-0 text-muted">Important Messages</p>
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
  
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  
  <!-- Custom JS -->
  <script>
    $(document).ready(function() {
      $('#mailboxTable').DataTable({
        "responsive": true,
        "language": {
          "emptyTable": "No messages found",
          "info": "Showing _START_ to _END_ of _TOTAL_ messages",
          "infoEmpty": "Showing 0 to 0 of 0 messages",
          "infoFiltered": "(filtered from _MAX_ total messages)",
          "lengthMenu": "Show _MENU_ messages per page",
          "search": "Search messages:",
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
    });
  </script>
</body>
</html>