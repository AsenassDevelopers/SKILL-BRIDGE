<?php 
session_start();

if(isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) { 
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Join SkillBridge - Candidate Registration</title>
  
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
    
    .nav-link {
      color: rgba(255, 255, 255, 0.85);
      font-weight: 500;
      padding: 0.5rem 1rem;
      transition: var(--transition);
    }
    
    .nav-link:hover, .nav-link:focus {
      color: var(--white);
      transform: translateY(-2px);
    }
    
    .registration-hero {
      background: linear-gradient(135deg, 
        rgba(26, 115, 232, 0.85) 0%, 
        rgba(13, 71, 161, 0.9) 100%),
        url('img/africa-tech.jpg') center/cover no-repeat;
      color: var(--white);
      padding: 60px 0;
      text-align: center;
      margin-bottom: 40px;
    }
    
    .registration-hero h1 {
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 15px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .registration-hero p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto;
      opacity: 0.9;
    }
    
    .registration-container {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      padding: 40px;
      margin-bottom: 40px;
    }
    
    .registration-title {
      font-weight: 600;
      color: var(--primary-dark);
      margin-bottom: 30px;
      text-align: center;
      position: relative;
    }
    
    .registration-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
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
    
    .btn-register {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      padding: 12px 30px;
      font-weight: 500;
      transition: var(--transition);
      width: 100%;
    }
    
    .btn-register:hover {
      background-color: var(--primary-dark);
      border-color: var(--primary-dark);
      transform: translateY(-2px);
    }
    
    .password-error {
      color: #dc3545;
      font-size: 0.9rem;
      margin-top: -15px;
      margin-bottom: 15px;
      display: none;
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
    
    .terms-check {
      margin: 20px 0;
    }
    
    .terms-check label {
      margin-left: 8px;
    }
    
    .motivational-quote {
      background: rgba(26, 115, 232, 0.1);
      padding: 20px;
      border-radius: 8px;
      margin: 30px 0;
      text-align: center;
      border-left: 4px solid var(--accent-color);
    }
    
    .quote-text {
      font-size: 1.1rem;
      font-style: italic;
      margin-bottom: 10px;
      color: var(--primary-dark);
    }
    
    .quote-author {
      font-weight: 600;
      color: var(--accent-color);
    }
    
    .main-footer {
      background: var(--dark-bg);
      color: var(--white);
      padding: 30px 0;
      margin-top: 60px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .registration-hero h1 {
        font-size: 2rem;
      }
      
      .registration-hero p {
        font-size: 1rem;
      }
      
      .registration-container {
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
              <a class="nav-link" href="jobs.php"><i class="fas fa-briefcase me-1"></i> Jobs</a>
            </li>
            <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="sign-up.php"><i class="fas fa-user-plus me-1"></i> Sign Up</a>
            </li>  
            <?php } else { 
              if(isset($_SESSION['id_user'])) { 
            ?>        
            <li class="nav-item">
              <a class="nav-link" href="user/index.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
            </li>
            <?php
            } else if(isset($_SESSION['id_company'])) { 
            ?>        
            <li class="nav-item">
              <a class="nav-link" href="company/index.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
            </li>
            <?php } ?>          
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="registration-hero">
    <div class="container">
      <h1>Join Africa's Rising Talent Pool</h1>
      <p>Create your profile and get discovered by top employers across the continent</p>
    </div>
  </section>

  <!-- Registration Form -->
  <section class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="registration-container">
          <h2 class="registration-title">Candidate Registration</h2>
          
          <div class="motivational-quote">
            <p class="quote-text">"Africa's youth are the continent's greatest asset. Your skills and talents will shape the future of work in Africa and beyond."</p>
            <p class="quote-author">- SkillBridge Team</p>
          </div>
          
          <form method="post" id="registerCandidates" action="adduser.php" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter your first name" required>
                </div>
                
                <div class="form-group">
                  <label for="lname" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter your last name" required>
                </div>
                
                <div class="form-group">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                  <?php if(isset($_SESSION['registerError'])) { ?>
                    <div class="text-danger small mt-1">Email already exists! Please use a different email.</div>
                  <?php unset($_SESSION['registerError']); } ?>
                </div>
                
                <div class="form-group">
                  <label for="aboutme" class="form-label">About You</label>
                  <textarea class="form-control" rows="4" id="aboutme" name="aboutme" placeholder="Brief introduction about yourself" required></textarea>
                </div>
                
                <div class="form-group">
                  <label for="dob" class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" id="dob" name="dob" min="1960-01-01" max="2005-12-31" required>
                </div>
                
                <div class="form-group">
                  <label for="age" class="form-label">Age</label>
                  <input type="text" class="form-control" id="age" name="age" readonly>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                </div>
                
                <div class="form-group">
                  <label for="cpassword" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm your password" required>
                  <div id="passwordError" class="password-error">Passwords do not match!</div>
                </div>
                
                <div class="form-group">
                  <label for="contactno" class="form-label">Phone Number</label>
                  <input type="text" class="form-control" id="contactno" name="contactno" minlength="10" maxlength="10" onkeypress="return validatePhone(event);" placeholder="Enter phone number" required>
                </div>
                
                <div class="form-group">
                  <label for="address" class="form-label">Address</label>
                  <textarea class="form-control" rows="2" id="address" name="address" placeholder="Enter your address"></textarea>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="city" class="form-label">City</label>
                      <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="state" class="form-label">State/Region</label>
                      <input type="text" class="form-control" id="state" name="state" placeholder="Enter your state">
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="skills" class="form-label">Your Skills</label>
                  <textarea class="form-control" rows="2" id="skills" name="skills" placeholder="List your skills (separated by commas)"></textarea>
                </div>
                
                <div class="form-group">
                  <label class="form-label">Upload Your Resume (PDF only)</label>
                  <div class="file-upload">
                    <input type="file" name="resume" id="resume" class="file-upload-input" accept=".pdf" required>
                    <label for="resume" class="file-upload-label">
                      <i class="fas fa-file-pdf file-upload-icon"></i>
                      <div class="file-upload-text">Choose your resume file</div>
                      <div class="file-upload-hint">Maximum file size: 5MB</div>
                    </label>
                  </div>
                  <?php if(isset($_SESSION['uploadError'])) { ?>
                    <div class="text-danger small"><?php echo $_SESSION['uploadError']; ?></div>
                  <?php unset($_SESSION['uploadError']); } ?>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="qualification" class="form-label">Highest Qualification</label>
                  <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Enter your highest qualification">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="stream" class="form-label">Field of Study</label>
                  <input type="text" class="form-control" id="stream" name="stream" placeholder="Enter your field of study">
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="passingyear" class="form-label">Year of Graduation</label>
              <input type="date" class="form-control" id="passingyear" name="passingyear">
            </div>
            
            <div class="form-group">
              <label for="designation" class="form-label">Current/Most Recent Job Title</label>
              <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter your job title">
            </div>
            
            <div class="terms-check form-group form-check">
              <input type="checkbox" class="form-check-input" id="terms" required>
              <label class="form-check-label" for="terms">I accept the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">terms and conditions</a></label>
            </div>
            
            <div class="form-group mt-4">
              <button type="submit" class="btn btn-primary btn-register">
                <i class="fas fa-user-plus me-2"></i> Complete Registration
              </button>
            </div>
            
            <div class="text-center mt-3">
              <p>Already have an account? <a href="login.php">Sign in here</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Terms Modal -->
  <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6>1. Account Registration</h6>
          <p>You must provide accurate and complete information when creating an account on SkillBridge. You are responsible for maintaining the confidentiality of your account credentials.</p>
          
          <h6>2. Profile Information</h6>
          <p>All profile information must be truthful and not misleading. SkillBridge reserves the right to verify any information provided and suspend accounts with false information.</p>
          
          <h6>3. Privacy Policy</h6>
          <p>Your personal information will be handled in accordance with our Privacy Policy. By registering, you consent to our collection and use of your data as described therein.</p>
          
          <h6>4. Job Applications</h6>
          <p>When applying for jobs through SkillBridge, you understand that employers may contact you directly and that SkillBridge is not responsible for the hiring decisions or practices of any employer.</p>
          
          <h6>5. Acceptable Use</h6>
          <p>You agree not to use SkillBridge for any unlawful purpose or in any way that might harm, damage, or disparage the platform or other users.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container text-center">
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="index.php">SkillBridge</a>.</strong> All rights reserved.
    </div>
  </footer>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Calculate age from date of birth
  $('#dob').on('change', function() {
    var today = new Date();
    var birthDate = new Date($(this).val());
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    
    if(m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    
    $('#age').val(age);
  });

  // Phone number validation
  function validatePhone(event) {
    var key = window.event ? event.keyCode : event.which;
    if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
      return true;
    } else if( key < 48 || key > 57 ) {
      return false;
    } else return true;
  }

  // Password match validation
  $('#registerCandidates').on('submit', function(e) {
    if($('#password').val() != $('#cpassword').val()) {
      e.preventDefault();
      $('#passwordError').show();
      $('html, body').animate({
        scrollTop: $('#passwordError').offset().top - 100
      }, 500);
    }
  });

  // Hide password error when typing
  $('#password, #cpassword').on('input', function() {
    if($('#password').val() == $('#cpassword').val()) {
      $('#passwordError').hide();
    }
  });

  // File upload display
  $('#resume').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    if(fileName) {
      $('.file-upload-text').text(fileName);
    }
  });
</script>
</body>
</html>