<?php
/**
 * Admin Layout: Minimal Fast Dark Header & Navigation
 */
$admin_current_page = $admin_current_page ?? 'dashboard';
$adminCssFile = file_exists(BASE_PATH . 'admin/assets/admin.min.css') ? 'admin.min.css' : 'admin.css';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? e($page_title) : 'Admin Console'; ?> | <?php echo e($profileName); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/assets/<?php echo $adminCssFile; ?>?v=<?php echo CSS_VERSION; ?>">

    <link rel="icon" type="image/svg+xml" href="<?php echo BASE_URL; ?>favicon.svg">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo BASE_URL; ?>favicon-96x96.png">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>favicon.ico">
</head>

<body class="admin-body">

    <!-- Mobile Top Header -->
    <header class="d-flex d-lg-none align-items-center justify-content-between px-3 py-2 w-100" style="background: var(--admin-surface); border: 1px solid var(--admin-border); border-radius: 12px; margin: 8px 10px 0; width: calc(100% - 20px) !important; position: sticky; top: 8px; z-index: 1040;">
        <a href="<?php echo BASE_URL; ?>admin/modules/dashboard/" class="admin-brand-link p-0">
            <div class="admin-brand-icon" style="width: 32px; height: 32px; font-size: 0.95rem;">
                <i class="bi bi-terminal-fill"></i>
            </div>
            <h1 class="admin-brand-title fs-6">Console</h1>
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="<?php echo BASE_URL; ?>admin/modules/blogs/add.php" class="btn btn-admin-primary btn-sm py-1 px-2">
                <i class="bi bi-plus-lg"></i>
            </a>
            <a href="<?php echo BASE_URL; ?>admin/modules/messages/" class="btn btn-admin-secondary btn-sm py-1 px-2 position-relative">
                <i class="bi bi-envelope"></i>
                <?php if (!empty($unread_count) && $unread_count > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger rounded-circle"></span>
                <?php endif; ?>
            </a>
            <button class="btn btn-admin-secondary btn-sm py-1 px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-controls="adminSidebarOffcanvas">
                <i class="bi bi-list fs-5"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Slide-Over Drawer -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="adminSidebarOffcanvas" style="background: var(--admin-surface); width: 270px; border: 1px solid var(--admin-border);">
        <div class="offcanvas-header px-3 pt-3 pb-2">
            <a href="<?php echo BASE_URL; ?>admin/modules/dashboard/" class="admin-brand-link p-0">
                <div class="admin-brand-icon"><i class="bi bi-terminal-fill"></i></div>
                <div>
                    <h1 class="admin-brand-title">Console</h1>
                    <span class="admin-brand-badge">FAST v3.0</span>
                </div>
            </a>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body px-3 py-2">
            <?php include __DIR__ . '/sidebar-nav.php'; ?>
        </div>
    </div>

    <!-- Main Layout -->
    <div class="admin-layout-wrapper">
        <!-- Desktop Sidebar -->
        <aside class="admin-sidebar">
            <a href="<?php echo BASE_URL; ?>admin/modules/dashboard/" class="admin-brand-link mb-2">
                <div class="admin-brand-icon"><i class="bi bi-terminal-fill"></i></div>
                <div>
                    <h1 class="admin-brand-title">Console</h1>
                    <span class="admin-brand-badge">FAST v3.0</span>
                </div>
            </a>

            <?php include __DIR__ . '/sidebar-nav.php'; ?>

            <div class="sidebar-user-card mt-auto">
                <div class="sidebar-user-avatar"><?php echo strtoupper(substr($current_admin_user, 0, 1)); ?></div>
                <div class="flex-grow-1 min-w-0">
                    <p class="sidebar-user-name text-truncate"><?php echo e($current_admin_user); ?></p>
                    <p class="sidebar-user-role">Admin</p>
                </div>
                <a href="<?php echo BASE_URL; ?>admin/index.php?logout=1" class="text-danger p-1" title="Sign Out" aria-label="Sign Out">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
            </div>
        </aside>

        <!-- Main Column -->
        <div class="admin-main-col">
            <header class="admin-top-navbar d-none d-lg-flex">
                <div class="search-command-bar">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control" placeholder="Quick filter..." data-table-search=".admin-table">
                    <kbd>Ctrl+K</kbd>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <a href="<?php echo BASE_URL; ?>" target="_blank" class="btn btn-admin-secondary btn-sm">
                        <i class="bi bi-globe"></i> Live Site
                    </a>
                    <a href="<?php echo BASE_URL; ?>admin/modules/blogs/add.php" class="btn btn-admin-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> New Article
                    </a>
                    <a href="<?php echo BASE_URL; ?>admin/modules/messages/" class="btn btn-admin-secondary btn-sm position-relative" title="Messages">
                        <i class="bi bi-envelope"></i>
                        <?php if (!empty($unread_count) && $unread_count > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.62rem;">
                                <?php echo $unread_count; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>
            </header>

            <main class="admin-main-content">
