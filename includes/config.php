<?php
session_start();
require_once __DIR__ . '/../database/db.php';

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /skillbridge/public/login.php");
        exit();
    }
}

// Redirect based on user type
function redirectBasedOnUserType() {
    if (isLoggedIn()) {
        switch ($_SESSION['user_type']) {
            case 'admin':
                header("Location: /skillbridge/admin_dashboard/dashboard.php");
                break;
            case 'provider':
                header("Location: /skillbridge/provider_dashboard/dashboard.php");
                break;
            default:
                header("Location: /skillbridge/user_dashboard/dashboard.php");
        }
        exit();
    }
}

// Simple function to escape HTML output
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>