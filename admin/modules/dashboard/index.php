<?php
/**
 * Admin Module: Dashboard
 */
$admin_current_page = 'dashboard';
$page_title = 'Dashboard';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

// Calculate metric counts
$projects_count = isset($data['projects']) ? count($data['projects']) : 0;
$skills_count = (isset($data['skills']) ? count($data['skills']) : 0) + (isset($data['tools']) ? count($data['tools']) : 0);
$exp_count = isset($data['experience']) ? count($data['experience']) : 0;
$blogs_count = count($blogs);

include __DIR__ . '/../../layout/header.php';
?>

<!-- Header Title -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1 font-title">Console Dashboard</h1>
        <p class="text-secondary small mb-0">Live overview of your portfolio content, metrics, and incoming inquiries</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        <a href="<?php echo BASE_URL; ?>" target="_blank" class="btn btn-admin-secondary btn-sm">
            <i class="bi bi-box-arrow-up-right"></i> View Site
        </a>
        <a href="<?php echo BASE_URL; ?>admin/modules/blogs/add.php" class="btn btn-warning-custom btn-sm">
            <i class="bi bi-plus-lg"></i> Write Article
        </a>
    </div>
</div>

<!-- Animated Metrics Cards Grid -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-4 mb-4">
    <!-- Projects Stat -->
    <div class="col">
        <div class="card admin-card stat-card" style="--card-accent: #ff5722; --icon-bg: rgba(255, 87, 34, 0.12); --icon-color: #ff5722;">
            <div class="stat-card-header">
                <span class="stat-card-label">Projects</span>
                <div class="stat-card-icon-wrap">
                    <i class="bi bi-folder-fill"></i>
                </div>
            </div>
            <div>
                <h2 class="stat-card-value stat-count-animated" data-target="<?php echo $projects_count; ?>"><?php echo $projects_count; ?></h2>
                <p class="stat-card-trend"><i class="bi bi-check2-circle text-success me-1"></i>Completed Works</p>
            </div>
        </div>
    </div>

    <!-- Skills & Tools Stat -->
    <div class="col">
        <div class="card admin-card stat-card" style="--card-accent: #6366f1; --icon-bg: rgba(99, 102, 241, 0.12); --icon-color: #6366f1;">
            <div class="stat-card-header">
                <span class="stat-card-label">Skills & Tools</span>
                <div class="stat-card-icon-wrap">
                    <i class="bi bi-code-slash"></i>
                </div>
            </div>
            <div>
                <h2 class="stat-card-value stat-count-animated" data-target="<?php echo $skills_count; ?>"><?php echo $skills_count; ?></h2>
                <p class="stat-card-trend"><i class="bi bi-lightning-fill text-warning me-1"></i>Competencies</p>
            </div>
        </div>
    </div>

    <!-- Articles Stat -->
    <div class="col">
        <div class="card admin-card stat-card" style="--card-accent: #10b981; --icon-bg: rgba(16, 185, 129, 0.12); --icon-color: #10b981;">
            <div class="stat-card-header">
                <span class="stat-card-label">Articles</span>
                <div class="stat-card-icon-wrap">
                    <i class="bi bi-journal-text"></i>
                </div>
            </div>
            <div>
                <h2 class="stat-card-value stat-count-animated" data-target="<?php echo $blogs_count; ?>"><?php echo $blogs_count; ?></h2>
                <p class="stat-card-trend"><i class="bi bi-file-earmark-check text-info me-1"></i>Published Posts</p>
            </div>
        </div>
    </div>

    <!-- Inbox Stat -->
    <div class="col">
        <div class="card admin-card stat-card" style="--card-accent: #f43f5e; --icon-bg: rgba(244, 63, 94, 0.12); --icon-color: #f43f5e;">
            <div class="stat-card-header">
                <span class="stat-card-label">Unread Inbox</span>
                <div class="stat-card-icon-wrap">
                    <i class="bi bi-envelope-fill"></i>
                </div>
            </div>
            <div>
                <h2 class="stat-card-value stat-count-animated" data-target="<?php echo $unread_count; ?>"><?php echo $unread_count; ?></h2>
                <p class="stat-card-trend"><?php echo ($unread_count > 0) ? '<span class="text-danger fw-bold"><i class="bi bi-bell-fill me-1"></i>Action Required</span>' : '<span class="text-secondary"><i class="bi bi-check-all me-1"></i>All Caught Up</span>'; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Middle Section: Quick Actions & Recent Messages Preview -->
<div class="row g-4 mb-4">
    <!-- Left Column: Quick Manager Navigation -->
    <div class="col-lg-7">
        <div class="card admin-card p-4 h-100">
            <h3 class="h5 fw-bold text-dark mb-1 font-title">Quick Content Management</h3>
            <p class="text-secondary small mb-4">Jump directly into content editors and data managers</p>

            <div class="row row-cols-1 row-cols-sm-2 g-3">
                <div class="col">
                    <a href="<?php echo BASE_URL; ?>admin/modules/profile/" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none border border-secondary-subtle" style="background: var(--admin-bg); transition: var(--transition);">
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px; background: rgba(255,87,34,0.12); color: var(--admin-accent);">
                            <i class="bi bi-person-fill fs-5"></i>
                        </div>
                        <div>
                            <h4 class="text-dark small fw-bold mb-0">Edit Profile</h4>
                            <span class="text-secondary" style="font-size: 0.76rem;">Bio, stats & contacts</span>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="<?php echo BASE_URL; ?>admin/modules/portfolio/" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none border border-secondary-subtle" style="background: var(--admin-bg); transition: var(--transition);">
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px; background: rgba(99,102,241,0.12); color: #6366f1;">
                            <i class="bi bi-folder-plus fs-5"></i>
                        </div>
                        <div>
                            <h4 class="text-dark small fw-bold mb-0">Manage Portfolio</h4>
                            <span class="text-secondary" style="font-size: 0.76rem;">Add and edit works</span>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="<?php echo BASE_URL; ?>admin/modules/timeline/" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none border border-secondary-subtle" style="background: var(--admin-bg); transition: var(--transition);">
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px; background: rgba(16,185,129,0.12); color: #10b981;">
                            <i class="bi bi-clock-history fs-5"></i>
                        </div>
                        <div>
                            <h4 class="text-dark small fw-bold mb-0">Timeline History</h4>
                            <span class="text-secondary" style="font-size: 0.76rem;">Career & education ladder</span>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="<?php echo BASE_URL; ?>admin/modules/details/" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none border border-secondary-subtle" style="background: var(--admin-bg); transition: var(--transition);">
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px; background: rgba(245,158,11,0.12); color: #d97706;">
                            <i class="bi bi-trophy fs-5"></i>
                        </div>
                        <div>
                            <h4 class="text-dark small fw-bold mb-0">Skills & Awards</h4>
                            <span class="text-secondary" style="font-size: 0.76rem;">Tech stacks & certs</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Recent Messages Feed -->
    <div class="col-lg-5">
        <div class="card admin-card p-4 h-100 d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="h5 fw-bold text-dark mb-0 font-title">Recent Inquiries</h3>
                    <span class="text-secondary small">Latest contact form messages</span>
                </div>
                <a href="<?php echo BASE_URL; ?>admin/modules/messages/" class="btn btn-admin-secondary btn-sm py-1 px-2.5" style="font-size: 0.78rem;">View All</a>
            </div>

            <?php if (empty($messages)): ?>
                <div class="text-center py-4 my-auto border rounded-3 border-dashed" style="border-color: var(--admin-border) !important;">
                    <i class="bi bi-inbox text-secondary fs-3 mb-2 d-block"></i>
                    <p class="text-secondary small mb-0">No client messages received yet.</p>
                </div>
            <?php else: ?>
                <div class="d-flex flex-column gap-2 mt-2">
                    <?php 
                    $recent_msgs = array_slice(array_reverse($messages), 0, 3);
                    foreach ($recent_msgs as $msg): 
                        $is_read = isset($msg['read']) && $msg['read'] === true;
                        $time_str = isset($msg['date']) ? date('M d, h:i A', strtotime($msg['date'])) : '';
                    ?>
                        <div class="p-3 rounded-3 border <?php echo $is_read ? 'border-secondary-subtle' : 'border-warning'; ?>" style="background: var(--admin-bg);">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark small"><?php echo e($msg['name']); ?></span>
                                <span class="text-secondary" style="font-size: 0.72rem;"><?php echo $time_str; ?></span>
                            </div>
                            <p class="text-secondary small mb-0 text-truncate" style="font-size: 0.82rem;"><?php echo e($msg['subject'] . ' — ' . $msg['message']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- System Status Card -->
<div class="card admin-card p-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center rounded-3 bg-success-subtle text-success" style="width: 44px; height: 44px; font-size: 1.25rem;">
                <i class="bi bi-activity"></i>
            </div>
            <div>
                <h4 class="text-dark small fw-bold mb-0">System Health & Metrics</h4>
                <span class="text-secondary" style="font-size: 0.8rem;">Lifetime Portfolio Page Impressions: <strong class="text-dark"><?php echo number_format($viewCount); ?></strong> &bull; Core Version: <?php echo CSS_VERSION; ?></span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill small fw-semibold">
                <i class="bi bi-check-circle-fill me-1"></i> JSON Database Healthy
            </span>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
