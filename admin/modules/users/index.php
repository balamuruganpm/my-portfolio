<?php
/**
 * Admin Module: Users & Access Management
 */
$admin_current_page = 'users';
$page_title = 'Admin Users';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$message = '';
$message_type = 'success';

// Handle Add / Delete User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    verifyCsrfToken();
    $action = $_POST['action'];

    if ($action === 'add') {
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (!empty($username) && !empty($password)) {
            // Verify uniqueness
            $exists = false;
            foreach ($data['users'] as $u) {
                if (strtolower($u['username']) === strtolower($username)) {
                    $exists = true;
                    break;
                }
            }

            if ($exists) {
                $message = 'A user with this username already exists.';
                $message_type = 'danger';
            } else {
                $data['users'][] = [
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ];
                if (saveAdminData($data)) {
                    $message = 'New admin user account created!';
                }
            }
        } else {
            $message = 'Username and password cannot be empty.';
            $message_type = 'danger';
        }
    }

    if ($action === 'delete') {
        $del_user = isset($_POST['username']) ? trim($_POST['username']) : '';
        if (count($data['users']) <= 1) {
            $message = 'Cannot delete the only administrative user account!';
            $message_type = 'danger';
        } else {
            foreach ($data['users'] as $idx => $u) {
                if ($u['username'] === $del_user) {
                    unset($data['users'][$idx]);
                    $data['users'] = array_values($data['users']);
                    if (saveAdminData($data)) {
                        $message = 'Admin user deleted!';
                    }
                    break;
                }
            }
        }
    }
}

$users = $data['users'] ?? [];

include __DIR__ . '/../../layout/header.php';
?>

<div class="mb-4">
    <h1 class="h3 fw-bold text-white mb-1 font-title">Admin Users & Access Control</h1>
    <p class="text-secondary small mb-0">Create additional administrator credentials and manage platform access</p>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $message_type; ?> border-0 py-3 px-4 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: <?php echo $message_type === 'success' ? 'var(--admin-success-bg)' : 'var(--admin-danger-bg)'; ?>; color: <?php echo $message_type === 'success' ? 'var(--admin-success)' : 'var(--admin-danger)'; ?>;">
        <i class="bi <?php echo $message_type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?>"></i>
        <div><?php echo e($message); ?></div>
    </div>
<?php endif; ?>

<div class="row g-4">
    <!-- Add User Form -->
    <div class="col-lg-5">
        <div class="card admin-card p-4 p-md-5">
            <h3 class="h5 fw-bold text-white mb-3 font-title"><i class="bi bi-person-plus-fill text-accent me-2"></i>Create New User</h3>
            
            <form method="POST" action="index.php">
                <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                <input type="hidden" name="action" value="add">

                <div class="mb-3">
                    <label class="form-label text-secondary small">Username</label>
                    <input type="text" name="username" class="form-control form-control-admin text-white" placeholder="newadmin" required autocomplete="off">
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary small">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control form-control-admin text-white" placeholder="••••••••" required autocomplete="new-password">
                        <button class="btn btn-admin-secondary password-toggle-btn" type="button">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning-custom w-100 justify-content-center py-2.5">
                    <i class="bi bi-shield-plus me-1"></i>Create User Account
                </button>
            </form>
        </div>
    </div>

    <!-- Users List -->
    <div class="col-lg-7">
        <div class="card admin-card p-4">
            <h3 class="h5 fw-bold text-white mb-3 font-title"><i class="bi bi-people-fill text-accent me-2"></i>Active Administrator Accounts</h3>

            <div class="d-flex flex-column gap-3">
                <?php foreach ($users as $user): 
                    $is_current = ($user['username'] === $current_admin_user);
                ?>
                    <div class="p-3 rounded-3 border border-secondary-subtle d-flex justify-content-between align-items-center" style="background: rgba(255, 255, 255, 0.02);">
                        <div class="d-flex align-items-center gap-3">
                            <div class="sidebar-user-avatar">
                                <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                            </div>
                            <div>
                                <h4 class="text-white small fw-bold mb-0">
                                    <?php echo e($user['username']); ?>
                                    <?php if ($is_current): ?>
                                        <span class="badge bg-success-subtle text-success small ms-2 border border-success-subtle">You</span>
                                    <?php endif; ?>
                                </h4>
                                <span class="text-secondary" style="font-size: 0.76rem;">Administrator</span>
                            </div>
                        </div>

                        <?php if (!$is_current && count($users) > 1): ?>
                            <form method="POST" action="index.php" onsubmit="return confirm('Delete user <?php echo e($user['username']); ?>?');">
                                <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="username" value="<?php echo e($user['username']); ?>">
                                <button type="submit" class="btn btn-admin-secondary btn-sm p-1.5 text-danger" title="Delete User">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
