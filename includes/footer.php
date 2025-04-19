</main>
        <footer class="bg-dark text-white pt-4 pb-2 mt-auto">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-about">
                            <h5 class="fw-bold mb-3">About SkillBridge</h5>
                            <p class="text-muted">Connecting skilled professionals with clients who need their services through a seamless, efficient platform.</p>
                            <div class="social-icons mt-3">
                                <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h5 class="fw-bold mb-3">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="/skillbridge/public/index.php" class="text-white-50 text-decoration-none hover-text-white">Home</a></li>
                            <li class="mb-2"><a href="/skillbridge/public/services.php" class="text-white-50 text-decoration-none hover-text-white">Services</a></li>
                            <li class="mb-2"><a href="/skillbridge/public/about.php" class="text-white-50 text-decoration-none hover-text-white">About Us</a></li>
                            <li class="mb-2"><a href="/skillbridge/public/contact.php" class="text-white-50 text-decoration-none hover-text-white">Contact</a></li>
                            <li class="mb-2"><a href="/skillbridge/public/privacy.php" class="text-white-50 text-decoration-none hover-text-white">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="fw-bold mb-3">Our Services</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-text-white">Freelance Matching</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-text-white">Project Management</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-text-white">Secure Payments</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-text-white">Skill Verification</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="fw-bold mb-3">Contact Us</h5>
                        <address class="text-white-50">
                            <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Skill St, Tech City</p>
                            <p class="mb-2"><i class="fas fa-phone me-2"></i> (123) 456-7890</p>
                            <p class="mb-2"><i class="fas fa-envelope me-2"></i> <a href="mailto:info@skillbridge.com" class="text-white-50 text-decoration-none hover-text-white">info@skillbridge.com</a></p>
                        </address>
                        <div class="newsletter mt-3">
                            <h6 class="fw-bold mb-2">Newsletter</h6>
                            <form class="d-flex">
                                <input type="email" class="form-control form-control-sm me-2" placeholder="Your email">
                                <button type="submit" class="btn btn-primary btn-sm">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr class="my-4 bg-secondary">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 text-white-50">&copy; <?php echo date('Y'); ?> SkillBridge. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0 text-white-50">Designed with <i class="fas fa-heart text-danger"></i> by asenass Developers</p>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- Back to Top Button -->
        <button id="back-to-top" class="btn btn-primary rounded-circle shadow" title="Go to top">
            <i class="fas fa-arrow-up"></i>
        </button>
        
        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <!-- Custom JS -->
        <script src="/skillbridge/assets/js/script.js"></script>
        
        <!-- Back to Top Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var backToTopButton = document.getElementById('back-to-top');
                
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        backToTopButton.style.display = 'block';
                    } else {
                        backToTopButton.style.display = 'none';
                    }
                });
                
                backToTopButton.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            });
        </script>
    </body>
</html>