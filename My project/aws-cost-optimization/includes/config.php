<?php
/**
 * AWS Cost Optimizer Configuration
 * 
 * Centralized settings for the project to ensure portability between 
 * local development (WAMP) and production (InfinityFree).
 */

// Start session for CSRF protection
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Site Information
define('SITE_NAME', 'Cloud Cost Solutions');
define('SITE_FOUNDERS', 'Het Bhalodiya & Takshay Bhalodiya');
define('CONTACT_EMAIL', 'takshaybhalodiya777@gmail.com');
define('WHATSAPP_NUMBER', '6352001097');
define('WHATSAPP_LINK', 'https://wa.me/916352001097');

// SMTP Configuration (For PHPMailer)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USER', 'takshaybhalodiya777@gmail.com');
define('SMTP_PASS', 'cixwkjtfmlglxuud');
define('SMTP_PORT', 587);
define('SMTP_AUTH', true);
define('SMTP_ENCRYPTION', 'tls'); // 'tls' or 'ssl'
define('FROM_EMAIL', 'takshaybhalodiya777@gmail.com');
define('FROM_NAME', SITE_NAME);

// CSRF Protection Functions
function generate_csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token)
{
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}

// Simple Rate Limiting (Cooldown between submissions)
function check_rate_limit($seconds = 60)
{
    if (isset($_SESSION['last_submission_time'])) {
        $elapsed = time() - $_SESSION['last_submission_time'];
        if ($elapsed < $seconds) {
            return false;
        }
    }
    return true;
}

function update_submission_time()
{
    $_SESSION['last_submission_time'] = time();
}

// Base URL Configuration
// Automatically detects if running locally or on a domain
if ($_SERVER['HTTP_HOST'] === 'localhost' || str_contains($_SERVER['HTTP_HOST'], '127.0.0.1')) {
    // Local development path (update if your folder name is different)
    define('BASE_URL', 'http://localhost/aws-cost-optimization/');
} else {
    // Production domain (InifinityFree will use your actual domain)
    // Using a dynamic approach for production as well
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? 'https' : 'http';
    define('BASE_URL', $protocol . '://' . $_SERVER['HTTP_HOST'] . '/');
}

// Development mode (set to false in production)
define('DEV_MODE', ($_SERVER['HTTP_HOST'] === 'localhost'));
?>