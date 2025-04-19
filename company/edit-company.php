<?php
session_start();

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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Company Profile | SkillBridge</title>
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #1a73e8;
      --primary-dark: #0d47a1;
      --accent-color: #ff6b00;
      --text-color: #333;
      --light-bg: #f8f9fa;
      --dark-bg: #212529;
      --white: #ffffff;
      --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s ease;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      color: var(--text-color);
      background-color: var(--light-bg);
      line-height: 1.6;
    }
    
    .sb-navbar {
      background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .sb-navbar-brand {
      font-weight: 700;
      font-size: 1.8rem;
      letter-spacing: -0.5px;
      display: flex;
      align-items: center;
      color: var(--white);
      text-decoration: none;
    }
    
    .sb-navbar-brand span {
      color: var(--accent-color);
    }
    
    .sb-navbar-brand:hover {
      color: var(--white);
    }
    
    .company-dashboard {
      padding-top: 30px;
      min-height: calc(100vh - 120px);
    }
    
    .sidebar {
      position: sticky;
      top: 20px;
    }
    
    .sidebar-card {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      overflow: hidden;
      margin-bottom: 20px;
    }
    
    .sidebar-header {
      background: var(--primary-color);
      color: var(--white);
      padding: 15px;
      font-weight: 600;
    }
    
    .sidebar-body {
      padding: 0;
    }
    
    .sidebar-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .sidebar-menu li {
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .sidebar-menu li:last-child {
      border-bottom: none;
    }
    
    .sidebar-menu a {
      display: block;
      padding: 12px 15px;
      color: var(--text-color);
      text-decoration: none;
      transition: var(--transition);
    }
    
    .sidebar-menu a:hover {
      background-color: rgba(0, 0, 0, 0.03);
      color: var(--primary-color);
      padding-left: 20px;
    }
    
    .sidebar-menu i {
      width: 20px;
      margin-right: 10px;
      color: var(--accent-color);
    }
    
    .sidebar-menu .active a {
      background-color: rgba(26, 115, 232, 0.1);
      color: var(--primary-color);
      font-weight: 500;
      border-left: 3px solid var(--accent-color);
    }
    
    .profile-container {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      padding: 30px;
      margin-bottom: 30px;
    }
    
    .profile-title {
      color: var(--primary-dark);
      font-weight: 600;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .profile-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 3px;
      background: var(--accent-color);
    }
    
    .form-label {
      font-weight: 500;
      color: var(--primary-dark);
      margin-bottom: 8px;
    }
    
    .form-control {
      padding: 12px 15px;
      border-radius: 4px;
      border: 1px solid #ddd;
      transition: var(--transition);
      margin-bottom: 20px;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(26, 115, 232, 0.25);
    }
    
    .btn-update {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      padding: 12px 30px;
      font-weight: 500;
      transition: var(--transition);
    }
    
    .btn-update:hover {
      background-color: var(--primary-dark);
      border-color: var(--primary-dark);
      transform: translateY(-2px);
    }
    
    .file-upload {
      position: relative;
      overflow: hidden;
      margin-bottom: 20px;
    }
    
    .file-upload-input {
      position: absolute;
      font-size: 100px;
      opacity: 0;
      right: 0;
      top: 0;
    }
    
    .file-upload-label {
      display: block;
      padding: 12px;
      background: rgba(26, 115, 232, 0.1);
      border: 1px dashed var(--primary-color);
      border-radius: 4px;
      text-align: center;
      cursor: pointer;
      transition: var(--transition);
    }
    
    .file-upload-label:hover {
      background: rgba(26, 115, 232, 0.2);
    }
    
    .file-upload-icon {
      color: var(--primary-color);
      font-size: 1.5rem;
      margin-bottom: 10px;
    }
    
    .file-upload-text {
      color: var(--primary-dark);
      font-weight: 500;
    }
    
    .file-upload-hint {
      font-size: 0.8rem;
      color: #dc3545;
    }
    
    .logo-preview {
      max-width: 200px;
      max-height: 200px;
      border-radius: 4px;
      border: 1px solid #ddd;
      padding: 5px;
      margin-top: 10px;
    }
    
    .main-footer {
      background: var(--dark-bg);
      color: var(--white);
      padding: 30px 0;
      margin-top: 60px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .sidebar {
        position: static;
        margin-bottom: 30px;
      }
      
      .profile-container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-expand-lg sb-navbar">
      <div class="container">
        <a class="navbar-brand sb-navbar-brand" href="index.php">
          Skill<span>Bridge</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Dashboard Content -->
  <div class="company-dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="sidebar-card">
            <div class="sidebar-header">
              Welcome <b><?php echo htmlspecialchars($_SESSION['name']); ?></b>
            </div>
            <div class="sidebar-body">
              <ul class="sidebar-menu">
                <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="active"><a href="edit-company.php"><i class="fas fa-building"></i> My Company</a></li>
                <li><a href="create-job-post.php"><i class="fas fa-file-alt"></i> Create Job Post</a></li>
                <li><a href="my-job-post.php"><i class="fas fa-list-ul"></i> My Job Posts</a></li>
                <li><a href="job-applications.php"><i class="fas fa-users"></i> Job Applications</a></li>
                <li><a href="mailbox.php"><i class="fas fa-envelope"></i> Mailbox</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="resume-database.php"><i class="fas fa-database"></i> Resume Database</a></li>
              </ul>
            </div>
          </div>
        </div>
        
        <div class="col-md-9">
          <div class="profile-container">
            <h3 class="profile-title">Company Profile</h3>
            <p class="mb-4">Update your company information to attract Africa's top talent</p>
            
            <?php if(isset($_SESSION['uploadError'])) { ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['uploadError']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php unset($_SESSION['uploadError']); } ?>
            
            <form action="update-company.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <?php
                $sql = "SELECT * FROM company WHERE id_company='$_SESSION[id_company]'";
                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="companyname" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo htmlspecialchars($row['companyname']); ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" class="form-control" id="website" name="website" value="<?php echo htmlspecialchars($row['website']); ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($row['email']); ?>" readonly>
                  </div>
                  
                  <div class="form-group">
                    <label for="aboutme" class="form-label">About Your Company</label>
                    <textarea class="form-control" id="aboutme" name="aboutme" rows="4"><?php echo htmlspecialchars($row['aboutme']); ?></textarea>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="contactno" class="form-label">Contact Number</label>
                    <input type="tel" class="form-control" id="contactno" name="contactno" value="<?php echo htmlspecialchars($row['contactno']); ?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($row['city']); ?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="state" class="form-label">State/Region</label>
                    <input type="text" class="form-control" id="state" name="state" value="<?php echo htmlspecialchars($row['state']); ?>">
                  </div>
                  
                  <div class="form-group">
                    <label class="form-label">Company Logo</label>
                    <div class="file-upload">
                      <input type="file" name="image" id="image" class="file-upload-input" accept="image/*">
                      <label for="image" class="file-upload-label">
                        <i class="fas fa-image file-upload-icon"></i>
                        <div class="file-upload-text">Change company logo</div>
                        <div class="file-upload-hint">Recommended size: 300x300px</div>
                      </label>
                    </div>
                    <?php if($row['logo'] != "") { ?>
                      <img src="../uploads/logo/<?php echo htmlspecialchars($row['logo']); ?>" class="logo-preview img-fluid">
                    <?php } ?>
                  </div>
                </div>
                <?php
                  }
                }
                ?>
              </div>
              
              <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary btn-update">
                  <i class="fas fa-save me-2"></i> Update Profile
                </button>
              </div>
            </form>
            
            <div class="motivational-quote mt-5 p-4 bg-light rounded">
              <p class="quote-text mb-2"><i class="fas fa-quote-left text-primary me-2"></i> A strong company profile attracts Africa's brightest talent. Showcase your organization's mission and values to connect with professionals who share your vision.</p>
              <p class="quote-author text-end mb-0">- SkillBridge Team</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container text-center">
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="../index.php">SkillBridge</a>.</strong> All rights reserved.
    </div>
  </footer>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // File upload display
  $('#image').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    if(fileName) {
      $('.file-upload-text').text(fileName);
      
      // Preview the selected image
      if (this.files && this.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('.logo-preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(this.files[0]);
      }
    }
  });
</script>
</body>
</html>