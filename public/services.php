<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Our Services - SkillBridge Africa';

// Fetch services from database with category information
try {
    $stmt = $pdo->query("SELECT s.*, u.first_name, u.last_name, c.name as category_name 
                         FROM services s 
                         JOIN users u ON s.provider_id = u.user_id
                         LEFT JOIN categories c ON s.category_id = c.category_id");
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get unique categories for filtering
    $categoriesStmt = $pdo->query("SELECT * FROM categories");
    $categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $services = [];
    $categories = [];
    $error = "Error fetching services: " . $e->getMessage();
}
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<!-- Hero Section -->
<section class="services-hero bg-dark text-white py-5 position-relative overflow-hidden">
    <div class="container position-relative z-index-1">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Discover African Talent & Services</h1>
                <p class="lead mb-4">Connect with skilled professionals across Africa offering exceptional services in various fields.</p>
                <div class="d-flex gap-3">
                    <a href="#services" class="btn btn-primary btn-lg px-4">Explore Services</a>
                    <a href="/skillbridge/public/contact.php" class="btn btn-outline-light btn-lg px-4">Get In Touch</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="/skillbridge/assets/images/africa-map-hero.png" alt="Africa Map" class="img-fluid rounded-3 shadow-lg animate-float" loading="lazy">
            </div>
        </div>
    </div>
    <div class="position-absolute top-0 end-0 w-100 h-100 bg-gradient-dark opacity-75"></div>
    <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" style="height: 100px;">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="height: 100%; width: 100%;">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="fill-light"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="fill-light"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="fill-light"></path>
        </svg>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-5 bg-light position-relative">
    <div class="container position-relative z-index-1">
        <div class="text-center mb-5">
            <span class="badge bg-primary-soft text-primary rounded-pill mb-3">What We Offer</span>
            <h2 class="fw-bold display-5 mb-3">Discover <span class="text-primary">African</span> Excellence</h2>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">Browse through our diverse range of services offered by talented professionals across Africa</p>
        </div>

        <!-- Category Filter -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <button class="btn btn-outline-primary rounded-pill px-4 filter-btn active" data-filter="all">All Services</button>
                    <?php foreach ($categories as $category): ?>
                        <button class="btn btn-outline-primary rounded-pill px-4 filter-btn" data-filter="<?php echo e($category['category_id']); ?>">
                            <?php echo e($category['name']); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo e($error); ?></div>
        <?php endif; ?>

        <div class="row g-4 services-container">
            <?php foreach ($services as $service): ?>
                <div class="col-lg-4 col-md-6 service-item" data-category="<?php echo e($service['category_id']); ?>">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden service-card animate-on-scroll">
                        <div class="position-relative overflow-hidden" style="height: 220px;">
                            <?php if ($service['service_image']): ?>
                                <img src="/skillbridge/assets/images/services/<?php echo e($service['service_image']); ?>" 
                                     class="card-img-top h-100 w-100 object-fit-cover" 
                                     alt="<?php echo e($service['title']); ?>"
                                     loading="lazy">
                            <?php else: ?>
                                <div class="card-img-top bg-africa-pattern h-100 w-100 d-flex align-items-center justify-content-center">
                                    <div class="bg-primary-soft p-4 rounded-circle">
                                        <i class="fas fa-hands-helping fa-3x text-primary"></i>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark-transparent">
                                <span class="badge bg-primary rounded-pill"><?php echo e($service['category_name'] ?? 'General'); ?></span>
                            </div>
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-success rounded-pill">$<?php echo e($service['price']); ?></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0 fw-bold"><?php echo e($service['title']); ?></h5>
                                <div class="rating small text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <p class="card-text text-muted mb-3"><?php echo substr(e($service['description']), 0, 120); ?>...</p>
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar me-2">
                                    <?php if (file_exists(__DIR__ . '/../assets/images/users/' . $service['provider_id'] . '.jpg')): ?>
                                        <img src="/skillbridge/assets/images/users/<?php echo e($service['provider_id']); ?>.jpg" 
                                             class="rounded-circle" width="40" height="40" alt="<?php echo e($service['first_name']); ?>"
                                             loading="lazy">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-primary-soft d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="mb-0 small fw-bold"><?php echo e($service['first_name'] . ' ' . $service['last_name']); ?></p>
                                    <p class="mb-0 small text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        <?php echo e($service['location'] ?? 'Africa'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 pt-0">
                            <a href="/skillbridge/public/service-details.php?id=<?php echo e($service['service_id']); ?>" 
                               class="btn btn-primary w-100 d-flex align-items-center justify-content-between">
                                View Details <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($services)): ?>
            <div class="text-center py-5">
                <div class="py-5">
                    <img src="/skillbridge/assets/images/empty-services.svg" alt="No services found" class="img-fluid mb-4" style="max-width: 300px;" loading="lazy">
                    <h4 class="mb-3">No Services Available Yet</h4>
                    <p class="text-muted mb-4">We're working on bringing you the best African talent. Check back soon!</p>
                    <a href="/skillbridge/public/contact.php" class="btn btn-primary px-4">Become a Provider</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" style="height: 100px; transform: rotate(180deg);">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="height: 100%; width: 100%;">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="fill-white"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="fill-white"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="fill-white"></path>
        </svg>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary-soft text-primary rounded-pill mb-3">Client Voices</span>
            <h2 class="fw-bold display-5 mb-3">What Our <span class="text-primary">Clients</span> Say</h2>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">Hear from those who've experienced African talent through our platform</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-quote-left text-primary opacity-25 fa-2x"></i>
                        </div>
                        <p class="mb-4">"The web development service I received from Nigeria was exceptional. The developer was professional and delivered beyond my expectations."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="50" height="50" alt="Client" loading="lazy">
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">CEO, TechSolutions Inc.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-quote-left text-primary opacity-25 fa-2x"></i>
                        </div>
                        <p class="mb-4">"The graphic designer from Kenya transformed our brand identity. The creativity and attention to detail was remarkable."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="50" height="50" alt="Client" loading="lazy">
                            <div>
                                <h6 class="mb-0">Michael Brown</h6>
                                <small class="text-muted">Marketing Director, BrandWorks</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-quote-left text-primary opacity-25 fa-2x"></i>
                        </div>
                        <p class="mb-4">"The translation services helped us expand into Francophone Africa. Accurate, timely, and culturally appropriate."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle me-3" width="50" height="50" alt="Client" loading="lazy">
                            <div>
                                <h6 class="mb-0">Amina Diallo</h6>
                                <small class="text-muted">Global Expansion Manager</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-primary text-white position-relative overflow-hidden">
    <div class="container position-relative z-index-1">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Have a special project in mind?</h3>
                <p class="mb-lg-0">Our African professionals can bring your vision to life with unique skills and creativity.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/skillbridge/public/contact.php" class="btn btn-light btn-lg px-4">Request Custom Service</a>
            </div>
        </div>
    </div>
    <div class="position-absolute top-0 end-0 w-100 h-100 bg-pattern-dark opacity-10"></div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<!-- Custom CSS for this page -->
<style>
    .services-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.85)), 
                    url('/skillbridge/assets/images/african-pattern-bg.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    
    .bg-africa-pattern {
        background: url('/skillbridge/assets/images/african-texture.jpg');
        background-size: cover;
        background-position: center;
    }
    
    .bg-pattern-dark {
        background: url('/skillbridge/assets/images/african-pattern-bg.jpg');
        background-size: cover;
        background-position: center;
        opacity: 0.1;
    }
    
    .bg-gradient-dark-transparent {
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
    }
    
    .bg-primary-soft {
        background-color: rgba(13, 110, 253, 0.1);
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .service-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px !important;
    }
    
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
    }
    
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .animate-on-scroll.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .fill-light {
        fill: #f8f9fa;
    }
    
    .fill-white {
        fill: #fff;
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    
    .rating {
        letter-spacing: 2px;
    }
</style>

<!-- JavaScript for animations and filtering -->
<script>
    // Animation on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
        
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const serviceItems = document.querySelectorAll('.service-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                const filterValue = button.getAttribute('data-filter');
                
                // Filter items
                serviceItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>