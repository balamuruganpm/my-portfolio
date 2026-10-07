<?php
/**
 * Admin Module: Dashboard (Glassmorphic Dark Edition)
 */
$admin_current_page = 'dashboard';
$page_title = 'Dashboard & Analytics';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

// Calculate metric counts
$projects_count = isset($data['projects']) ? count($data['projects']) : 0;
$skills_count = (isset($data['skills']) ? count($data['skills']) : 0) + (isset($data['tools']) ? count($data['tools']) : 0);
$exp_count = isset($data['experience']) ? count($data['experience']) : 0;
$blogs_count = count($blogs);

include __DIR__ . '/../../layout/header.php';
?>

<!-- Header Title Bar -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h1 class="h3 fw-bold text-white mb-1">Console Dashboard</h1>
        <p class="text-secondary small mb-0">Real-time portfolio telemetry, ApexCharts analytics, and workspace controls</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        <a href="<?php echo BASE_URL; ?>" target="_blank" class="btn btn-admin-secondary btn-sm">
            <i class="bi bi-box-arrow-up-right me-1"></i> Live Site
        </a>
        <a href="<?php echo BASE_URL; ?>admin/modules/blogs/add.php" class="btn btn-admin-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Write Article
        </a>
    </div>
</div>

<!-- Animated KPI Metrics Grid -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-4 mb-4">
    <!-- Total Views KPI -->
    <div class="col">
        <div class="stat-card" style="--card-accent: linear-gradient(135deg, #ff5722, #ff8a65); --icon-bg: rgba(255, 87, 34, 0.15); --icon-color: #ff5722;">
            <div class="stat-card-header">
                <span class="stat-card-label">Profile Impressions</span>
                <div class="stat-card-icon-wrap">
                    <i class="bi bi-eye-fill"></i>
                </div>
            </div>
            <div>
                <h2 class="stat-card-value stat-count-animated" data-target="<?php echo $viewCount; ?>"><?php echo $viewCount; ?></h2>
                <p class="stat-card-trend"><i class="bi bi-graph-up-arrow text-success me-1"></i> Live Impressions</p>
            </div>
        </div>
    </div>

    <!-- Portfolio Projects KPI -->
    <div class="col">
        <div class="stat-card" style="--card-accent: linear-gradient(135deg, #6366f1, #818cf8); --icon-bg: rgba(99, 102, 241, 0.15); --icon-color: #6366f1;">
            <div class="stat-card-header">
                <span class="stat-card-label">Projects</span>
                <div class="stat-card-icon-wrap">
                    <i class="bi bi-folder-fill"></i>
                </div>
            </div>
            <div>
                <h2 class="stat-card-value stat-count-animated" data-target="<?php echo $projects_count; ?>"><?php echo $projects_count; ?></h2>
                <p class="stat-card-trend"><i class="bi bi-check-circle-fill text-success me-1"></i> Featured Works</p>
            </div>
        </div>
    </div>

    <!-- Published Articles KPI -->
    <div class="col">
        <div class="stat-card" style="--card-accent: linear-gradient(135deg, #10b981, #34d399); --icon-bg: rgba(16, 185, 129, 0.15); --icon-color: #10b981;">
            <div class="stat-card-header">
                <span class="stat-card-label">Published Articles</span>
                <div class="stat-card-icon-wrap">
                    <i class="bi bi-journal-richtext"></i>
                </div>
            </div>
            <div>
                <h2 class="stat-card-value stat-count-animated" data-target="<?php echo $blogs_count; ?>"><?php echo $blogs_count; ?></h2>
                <p class="stat-card-trend"><i class="bi bi-patch-check-fill text-info me-1"></i> Dynamic Blog Posts</p>
            </div>
        </div>
    </div>

    <!-- Inbox Messages KPI -->
    <div class="col">
        <div class="stat-card" style="--card-accent: linear-gradient(135deg, #f43f5e, #fb7185); --icon-bg: rgba(244, 63, 94, 0.15); --icon-color: #f43f5e;">
            <div class="stat-card-header">
                <span class="stat-card-label">Unread Inquiries</span>
                <div class="stat-card-icon-wrap">
                    <i class="bi bi-envelope-fill"></i>
                </div>
            </div>
            <div>
                <h2 class="stat-card-value stat-count-animated" data-target="<?php echo $unread_count; ?>"><?php echo $unread_count; ?></h2>
                <p class="stat-card-trend"><?php echo ($unread_count > 0) ? '<span class="text-danger fw-bold"><i class="bi bi-bell-fill me-1"></i>Action Needed</span>' : '<span class="text-secondary"><i class="bi bi-check-all me-1"></i>Inbox Clear</span>'; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- ApexCharts Telemetry Section -->
<div class="row g-4 mb-4">
    <!-- Left Column: Traffic Analytics Chart -->
    <div class="col-lg-8">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="bi bi-bar-chart-line-fill text-warning"></i> Traffic & Impression Telemetry
                </h3>
                <span class="admin-badge badge-accent-subtle">Monthly Analytics</span>
            </div>
            <div id="apex-traffic-chart"></div>
        </div>
    </div>

    <!-- Right Column: Content Breakdown Donut Chart -->
    <div class="col-lg-4">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="bi bi-pie-chart-fill text-info"></i> Content Matrix
                </h3>
                <span class="admin-badge badge-info-subtle">Distribution</span>
            </div>
            <div id="apex-content-distribution"></div>
        </div>
    </div>
</div>

<!-- Quick Navigation & Recent Inquiries Section -->
<div class="row g-4 mb-4">
    <!-- Left Column: Quick Managers -->
    <div class="col-lg-7">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="bi bi-sliders text-secondary"></i> Quick Management Hub
                </h3>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 g-3">
                <div class="col">
                    <a href="<?php echo BASE_URL; ?>admin/modules/profile/" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none border border-secondary border-opacity-25" style="background: rgba(15, 23, 42, 0.6); transition: var(--transition);">
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="width: 42px; height: 42px; background: rgba(255,87,34,0.15); color: var(--admin-accent);">
                            <i class="bi bi-person-fill fs-5"></i>
                        </div>
                        <div>
                            <h4 class="text-white small fw-bold mb-0">Profile & Bio</h4>
                            <span class="text-secondary" style="font-size: 0.78rem;">Personal bio, stats & resume</span>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="<?php echo BASE_URL; ?>admin/modules/portfolio/" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none border border-secondary border-opacity-25" style="background: rgba(15, 23, 42, 0.6); transition: var(--transition);">
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="width: 42px; height: 42px; background: rgba(99,102,241,0.15); color: #6366f1;">
                            <i class="bi bi-folder-plus fs-5"></i>
                        </div>
                        <div>
                            <h4 class="text-white small fw-bold mb-0">Manage Portfolio</h4>
                            <span class="text-secondary" style="font-size: 0.78rem;">Add & update project works</span>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="<?php echo BASE_URL; ?>admin/modules/timeline/" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none border border-secondary border-opacity-25" style="background: rgba(15, 23, 42, 0.6); transition: var(--transition);">
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="width: 42px; height: 42px; background: rgba(16,185,129,0.15); color: #10b981;">
                            <i class="bi bi-clock-history fs-5"></i>
                        </div>
                        <div>
                            <h4 class="text-white small fw-bold mb-0">Career Timeline</h4>
                            <span class="text-secondary" style="font-size: 0.78rem;">Work experience & education</span>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="<?php echo BASE_URL; ?>admin/modules/details/" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none border border-secondary border-opacity-25" style="background: rgba(15, 23, 42, 0.6); transition: var(--transition);">
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="width: 42px; height: 42px; background: rgba(245,158,11,0.15); color: #f59e0b;">
                            <i class="bi bi-award-fill fs-5"></i>
                        </div>
                        <div>
                            <h4 class="text-white small fw-bold mb-0">Skills & Awards</h4>
                            <span class="text-secondary" style="font-size: 0.78rem;">Tech stack & certifications</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Recent Inquiries -->
    <div class="col-lg-5">
        <div class="admin-card h-100 d-flex flex-column">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="bi bi-envelope-open-fill text-danger"></i> Recent Inquiries
                </h3>
                <a href="<?php echo BASE_URL; ?>admin/modules/messages/" class="btn btn-admin-secondary btn-sm py-1 px-2.5" style="font-size: 0.78rem;">Inbox</a>
            </div>

            <?php if (empty($messages)): ?>
                <div class="text-center py-4 my-auto border rounded-3 border-secondary border-opacity-25 border-dashed">
                    <i class="bi bi-inbox text-secondary fs-3 mb-2 d-block"></i>
                    <p class="text-secondary small mb-0">No client messages received yet.</p>
                </div>
            <?php else: ?>
                <div class="d-flex flex-column gap-2 mt-1">
                    <?php 
                    $recent_msgs = array_slice(array_reverse($messages), 0, 3);
                    foreach ($recent_msgs as $msg): 
                        $is_read = isset($msg['read']) && $msg['read'] === true;
                        $time_str = isset($msg['date']) ? date('M d, h:i A', strtotime($msg['date'])) : '';
                    ?>
                        <div class="p-3 rounded-3 border <?php echo $is_read ? 'border-secondary border-opacity-25' : 'border-warning'; ?>" style="background: rgba(15, 23, 42, 0.6);">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-white small"><?php echo e($msg['name']); ?></span>
                                <span class="text-secondary" style="font-size: 0.72rem;"><?php echo $time_str; ?></span>
                            </div>
                            <p class="text-secondary small mb-0 text-truncate" style="font-size: 0.82rem;"><?php echo e(($msg['subject'] ?? 'Inquiry') . ' — ' . $msg['message']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- System Health & Status Banner -->
<div class="admin-card p-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center rounded-3 bg-success-subtle text-success" style="width: 44px; height: 44px; font-size: 1.25rem;">
                <i class="bi bi-activity"></i>
            </div>
            <div>
                <h4 class="text-white small fw-bold mb-0">System Engine & Persistence Health</h4>
                <span class="text-secondary" style="font-size: 0.8rem;">Lifetime Portfolio Page Views: <strong class="text-white"><?php echo number_format($viewCount); ?></strong> &bull; Core Engine Version: <?php echo CSS_VERSION; ?></span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <span class="admin-badge badge-success-subtle">
                <i class="bi bi-check-circle-fill me-1"></i> JSON Database Engine Active
            </span>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
