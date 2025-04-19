<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Home - SkillBridge';
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<style>
    .hover-text-white:hover {
    color: white !important;
    transition: color 0.3s ease;
}

#back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: none;
    z-index: 99;
    width: 40px;
    height: 40px;
}
    /* Hero Section Animation */
    .hero-section {
        background: linear-gradient(135deg, #1e5799 0%, #207cca 51%, #2989d8 100%);
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
        background-size: cover;
        opacity: 0.15;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        animation: fadeInUp 1s ease-out;
    }
    
    /* Card Hover Effects */
    .service-card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    .service-card .card-body {
        padding: 2rem;
    }
    
    /* How It Works Section */
    .step-icon {
        transition: all 0.3s ease;
    }
    .step-item:hover .step-icon {
        transform: scale(1.1);
        background: #ff6b00 !important;
    }
    
    /* Testimonial Section */
    .testimonial-card {
        border-left: 4px solid #2989d8;
        transition: all 0.3s ease;
    }
    .testimonial-card:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    /* Animation Keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.5rem;
        }
        .service-card {
            margin-bottom: 1.5rem;
        }
    }
</style>

<!-- Hero Section with African Background -->
<div class="hero-section text-white py-5" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container text-center hero-content">
        <h1 class="display-4 mb-4 animate__animated animate__fadeInDown" style="font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            Empower Your Business with African Talent
        </h1>
        <p class="lead mb-5" style="font-size: 1.5rem; max-width: 800px; margin: 0 auto;">
            Connect with skilled professionals across Africa for quality services at competitive rates
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="/skillbridge/public/services.php" class="btn btn-light btn-lg px-4 py-3" style="font-weight: 600; border-radius: 50px; animation: pulse 2s infinite;">
                Browse Services <i class="fas fa-arrow-right ms-2"></i>
            </a>
            <a href="#" class="btn btn-outline-light btn-lg px-4 py-3" style="font-weight: 600; border-radius: 50px;">
                How It Works <i class="fas fa-info-circle ms-2"></i>
            </a>
        </div>
    </div>
</div>

<!-- Popular Categories Section -->
<div class="container my-5 py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 mb-3" style="font-weight: 600;">Popular Services Across Africa</h2>
        <p class="lead" style="max-width: 700px; margin: 0 auto;">Discover top-rated services from professionals in various African regions</p>
    </div>
    
    <div class="row g-4">
        <!-- Home Services -->
        <div class="col-lg-3 col-md-6">
            <div class="service-card card h-100">
                <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="card-img-top" alt="African home services" style="height: 180px; object-fit: cover;">
                <div class="card-body text-center">
                    <div class="icon-wrapper mb-3" style="width: 60px; height: 60px; background: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-paint-brush fa-2x text-primary"></i>
                    </div>
                    <h5 class="card-title" style="font-weight: 600;">Home Services</h5>
                    <p class="card-text">Quality plumbing, electrical, and cleaning services across major African cities</p>
                    <a href="#" class="btn btn-link text-primary text-decoration-none">Explore <i class="fas fa-chevron-right ms-1"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Tech Services -->
        <div class="col-lg-3 col-md-6">
            <div class="service-card card h-100">
                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="card-img-top" alt="African tech services" style="height: 180px; object-fit: cover;">
                <div class="card-body text-center">
                    <div class="icon-wrapper mb-3" style="width: 60px; height: 60px; background: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-laptop-code fa-2x text-primary"></i>
                    </div>
                    <h5 class="card-title" style="font-weight: 600;">Tech Services</h5>
                    <p class="card-text">Innovative IT solutions, web development, and tech support from African experts</p>
                    <a href="#" class="btn btn-link text-primary text-decoration-none">Explore <i class="fas fa-chevron-right ms-1"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Tutoring -->
        <div class="col-lg-3 col-md-6">
            <div class="service-card card h-100">
                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="card-img-top" alt="African education" style="height: 180px; object-fit: cover;">
                <div class="card-body text-center">
                    <div class="icon-wrapper mb-3" style="width: 60px; height: 60px; background: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-chalkboard-teacher fa-2x text-primary"></i>
                    </div>
                    <h5 class="card-title" style="font-weight: 600;">Education</h5>
                    <p class="card-text">Academic tutoring, language lessons, and professional training across Africa</p>
                    <a href="#" class="btn btn-link text-primary text-decoration-none">Explore <i class="fas fa-chevron-right ms-1"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Fitness -->
        <div class="col-lg-3 col-md-6">
            <div class="service-card card h-100">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="card-img-top" alt="African fitness" style="height: 180px; object-fit: cover;">
                <div class="card-body text-center">
                    <div class="icon-wrapper mb-3" style="width: 60px; height: 60px; background: #f8f9fa; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-dumbbell fa-2x text-primary"></i>
                    </div>
                    <h5 class="card-title" style="font-weight: 600;">Health & Fitness</h5>
                    <p class="card-text">Personal trainers, yoga instructors, and wellness coaches throughout Africa</p>
                    <a href="#" class="btn btn-link text-primary text-decoration-none">Explore <i class="fas fa-chevron-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<div class="bg-light py-5" style="background: linear-gradient(to right, #f8f9fa, #ffffff);">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-5 mb-3" style="font-weight: 600;">How SkillBridge Works</h2>
            <p class="lead" style="max-width: 700px; margin: 0 auto;">Three simple steps to connect with Africa's top professionals</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4 mb-4 step-item">
                <div class="text-center p-4 h-100" style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <div class="step-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px;">
                        <i class="fas fa-search fa-3x"></i>
                    </div>
                    <div class="step-number mb-3" style="font-size: 1.2rem; font-weight: 600; color: #2989d8;">Step 1</div>
                    <h4 class="mb-3" style="font-weight: 600;">Find a Service</h4>
                    <p>Browse our directory of skilled professionals across Africa's growing markets</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4 step-item">
                <div class="text-center p-4 h-100" style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <div class="step-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px;">
                        <i class="fas fa-calendar-check fa-3x"></i>
                    </div>
                    <div class="step-number mb-3" style="font-size: 1.2rem; font-weight: 600; color: #2989d8;">Step 2</div>
                    <h4 class="mb-3" style="font-weight: 600;">Book an Appointment</h4>
                    <p>Choose a time that works for you with our easy scheduling system</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4 step-item">
                <div class="text-center p-4 h-100" style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <div class="step-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px;">
                        <i class="fas fa-thumbs-up fa-3x"></i>
                    </div>
                    <div class="step-number mb-3" style="font-size: 1.2rem; font-weight: 600; color: #2989d8;">Step 3</div>
                    <h4 class="mb-3" style="font-weight: 600;">Enjoy the Service</h4>
                    <p>Receive quality service from vetted professionals with satisfaction guarantee</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="container my-5 py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 mb-3" style="font-weight: 600;">Trusted by Businesses Across Africa</h2>
        <p class="lead" style="max-width: 700px; margin: 0 auto;">What our clients say about our platform</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="testimonial-card p-4 h-100" style="background: #f8f9fa; border-radius: 8px;">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="Testimonial">
                    <div>
                        <h5 style="font-weight: 600; margin-bottom: 0;">Amina Diallo</h5>
                        <small class="text-muted">Nairobi, Kenya</small>
                    </div>
                </div>
                <div class="rating mb-2">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                </div>
                <p>"SkillBridge connected me with an amazing web developer in Lagos who rebuilt my e-commerce site at half the cost I was quoted locally."</p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="testimonial-card p-4 h-100" style="background: #f8f9fa; border-radius: 8px;">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="Testimonial">
                    <div>
                        <h5 style="font-weight: 600; margin-bottom: 0;">Kwame Ofori</h5>
                        <small class="text-muted">Accra, Ghana</small>
                    </div>
                </div>
                <div class="rating mb-2">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star-half-alt text-warning"></i>
                </div>
                <p>"Found a reliable accountant in Johannesburg through SkillBridge who helped streamline my business finances. The platform is a game-changer!"</p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="testimonial-card p-4 h-100" style="background: #f8f9fa; border-radius: 8px;">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="Testimonial">
                    <div>
                        <h5 style="font-weight: 600; margin-bottom: 0;">Fatima Bello</h5>
                        <small class="text-muted">Cairo, Egypt</small>
                    </div>
                </div>
                <div class="rating mb-2">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                </div>
                <p>"As a small business owner, SkillBridge has been invaluable for finding affordable marketing experts across Africa. Highly recommended!"</p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-primary py-5" style="background: linear-gradient(135deg, #1e5799 0%, #207cca 51%, #2989d8 100%);">
    <div class="container text-center text-white py-5">
        <h2 class="display-5 mb-4" style="font-weight: 700;">Ready to Find Your Perfect Service Provider?</h2>
        <p class="lead mb-5" style="max-width: 700px; margin: 0 auto;">Join thousands of satisfied clients who found quality services through SkillBridge</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="/skillbridge/public/services.php" class="btn btn-light btn-lg px-4 py-3" style="font-weight: 600; border-radius: 50px;">
                Browse Services <i class="fas fa-arrow-right ms-2"></i>
            </a>
            <a href="#" class="btn btn-outline-light btn-lg px-4 py-3" style="font-weight: 600; border-radius: 50px;">
                Learn More <i class="fas fa-info-circle ms-2"></i>
            </a>
        </div>
    </div>
</div>

<script>
    // Animation on scroll
    document.addEventListener('DOMContentLoaded', function() {
        // Animate elements when they come into view
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.service-card, .step-item, .testimonial-card');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;
                
                if(elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };
        
        // Set initial state for animated elements
        const animatedElements = document.querySelectorAll('.service-card, .step-item, .testimonial-card');
        animatedElements.forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'all 0.6s ease-out';
        });
        
        // Run once on load
        animateOnScroll();
        
        // Run on scroll
        window.addEventListener('scroll', animateOnScroll);
        
        // Add hover effect to service cards
        const serviceCards = document.querySelectorAll('.service-card');
        serviceCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                const icon = card.querySelector('.icon-wrapper');
                if(icon) {
                    icon.style.backgroundColor = '#2989d8';
                    icon.querySelector('i').style.color = 'white';
                }
            });
            
            card.addEventListener('mouseleave', () => {
                const icon = card.querySelector('.icon-wrapper');
                if(icon) {
                    icon.style.backgroundColor = '#f8f9fa';
                    icon.querySelector('i').style.color = '#2989d8';
                }
            });
        });
    });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>