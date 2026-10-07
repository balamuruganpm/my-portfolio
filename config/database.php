<?php
/**
 * Database Layer — JSON flat-file data loading and visitor counting
 * Extracted from the old Components/configuration.php
 */

/**
 * Load the main data.json database file
 * @return array The parsed data array
 */
function loadDatabase(): array
{
    $db_file = ADMIN_DATA_PATH . 'data.json';
    if (!file_exists($db_file)) {
        return [];
    }

    $data = json_decode(file_get_contents($db_file), true);
    return is_array($data) ? $data : [];
}

/**
 * Load the blogs.json database file
 * @return array The parsed blogs array
 */
function loadBlogs(): array
{
    $blogs_file = ADMIN_DATA_PATH . 'blogs.json';
    if (!file_exists($blogs_file)) {
        return [];
    }

    $blogs = json_decode(file_get_contents($blogs_file), true);
    return is_array($blogs) ? $blogs : [];
}

/**
 * Increment visitor view count (once per session)
 * @param array &$data Reference to the data array
 */
function trackVisitor(array &$data): void
{
    if (!isset($_SESSION['has_visited'])) {
        $_SESSION['has_visited'] = true;
        $data['views'] = isset($data['views']) ? (int)$data['views'] + 1 : 1;

        $db_file = ADMIN_DATA_PATH . 'data.json';
        @file_put_contents($db_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}

// Load data and track visitor
$data = loadDatabase();
$blogs = loadBlogs();
trackVisitor($data);

// View count (available globally)
$viewCount = isset($data['views']) ? (int)$data['views'] : 0;
