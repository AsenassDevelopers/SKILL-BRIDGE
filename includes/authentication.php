<?php
// authentication.php - User authentication and authorization functions

/**
 * Start secure session with strict settings
 */
function startSecureSession() {
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_secure', 1); // Enable in production with HTTPS
        ini_set('session.use_strict_mode', 1);
        session_start();
        
        // Regenerate session ID if it's too old
        if (!isset($_SESSION['last_regeneration'])) {
            $_SESSION['last_regeneration'] = time();
        } elseif (time() - $_SESSION['last_regeneration'] > 1800) { // 30 minutes
            session_regenerate_id(true);
            $_SESSION['last_regeneration'] = time();
        }
    }
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    startSecureSession();
    return isset($_SESSION['user_id'], $_SESSION['user_type'], $_SESSION['ip_address'], $_SESSION['user_agent']) && 
           $_SESSION['ip_address'] === $_SERVER['REMOTE_ADDR'] && 
           $_SESSION['user_agent'] === $_SERVER['HTTP_USER_AGENT'];
}

/**
 * Verify user has specific role
 */
function hasRole($role) {
    return isLoggedIn() && $_SESSION['user_type'] === $role;
}

/**
 * Redirect unauthorized access
 */
function redirectUnauthorized($role = 'user') {
    if (!isLoggedIn()) {
        header("Location: /skillbridge/public/login.php");
        exit();
    }
    
    if (!hasRole($role)) {
        header("Location: /skillbridge/public/unauthorized.php");
        exit();
    }
}

/**
 * Login user and set session variables
 */
function loginUser($user) {
    startSecureSession();
    
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['user_type'] = $user['user_type'];
    $_SESSION['profile_pic'] = $user['profile_pic'] ?? null;
    $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['last_activity'] = time();
    
    // Regenerate session ID to prevent fixation
    session_regenerate_id(true);
}

/**
 * Escape output to prevent XSS
 */
function e($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

/**
 * Verify login credentials
 */
function verifyCredentials($pdo, $username, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    
    return false;
}

/**
 * Get current user ID
 */
function getCurrentUserId() {
    return isLoggedIn() ? $_SESSION['user_id'] : null;
}

/**
 * Logout user and destroy session
 */
function logoutUser() {
    startSecureSession();
    
    // Unset all session variables
    $_SESSION = array();
    
    // Delete session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Destroy session
    session_destroy();
}