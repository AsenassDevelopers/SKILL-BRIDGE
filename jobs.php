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
  <title>Job Portal | SkillBridge</title>
  
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
      --accent-color: #ff6d00;
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
      font-size: 1.5rem;
      color: var(--white);
      display: flex;
      align-items: center;
    }
    
    .sb-navbar-brand:hover {
      color: var(--white);
      text-decoration: none;
    }
    
    .sb-logo-icon {
      margin-right: 10px;
      font-size: 1.8rem;
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
    
    .main-header {
      position: sticky;
      top: 0;
      z-index: 1030;
    }
    
    .content-wrapper {
      padding-top: 20px;
      min-height: calc(100vh - 120px);
    }
    
    .latest-job {
      margin-bottom: 30px;
    }
    
    .latest-job h1 {
      font-weight: 600;
      color: var(--primary-dark);
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .latest-job h1::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: var(--accent-color);
    }
    
    .search-container {
      max-width: 800px;
      margin: 0 auto;
    }
    
    .filter-box {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      overflow: hidden;
      margin-bottom: 20px;
    }
    
    .filter-header {
      background: var(--primary-color);
      color: var(--white);
      padding: 12px 15px;
      font-weight: 600;
    }
    
    .filter-body {
      padding: 15px;
    }
    
    .filter-link {
      display: block;
      padding: 8px 0;
      color: var(--text-color);
      transition: var(--transition);
      text-decoration: none;
    }
    
    .filter-link:hover {
      color: var(--primary-color);
      transform: translateX(5px);
    }
    
    .filter-link i {
      margin-right: 8px;
      color: var(--accent-color);
    }
    
    .job-card {
      background: var(--white);
      border-radius: 8px;
      box-shadow: var(--card-shadow);
      margin-bottom: 20px;
      transition: var(--transition);
      border: none;
    }
    
    .job-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .job-card-header {
      background: var(--primary-color);
      color: var(--white);
      padding: 15px;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }
    
    .job-card-body {
      padding: 20px;
    }
    
    .job-title {
      font-weight: 600;
      color: var(--primary-dark);
      margin-bottom: 5px;
    }
    
    .company-name {
      color: var(--accent-color);
      font-weight: 500;
      margin-bottom: 10px;
    }
    
    .job-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-bottom: 15px;
    }
    
    .job-meta-item {
      display: flex;
      align-items: center;
    }
    
    .job-meta-item i {
      margin-right: 5px;
      color: var(--primary-color);
    }
    
    .btn-apply {
      background: var(--accent-color);
      color: var(--white);
      border: none;
      padding: 8px 20px;
      border-radius: 4px;
      font-weight: 500;
      transition: var(--transition);
    }
    
    .btn-apply:hover {
      background: #e65100;
      color: var(--white);
      transform: translateY(-2px);
    }
    
    .pagination {
      justify-content: center;
      margin-top: 30px;
    }
    
    .page-item.active .page-link {
      background: var(--primary-color);
      border-color: var(--primary-color);
    }
    
    .page-link {
      color: var(--primary-color);
    }
    
    .main-footer {
      background: var(--dark-bg);
      color: var(--white);
      padding: 20px 0;
      margin-top: 40px;
    }
    
    /* Loading animation */
    #target-content.loading {
      position: relative;
      min-height: 100px;
    }
    
    #target-content.loading::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 40px;
      height: 40px;
      border: 3px solid rgba(0, 0, 0, 0.1);
      border-radius: 50%;
      border-top-color: var(--primary-color);
      animation: spin 1s ease-in-out infinite;
    }
    
    @keyframes spin {
      to { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .filter-box {
        margin-bottom: 30px;
      }
      
      .latest-job h1 {
        font-size: 1.8rem;
      }
      
      .search-container {
        padding: 0 15px;
      }
    }
  </style>
</head>
<body>
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-expand-lg sb-navbar">
      <div class="container">
        <a href="index.php" class="navbar-brand sb-navbar-brand">
          <i class="fas fa-hands-helping sb-logo-icon"></i>
          <span>SkillBridge</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sign-up.php">Sign Up</a>
            </li>  
            <?php } else { 
              if(isset($_SESSION['id_user'])) { 
            ?>        
            <li class="nav-item">
              <a class="nav-link" href="user/index.php">Dashboard</a>
            </li>
            <?php
            } else if(isset($_SESSION['id_company'])) { 
            ?>        
            <li class="nav-item">
              <a class="nav-link" href="company/index.php">Dashboard</a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <?php } ?>          
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 latest-job margin-top-50 margin-bottom-20">
            <h1 class="text-center">Latest Jobs</h1>  
            <div class="search-container">
              <div class="input-group mb-3">
                <input type="text" id="searchBar" class="form-control form-control-lg" placeholder="Search job by title, company, or keywords">
                <button id="searchBtn" class="btn btn-primary" type="button">
                  <i class="fas fa-search"></i> Search
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="filter-box">
              <div class="filter-header">
                <i class="fas fa-filter me-2"></i> Filters
              </div>
              <div class="filter-body">
                <div class="mb-3">
                  <h5 class="fw-bold mb-3"><i class="fas fa-map-marker-alt text-primary me-2"></i> City</h5>
                  <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action citySearch" data-target="Delhi">
                      <i class="fas fa-city text-accent me-2"></i> Delhi
                    </a>
                    <a href="#" class="list-group-item list-group-item-action citySearch" data-target="Kouba">
                      <i class="fas fa-city text-accent me-2"></i> Kouba
                    </a>
                  </div>
                </div>
                
                <div class="mb-3">
                  <h5 class="fw-bold mb-3"><i class="fas fa-briefcase text-primary me-2"></i> Experience</h5>
                  <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action experienceSearch" data-target="1">
                      <i class="fas fa-chart-line text-accent me-2"></i> > 1 Year
                    </a>
                    <a href="#" class="list-group-item list-group-item-action experienceSearch" data-target="2">
                      <i class="fas fa-chart-line text-accent me-2"></i> > 2 Years
                    </a>
                    <a href="#" class="list-group-item list-group-item-action experienceSearch" data-target="3">
                      <i class="fas fa-chart-line text-accent me-2"></i> > 3 Years
                    </a>
                    <a href="#" class="list-group-item list-group-item-action experienceSearch" data-target="4">
                      <i class="fas fa-chart-line text-accent me-2"></i> > 4 Years
                    </a>
                    <a href="#" class="list-group-item list-group-item-action experienceSearch" data-target="5">
                      <i class="fas fa-chart-line text-accent me-2"></i> > 5 Years
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <?php
            $limit = 4;
            $sql = "SELECT COUNT(id_jobpost) AS id FROM job_post";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $total_records = $row['id'];
              $total_pages = ceil($total_records / $limit);
            } else {
              $total_pages = 1;
            }
            ?>
            
            <div id="target-content"></div>
            <div class="text-center">
              <ul class="pagination" id="pagination"></ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="container text-center">
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://localhost/SkillBridge/">SkillBridge</a>.</strong> All rights reserved.
    </div>
  </footer>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Pagination Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>

<script>
  // Improved loading performance with optimized AJAX calls
  $(document).ready(function() {
    // Initialize pagination
    Pagination();
    
    // Preload the first page immediately
    loadPage(1);
  });

  function Pagination() {
    $("#pagination").twbsPagination({
      totalPages: <?php echo $total_pages; ?>,
      visible: 5,
      onPageClick: function (e, page) {
        e.preventDefault();
        loadPage(page);
      }
    });
  }
  
  function loadPage(page) {
    // Show loading animation
    $("#target-content").html('<div class="text-center py-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
    
    // Load content via AJAX
    $.ajax({
      url: "jobpagination.php?page=" + page,
      cache: true, // Enable caching for better performance
      success: function(data) {
        $("#target-content").html(data);
      },
      error: function() {
        $("#target-content").html('<div class="alert alert-danger">Error loading content. Please try again.</div>');
      }
    });
  }

  // Search functionality with debounce for better performance
  let searchTimer;
  $("#searchBtn").on("click", function(e) {
    e.preventDefault();
    clearTimeout(searchTimer);
    performSearch();
  });
  
  $("#searchBar").on("keyup", function(e) {
    if (e.key === "Enter") {
      clearTimeout(searchTimer);
      performSearch();
    } else {
      // Debounce the search to avoid too many requests
      clearTimeout(searchTimer);
      searchTimer = setTimeout(performSearch, 500);
    }
  });

  function performSearch() {
    var searchResult = $("#searchBar").val().trim();
    var filter = "searchBar";
    
    if(searchResult !== "") {
      $("#pagination").twbsPagination('destroy');
      Search(searchResult, filter);
    } else {
      $("#pagination").twbsPagination('destroy');
      Pagination();
    }
  }

  $(".experienceSearch, .citySearch").on("click", function(e) {
    e.preventDefault();
    var searchResult = $(this).data("target");
    var filter = $(this).hasClass("experienceSearch") ? "experience" : "city";
    
    if(searchResult !== "") {
      $("#pagination").twbsPagination('destroy');
      Search(searchResult, filter);
    } else {
      $("#pagination").twbsPagination('destroy');
      Pagination();
    }
  });

  function Search(val, filter) {
    // Show loading animation
    $("#target-content").html('<div class="text-center py-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
    
    $("#pagination").twbsPagination({
      totalPages: <?php echo $total_pages; ?>,
      visible: 5,
      onPageClick: function (e, page) {
        e.preventDefault();
        val = encodeURIComponent(val);
        
        $.ajax({
          url: "search.php?page=" + page + "&search=" + val + "&filter=" + filter,
          cache: true,
          success: function(data) {
            $("#target-content").html(data);
          },
          error: function() {
            $("#target-content").html('<div class="alert alert-danger">Error loading search results. Please try again.</div>');
          }
        });
      }
    });
    
    // Load first page immediately
    $.ajax({
      url: "search.php?page=1&search=" + encodeURIComponent(val) + "&filter=" + filter,
      cache: true,
      success: function(data) {
        $("#target-content").html(data);
      }
    });
  }
</script>
</body>
</html>