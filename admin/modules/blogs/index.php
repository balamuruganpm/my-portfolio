<?php
/**
 * Admin Module: Blogs & Articles Manager (Glassmorphic Dark Edition)
 */
$admin_current_page = 'blogs';
$page_title = 'Blogs & Articles';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$message = '';
$message_type = 'success';

// Handle Delete Post via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    verifyCsrfToken();
    $id = (int)$_POST['id'];
    foreach ($blogs as $idx => $blog) {
        if ((int)$blog['id'] === $id) {
            // Remove associated files
            if (!empty($blog['image']) && file_exists(BASE_PATH . $blog['image'])) {
                @unlink(BASE_PATH . $blog['image']);
            }
            if (!empty($blog['pdf']) && file_exists(BASE_PATH . $blog['pdf'])) {
                @unlink(BASE_PATH . $blog['pdf']);
            }
            if (!empty($blog['video']) && file_exists(BASE_PATH . $blog['video'])) {
                @unlink(BASE_PATH . $blog['video']);
            }

            unset($blogs[$idx]);
            $blogs = array_values($blogs);
            if (saveAdminBlogs($blogs)) {
                $message = 'Blog post and associated files deleted!';
            }
            break;
        }
    }
}

if (isset($_GET['message'])) {
    if ($_GET['message'] === 'added') $message = 'Article published successfully!';
    if ($_GET['message'] === 'updated') $message = 'Article updated successfully!';
}

include __DIR__ . '/../../layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h1 class="h3 fw-bold text-white mb-1">Blogs & Articles Engine</h1>
        <p class="text-secondary small mb-0">Write tutorials, technical guides, career insights, and manage discussions</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <div class="search-command-bar d-none d-md-block" style="max-width: 250px;">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control form-control-sm" placeholder="Search articles..." data-table-search="#blogs-table">
        </div>
        <a href="add.php" class="btn btn-admin-primary">
            <i class="bi bi-pencil-square me-1"></i> Write New Article
        </a>
    </div>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $message_type; ?> border-0 py-3 px-4 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: <?php echo $message_type === 'success' ? 'var(--admin-success-bg)' : 'var(--admin-danger-bg)'; ?>; color: <?php echo $message_type === 'success' ? 'var(--admin-success)' : 'var(--admin-danger)'; ?>;">
        <i class="bi <?php echo $message_type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?>"></i>
        <div><?php echo e($message); ?></div>
    </div>
<?php endif; ?>

<div class="admin-table-wrapper">
    <table class="table admin-table" id="blogs-table">
        <thead>
            <tr>
                <th style="width: 70px;">Cover</th>
                <th>Date</th>
                <th>Article Title</th>
                <th>Category</th>
                <th>Views</th>
                <th>Discussion</th>
                <th class="text-end" style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($blogs)): ?>
                <tr>
                    <td colspan="7" class="text-center py-5 text-secondary">
                        <i class="bi bi-journal-x fs-2 d-block mb-2 text-muted"></i>
                        No blog posts found. Click "Write New Article" to publish.
                    </td>
                </tr>
            <?php else: ?>
                <?php 
                $display_blogs = array_reverse($blogs);
                foreach ($display_blogs as $blog): 
                    $cat_label = !empty($blog['category']) ? $blog['category'] : 'Blog';
                    $thumb_img = !empty($blog['image']) ? BASE_URL . $blog['image'] : BASE_URL . 'assets/images/placeholder.webp';
                    
                    $comm_count = 0;
                    foreach ($comments as $c) {
                        if (isset($c['blog_id']) && (int)$c['blog_id'] === (int)$blog['id']) {
                            $comm_count++;
                        }
                    }
                    $short_url = BASE_URL . 'blogs/detail?id=' . $blog['id'];
                ?>
                    <tr>
                        <td>
                            <img src="<?php echo e($thumb_img); ?>" alt="<?php echo e($blog['title']); ?> Thumbnail" title="<?php echo e($blog['title']); ?> Thumbnail" class="rounded-3 border border-secondary border-opacity-25" style="width: 44px; height: 44px; object-fit: cover;">
                        </td>
                        <td>
                            <span class="text-secondary small"><?php echo date('M d, Y', strtotime($blog['date'])); ?></span>
                        </td>
                        <td>
                            <span class="fw-bold text-white d-block"><?php echo e($blog['title']); ?></span>
                        </td>
                        <td>
                            <span class="admin-badge badge-accent-subtle"><?php echo e($cat_label); ?></span>
                        </td>
                        <td>
                            <span class="text-secondary small"><i class="bi bi-eye me-1 text-info"></i><?php echo number_format($blog['views'] ?? 0); ?></span>
                        </td>
                        <td>
                            <span class="admin-badge <?php echo $comm_count > 0 ? 'badge-warning-subtle' : 'badge-info-subtle'; ?>">
                                <i class="bi bi-chat-left-text me-1"></i><?php echo $comm_count; ?>
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <button type="button" class="btn btn-admin-secondary btn-sm p-1.5 text-warning" onclick="copyShortlink('<?php echo $short_url; ?>', this)" title="Copy Shortlink">
                                    <i class="bi bi-lightning-fill"></i>
                                </button>
                                <a href="add.php?edit_id=<?php echo $blog['id']; ?>" class="btn btn-admin-secondary btn-sm p-1.5" title="Edit">
                                    <i class="bi bi-pencil-square text-info"></i>
                                </a>
                                <form method="POST" action="index.php" onsubmit="return confirm('Delete this blog article and media files?');" class="d-inline">
                                    <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">
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

<?php include __DIR__ . '/../../layout/footer.php'; ?>
