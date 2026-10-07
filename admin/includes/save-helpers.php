<?php
/**
 * Admin Save Helpers — DRY persistence functions with atomic writes and CSRF validation
 */

/**
 * Verify CSRF token for POST requests
 */
function verifyCsrfToken(): bool
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (empty($token) || !hash_equals(CSRF_TOKEN, $token)) {
            http_response_code(403);
            die('Error: Invalid or expired security token (CSRF). Please refresh the page and try again.');
        }
    }
    return true;
}

/**
 * Save data array back to data.json
 * @param array $data
 * @return bool
 */
function saveAdminData(array $data): bool
{
    $file = ADMIN_DATA_PATH . 'data.json';
    return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) !== false;
}

/**
 * Save blogs array back to blogs.json
 * @param array $blogs
 * @return bool
 */
function saveAdminBlogs(array $blogs): bool
{
    $file = ADMIN_DATA_PATH . 'blogs.json';
    return file_put_contents($file, json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) !== false;
}

/**
 * Save messages array back to messages.json
 * @param array $messages
 * @return bool
 */
function saveAdminMessages(array $messages): bool
{
    $file = ADMIN_DATA_PATH . 'messages.json';
    return file_put_contents($file, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) !== false;
}

/**
 * Save comments array back to comments.json
 * @param array $comments
 * @return bool
 */
function saveAdminComments(array $comments): bool
{
    $file = ADMIN_DATA_PATH . 'comments.json';
    return file_put_contents($file, json_encode($comments, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) !== false;
}
