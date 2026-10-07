<?php
/**
 * Admin Bootstrap — Central loader for all admin modules
 * Handles authentication, CSRF tokens, database loading, and shared metrics
 */

// Define page depth for admin modules (typically 2 levels: admin/modules/xxx/)
if (!defined('PAGE_DEPTH')) {
    define('PAGE_DEPTH', 2);
}

// Load core bootstrap
require_once __DIR__ . '/../../config/bootstrap.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../includes/save-helpers.php';

// Generate CSRF Token for form submissions
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
define('CSRF_TOKEN', $_SESSION['csrf_token']);

// Load databases
$db_file = ADMIN_DATA_PATH . 'data.json';
$data = file_exists($db_file) ? (json_decode(file_get_contents($db_file), true) ?: []) : [];

$blogs_file = ADMIN_DATA_PATH . 'blogs.json';
$blogs = file_exists($blogs_file) ? (json_decode(file_get_contents($blogs_file), true) ?: []) : [];

$msgs_file = ADMIN_DATA_PATH . 'messages.json';
$messages = file_exists($msgs_file) ? (json_decode(file_get_contents($msgs_file), true) ?: []) : [];

$comments_file = ADMIN_DATA_PATH . 'comments.json';
$comments = file_exists($comments_file) ? (json_decode(file_get_contents($comments_file), true) ?: []) : [];

// Compute unread message count
$unread_count = 0;
foreach ($messages as $m) {
    if (!isset($m['read']) || $m['read'] === false) {
        $unread_count++;
    }
}

// Current logged in user
$current_admin_user = $_SESSION['admin_username'] ?? 'Admin';
