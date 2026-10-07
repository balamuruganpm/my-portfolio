<?php
/**
 * Admin Module: Messages & Inquiries Inbox
 */
$admin_current_page = 'messages';
$page_title = 'Messages Inbox';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$message = '';
$message_type = 'success';

// Handle Mark Read / Delete via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    verifyCsrfToken();
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($action === 'toggle_read') {
        foreach ($messages as &$m) {
            if ((int)$m['id'] === $id) {
                $m['read'] = !isset($m['read']) || !$m['read'];
                break;
            }
        }
        if (saveAdminMessages($messages)) {
            $message = 'Message status updated!';
        }
    }

    if ($action === 'delete') {
        foreach ($messages as $idx => $m) {
            if ((int)$m['id'] === $id) {
                unset($messages[$idx]);
                $messages = array_values($messages);
                if (saveAdminMessages($messages)) {
                    $message = 'Message deleted!';
                }
                break;
            }
        }
    }
}

// Re-calculate unread count
$unread_count = 0;
foreach ($messages as $m) {
    if (!isset($m['read']) || $m['read'] === false) $unread_count++;
}

include __DIR__ . '/../../layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h1 class="h3 fw-bold text-white mb-1 font-title">Messages & Inquiries</h1>
        <p class="text-secondary small mb-0">Review incoming submissions sent via your portfolio contact form</p>
    </div>
    <div class="d-flex align-items-center gap-3">
        <input type="text" class="form-control form-control-admin text-white search-input" style="max-width: 240px;" placeholder="Search inbox..." data-table="admin-table">
        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill">
            <i class="bi bi-envelope me-1"></i><?php echo $unread_count; ?> Unread Inquiries
        </span>
    </div>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $message_type; ?> border-0 py-3 px-4 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: <?php echo $message_type === 'success' ? 'var(--admin-success-bg)' : 'var(--admin-danger-bg)'; ?>; color: <?php echo $message_type === 'success' ? 'var(--admin-success)' : 'var(--admin-danger)'; ?>;">
        <i class="bi <?php echo $message_type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?>"></i>
        <div><?php echo e($message); ?></div>
    </div>
<?php endif; ?>

<div class="card admin-card overflow-hidden">
    <div class="table-responsive">
        <table class="admin-table align-middle">
            <thead>
                <tr>
                    <th style="width: 100px;">Status</th>
                    <th>Date</th>
                    <th>Sender Name</th>
                    <th>Contact Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th class="text-end" style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($messages)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-5 text-secondary">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                            No messages in your inbox.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php 
                    $sorted_msgs = array_reverse($messages);
                    foreach ($sorted_msgs as $msg): 
                        $is_read = isset($msg['read']) && $msg['read'] === true;
                    ?>
                        <tr style="<?php echo !$is_read ? 'background: rgba(99, 102, 241, 0.05);' : ''; ?>">
                            <td>
                                <span class="badge <?php echo $is_read ? 'bg-secondary-subtle text-secondary' : 'bg-primary-subtle text-primary border border-primary-subtle'; ?> rounded-pill px-2.5 py-1">
                                    <?php echo $is_read ? 'Read' : 'New'; ?>
                                </span>
                            </td>
                            <td>
                                <span class="text-secondary small font-mono"><?php echo date('M d, Y h:i A', strtotime($msg['date'])); ?></span>
                            </td>
                            <td>
                                <span class="fw-bold text-white"><?php echo e($msg['name']); ?></span>
                            </td>
                            <td>
                                <a href="mailto:<?php echo e($msg['email']); ?>" class="text-accent text-decoration-none small font-mono"><?php echo e($msg['email']); ?></a>
                            </td>
                            <td>
                                <span class="fw-semibold text-white small"><?php echo e($msg['subject']); ?></span>
                            </td>
                            <td>
                                <span class="text-secondary small" style="max-width: 320px; display: inline-block; white-space: pre-wrap;"><?php echo e($msg['message']); ?></span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <form method="POST" action="index.php" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                                        <input type="hidden" name="action" value="toggle_read">
                                        <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                                        <button type="submit" class="btn btn-admin-secondary btn-sm p-1.5" title="<?php echo $is_read ? 'Mark as Unread' : 'Mark as Read'; ?>">
                                            <i class="bi <?php echo $is_read ? 'bi-envelope' : 'bi-envelope-open'; ?>"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="index.php" onsubmit="return confirm('Delete this message?');" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                                        <button type="submit" class="btn btn-admin-secondary btn-sm p-1.5 text-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
