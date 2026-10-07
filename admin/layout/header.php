<?php
/**
 * Admin Layout: Header & Sidebar Navigation
 * Single unified sidebar template rendered for both desktop and mobile
 */

$admin_current_page = $admin_current_page ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? e($page_title) : 'Admin Console'; ?> | <?php echo e($profileName); ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fira+Code:wght@400;500&display=swap">
    
    <!-- Bootstrap CSS & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Admin Console Stylesheet -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/assets/admin.min.css?v=<?php echo CSS_VERSION; ?>">
    
    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="<?php echo BASE_URL; ?>favicon.svg">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo BASE_URL; ?>favicon-96x96.png">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>favicon.ico">
</head>

<body class="admin-body">

    <!-- Mobile Top Navigation Bar -->
    <header class="d-flex d-lg-none align-items-center justify-content-between px-3 py-2.5 border-bottom w-100" style="background: var(--admin-sidebar-bg); border-color: var(--admin-border) !important; position: sticky; top: 0; z-index: 1040;">
        <a href="<?php echo BASE_URL; ?>admin/modules/dashboard/" class="admin-brand-link p-0">
            <div class="admin-brand-icon" style="width: 32px; height: 32px; font-size: 1rem;">
                <i class="bi bi-terminal-fill"></i>
            </div>
            <h1 class="admin-brand-title fs-6">Console</h1>
        </a>
        <button class="btn btn-admin-secondary btn-sm p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-controls="adminSidebarOffcanvas">
            <i class="bi bi-list fs-5"></i>
        </button>
    </header>

    <!-- Offcanvas Mobile Drawer Navigation -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="adminSidebarOffcanvas" style="background: var(--admin-sidebar-bg); width: 280px; border-right: 1px solid var(--admin-border);">
        <div class="offcanvas-header px-4 pt-4 pb-2">
            <a href="<?php echo BASE_URL; ?>admin/modules/dashboard/" class="admin-brand-link p-0">
                <div class="admin-brand-icon">
                    <i class="bi bi-terminal-fill"></i>
                </div>
                <div>
                    <h1 class="admin-brand-title">Console</h1>
                    <span class="admin-brand-badge">PRO v2.0</span>
                </div>
            </a>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body px-3 py-2">
            <?php include __DIR__ . '/sidebar-nav.php'; ?>
        </div>
    </div>

    <!-- Main Desktop Layout Wrapper -->
    <div class="admin-layout-wrapper">

        <!-- Desktop Persistent Sidebar -->
        <aside class="admin-sidebar">
            <a href="<?php echo BASE_URL; ?>admin/modules/dashboard/" class="admin-brand-link mb-3">
                <div class="admin-brand-icon">
                    <i class="bi bi-terminal-fill"></i>
                </div>
                <div>
                    <h1 class="admin-brand-title">Console</h1>
                    <span class="admin-brand-badge">PRO v2.0</span>
                </div>
            </a>

            <?php include __DIR__ . '/sidebar-nav.php'; ?>

            <!-- User Session Card -->
            <div class="sidebar-user-card mt-auto">
                <div class="sidebar-user-avatar">
                    <?php echo strtoupper(substr($current_admin_user, 0, 1)); ?>
                </div>
                <div class="flex-grow-1 min-w-0">
                    <p class="sidebar-user-name text-truncate"><?php echo e($current_admin_user); ?></p>
                    <p class="sidebar-user-role">Administrator</p>
                </div>
                <a href="<?php echo BASE_URL; ?>admin/index.php?logout=1" class="text-danger p-1" title="Sign Out" aria-label="Sign Out">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                </a>
            </div>
        </aside>

        <!-- Main Workspace Content Column -->
        <main class="admin-main-content">
