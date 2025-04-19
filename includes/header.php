<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? e($pageTitle) : 'SkillBridge - African Talent Marketplace'; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Header-specific styles with unique class names */
        .sb-navbar {
            background: linear-gradient(135deg, #1e5799 0%, #2989d8 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 12px 0;
            transition: all 0.3s ease;
        }
        
        .sb-navbar.scrolled {
            padding: 8px 0;
            background: rgba(30, 87, 153, 0.95);
            backdrop-filter: blur(10px);
        }
        
        .sb-navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
        }
        
        .sb-navbar-brand span {
            color: #ff6b00;
        }
        
        .sb-nav-link {
            font-weight: 500;
            padding: 8px 15px !important;
            margin: 0 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .sb-nav-link:not(.dropdown-toggle):after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #ff6b00;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .sb-nav-link:hover:not(.dropdown-toggle):after,
        .sb-nav-link.active:after {
            width: 70%;
        }
        
        .sb-dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 10px 0;
            margin-top: 8px;
        }
        
        .sb-dropdown-item {
            padding: 8px 20px;
            transition: all 0.3s ease;
        }
        
        .sb-dropdown-item:hover {
            background: #2989d8;
            color: white;
            transform: translateX(5px);
        }
        
        .sb-auth-btn {
            border-radius: 50px;
            padding: 8px 20px !important;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-left: 10px;
        }
        
        .sb-login-btn {
            border: 2px solid white;
            color: white;
        }
        
        .sb-login-btn:hover {
            background: white;
            color: #2989d8;
        }
        
        .sb-register-btn {
            background: #ff6b00;
            color: white;
            border: 2px solid #ff6b00;
        }
        
        .sb-register-btn:hover {
            background: transparent;
            color: #ff6b00;
        }
        
        .sb-user-avatar {
            width: 32px;
            height: 32px;
            background: #fff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #2989d8;
            font-weight: bold;
            margin-right: 8px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sb-navbar-collapse {
                padding: 15px 0;
            }
            
            .sb-nav-link {
                margin: 5px 0;
                padding: 10px 15px !important;
            }
            
            .sb-auth-btn {
                margin: 10px 0 0 0;
                display: inline-block;
                width: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark sb-navbar fixed-top">
        <div class="container">
            <a class="navbar-brand sb-navbar-brand" href="/skillbridge/public/index.php">
                Skill<span>Bridge</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sbNavbar" aria-controls="sbNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="sbNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link sb-nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : ''; ?>" href="/SkillBridge/public/">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sb-nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'services.php' ? 'active' : ''; ?>" href="/SkillBridge/public/services.php">
                            <i class="fas fa-list-alt me-1"></i> Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sb-nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'contact.php' ? 'active' : ''; ?>" href="/SkillBridge/public/contact.php">
                            <i class="fas fa-envelope me-1"></i> Contact
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-auto">
                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle sb-nav-link d-flex align-items-center" href="#" id="sbUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="sb-user-avatar">
                                    <?php echo strtoupper(substr($_SESSION['first_name'], 0, 1)); ?>
                                </div>
                                <?php echo e($_SESSION['first_name']); ?>
                            </a>
                            <ul class="dropdown-menu sb-dropdown-menu dropdown-menu-end" aria-labelledby="sbUserDropdown">
                                <?php if ($_SESSION['user_type'] === 'admin'): ?>
                                    <li><a class="dropdown-item sb-dropdown-item" href="/SkillBridge/admin_dashboard/dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</a></li>
                                <?php elseif ($_SESSION['user_type'] === 'provider'): ?>
                                    <li><a class="dropdown-item sb-dropdown-item" href="/SkillBridge/provider_dashboard/dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Provider Dashboard</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item sb-dropdown-item" href="/SkillBridge/user/dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>User Dashboard</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item sb-dropdown-item" href="/SkillBridge/public/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link sb-auth-btn sb-login-btn" href="/SkillBridge/login.php">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sb-auth-btn sb-register-btn" href="/SkillBridge/sign-up.php">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        // Navbar scroll effect with unique function names
        document.addEventListener('DOMContentLoaded', function() {
            const sbNavbar = document.querySelector('.sb-navbar');
            
            // Scroll event
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    sbNavbar.classList.add('scrolled');
                } else {
                    sbNavbar.classList.remove('scrolled');
                }
            });
            
            // Initialize scroll state
            if (window.scrollY > 50) {
                sbNavbar.classList.add('scrolled');
            }
            
            // Mobile menu close on click
            const sbNavLinks = document.querySelectorAll('.sb-nav-link');
            const sbNavbarCollapse = document.querySelector('.navbar-collapse');
            
            sbNavLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        const bsCollapse = new bootstrap.Collapse(sbNavbarCollapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }
                });
            });
        });
    </script>

    <main class="container-fluid px-0" style="padding-top: 80px;">