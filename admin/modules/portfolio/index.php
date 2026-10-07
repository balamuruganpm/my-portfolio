<?php
/**
 * Admin Module: Portfolio Works Manager
 */
$admin_current_page = 'portfolio';
$page_title = 'Portfolio Works';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$message = '';
$message_type = 'success';

// Handle Delete Project via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    verifyCsrfToken();
    $index = (int)$_POST['index'];
    if (isset($data['projects'][$index])) {
        unset($data['projects'][$index]);
        $data['projects'] = array_values($data['projects']);
        if (saveAdminData($data)) {
            $message = 'Project deleted successfully!';
        }
    }
}

if (isset($_GET['message'])) {
    if ($_GET['message'] === 'added') $message = 'Project created successfully!';
    if ($_GET['message'] === 'updated') $message = 'Project updated successfully!';
}

$projects = $data['projects'] ?? [];

include __DIR__ . '/../../layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1 font-title">Portfolio Works Gallery</h1>
        <p class="text-secondary small mb-0">List, add, edit, and organize your featured projects</p>
    </div>
    <a href="add.php" class="btn btn-warning-custom">
        <i class="bi bi-plus-lg"></i> Add New Project
    </a>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $message_type; ?> border-0 py-3 px-4 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: <?php echo $message_type === 'success' ? 'var(--admin-success-bg)' : 'var(--admin-danger-bg)'; ?>; color: <?php echo $message_type === 'success' ? 'var(--admin-success)' : 'var(--admin-danger)'; ?>;">
        <i class="bi <?php echo $message_type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?>"></i>
        <div><?php echo e($message); ?></div>
    </div>
<?php endif; ?>

<div class="card admin-card overflow-hidden">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 80px;">Thumbnail</th>
                    <th>Project Title</th>
                    <th>Tagline / Description</th>
                    <th>Tags</th>
                    <th class="text-end" style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($projects)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-secondary">
                            <i class="bi bi-folder-x fs-2 d-block mb-2 text-muted"></i>
                            No projects found. Click "Add New Project" to get started.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($projects as $idx => $proj): 
                        $img = !empty($proj['image']) ? BASE_URL . $proj['image'] : BASE_URL . 'assets/images/placeholder.webp';
                    ?>
                        <tr>
                            <td>
                                <img src="<?php echo e($img); ?>" alt="<?php echo e($proj['title']); ?> Thumbnail" title="<?php echo e($proj['title']); ?> Thumbnail" class="rounded-3 border border-secondary-subtle" style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td>
                                <span class="fw-bold text-dark"><?php echo e($proj['title']); ?></span>
                            </td>
                            <td class="text-secondary small"><?php echo e($proj['tagline'] ?? ''); ?></td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <?php foreach ($proj['tags'] ?? [] as $tag): ?>
                                        <span class="badge bg-secondary-subtle text-secondary small"><?php echo e($tag); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="add.php?edit_index=<?php echo $idx; ?>" class="btn btn-admin-secondary btn-sm p-1.5" title="Edit">
                                        <i class="bi bi-pencil-square text-info"></i>
                                    </a>
                                    <form method="POST" action="index.php" onsubmit="return confirm('Delete this project?');" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="index" value="<?php echo $idx; ?>">
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
