<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /admin/login.php');
        exit;
    }
}

function loginUser($userId, $username) {
    // Prevent session fixation
    session_regenerate_id(true);
    
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    $_SESSION['last_activity'] = time();
}

function logoutUser() {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

// Session timeout (e.g., 2 hours)
$timeout_duration = 7200;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    logoutUser();
    if (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false && strpos($_SERVER['REQUEST_URI'], '/admin/login.php') === false) {
        header('Location: /admin/login.php?msg=timeout');
        exit;
    }
}

if (isset($_SESSION['user_id'])) {
    $_SESSION['last_activity'] = time();
}

// CSRF Protection
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrfToken($token) {
    if (empty($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}
