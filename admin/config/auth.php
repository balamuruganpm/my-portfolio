<?php
/**
 * Admin Auth Guard
 * Checks if user is authenticated; if not, redirects to the admin login page
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Determine the base URL for redirect
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    
    // Find where /admin is in the script dir
    $adminPos = strpos($scriptDir, '/admin');
    if ($adminPos !== false) {
        $adminBase = substr($scriptDir, 0, $adminPos + 6);
    } else {
        $adminBase = '/admin';
    }
    
    header("Location: " . $protocol . $_SERVER['HTTP_HOST'] . $adminBase . "/index.php");
    exit();
}
