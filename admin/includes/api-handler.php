<?php
/**
 * Admin Central API Controller (AJAX Endpoint)
 * Processes JSON requests for dynamic administrative actions with CSRF protection.
 */
header('Content-Type: application/json; charset=utf-8');

// Load Admin Bootstrap
require_once __DIR__ . '/../config/admin-bootstrap.php';

// Action router
$action = $_REQUEST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF
    $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (empty($token) || !hash_equals(CSRF_TOKEN, $token)) {
        http_response_code(403);
        echo json_encode(['status' => 'error', 'message' => 'Security token (CSRF) validation failed.']);
        exit();
    }
}

switch ($action) {
    case 'mark_message':
        $index = isset($_POST['index']) ? (int)$POST['index'] : -1;
        $read = isset($_POST['read']) ? (bool)$_POST['read'] : true;
        
        if (isset($messages[$index])) {
            $messages[$index]['read'] = $read;
            if (saveAdminMessages($messages)) {
                echo json_encode(['status' => 'success', 'message' => 'Message status updated.', 'unreadCount' => count(array_filter($messages, fn($m) => !($m['read'] ?? false)))]);
                exit();
            }
        }
        echo json_encode(['status' => 'error', 'message' => 'Failed to update message status.']);
        exit();

    case 'delete_message':
        $index = isset($_POST['index']) ? (int)$_POST['index'] : -1;
        if (isset($messages[$index])) {
            array_splice($messages, $index, 1);
            if (saveAdminMessages($messages)) {
                echo json_encode(['status' => 'success', 'message' => 'Message deleted successfully.']);
                exit();
            }
        }
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete message.']);
        exit();

    case 'delete_portfolio':
        $id = $_POST['id'] ?? '';
        if (!empty($id) && isset($data['projects'])) {
            $initialCount = count($data['projects']);
            $data['projects'] = array_values(array_filter($data['projects'], fn($p) => ($p['id'] ?? '') !== $id));
            if (count($data['projects']) < $initialCount) {
                if (saveAdminData($data)) {
                    echo json_encode(['status' => 'success', 'message' => 'Portfolio project deleted.']);
                    exit();
                }
            }
        }
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete portfolio project.']);
        exit();

    case 'toggle_blog_status':
        $slug = $_POST['slug'] ?? '';
        if (!empty($slug)) {
            foreach ($blogs as &$b) {
                if (($b['slug'] ?? '') === $slug) {
                    $b['status'] = ($b['status'] ?? 'published') === 'published' ? 'draft' : 'published';
                    if (saveAdminBlogs($blogs)) {
                        echo json_encode(['status' => 'success', 'message' => 'Blog status toggled to ' . $b['status'], 'newStatus' => $b['status']]);
                        exit();
                    }
                }
            }
        }
        echo json_encode(['status' => 'error', 'message' => 'Failed to toggle blog status.']);
        exit();

    case 'delete_blog':
        $slug = $_POST['slug'] ?? '';
        if (!empty($slug)) {
            $initialCount = count($blogs);
            $blogs = array_values(array_filter($blogs, fn($b) => ($b['slug'] ?? '') !== $slug));
            if (count($blogs) < $initialCount) {
                if (saveAdminBlogs($blogs)) {
                    echo json_encode(['status' => 'success', 'message' => 'Blog article removed.']);
                    exit();
                }
            }
        }
        echo json_encode(['status' => 'error', 'message' => 'Failed to remove blog article.']);
        exit();

    default:
        echo json_encode(['status' => 'error', 'message' => 'Unknown or unsupported action.']);
        exit();
}
