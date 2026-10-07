<?php
/**
 * Admin Login Page
 * Redesigned with dark aesthetic, split-screen brand panel, password toggle, and session handling.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('PAGE_DEPTH', 1);
require_once __DIR__ . '/../config/bootstrap.php';

$db_file = ADMIN_DATA_PATH . 'data.json';
$data = file_exists($db_file) ? (json_decode(file_get_contents($db_file), true) ?: []) : [];

// Auto-seed default credentials if user database is missing
if (!isset($data['users']) || empty($data['users'])) {
    $data['users'] = [
        [
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT)
        ]
    ];
    file_put_contents($db_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

// Handle logouts
if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: " . BASE_URL . "admin/index.php");
    exit();
}

// Redirect if already authenticated
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: " . BASE_URL . "admin/modules/dashboard/");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    $authenticated = false;
    foreach ($data['users'] as $user) {
        if (strtolower($user['username']) === strtolower($username) && password_verify($password, $user['password'])) {
            $authenticated = true;
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            header("Location: " . BASE_URL . "admin/modules/dashboard/");
            exit();
        }
    }

    if (!$authenticated) {
        $error = 'Invalid credentials. Please verify your username and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Console Login | <?php echo e($profileName); ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    
    <!-- Bootstrap CSS & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="<?php echo BASE_URL; ?>favicon.svg">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo BASE_URL; ?>favicon-96x96.png">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>favicon.ico">

    <style>
        .login-page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: #f1f5f9;
        }
        .login-container-card {
            max-width: 920px;
            width: 100%;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .login-brand-panel {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        .login-brand-panel::before {
            content: '';
            position: absolute;
            top: -40px;
            left: -40px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255, 87, 34, 0.25);
            filter: blur(40px);
            pointer-events: none;
        }
        .login-form-panel {
            padding: 3rem 2.5rem;
            background: #ffffff;
        }
        @media (max-width: 767.98px) {
            .login-brand-panel {
                padding: 2rem 1.5rem;
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
            }
            .login-form-panel {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body class="admin-body">
    <div class="login-page-wrapper">
        <div class="login-container-card row g-0">
            <!-- Left: Brand Showcase Panel -->
            <div class="col-md-5 login-brand-panel">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="admin-brand-icon" style="width: 42px; height: 42px; font-size: 1.25rem;">
                            <i class="bi bi-terminal-fill"></i>
                        </div>
                        <div>
                            <h2 class="admin-brand-title fs-5 mb-0 text-white">Console</h2>
                            <span class="admin-brand-badge">PRO v2.0</span>
                        </div>
                    </div>

                    <h3 class="h4 fw-bold text-white font-title mb-2">Welcome Back</h3>
                    <p class="text-white-50 small leading-relaxed mb-4">
                        Manage your portfolio content, real-time analytics, blog articles, and incoming client inquiries from one central dashboard.
                    </p>
                </div>

                <div class="pt-4 border-top border-secondary">
                    <div class="d-flex align-items-center gap-3">
                        <div class="sidebar-user-avatar">
                            <?php echo strtoupper(substr($profileName, 0, 1)); ?>
                        </div>
                        <div>
                            <p class="text-white small fw-bold mb-0"><?php echo e($profileName); ?></p>
                            <p class="text-white-50 mb-0" style="font-size: 0.76rem;"><?php echo e($profileSubtitle); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Login Form Panel -->
            <div class="col-md-7 login-form-panel d-flex flex-column justify-content-center">
                <div class="mb-4">
                    <h3 class="h4 fw-bold text-dark font-title mb-1">Sign In to Workspace</h3>
                    <p class="text-secondary small mb-0">Enter your administrative credentials to continue</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger border-0 py-2.5 px-3 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: var(--admin-danger-bg); color: var(--admin-danger);">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <div><?php echo e($error); ?></div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-secondary-subtle text-secondary" style="border-radius: var(--radius-md) 0 0 var(--radius-md);">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" name="username" class="form-control" placeholder="Enter username" required autocomplete="username" autofocus style="border-left: none !important; border-radius: 0 var(--radius-md) var(--radius-md) 0 !important;">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold text-secondary">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-secondary-subtle text-secondary" style="border-radius: var(--radius-md) 0 0 var(--radius-md);">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="Enter password" required autocomplete="current-password" style="border-left: none !important; border-right: none !important; border-radius: 0 !important;">
                            <button class="btn btn-admin-secondary password-toggle-btn" type="button" style="border-radius: 0 var(--radius-md) var(--radius-md) 0; border-left: none;">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning-custom w-100 py-3 fw-bold justify-content-center">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In to Console
                    </button>
                </form>

                <div class="mt-4 pt-3 text-center border-top border-secondary-subtle">
                    <a href="<?php echo BASE_URL; ?>" class="text-secondary small text-decoration-none hover-accent">
                        <i class="bi bi-arrow-left me-1"></i> Back to Public Site
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo BASE_URL; ?>admin/assets/admin.js?v=<?php echo JS_VERSION; ?>"></script>
</body>

</html>
