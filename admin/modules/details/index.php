<?php
/**
 * Admin Module: Skills, Tools, Awards, and Certifications
 */
$admin_current_page = 'details';
$page_title = 'Skills & Details';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$message = '';
$message_type = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    verifyCsrfToken();
    $action = $_POST['action'];

    // 1. Update Technical Skills (comma separated)
    if ($action === 'update_skills') {
        $skills_input = isset($_POST['skills']) ? trim($_POST['skills']) : '';
        $skills = array_filter(array_map('trim', explode(',', $skills_input)));
        $data['skills'] = array_values($skills);

        if (saveAdminData($data)) {
            $message = 'Technical skills updated!';
        }
    }

    // 2. Update Tools (comma separated)
    if ($action === 'update_tools') {
        $tools_input = isset($_POST['tools']) ? trim($_POST['tools']) : '';
        $tools = array_filter(array_map('trim', explode(',', $tools_input)));
        $data['tools'] = array_values($tools);

        if (saveAdminData($data)) {
            $message = 'Development tools updated!';
        }
    }

    // 3. Add Award
    if ($action === 'add_award') {
        $title = isset($_POST['award_title']) ? trim($_POST['award_title']) : '';
        $desc = isset($_POST['award_desc']) ? trim($_POST['award_desc']) : '';

        if (!empty($title)) {
            $data['awards'][] = ['title' => $title, 'description' => $desc];
            saveAdminData($data);
            $message = 'Award entry added!';
        }
    }

    // 4. Delete Award
    if ($action === 'delete_award') {
        $idx = (int)$_POST['index'];
        if (isset($data['awards'][$idx])) {
            unset($data['awards'][$idx]);
            $data['awards'] = array_values($data['awards']);
            saveAdminData($data);
            $message = 'Award entry removed!';
        }
    }

    // 5. Add Certificate
    if ($action === 'add_cert') {
        $name = isset($_POST['cert_name']) ? trim($_POST['cert_name']) : '';
        $issuer = isset($_POST['cert_issuer']) ? trim($_POST['cert_issuer']) : '';

        if (!empty($name)) {
            $data['certificates'][] = ['name' => $name, 'issuer' => $issuer];
            saveAdminData($data);
            $message = 'Certificate entry added!';
        }
    }

    // 6. Delete Certificate
    if ($action === 'delete_cert') {
        $idx = (int)$_POST['index'];
        if (isset($data['certificates'][$idx])) {
            unset($data['certificates'][$idx]);
            $data['certificates'] = array_values($data['certificates']);
            saveAdminData($data);
            $message = 'Certificate entry removed!';
        }
    }
}

$skills_str = isset($data['skills']) ? implode(', ', array_map(fn($s) => is_array($s) ? ($s['name'] ?? '') : $s, $data['skills'])) : '';
$tools_str = isset($data['tools']) ? implode(', ', $data['tools']) : '';
$awards = $data['awards'] ?? [];
$certificates = $data['certificates'] ?? [];

include __DIR__ . '/../../layout/header.php';
?>

<div class="mb-4">
    <h1 class="h3 fw-bold text-dark mb-1 font-title">Skills, Tools & Accreditations</h1>
    <p class="text-secondary small mb-0">Manage technical proficiencies, development software, awards, and certifications</p>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $message_type; ?> border-0 py-3 px-4 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: <?php echo $message_type === 'success' ? 'var(--admin-success-bg)' : 'var(--admin-danger-bg)'; ?>; color: <?php echo $message_type === 'success' ? 'var(--admin-success)' : 'var(--admin-danger)'; ?>;">
        <i class="bi <?php echo $message_type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?>"></i>
        <div><?php echo e($message); ?></div>
    </div>
<?php endif; ?>

<div class="row g-4">
    <!-- Skills & Tools Columns -->
    <div class="col-lg-6">
        <div class="card admin-card p-4 mb-4">
            <h3 class="h5 fw-bold text-dark mb-2 font-title"><i class="bi bi-code-slash text-accent me-2"></i>Technical Skills</h3>
            <p class="text-secondary small mb-3">Comma-separated list of programming languages and libraries</p>
            
            <form method="POST" action="index.php">
                <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                <input type="hidden" name="action" value="update_skills">
                <textarea name="skills" rows="4" class="form-control mb-3" placeholder="React.js, JavaScript, HTML5..."><?php echo e($skills_str); ?></textarea>
                <button type="submit" class="btn btn-warning-custom btn-sm">Save Skills</button>
            </form>
        </div>

        <div class="card admin-card p-4">
            <h3 class="h5 fw-bold text-dark mb-2 font-title"><i class="bi bi-tools text-accent me-2"></i>Development Tools</h3>
            <p class="text-secondary small mb-3">Comma-separated list of IDEs, platforms, and toolchains</p>
            
            <form method="POST" action="index.php">
                <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                <input type="hidden" name="action" value="update_tools">
                <textarea name="tools" rows="3" class="form-control mb-3" placeholder="Git, GitHub, VS Code, Figma..."><?php echo e($tools_str); ?></textarea>
                <button type="submit" class="btn btn-warning-custom btn-sm">Save Tools</button>
            </form>
        </div>
    </div>

    <!-- Awards & Certifications Column -->
    <div class="col-lg-6">
        <!-- Awards -->
        <div class="card admin-card p-4 mb-4">
            <h3 class="h5 fw-bold text-dark mb-3 font-title"><i class="bi bi-trophy-fill text-accent me-2"></i>Awards & Honors</h3>
            
            <form method="POST" action="index.php" class="mb-3 pb-3 border-bottom border-secondary-subtle">
                <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                <input type="hidden" name="action" value="add_award">
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <input type="text" name="award_title" class="form-control" placeholder="Award Title" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="award_desc" class="form-control" placeholder="Description / Ranking">
                    </div>
                </div>
                <button type="submit" class="btn btn-admin-secondary btn-sm"><i class="bi bi-plus-lg me-1"></i>Add Award</button>
            </form>

            <div class="d-flex flex-column gap-2">
                <?php if (empty($awards)): ?>
                    <p class="text-secondary small mb-0">No awards listed.</p>
                <?php else: ?>
                    <?php foreach ($awards as $idx => $award): ?>
                        <div class="p-2.5 rounded-3 border border-secondary-subtle d-flex justify-content-between align-items-center" style="background: var(--admin-surface);">
                            <div>
                                <h4 class="text-dark small fw-bold mb-0"><?php echo e($award['title']); ?></h4>
                                <span class="text-secondary" style="font-size: 0.78rem;"><?php echo e($award['description'] ?? ''); ?></span>
                            </div>
                            <form method="POST" action="index.php" class="d-inline" onsubmit="return confirm('Delete this award?');">
                                <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                                <input type="hidden" name="action" value="delete_award">
                                <input type="hidden" name="index" value="<?php echo $idx; ?>">
                                <button type="submit" class="btn btn-admin-secondary btn-sm p-1 text-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Certifications -->
        <div class="card admin-card p-4">
            <h3 class="h5 fw-bold text-dark mb-3 font-title"><i class="bi bi-patch-check-fill text-accent me-2"></i>Certificates</h3>
            
            <form method="POST" action="index.php" class="mb-3 pb-3 border-bottom border-secondary-subtle">
                <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                <input type="hidden" name="action" value="add_cert">
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <input type="text" name="cert_name" class="form-control" placeholder="Certificate Name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="cert_issuer" class="form-control" placeholder="Issuing Organization">
                    </div>
                </div>
                <button type="submit" class="btn btn-admin-secondary btn-sm"><i class="bi bi-plus-lg me-1"></i>Add Certificate</button>
            </form>

            <div class="d-flex flex-column gap-2">
                <?php if (empty($certificates)): ?>
                    <p class="text-secondary small mb-0">No certificates listed.</p>
                <?php else: ?>
                    <?php foreach ($certificates as $idx => $cert): ?>
                        <div class="p-2.5 rounded-3 border border-secondary-subtle d-flex justify-content-between align-items-center" style="background: var(--admin-surface);">
                            <div>
                                <h4 class="text-dark small fw-bold mb-0"><?php echo e($cert['name']); ?></h4>
                                <span class="text-secondary" style="font-size: 0.78rem;"><?php echo e($cert['issuer'] ?? ''); ?></span>
                            </div>
                            <form method="POST" action="index.php" class="d-inline" onsubmit="return confirm('Delete this certificate?');">
                                <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                                <input type="hidden" name="action" value="delete_cert">
                                <input type="hidden" name="index" value="<?php echo $idx; ?>">
                                <button type="submit" class="btn btn-admin-secondary btn-sm p-1 text-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
