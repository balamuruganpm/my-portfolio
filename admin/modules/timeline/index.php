<?php
/**
 * Admin Module: Timeline & Education Manager (Glassmorphic Dark Edition)
 */
$admin_current_page = 'timeline';
$page_title = 'Experience & Education';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$message = '';
$message_type = 'success';

// Handle Add/Edit Experience & Education
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    verifyCsrfToken();
    $action = $_POST['action'];

    if ($action === 'add_experience' || $action === 'edit_experience') {
        $role = isset($_POST['role']) ? trim($_POST['role']) : '';
        $company = isset($_POST['company']) ? trim($_POST['company']) : '';
        $duration = isset($_POST['duration']) ? trim($_POST['duration']) : '';
        $location = isset($_POST['location']) ? trim($_POST['location']) : '';
        $bullets_input = isset($_POST['bullets']) ? trim($_POST['bullets']) : '';

        $bullets = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $bullets_input))));

        if (!empty($role) && !empty($company)) {
            $exp_item = [
                'role' => $role,
                'company' => $company,
                'duration' => $duration,
                'location' => $location,
                'bullets' => array_values($bullets)
            ];

            if ($action === 'add_experience') {
                $data['experience'][] = $exp_item;
                $message = 'Experience entry added successfully!';
            } else {
                $index = (int)$_POST['index'];
                if (isset($data['experience'][$index])) {
                    $data['experience'][$index] = $exp_item;
                    $message = 'Experience entry updated!';
                }
            }
            saveAdminData($data);
        } else {
            $message = 'Role and Company are required fields.';
            $message_type = 'danger';
        }
    }

    if ($action === 'add_education' || $action === 'edit_education') {
        $degree = isset($_POST['degree']) ? trim($_POST['degree']) : '';
        $institution = isset($_POST['institution']) ? trim($_POST['institution']) : '';
        $duration = isset($_POST['duration']) ? trim($_POST['duration']) : '';
        $location = isset($_POST['location']) ? trim($_POST['location']) : '';
        $metric = isset($_POST['metric']) ? trim($_POST['metric']) : '';

        if (!empty($degree) && !empty($institution)) {
            $edu_item = [
                'degree' => $degree,
                'institution' => $institution,
                'duration' => $duration,
                'location' => $location,
                'metric' => $metric
            ];

            if ($action === 'add_education') {
                $data['education'][] = $edu_item;
                $message = 'Education entry added successfully!';
            } else {
                $index = (int)$_POST['index'];
                if (isset($data['education'][$index])) {
                    $data['education'][$index] = $edu_item;
                    $message = 'Education entry updated!';
                }
            }
            saveAdminData($data);
        } else {
            $message = 'Degree and Institution are required fields.';
            $message_type = 'danger';
        }
    }

    // Delete Operations via POST
    if ($action === 'delete_experience') {
        $index = (int)$_POST['index'];
        if (isset($data['experience'][$index])) {
            unset($data['experience'][$index]);
            $data['experience'] = array_values($data['experience']);
            saveAdminData($data);
            $message = 'Experience item deleted!';
        }
    }

    if ($action === 'delete_education') {
        $index = (int)$_POST['index'];
        if (isset($data['education'][$index])) {
            unset($data['education'][$index]);
            $data['education'] = array_values($data['education']);
            saveAdminData($data);
            $message = 'Education item deleted!';
        }
    }
}

// Check Edit Mode
$edit_exp_idx = isset($_GET['edit_exp']) ? (int)$_GET['edit_exp'] : -1;
$edit_exp_item = ($edit_exp_idx >= 0 && isset($data['experience'][$edit_exp_idx])) ? $data['experience'][$edit_exp_idx] : null;

$edit_edu_idx = isset($_GET['edit_edu']) ? (int)$_GET['edit_edu'] : -1;
$edit_edu_item = ($edit_edu_idx >= 0 && isset($data['education'][$edit_edu_idx])) ? $data['education'][$edit_edu_idx] : null;

$experience = $data['experience'] ?? [];
$education = $data['education'] ?? [];

include __DIR__ . '/../../layout/header.php';
?>

<div class="mb-4">
    <h1 class="h3 fw-bold text-white mb-1">Career & Academic Timelines</h1>
    <p class="text-secondary small mb-0">Manage professional experience history, key achievements, and academic credentials</p>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $message_type; ?> border-0 py-3 px-4 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: <?php echo $message_type === 'success' ? 'var(--admin-success-bg)' : 'var(--admin-danger-bg)'; ?>; color: <?php echo $message_type === 'success' ? 'var(--admin-success)' : 'var(--admin-danger)'; ?>;">
        <i class="bi <?php echo $message_type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?>"></i>
        <div><?php echo e($message); ?></div>
    </div>
<?php endif; ?>

<div class="row g-4">
    <!-- Work Timeline Panel -->
    <div class="col-lg-6">
        <div class="admin-card p-4 h-100">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="bi bi-briefcase-fill text-warning"></i> Work Experience</h3>
                <?php if ($edit_exp_item): ?>
                    <a href="index.php" class="btn btn-admin-secondary btn-sm"><i class="bi bi-plus-lg me-1"></i>New Entry</a>
                <?php endif; ?>
            </div>

            <!-- Form -->
            <form method="POST" action="index.php" class="mb-4 pb-4 border-bottom border-secondary border-opacity-25">
                <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                <input type="hidden" name="action" value="<?php echo $edit_exp_item ? 'edit_experience' : 'add_experience'; ?>">
                <?php if ($edit_exp_item): ?>
                    <input type="hidden" name="index" value="<?php echo $edit_exp_idx; ?>">
                <?php endif; ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Role Title</label>
                        <input type="text" name="role" class="form-control" placeholder="Frontend Developer" required value="<?php echo e($edit_exp_item['role'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company" class="form-control" placeholder="RMM Technologies" required value="<?php echo e($edit_exp_item['company'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Duration Period</label>
                        <input type="text" name="duration" class="form-control" placeholder="Jul 2025 – Present" required value="<?php echo e($edit_exp_item['duration'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="Coimbatore, India" value="<?php echo e($edit_exp_item['location'] ?? ''); ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Bullet Highlights (One per line)</label>
                        <textarea name="bullets" rows="3" class="form-control" placeholder="Enter key achievements..." required><?php echo ($edit_exp_item && is_array($edit_exp_item['bullets'])) ? e(implode("\n", $edit_exp_item['bullets'])) : ''; ?></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-admin-primary w-100 justify-content-center py-2.5">
                            <i class="bi <?php echo $edit_exp_item ? 'bi-save' : 'bi-plus-circle'; ?> me-1"></i> <?php echo $edit_exp_item ? 'Save Experience Updates' : 'Add Experience Entry'; ?>
                        </button>
                    </div>
                </div>
            </form>

            <!-- List -->
            <div class="d-flex flex-column gap-3">
                <?php if (empty($experience)): ?>
                    <p class="text-secondary small text-center py-3 mb-0">No experience records found.</p>
                <?php else: ?>
                    <?php foreach ($experience as $idx => $exp): ?>
                        <div class="p-3 rounded-3 border border-secondary border-opacity-25 position-relative" style="background: rgba(15, 23, 42, 0.6);">
                            <div class="position-absolute top-0 end-0 p-3 d-flex gap-2">
                                <a href="index.php?edit_exp=<?php echo $idx; ?>" class="btn btn-admin-secondary btn-sm p-1.5" title="Edit">
                                    <i class="bi bi-pencil-square text-info"></i>
                                </a>
                                <form method="POST" action="index.php" onsubmit="return confirm('Delete this experience entry?');" class="d-inline">
                                    <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                                    <input type="hidden" name="action" value="delete_experience">
                                    <input type="hidden" name="index" value="<?php echo $idx; ?>">
                                    <button type="submit" class="btn btn-admin-secondary btn-sm p-1.5 text-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <h4 class="text-white fw-bold small mb-0 pe-5"><?php echo e($exp['role']); ?></h4>
                            <div class="text-warning small fw-semibold mb-1"><?php echo e($exp['company']); ?></div>
                            <div class="text-secondary small d-flex gap-3 mb-2 flex-wrap" style="font-size: 0.76rem;">
                                <span><i class="bi bi-calendar3 me-1"></i><?php echo e($exp['duration']); ?></span>
                                <span><i class="bi bi-geo-alt me-1"></i><?php echo e($exp['location']); ?></span>
                            </div>
                            <ul class="mb-0 text-secondary ps-3 small" style="font-size: 0.82rem;">
                                <?php foreach ($exp['bullets'] as $bullet): ?>
                                    <li><?php echo e($bullet); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Education Timeline Panel -->
    <div class="col-lg-6">
        <div class="admin-card p-4 h-100">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="bi bi-mortarboard-fill text-info"></i> Education Timeline</h3>
                <?php if ($edit_edu_item): ?>
                    <a href="index.php" class="btn btn-admin-secondary btn-sm"><i class="bi bi-plus-lg me-1"></i>New Entry</a>
                <?php endif; ?>
            </div>

            <!-- Form -->
            <form method="POST" action="index.php" class="mb-4 pb-4 border-bottom border-secondary border-opacity-25">
                <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                <input type="hidden" name="action" value="<?php echo $edit_edu_item ? 'edit_education' : 'add_education'; ?>">
                <?php if ($edit_edu_item): ?>
                    <input type="hidden" name="index" value="<?php echo $edit_edu_idx; ?>">
                <?php endif; ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Degree / Certificate</label>
                        <input type="text" name="degree" class="form-control" placeholder="B.E. Computer Science" required value="<?php echo e($edit_edu_item['degree'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Institution / College</label>
                        <input type="text" name="institution" class="form-control" placeholder="AVS College of Technology" required value="<?php echo e($edit_edu_item['institution'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Duration Period</label>
                        <input type="text" name="duration" class="form-control" placeholder="2021 – 2025" required value="<?php echo e($edit_edu_item['duration'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="Salem, India" value="<?php echo e($edit_edu_item['location'] ?? ''); ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Score / CGPA Metric</label>
                        <input type="text" name="metric" class="form-control" placeholder="CGPA: 8.27 or Percentage: 85%" value="<?php echo e($edit_edu_item['metric'] ?? ''); ?>">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-admin-primary w-100 justify-content-center py-2.5">
                            <i class="bi <?php echo $edit_edu_item ? 'bi-save' : 'bi-plus-circle'; ?> me-1"></i> <?php echo $edit_edu_item ? 'Save Education Updates' : 'Add Education Entry'; ?>
                        </button>
                    </div>
                </div>
            </form>

            <!-- List -->
            <div class="d-flex flex-column gap-3">
                <?php if (empty($education)): ?>
                    <p class="text-secondary small text-center py-3 mb-0">No education records found.</p>
                <?php else: ?>
                    <?php foreach ($education as $idx => $edu): ?>
                        <div class="p-3 rounded-3 border border-secondary border-opacity-25 position-relative" style="background: rgba(15, 23, 42, 0.6);">
                            <div class="position-absolute top-0 end-0 p-3 d-flex gap-2">
                                <a href="index.php?edit_edu=<?php echo $idx; ?>" class="btn btn-admin-secondary btn-sm p-1.5" title="Edit">
                                    <i class="bi bi-pencil-square text-info"></i>
                                </a>
                                <form method="POST" action="index.php" onsubmit="return confirm('Delete this education entry?');" class="d-inline">
                                    <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                                    <input type="hidden" name="action" value="delete_education">
                                    <input type="hidden" name="index" value="<?php echo $idx; ?>">
                                    <button type="submit" class="btn btn-admin-secondary btn-sm p-1.5 text-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <h4 class="text-white fw-bold small mb-0 pe-5"><?php echo e($edu['degree']); ?></h4>
                            <div class="text-info small fw-semibold mb-1"><?php echo e($edu['institution']); ?></div>
                            <div class="text-secondary small d-flex gap-3 mb-2 flex-wrap" style="font-size: 0.76rem;">
                                <span><i class="bi bi-calendar3 me-1"></i><?php echo e($edu['duration']); ?></span>
                                <span><i class="bi bi-geo-alt me-1"></i><?php echo e($edu['location']); ?></span>
                                <?php if (!empty($edu['metric'])): ?>
                                    <span class="admin-badge badge-info-subtle"><?php echo e($edu['metric']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
