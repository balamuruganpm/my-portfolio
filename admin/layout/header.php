<?php
/**
 * Admin Layout: Glassmorphic Dark Header & Topbar Navigation
 */

$admin_current_page = $admin_current_page ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

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
    
    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.1/dist/apexcharts.min.js"></script>
    
    <!-- Admin Console Glassmorphic Dark Stylesheet -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/assets/admin.css?v=<?php echo CSS_VERSION; ?>">
    
    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="<?php echo BASE_URL; ?>favicon.svg">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo BASE_URL; ?>favicon-96x96.png">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>favicon.ico">
</head>

<body class="admin-body">

    <!-- Mobile Top Navigation Header -->
    <header class="d-flex d-lg-none align-items-center justify-content-between px-3 py-2.5 border-bottom w-100" style="background: rgba(15, 23, 42, 0.95); border-color: var(--admin-border) !important; position: sticky; top: 0; z-index: 1040; backdrop-filter: blur(12px);">
        <a href="<?php echo BASE_URL; ?>admin/modules/dashboard/" class="admin-brand-link p-0">
            <div class="admin-brand-icon" style="width: 34px; height: 34px; font-size: 1rem;">
                <i class="bi bi-terminal-fill"></i>
            </div>
            <h1 class="admin-brand-title fs-6 text-white">Console</h1>
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="<?php echo BASE_URL; ?>admin/modules/messages/" class="btn btn-admin-secondary btn-sm p-2 position-relative">
                <i class="bi bi-envelope"></i>
                <?php if (!empty($unread_count) && $unread_count > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                <?php endif; ?>
            </a>
            <button class="btn btn-admin-secondary btn-sm p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-controls="adminSidebarOffcanvas">
                <i class="bi bi-list fs-5"></i>
            </button>
        </div>
    </header>

    <!-- Offcanvas Mobile Drawer Navigation -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="adminSidebarOffcanvas" style="background: #0f172a; width: 290px; border-right: 1px solid var(--admin-border);">
        <div class="offcanvas-header px-4 pt-4 pb-2">
            <a href="<?php echo BASE_URL; ?>admin/modules/dashboard/" class="admin-brand-link p-0">
                <div class="admin-brand-icon">
                    <i class="bi bi-terminal-fill"></i>
                </div>
                <div>
                    <h1 class="admin-brand-title">Console</h1>
                    <span class="admin-brand-badge">PRO v2.5</span>
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
                    <span class="admin-brand-badge">PRO v2.5</span>
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

        <!-- Main Workspace Column -->
        <div class="flex-grow-1 min-w-0 d-flex flex-column">

            <!-- Desktop Sticky Glass Top Navbar -->
            <header class="admin-top-navbar d-none d-lg-flex">
                <div class="search-command-bar">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control" placeholder="Quick search modules, blogs, projects..." data-table-search=".admin-table">
                    <kbd>Ctrl+K</kbd>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="<?php echo BASE_URL; ?>" target="_blank" class="btn btn-admin-secondary btn-sm">
                        <i class="bi bi-globe me-1"></i> Live Site
                    </a>

                    <a href="<?php echo BASE_URL; ?>admin/modules/messages/" class="btn btn-admin-secondary btn-sm position-relative">
                        <i class="bi bi-envelope fs-6"></i>
                        <?php if (!empty($unread_count) && $unread_count > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                                <?php echo $unread_count; ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-admin-secondary btn-sm dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="sidebar-user-avatar" style="width: 26px; height: 26px; font-size: 0.8rem;">
                                <?php echo strtoupper(substr($current_admin_user, 0, 1)); ?>
                            </div>
                            <span class="fw-semibold text-white"><?php echo e($current_admin_user); ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark border border-secondary shadow-lg">
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>admin/modules/profile/"><i class="bi bi-person me-2"></i> Edit Profile</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>admin/modules/users/"><i class="bi bi-shield-lock me-2"></i> Security Settings</a></li>
                            <li><hr class="dropdown-divider border-secondary"></li>
                            <li><a class="dropdown-item text-danger" href="<?php echo BASE_URL; ?>admin/index.php?logout=1"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Main Workspace Content Column -->
            <main class="admin-main-content">
