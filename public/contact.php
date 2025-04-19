<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Contact Us - SkillBridge';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } else {
        // Here you can implement email sending or database storage
        $success = true;
    }
}
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="container my-5 animate__animated animate__fadeIn">
    <h1 class="mb-4 text-center">Contact Us</h1>

    <div class="row">
        <div class="col-lg-6">
            <?php if ($success): ?>
                <div class="alert alert-success animate__animated animate__fadeIn">
                    Thank you for your message! We'll get back to you soon.
                </div>
            <?php elseif ($error): ?>
                <div class="alert alert-danger animate__animated animate__shakeX">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <form method="post" id="contactForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Message</button>
            </form>
        </div>
        <div class="col-lg-6">
    <div class="card shadow-lg border-0">
        <div class="card-body text-center">
            <h5 class="card-title">Our Information</h5>
            <address>
                <strong>SkillBridge Headquarters</strong><br>
                123 Service Lane<br>
                Professional City, PC 12345<br>
                <i class="fas fa-phone"></i> (123) 456-7890<br>
                <i class="fas fa-envelope"></i> info@skillbridge.com
            </address>
            <hr>
            <h5>Business Hours</h5>
            <p>
                Monday - Friday: 9:00 AM - 6:00 PM<br>
                Saturday: 10:00 AM - 4:00 PM<br>
                Sunday: Closed
            </p>
            <hr>
            <div id="map" class="rounded shadow" style="height: 200px;"></div>
        </div>
    </div>
</div>

<script>
    // Google Maps integration with updated coordinates
    function initMap() {
        var location = { lat: -1.2921, lng: 36.8219 }; // Extracted from the Google Maps link
        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: location,
        });
        new google.maps.Marker({ position: location, map: map });
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApK87ffw5OG-FYFLPMZEnrhxpSiTQIjXw&callback=initMap"></script>

<script async defer src="https://maps.app.goo.gl/7EgBhYpqWwnwHDmf9"></script>

<script>
    document.getElementById("contactForm").addEventListener("submit", function(event) {
        let name = document.getElementById("name").value.trim();
        let email = document.getElementById("email").value.trim();
        let message = document.getElementById("message").value.trim();
        
        if (!name || !email || !message) {
            alert("Please fill in all fields.");
            event.preventDefault();
        }
    });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
