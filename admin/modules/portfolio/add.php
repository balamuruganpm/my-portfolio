<?php
/**
 * Admin Module: Add / Edit Portfolio Project (Glassmorphic Dark Edition)
 */
$admin_current_page = 'portfolio';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$edit_index = isset($_GET['edit_index']) ? (int)$_GET['edit_index'] : -1;
$editing_project = ($edit_index >= 0 && isset($data['projects'][$edit_index])) ? $data['projects'][$edit_index] : null;

$page_title = $editing_project ? 'Edit Project' : 'Add Project';
$message = '';
$message_type = 'danger';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    verifyCsrfToken();
    $action = $_POST['action'];
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $tagline = isset($_POST['tagline']) ? trim($_POST['tagline']) : '';
    $link = isset($_POST['link']) ? trim($_POST['link']) : '';
    $tags_input = isset($_POST['tags']) ? trim($_POST['tags']) : '';
    $bullets_input = isset($_POST['bullets']) ? trim($_POST['bullets']) : '';

    $tags = array_filter(array_map('trim', explode(',', $tags_input)));
    $bullets = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $bullets_input))));

    // Handle Image Upload
    $image_path = ($editing_project) ? $editing_project['image'] : 'assets/images/placeholder.webp';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img_dir = BASE_PATH . 'uploads/images/';
        if (!is_dir($img_dir)) {
            mkdir($img_dir, 0755, true);
        }
        $filename = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", basename($_FILES['image']['name']));
        if (move_uploaded_file($_FILES['image']['tmp_name'], $img_dir . $filename)) {
            $image_path = 'uploads/images/' . $filename;
        }
    }

    if (!empty($title)) {
        $project_data = [
            'title' => $title,
            'tagline' => $tagline,
            'bullets' => $bullets,
            'tags' => $tags,
            'image' => $image_path,
            'link' => $link
        ];

        if ($action === 'add') {
            $data['projects'][] = $project_data;
            $redirect_msg = "added";
        } elseif ($action === 'edit' && $edit_index >= 0) {
            $data['projects'][$edit_index] = $project_data;
            $redirect_msg = "updated";
        }

        if (saveAdminData($data)) {
            header("Location: index.php?message=" . $redirect_msg);
            exit();
        } else {
            $message = 'Failed to write project to data.json.';
        }
    } else {
        $message = 'Project title is required.';
    }
}

include __DIR__ . '/../../layout/header.php';
?>

<div class="mb-4 d-flex align-items-center gap-3">
    <a href="index.php" class="btn btn-admin-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
    <div>
        <h1 class="h3 fw-bold text-white mb-1"><?php echo $editing_project ? 'Edit Portfolio Project' : 'Add New Portfolio Project'; ?></h1>
        <p class="text-secondary small mb-0">Publish or update showcase cards in your public portfolio gallery</p>
    </div>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-danger border-0 py-3 px-4 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: var(--admin-danger-bg); color: var(--admin-danger);">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div><?php echo e($message); ?></div>
    </div>
<?php endif; ?>

<form method="POST" action="add.php<?php echo $editing_project ? '?edit_index=' . $edit_index : ''; ?>" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
    <input type="hidden" name="action" value="<?php echo $editing_project ? 'edit' : 'add'; ?>">

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card p-4 p-md-5 mb-4">
                <div class="mb-4">
                    <label class="form-label">Project Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Vocalease" required value="<?php echo e($editing_project['title'] ?? ''); ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label">Tagline Summary</label>
                    <input type="text" name="tagline" class="form-control" placeholder="e.g. Accessible Communication Platform" required value="<?php echo e($editing_project['tagline'] ?? ''); ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label">Live Project or GitHub Link</label>
                    <input type="url" name="link" class="form-control" placeholder="https://github.com/..." value="<?php echo e($editing_project['link'] ?? ''); ?>">
                </div>
                <div class="mb-0">
                    <label class="form-label">Feature Highlights (One per line)</label>
                    <textarea name="bullets" rows="5" class="form-control" placeholder="Enter key feature bullets..." required><?php echo ($editing_project && is_array($editing_project['bullets'])) ? e(implode("\n", $editing_project['bullets'])) : ''; ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary px-5 py-2.5">
                <i class="bi bi-check2-circle me-1"></i> <?php echo $editing_project ? 'Save Project Changes' : 'Publish Project'; ?>
            </button>
        </div>

        <div class="col-lg-4">
            <div class="admin-card p-4 mb-4">
                <h3 class="admin-card-title mb-3"><i class="bi bi-tags-fill text-warning"></i> Technologies & Tags</h3>
                <label class="form-label">Tags (comma-separated)</label>
                <input type="text" name="tags" class="form-control" placeholder="React.js, Accessibility, CSS3" required value="<?php echo ($editing_project && is_array($editing_project['tags'])) ? e(implode(', ', $editing_project['tags'])) : ''; ?>">
            </div>

            <div class="admin-card p-4">
                <h3 class="admin-card-title mb-3"><i class="bi bi-image-fill text-info"></i> Cover Image</h3>
                <?php if ($editing_project && !empty($editing_project['image'])): ?>
                    <div class="mb-3 text-center">
                        <img src="<?php echo BASE_URL . e($editing_project['image']); ?>" alt="<?php echo e($editing_project['title']); ?> Cover Preview" title="<?php echo e($editing_project['title']); ?> Cover Preview" class="rounded-3 border border-secondary border-opacity-25 w-100" style="max-height: 140px; object-fit: cover;">
                    </div>
                <?php endif; ?>
                <label class="form-label"><?php echo $editing_project ? 'Replace Image' : 'Upload Image'; ?></label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
        </div>
    </div>
</form>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
