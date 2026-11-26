<?php
/**
 * Admin Module: Minimal Fast Dashboard
 * Zero heavy chart JS, 1-click actions, blog shortlinks, and SEO/GEO/AEO quick-access.
 */
$admin_current_page = 'dashboard';
$page_title = 'Dashboard';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$projects_count = isset($data['projects']) ? count($data['projects']) : 0;
$skills_count = (isset($data['skills']) ? count($data['skills']) : 0) + (isset($data['tools']) ? count($data['tools']) : 0);
$exp_count = isset($data['experience']) ? count($data['experience']) : 0;
$blogs_count = count($blogs);
$published_count = count(array_filter($blogs, fn($b) => !isset($b['status']) || $b['status'] === 'published'));

include __DIR__ . '/../../layout/header.php';
?>

<!-- Minimal Header -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h4 fw-bold text-white mb-0">Workspace</h1>
        <p class="text-secondary small mb-0">Fast content control, blog shortlinks &amp; SEO/GEO/AEO endpoints</p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="<?php echo BASE_URL; ?>admin/modules/portfolio/add.php" class="btn btn-admin-secondary btn-sm">
            <i class="bi bi-folder-plus"></i> Add Project
        </a>
        <a href="<?php echo BASE_URL; ?>admin/modules/blogs/add.php" class="btn btn-admin-primary btn-sm">
            <i class="bi bi-pencil-square"></i> Write Article
        </a>
    </div>
</div>

<!-- Compact KPI Strip -->
<div class="row row-cols-2 row-cols-xl-4 g-3 mb-3">
    <div class="col">
        <div class="stat-card" style="--icon-bg: rgba(6, 182, 212, 0.14); --icon-color: #22d3ee;">
            <div class="stat-card-header">
                <span class="stat-card-label">Site Views</span>
                <div class="stat-card-icon-wrap"><i class="bi bi-eye-fill"></i></div>
            </div>
            <div>
                <h2 class="stat-card-value"><?php echo number_format($viewCount); ?></h2>
                <p class="stat-card-trend">Unique sessions</p>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card" style="--icon-bg: rgba(99, 102, 241, 0.14); --icon-color: #818cf8;">
            <div class="stat-card-header">
                <span class="stat-card-label">Projects</span>
                <div class="stat-card-icon-wrap"><i class="bi bi-folder-fill"></i></div>
            </div>
            <div>
                <h2 class="stat-card-value"><?php echo $projects_count; ?></h2>
                <p class="stat-card-trend"><?php echo $skills_count; ?> skills &amp; tools</p>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card" style="--icon-bg: rgba(16, 185, 129, 0.14); --icon-color: #34d399;">
            <div class="stat-card-header">
                <span class="stat-card-label">Articles</span>
                <div class="stat-card-icon-wrap"><i class="bi bi-journal-richtext"></i></div>
            </div>
            <div>
                <h2 class="stat-card-value"><?php echo $published_count; ?> <span class="fs-6 text-secondary fw-normal">/ <?php echo $blogs_count; ?></span></h2>
                <p class="stat-card-trend">Published / Total</p>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card" style="--icon-bg: rgba(244, 63, 94, 0.14); --icon-color: #fb7185;">
            <div class="stat-card-header">
                <span class="stat-card-label">Inbox</span>
                <div class="stat-card-icon-wrap"><i class="bi bi-envelope-fill"></i></div>
            </div>
            <div>
                <h2 class="stat-card-value"><?php echo $unread_count; ?></h2>
                <p class="stat-card-trend"><?php echo $unread_count > 0 ? '<span class="text-danger fw-semibold">Unread inquiries</span>' : 'All caught up'; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Shortcuts Grid -->
<div class="admin-card mb-3">
    <div class="admin-card-header">
        <h2 class="admin-card-title"><i class="bi bi-lightning-charge-fill text-info"></i> Quick Access</h2>
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-xl-6 g-2">
        <div class="col">
            <a href="<?php echo BASE_URL; ?>admin/modules/profile/" class="quick-tile">
                <i class="bi bi-person-fill text-info fs-5"></i>
                <span class="text-white small fw-semibold">Profile</span>
            </a>
        </div>
        <div class="col">
            <a href="<?php echo BASE_URL; ?>admin/modules/portfolio/" class="quick-tile">
                <i class="bi bi-grid-fill text-primary fs-5"></i>
                <span class="text-white small fw-semibold">Projects</span>
            </a>
        </div>
        <div class="col">
            <a href="<?php echo BASE_URL; ?>admin/modules/blogs/" class="quick-tile">
                <i class="bi bi-journal-text text-success fs-5"></i>
                <span class="text-white small fw-semibold">Articles</span>
            </a>
        </div>
        <div class="col">
            <a href="<?php echo BASE_URL; ?>admin/modules/timeline/" class="quick-tile">
                <i class="bi bi-clock-history text-warning fs-5"></i>
                <span class="text-white small fw-semibold">Timeline</span>
            </a>
        </div>
        <div class="col">
            <a href="<?php echo BASE_URL; ?>admin/modules/details/" class="quick-tile">
                <i class="bi bi-patch-check-fill text-info fs-5"></i>
                <span class="text-white small fw-semibold">Skills</span>
            </a>
        </div>
        <div class="col">
            <a href="<?php echo BASE_URL; ?>admin/modules/messages/" class="quick-tile">
                <i class="bi bi-envelope-open-fill text-danger fs-5"></i>
                <span class="text-white small fw-semibold">Messages</span>
            </a>
        </div>
    </div>
</div>

<!-- Main Two-Column Workspace -->
<div class="row g-3 mb-3">
    <!-- Recent Articles with 1-Click Shortlink -->
    <div class="col-lg-7">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h2 class="admin-card-title"><i class="bi bi-journal-richtext text-success"></i> Recent Articles &amp; Shortlinks</h2>
                <a href="<?php echo BASE_URL; ?>admin/modules/blogs/" class="btn btn-admin-secondary btn-sm py-1 px-2">All (<?php echo $blogs_count; ?>)</a>
            </div>
            <?php if (empty($blogs)): ?>
                <p class="text-secondary small mb-0">No articles published yet.</p>
            <?php else: ?>
                <div class="d-flex flex-column gap-2">
                    <?php foreach (array_slice(array_reverse($blogs), 0, 5) as $b):
                        $shortUrl = BASE_URL . 'b/' . (int)($b['id'] ?? 0);
                        $isPub = !isset($b['status']) || $b['status'] === 'published';
                    ?>
                        <div class="d-flex align-items-center justify-content-between gap-2 p-2 rounded-3" style="background: var(--admin-surface-2); border: 1px solid var(--admin-border);">
                            <div class="min-w-0 flex-grow-1">
                                <a href="<?php echo BASE_URL; ?>admin/modules/blogs/add.php?edit_id=<?php echo (int)$b['id']; ?>" class="text-white text-decoration-none fw-semibold small d-block text-truncate">
                                    <?php echo e($b['title'] ?? 'Untitled'); ?>
                                </a>
                                <div class="d-flex align-items-center gap-2 text-secondary" style="font-size: 0.72rem; font-family: var(--font-code);">
                                    <span class="<?php echo $isPub ? 'text-success' : 'text-warning'; ?>"><?php echo $isPub ? 'PUBLISHED' : 'DRAFT'; ?></span>
                                    <span>&bull;</span>
                                    <span>/b/<?php echo (int)($b['id'] ?? 0); ?></span>
                                    <span>&bull;</span>
                                    <span><?php echo number_format($b['views'] ?? 0); ?> views</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                <button type="button" class="btn btn-admin-secondary btn-sm py-1 px-2" onclick="copyText('<?php echo e($shortUrl); ?>', this)" title="Copy Shortlink">
                                    <i class="bi bi-link-45deg"></i>
                                </button>
                                <a href="<?php echo e($shortUrl); ?>" target="_blank" class="btn btn-admin-secondary btn-sm py-1 px-2" title="Open Article">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Inquiries + SEO/GEO/AEO Feeds -->
    <div class="col-lg-5 d-flex flex-column gap-3">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title"><i class="bi bi-envelope-fill text-danger"></i> Recent Inquiries</h2>
                <a href="<?php echo BASE_URL; ?>admin/modules/messages/" class="btn btn-admin-secondary btn-sm py-1 px-2">Inbox</a>
            </div>
            <?php if (empty($messages)): ?>
                <p class="text-secondary small mb-0">No client messages yet.</p>
            <?php else: ?>
                <div class="d-flex flex-column gap-2">
                    <?php foreach (array_slice(array_reverse($messages), 0, 3) as $msg):
                        $is_read = isset($msg['read']) && $msg['read'] === true;
                    ?>
                        <div class="p-2 rounded-3" style="background: var(--admin-surface-2); border: 1px solid <?php echo $is_read ? 'var(--admin-border)' : 'rgba(245, 158, 11, 0.5)'; ?>;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold text-white small"><?php echo e($msg['name'] ?? ''); ?></span>
                                <span class="text-secondary" style="font-size: 0.7rem;"><?php echo isset($msg['date']) ? date('M d', strtotime($msg['date'])) : ''; ?></span>
                            </div>
                            <p class="text-secondary small mb-0 text-truncate" style="font-size: 0.78rem;"><?php echo e(($msg['subject'] ?? 'Inquiry') . ' — ' . ($msg['message'] ?? '')); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title"><i class="bi bi-search text-info"></i> SEO / GEO / AEO Endpoints</h2>
                <span class="admin-badge badge-success-subtle">LIVE</span>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?php echo BASE_URL; ?>sitemap.xml" target="_blank" class="btn btn-admin-secondary btn-sm py-1 px-2">sitemap.xml</a>
                <a href="<?php echo BASE_URL; ?>news-sitemap.xml" target="_blank" class="btn btn-admin-secondary btn-sm py-1 px-2">news-sitemap.xml</a>
                <a href="<?php echo BASE_URL; ?>rss.xml" target="_blank" class="btn btn-admin-secondary btn-sm py-1 px-2">rss.xml</a>
                <a href="<?php echo BASE_URL; ?>llms.txt" target="_blank" class="btn btn-admin-secondary btn-sm py-1 px-2">llms.txt</a>
                <a href="<?php echo BASE_URL; ?>ai.txt" target="_blank" class="btn btn-admin-secondary btn-sm py-1 px-2">ai.txt</a>
            </div>
        </div>
    </div>
</div>

<script>
function copyText(url, btn) {
    if (!navigator.clipboard) return;
    navigator.clipboard.writeText(url).then(() => {
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check2 text-success"></i>';
        if (window.showToast) window.showToast('Shortlink copied: ' + url, 'success');
        setTimeout(() => { btn.innerHTML = orig; }, 1600);
    });
}
</script>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
