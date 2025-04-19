<?php
require_once __DIR__ . '/../includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: /skillbridge/public/services.php");
    exit();
}

$serviceId = $_GET['id'];

try {
    // Get service details with provider info and average rating
    $stmt = $pdo->prepare("SELECT s.*, u.first_name, u.last_name, u.email, u.phone, u.profile_image,
                          (SELECT AVG(rating) FROM reviews WHERE service_id = s.service_id) as avg_rating,
                          (SELECT COUNT(*) FROM reviews WHERE service_id = s.service_id) as review_count
                          FROM services s 
                          JOIN users u ON s.provider_id = u.user_id 
                          WHERE s.service_id = ?");
    $stmt->execute([$serviceId]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$service) {
        header("Location: /skillbridge/public/services.php");
        exit();
    }
    
    // Get related services (same category, different provider)
    $relatedStmt = $pdo->prepare("SELECT s.service_id, s.title, s.price, s.service_image, u.first_name, u.last_name
                                FROM services s
                                JOIN users u ON s.provider_id = u.user_id
                                WHERE s.category = ? AND s.service_id != ? AND s.provider_id != ?
                                LIMIT 3");
    $relatedStmt->execute([$service['category'], $serviceId, $service['provider_id']]);
    $relatedServices = $relatedStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get reviews for this service
    $reviewsStmt = $pdo->prepare("SELECT r.*, u.first_name, u.last_name, u.profile_image
                                 FROM reviews r
                                 JOIN users u ON r.user_id = u.user_id
                                 WHERE r.service_id = ?
                                 ORDER BY r.created_at DESC");
    $reviewsStmt->execute([$serviceId]);
    $reviews = $reviewsStmt->fetchAll(PDO::FETCH_ASSOC);
    
    $pageTitle = $service['title'] . ' - SkillBridge';
} catch (PDOException $e) {
    $error = "Error fetching service details: " . $e->getMessage();
}
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="container my-5 animate__animated animate__fadeIn">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo e($error); ?></div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-8">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/skillbridge/public/services.php">Services</a></li>
                        <li class="breadcrumb-item"><a href="/skillbridge/public/services.php?category=<?php echo urlencode($service['category']); ?>"><?php echo e($service['category']); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($service['title']); ?></li>
                    </ol>
                </nav>
                
                <!-- Service Gallery -->
                <div class="card mb-4 border-0 shadow-sm animate__animated animate__fadeInUp">
                    <?php if ($service['service_image']): ?>
                        <div id="serviceGallery" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner rounded-top">
                                <div class="carousel-item active">
                                    <img src="/skillbridge/assets/images/services/<?php echo e($service['service_image']); ?>" 
                                         class="d-block w-100 service-main-image" 
                                         alt="<?php echo e($service['title']); ?>"
                                         style="height: 400px; object-fit: cover;">
                                </div>
                                <!-- Additional images could be added here if available -->
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#serviceGallery" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#serviceGallery" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="card-img-top bg-light text-secondary d-flex align-items-center justify-content-center" 
                             style="height: 400px;">
                            <i class="fas fa-image fa-5x opacity-25"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h1 class="card-title mb-0"><?php echo e($service['title']); ?></h1>
                            <div class="d-flex align-items-center">
                                <?php if ($service['avg_rating']): ?>
                                    <div class="rating-display me-2">
                                        <span class="stars" style="--rating: <?php echo e($service['avg_rating']); ?>;"></span>
                                        <small class="text-muted">(<?php echo e(number_format($service['avg_rating'], 1)); ?>)</small>
                                    </div>
                                <?php endif; ?>
                                <span class="badge bg-primary"><?php echo e($service['category']); ?></span>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <span class="h4 text-primary mb-0">$<?php echo e(number_format($service['price'], 2)); ?></span>
                            <?php if ($service['price_unit']): ?>
                                <span class="text-muted ms-2">/ <?php echo e($service['price_unit']); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-4">
                            <button class="btn btn-outline-secondary btn-sm me-2" onclick="shareService()">
                                <i class="fas fa-share-alt me-1"></i> Share
                            </button>
                            <?php if (isLoggedIn()): ?>
                                <button class="btn btn-outline-danger btn-sm" id="saveServiceBtn">
                                    <i class="far fa-heart me-1"></i> Save
                                </button>
                            <?php endif; ?>
                        </div>
                        
                        <hr>
                        
                        <h4 class="mb-3"><i class="fas fa-align-left text-primary me-2"></i>Description</h4>
                        <p class="card-text"><?php echo nl2br(e($service['description'])); ?></p>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h4><i class="fas fa-calendar-check text-primary me-2"></i>Availability</h4>
                                <p><?php echo e($service['availability'] ?: 'Flexible - contact provider'); ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4><i class="fas fa-map-marker-alt text-primary me-2"></i>Location</h4>
                                <p><?php echo e($service['location'] ?: 'Various locations'); ?></p>
                            </div>
                        </div>
                        
                        <?php if (!empty($service['tags'])): ?>
                            <hr>
                            <div class="mb-3">
                                <h4><i class="fas fa-tags text-primary me-2"></i>Tags</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php 
                                    $tags = explode(',', $service['tags']);
                                    foreach ($tags as $tag): 
                                    ?>
                                        <span class="badge bg-light text-dark border"><?php echo e(trim($tag)); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Reviews Section -->
                <div class="card mb-4 border-0 shadow-sm animate__animated animate__fadeInUp">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="h4 mb-0"><i class="fas fa-star text-warning me-2"></i>Reviews</h2>
                            <?php if (isLoggedIn() && $_SESSION['user_type'] === 'user'): ?>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                    <i class="fas fa-plus me-1"></i> Add Review
                                </button>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($service['review_count'] > 0): ?>
                            <div class="row align-items-center mb-4">
                                <div class="col-md-3 text-center">
                                    <div class="display-4 fw-bold text-primary"><?php echo e(number_format($service['avg_rating'], 1)); ?></div>
                                    <div class="rating-display mb-2">
                                        <span class="stars" style="--rating: <?php echo e($service['avg_rating']); ?>;"></span>
                                    </div>
                                    <small class="text-muted"><?php echo e($service['review_count']); ?> review<?php echo e($service['review_count'] != 1 ? 's' : ''); ?></small>
                                </div>
                                <div class="col-md-9">
                                    <!-- Rating breakdown could be added here -->
                                </div>
                            </div>
                            
                            <div class="reviews-list">
                                <?php foreach ($reviews as $review): ?>
                                    <div class="review-item mb-4 pb-4 border-bottom">
                                        <div class="d-flex mb-2">
                                            <?php if ($review['profile_image']): ?>
                                                <img src="/skillbridge/assets/images/profiles/<?php echo e($review['profile_image']); ?>" 
                                                     class="rounded-circle me-3" width="50" height="50" alt="<?php echo e($review['first_name']); ?>">
                                            <?php else: ?>
                                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <h5 class="mb-0"><?php echo e($review['first_name'] . ' ' . $review['last_name']); ?></h5>
                                                <div class="rating-display small">
                                                    <span class="stars" style="--rating: <?php echo e($review['rating']); ?>;"></span>
                                                    <span class="text-muted ms-2">
                                                        <?php echo e(date('M j, Y', strtotime($review['created_at']))); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-2 fw-bold"><?php echo e($review['title']); ?></p>
                                        <p class="mb-0"><?php echo e($review['comment']); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                                <h5>No reviews yet</h5>
                                <p class="text-muted">Be the first to review this service</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Related Services -->
                <?php if (!empty($relatedServices)): ?>
                    <div class="card border-0 shadow-sm animate__animated animate__fadeInUp">
                        <div class="card-body">
                            <h2 class="h4 mb-4">Related Services</h2>
                            <div class="row">
                                <?php foreach ($relatedServices as $related): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 border-0 shadow-sm-hover" style="transition: all 0.3s ease;">
                                            <a href="/skillbridge/public/service-details.php?id=<?php echo e($related['service_id']); ?>" class="text-decoration-none text-dark">
                                                <?php if ($related['service_image']): ?>
                                                    <img src="/skillbridge/assets/images/services/<?php echo e($related['service_image']); ?>" 
                                                         class="card-img-top" 
                                                         alt="<?php echo e($related['title']); ?>"
                                                         style="height: 120px; object-fit: cover;">
                                                <?php else: ?>
                                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                                         style="height: 120px;">
                                                        <i class="fas fa-image fa-2x text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="card-body">
                                                    <h5 class="card-title text-truncate"><?php echo e($related['title']); ?></h5>
                                                    <p class="card-text text-primary mb-1">$<?php echo e(number_format($related['price'], 2)); ?></p>
                                                    <small class="text-muted">by <?php echo e($related['first_name'] . ' ' . $related['last_name']); ?></small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <!-- Provider Card -->
                <div class="card mb-4 border-0 shadow-sm sticky-top animate__animated animate__fadeInRight" style="top: 20px;">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-user-tie me-2"></i>Provider</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <?php if ($service['profile_image']): ?>
                                <img src="/skillbridge/assets/images/profiles/<?php echo e($service['profile_image']); ?>" 
                                     class="rounded-circle me-3" width="80" height="80" alt="<?php echo e($service['first_name']); ?>">
                            <?php else: ?>
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3" 
                                     style="width: 80px; height: 80px;">
                                    <i class="fas fa-user text-white fa-2x"></i>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h5 class="mb-0"><?php echo e($service['first_name'] . ' ' . $service['last_name']); ?></h5>
                                <?php if ($service['avg_rating']): ?>
                                    <div class="rating-display small">
                                        <span class="stars" style="--rating: <?php echo e($service['avg_rating']); ?>;"></span>
                                        <small class="text-muted">(<?php echo e($service['review_count']); ?>)</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <a href="mailto:<?php echo e($service['email']); ?>" class="text-decoration-none"><?php echo e($service['email']); ?></a>
                            </li>
                            <?php if ($service['phone']): ?>
                                <li class="mb-2">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    <a href="tel:<?php echo e($service['phone']); ?>" class="text-decoration-none"><?php echo e($service['phone']); ?></a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <i class="fas fa-clock text-primary me-2"></i>
                                <?php echo e($service['response_time'] ? $service['response_time'] . ' avg. response time' : 'Usually responds quickly'); ?>
                            </li>
                        </ul>
                        
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#contactProviderModal">
                                <i class="fas fa-paper-plane me-1"></i> Contact Provider
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Booking Card -->
                <?php if (isLoggedIn() && $_SESSION['user_type'] === 'user'): ?>
                    <div class="card mb-4 border-0 shadow-sm animate__animated animate__fadeInRight">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Book This Service</h4>
                        </div>
                        <div class="card-body">
                            <form id="bookingForm" action="/skillbridge/user_dashboard/book-service.php" method="post">
                                <input type="hidden" name="service_id" value="<?php echo e($serviceId); ?>">
                                
                                <div class="mb-3">
                                    <label for="booking_date" class="form-label">Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="booking_date" name="booking_date" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="duration" class="form-label">Duration</label>
                                    <select class="form-select" id="duration" name="duration">
                                        <option value="1">1 hour</option>
                                        <option value="2">2 hours</option>
                                        <option value="3">3 hours</option>
                                        <option value="4">4 hours</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Special Requests</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Any specific requirements..."></textarea>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-check-circle me-1"></i> Confirm Booking
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php elseif (!isLoggedIn()): ?>
                    <div class="card border-0 shadow-sm animate__animated animate__fadeInRight">
                        <div class="card-body text-center">
                            <i class="fas fa-lock fa-3x text-muted mb-3"></i>
                            <h5>Login to Book</h5>
                            <p class="text-muted">Please login to book this service or contact the provider</p>
                            <div class="d-grid gap-2">
                                <a href="/skillbridge/public/login.php" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                                <a href="/skillbridge/public/register.php" class="btn btn-outline-primary">
                                    <i class="fas fa-user-plus me-1"></i> Register
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Service Stats -->
                <div class="card border-0 shadow-sm animate__animated animate__fadeInRight">
                    <div class="card-body">
                        <h5 class="card-title mb-3"><i class="fas fa-chart-line text-primary me-2"></i>Service Stats</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-eye text-muted me-2"></i> Views</span>
                                <span class="badge bg-light text-dark"><?php echo e(rand(50, 500)); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-bookmark text-muted me-2"></i> Saved</span>
                                <span class="badge bg-light text-dark"><?php echo e(rand(5, 50)); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-calendar-check text-muted me-2"></i> Bookings</span>
                                <span class="badge bg-light text-dark"><?php echo e(rand(10, 100)); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Contact Provider Modal -->
<div class="modal fade" id="contactProviderModal" tabindex="-1" aria-labelledby="contactProviderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="contactProviderModalLabel">Contact <?php echo e($service['first_name']); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="contactProviderForm" action="/skillbridge/includes/contact-provider.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="service_id" value="<?php echo e($serviceId); ?>">
                    <input type="hidden" name="provider_id" value="<?php echo e($service['provider_id']); ?>">
                    
                    <div class="mb-3">
                        <label for="contact_subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="contact_subject" name="subject" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="contact_message" class="form-label">Message</label>
                        <textarea class="form-control" id="contact_message" name="message" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Review Modal -->
<?php if (isLoggedIn() && $_SESSION['user_type'] === 'user'): ?>
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="reviewModalLabel">Add Your Review</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="reviewForm" action="/skillbridge/includes/add-review.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="service_id" value="<?php echo e($serviceId); ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <div class="rating-input">
                            <input type="radio" id="star5" name="rating" value="5" required>
                            <label for="star5" class="star"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" class="star"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" class="star"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" class="star"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" class="star"><i class="fas fa-star"></i></label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="review_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="review_title" name="title" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="review_comment" class="form-label">Your Review</label>
                        <textarea class="form-control" id="review_comment" name="comment" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<style>
    /* Custom CSS for service details */
    .animate__animated {
        animation-duration: 0.5s;
    }
    
    .service-main-image {
        border-radius: 0.25rem 0.25rem 0 0;
    }
    
    .rating-display {
        display: inline-block;
        position: relative;
        unicode-bidi: bidi-override;
        direction: ltr;
    }
    
    .rating-display .stars {
        display: inline-block;
        position: relative;
        font-size: 1.2em;
    }
    
    .rating-display .stars::before {
        content: "★★★★★";
        color: #ddd;
    }
    
    .rating-display .stars::after {
        content: "★★★★★";
        position: absolute;
        left: 0;
        top: 0;
        width: calc(var(--rating) * 20%);
        overflow: hidden;
        color: #ffc107;
    }
    
    .rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    
    .rating-input input {
        display: none;
    }
    
    .rating-input label {
        color: #ddd;
        font-size: 1.5em;
        padding: 0 0.1em;
        cursor: pointer;
    }
    
    .rating-input input:checked ~ label,
    .rating-input input:hover ~ label {
        color: #ffc107;
    }
    
    .rating-input label:hover,
    .rating-input label:hover ~ label {
        color: #ffc107;
    }
    
    .shadow-sm-hover:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }
    
    .sticky-top {
        position: -webkit-sticky;
        position: sticky;
        z-index: 1020;
    }
</style>

<script>
    // Animation triggers
    document.addEventListener('DOMContentLoaded', function() {
        // Add intersection observers for scroll animations
        const animateElements = document.querySelectorAll('.animate__animated');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add(entry.target.dataset.animate);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        animateElements.forEach(element => {
            observer.observe(element);
        });
        
        // Save service button functionality
        const saveServiceBtn = document.getElementById('saveServiceBtn');
        if (saveServiceBtn) {
            saveServiceBtn.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-heart me-1"></i> Saved';
                this.classList.remove('btn-outline-danger');
                this.classList.add('btn-danger');
                
                // Here you would typically make an AJAX call to save the service
                fetch('/skillbridge/includes/save-service.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `service_id=<?php echo e($serviceId); ?>`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const toast = new bootstrap.Toast(document.createElement('div'));
                        toast._element.classList.add('toast', 'align-items-center', 'text-white', 'bg-success', 'border-0');
                        toast._element.innerHTML = `
                            <div class="d-flex">
                                <div class="toast-body">
                                    Service saved to your favorites!
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        `;
                        document.body.appendChild(toast._element);
                        toast.show();
                    }
                });
            });
        }
    });
    
    // Share service functionality
    function shareService() {
        if (navigator.share) {
            navigator.share({
                title: '<?php echo e($service['title']); ?>',
                text: 'Check out this service on SkillBridge: <?php echo e($service['title']); ?>',
                url: window.location.href
            })
            .then(() => console.log('Successful share'))
            .catch((error) => console.log('Error sharing:', error));
        } else {
            // Fallback for browsers that don't support Web Share API
            const shareUrl = `${window.location.origin}/skillbridge/public/service-details.php?id=<?php echo e($serviceId); ?>`;
            navigator.clipboard.writeText(shareUrl)
                .then(() => {
                    const toast = new bootstrap.Toast(document.createElement('div'));
                    toast._element.classList.add('toast', 'align-items-center', 'text-white', 'bg-primary', 'border-0');
                    toast._element.innerHTML = `
                        <div class="d-flex">
                            <div class="toast-body">
                                Link copied to clipboard!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    `;
                    document.body.appendChild(toast._element);
                    toast.show();
                });
        }
    }
    
    // Form validation
    document.getElementById('bookingForm')?.addEventListener('submit', function(e) {
        const dateInput = document.getElementById('booking_date');
        if (new Date(dateInput.value) < new Date()) {
            e.preventDefault();
            alert('Please select a future date and time');
        }
    });
</script>