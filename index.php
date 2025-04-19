<?php
// To Handle Session Variables on This Page
session_start();

// Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkillBridge - Unlocking Africa's Potential</title>
  
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
    
    .hero-section {
  background: 
    linear-gradient(135deg, 
      rgba(26, 115, 232, 0.85) 0%, 
      rgba(13, 71, 161, 0.9) 100%),
    url('img/africa-tech.jpg') center/cover no-repeat;
  color: var(--white);
  padding: 120px 0;
  text-align: center;
  position: relative;
  overflow: hidden;
}

/* Optional: Add a subtle pattern overlay for more depth */
.hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: radial-gradient(circle at 50% 50%, 
    rgba(255,255,255,0.1) 1px, transparent 1px);
  background-size: 20px 20px;
  opacity: 0.3;
}
    
.hero-section {
  background: 
    linear-gradient(135deg, 
      rgba(26, 115, 232, 0.7) 0%, 
      rgba(13, 71, 161, 0.75) 100%),
    url('img/africa-tech.jpg') center/cover no-repeat;
}
    .hero-title {
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    
    .hero-subtitle {
      font-size: 1.2rem;
      margin-bottom: 30px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }
    
    .btn-hero {
      background-color: var(--accent-color);
      color: var(--white);
      padding: 12px 30px;
      font-weight: 600;
      border-radius: 30px;
      transition: var(--transition);
      border: none;
    }
    
    .btn-hero:hover {
      background-color: #e65100;
      color: var(--white);
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .section-title {
      font-weight: 600;
      color: var(--primary-dark);
      margin-bottom: 30px;
      position: relative;
      padding-bottom: 10px;
      text-align: center;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: var(--accent-color);
    }
    
    .section-subtitle {
      text-align: center;
      max-width: 800px;
      margin: 0 auto 40px;
      color: #555;
    }
    
    .feature-card {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      padding: 30px;
      margin-bottom: 30px;
      height: 100%;
      transition: var(--transition);
      text-align: center;
      border: none;
    }
    
    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .feature-icon {
      font-size: 2.5rem;
      color: var(--primary-color);
      margin-bottom: 20px;
    }
    
    .feature-title {
      font-weight: 600;
      margin-bottom: 15px;
      color: var(--primary-dark);
    }
    
    .job-card {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      margin-bottom: 20px;
      transition: var(--transition);
      border: none;
      overflow: hidden;
    }
    
    .job-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .job-card-header {
      padding: 15px;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .job-card-title {
      font-weight: 600;
      margin-bottom: 5px;
      color: var(--primary-dark);
    }
    
    .job-card-company {
      color: var(--accent-color);
      font-weight: 500;
    }
    
    .job-card-salary {
      color: #28a745;
      font-weight: 500;
    }
    
    .job-card-body {
      padding: 15px;
    }
    
    .job-card-footer {
      padding: 15px;
      background: rgba(0, 0, 0, 0.02);
      border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .stats-card {
      border-radius: 8px;
      color: var(--white);
      padding: 20px;
      margin-bottom: 20px;
      text-align: center;
      transition: var(--transition);
    }
    
    .stats-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .stats-icon {
      font-size: 2rem;
      margin-bottom: 10px;
    }
    
    .stats-number {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 5px;
    }
    
    .stats-label {
      font-size: 1rem;
      opacity: 0.9;
    }
    
    .about-section {
      background: rgba(16, 63, 126, 0.05);
      padding: 60px 0;
    }
    
    .about-image {
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      overflow: hidden;
    }
    
    .about-image img {
      width: 100%;
      height: auto;
      transition: var(--transition);
    }
    
    .about-image:hover img {
      transform: scale(1.03);
    }
    
    .about-content {
      padding-left: 30px;
    }
    
    .main-footer {
      background: var(--dark-bg);
      color: var(--white);
      padding: 30px 0;
      margin-top: 60px;
    }
    
    .motivational-quote {
      background: var(--primary-color);
      color: var(--white);
      padding: 30px;
      border-radius: 8px;
      margin: 40px 0;
      text-align: center;
      box-shadow: var(--card-shadow);
    }
    
    .quote-text {
      font-size: 1.3rem;
      font-style: italic;
      margin-bottom: 15px;
    }
    
    .quote-author {
      font-weight: 600;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .about-content {
        padding-left: 0;
        margin-top: 30px;
      }
      
      .section-title {
        font-size: 1.8rem;
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
            <li class="nav-item">
              <a class="nav-link" href="#candidates"><i class="fas fa-users me-1"></i> Candidates</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#company"><i class="fas fa-building me-1"></i> Companies</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about"><i class="fas fa-info-circle me-1"></i> About</a>
            </li>
            <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sign-up.php"><i class="fas fa-user-plus me-1"></i> Sign Up</a>
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
  <section class="hero-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="hero-title">Unlock Your Potential with SkillBridge</h1>
          <p class="hero-subtitle">Connecting Africa's brightest talent with world-class opportunities. Your dream job is just a click away!</p>
          <a href="jobs.php" class="btn btn-hero">
            <i class="fas fa-search me-1"></i> Find Jobs Now
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Latest Jobs Section -->
  <section class="py-5">
    <div class="container">
      <h2 class="section-title">Latest Job Opportunities</h2>
      <p class="section-subtitle">Discover exciting career opportunities across Africa's fastest-growing industries</p>
      
      <div class="row">
        <?php 
        $sql = "SELECT * FROM job_post Order By Rand() Limit 4";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
            $result1 = $conn->query($sql1);
            if($result1->num_rows > 0) {
              while($row1 = $result1->fetch_assoc()) {
        ?>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="job-card">
            <div class="job-card-header">
              <h5 class="job-card-title"><?php echo htmlspecialchars($row['jobtitle']); ?></h5>
              <p class="job-card-company mb-1"><?php echo htmlspecialchars($row1['companyname']); ?></p>
              <p class="job-card-salary mb-0">$<?php echo htmlspecialchars($row['maximumsalary']); ?>/Month</p>
            </div>
            <div class="job-card-body">
              <p><i class="fas fa-map-marker-alt text-primary me-2"></i> <?php echo htmlspecialchars($row1['city']); ?></p>
              <p><i class="fas fa-briefcase text-primary me-2"></i> <?php echo htmlspecialchars($row['experience']); ?> Years Experience</p>
            </div>
            <div class="job-card-footer text-center">
              <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-sm btn-primary">
                View Details
              </a>
            </div>
          </div>
        </div>
        <?php
              }
            }
          }
        }
        ?>
      </div>
      
      <div class="text-center mt-4">
        <a href="jobs.php" class="btn btn-primary">
          <i class="fas fa-list me-1"></i> View All Jobs
        </a>
      </div>
    </div>
  </section>

  <!-- Motivational Quote -->
  <section class="py-3">
    <div class="container">
      <div class="motivational-quote">
        <p class="quote-text">"Africa's youth are not just the future - they are the present. At SkillBridge, we're building the bridges that connect talent with opportunity across our great continent."</p>
        <p class="quote-author">- SkillBridge Team</p>
      </div>
    </div>
  </section>

  <!-- Candidates Section -->
  <section id="candidates" class="py-5 bg-light">
    <div class="container">
      <h2 class="section-title">For Job Seekers</h2>
      <p class="section-subtitle">Your journey to career success starts here. Africa needs your skills!</p>
      
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-search"></i>
            </div>
            <h3 class="feature-title">Find Your Dream Job</h3>
            <p>Access thousands of opportunities across Africa's booming tech, finance, and creative sectors.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-rocket"></i>
            </div>
            <h3 class="feature-title">Fast-Track Your Career</h3>
            <p>Get noticed by top employers looking for African talent with your unique skills and perspective.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-globe-africa"></i>
            </div>
            <h3 class="feature-title">Join Africa's Rising Stars</h3>
            <p>Be part of the new generation shaping Africa's digital future and economic transformation.</p>
          </div>
        </div>
      </div>
      
      <div class="text-center mt-3">
        <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
        <a href="sign-up.php" class="btn btn-success btn-lg">
          <i class="fas fa-user-plus me-1"></i> Create Your Profile
        </a>
        <?php } else { ?>
        <a href="jobs.php" class="btn btn-primary btn-lg">
          <i class="fas fa-briefcase me-1"></i> Browse Jobs
        </a>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- Companies Section -->
  <section id="company" class="py-5">
    <div class="container">
      <h2 class="section-title">For Employers</h2>
      <p class="section-subtitle">Find the best African talent to drive your business forward</p>
      
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-bullhorn"></i>
            </div>
            <h3 class="feature-title">Post Jobs</h3>
            <p>Reach thousands of qualified candidates across Africa's fastest-growing talent pools.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-users"></i>
            </div>
            <h3 class="feature-title">Find Talent</h3>
            <p>Access a diverse pool of skilled professionals ready to contribute to your success.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="feature-title">Grow Your Business</h3>
            <p>Build your team with Africa's brightest minds and drive innovation in your industry.</p>
          </div>
        </div>
      </div>
      
      <div class="text-center mt-3">
        <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
        <a href="sign-up.php" class="btn btn-primary btn-lg">
          <i class="fas fa-building me-1"></i> Register Your Company
        </a>
        <?php } else if(isset($_SESSION['id_company'])) { ?>
        <a href="company/index.php" class="btn btn-primary btn-lg">
          <i class="fas fa-tachometer-alt me-1"></i> Company Dashboard
        </a>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- Statistics Section -->
  <section id="statistics" class="py-5 bg-light">
    <div class="container">
      <h2 class="section-title">Our Impact</h2>
      <p class="section-subtitle">Join Africa's fastest-growing talent community</p>
      
      <div class="row">
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="stats-card bg-primary">
            <div class="stats-icon">
              <i class="fas fa-briefcase"></i>
            </div>
            <div class="stats-number">
              <?php
              $sql = "SELECT * FROM job_post";
              $result = $conn->query($sql);
              echo $result->num_rows > 0 ? $result->num_rows : '0';
              ?>
            </div>
            <div class="stats-label">Job Offers</div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="stats-card bg-success">
            <div class="stats-icon">
              <i class="fas fa-building"></i>
            </div>
            <div class="stats-number">
              <?php
              $sql = "SELECT * FROM company WHERE active='1'";
              $result = $conn->query($sql);
              echo $result->num_rows > 0 ? $result->num_rows : '0';
              ?>
            </div>
            <div class="stats-label">Registered Companies</div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="stats-card bg-warning text-dark">
            <div class="stats-icon">
              <i class="fas fa-file-alt"></i>
            </div>
            <div class="stats-number">
              <?php
              $sql = "SELECT * FROM users WHERE resume!=''";
              $result = $conn->query($sql);
              echo $result->num_rows > 0 ? $result->num_rows : '0';
              ?>
            </div>
            <div class="stats-label">CVs/Resumes</div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="stats-card bg-danger">
            <div class="stats-icon">
              <i class="fas fa-users"></i>
            </div>
            <div class="stats-number">
              <?php
              $sql = "SELECT * FROM users WHERE active='1'";
              $result = $conn->query($sql);
              echo $result->num_rows > 0 ? $result->num_rows : '0';
              ?>
            </div>
            <div class="stats-label">Active Users</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="about-section py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <div class="about-image">
            <img src="img/africa-team.jpg" alt="SkillBridge Team" class="img-fluid">
          </div>
        </div>
        <div class="col-lg-6">
          <h2 class="section-title text-start">About SkillBridge</h2>
          <p>SkillBridge is Africa's premier talent platform, connecting the continent's brightest minds with transformative career opportunities. We believe in the unlimited potential of African professionals to shape the future of work.</p>
          <p>Our mission is to break down barriers to employment and create pathways for African talent to thrive in local and global markets. Whether you're a recent graduate or an experienced professional, SkillBridge provides the tools and connections to take your career to the next level.</p>
          <p>For employers, we offer access to Africa's most dynamic talent pool - skilled, innovative professionals ready to drive your business forward in the digital age.</p>
          <p>Join us in building the bridges that will connect Africa's talent with the world's opportunities.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Final Call to Action -->
  <section class="py-5 bg-primary text-white">
    <div class="container text-center">
      <h2 class="mb-4">Ready to Transform Your Career?</h2>
      <p class="lead mb-4">Join thousands of African professionals who've found their dream jobs through SkillBridge</p>
      <a href="<?php echo empty($_SESSION['id_user']) ? 'sign-up.php' : 'jobs.php'; ?>" class="btn btn-light btn-lg">
        <i class="fas fa-rocket me-1"></i> Get Started Now
      </a>
    </div>
  </section>

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
  // Smooth scrolling for anchor links
  $(document).ready(function(){
    $("a").on('click', function(event) {
      if (this.hash !== "") {
        event.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 800, function(){
          window.location.hash = hash;
        });
      }
    });
  });
</script>
</body>
</html>