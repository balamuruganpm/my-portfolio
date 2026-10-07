<?php
/**
 * Core Bootstrap — Central entry point for all public pages
 * Replaces the old $folderPath relative path system with constants.
 */

// Start session if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Absolute filesystem path to project root
define('BASE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// Admin data directory path
define('ADMIN_DATA_PATH', BASE_PATH . 'admin' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);

// Environment detection with CLI fallback
$_httpHost = $_SERVER['HTTP_HOST'] ?? 'localhost';
$_isLocal = in_array($_httpHost, ['localhost', '127.0.0.1'])
    || strpos($_httpHost, '.test') !== false
    || strpos($_httpHost, '.local') !== false;

define('IS_LOCAL', $_isLocal);
define('PROTOCOL', IS_LOCAL ? 'http://' : 'https://');

// Canonical production URL (used in SEO schemas, sitemap, etc.)
define('SITE_URL', 'https://balamuruganpm.unaux.com/');

// Calculate the web-accessible root URL dynamically
// Compares project directory with document root or falls back to script name
$_docRoot = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'] ?? '') ?: '');
$_basePath = str_replace('\\', '/', realpath(dirname(__DIR__)) ?: '');

if (!empty($_docRoot) && strpos($_basePath, $_docRoot) === 0) {
    $_webRoot = substr($_basePath, strlen($_docRoot));
} else {
    $_scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
    $_pos = strpos($_scriptName, '/admin');
    if ($_pos !== false) {
        $_webRoot = substr($_scriptName, 0, $_pos);
    } else {
        $_pos = strpos($_scriptName, '/pages');
        if ($_pos !== false) {
            $_webRoot = substr($_scriptName, 0, $_pos);
        } else {
            $_webRoot = dirname($_scriptName);
        }
    }
}

if ($_webRoot === '.' || $_webRoot === '/') {
    $_webRoot = '';
}
$_webRoot = rtrim($_webRoot, '/');
define('BASE_URL', PROTOCOL . $_httpHost . (!empty($_webRoot) ? $_webRoot : '') . '/');

// Canonical URL for the current page
$_requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$_canonicalPath = parse_url($_requestUri, PHP_URL_PATH) ?? '/';
define('CANONICAL_URL', PROTOCOL . $_httpHost . $_canonicalPath);

// Enable output buffering with dynamic Gzip compression
$_zlibActive = ini_get('zlib.output_compression');
if ($_zlibActive === '1' || strtolower((string)$_zlibActive) === 'on') {
    ob_start();
} else {
    if (@ini_set('zlib.output_compression', 'On') !== false) {
        ob_start();
    } else {
        if (extension_loaded('zlib') && !headers_sent()) {
            ob_start('ob_gzhandler');
        } else {
            ob_start();
        }
    }
}

// Load configuration, data, and helpers
require_once BASE_PATH . 'config/constants.php';
require_once BASE_PATH . 'config/database.php';
require_once BASE_PATH . 'includes/helpers.php';
require_once BASE_PATH . 'includes/data-extractor.php';

// Send UTF-8 HTTP Header
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
