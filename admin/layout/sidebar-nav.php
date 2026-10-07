<?php
/**
 * Shared Sidebar Navigation Links List (Glassmorphic Dark Edition)
 */
?>
<nav class="d-flex flex-column gap-1 w-100" aria-label="Admin Console Navigation">
    <div class="nav-group-heading">Overview & Analytics</div>
    <a href="<?php echo BASE_URL; ?>admin/modules/dashboard/" class="nav-link-admin <?php echo ($admin_current_page === 'dashboard') ? 'active' : ''; ?>">
        <i class="bi bi-grid-1x2-fill"></i>
        <span>Dashboard</span>
    </a>

    <div class="nav-group-heading">Content & Profile</div>
    <a href="<?php echo BASE_URL; ?>admin/modules/profile/" class="nav-link-admin <?php echo ($admin_current_page === 'profile') ? 'active' : ''; ?>">
        <i class="bi bi-person-bounding-box"></i>
        <span>Profile & Bio</span>
    </a>
    <a href="<?php echo BASE_URL; ?>admin/modules/social-links/" class="nav-link-admin <?php echo ($admin_current_page === 'social-links') ? 'active' : ''; ?>">
        <i class="bi bi-share-fill"></i>
        <span>Social Profiles</span>
    </a>
    <a href="<?php echo BASE_URL; ?>admin/modules/timeline/" class="nav-link-admin <?php echo ($admin_current_page === 'timeline') ? 'active' : ''; ?>">
        <i class="bi bi-clock-history"></i>
        <span>Experience & Education</span>
    </a>
    <a href="<?php echo BASE_URL; ?>admin/modules/details/" class="nav-link-admin <?php echo ($admin_current_page === 'details') ? 'active' : ''; ?>">
        <i class="bi bi-patch-check-fill"></i>
        <span>Skills & Credentials</span>
    </a>

    <div class="nav-group-heading">Publishing Engine</div>
    <a href="<?php echo BASE_URL; ?>admin/modules/blogs/" class="nav-link-admin <?php echo ($admin_current_page === 'blogs') ? 'active' : ''; ?>">
        <i class="bi bi-journal-richtext"></i>
        <span>Blogs & Articles</span>
    </a>
    <a href="<?php echo BASE_URL; ?>admin/modules/portfolio/" class="nav-link-admin <?php echo ($admin_current_page === 'portfolio') ? 'active' : ''; ?>">
        <i class="bi bi-folder-fill"></i>
        <span>Portfolio Works</span>
    </a>

    <div class="nav-group-heading">Communication & System</div>
    <a href="<?php echo BASE_URL; ?>admin/modules/messages/" class="nav-link-admin <?php echo ($admin_current_page === 'messages') ? 'active' : ''; ?>">
        <i class="bi bi-envelope-fill"></i>
        <span>Messages</span>
        <?php if (!empty($unread_count) && $unread_count > 0): ?>
            <span class="nav-badge-pill"><?php echo $unread_count; ?></span>
        <?php endif; ?>
    </a>
    <a href="<?php echo BASE_URL; ?>admin/modules/users/" class="nav-link-admin <?php echo ($admin_current_page === 'users') ? 'active' : ''; ?>">
        <i class="bi bi-shield-lock-fill"></i>
        <span>Security Settings</span>
    </a>

    <div class="nav-group-heading">Quick Actions</div>
    <a href="<?php echo BASE_URL; ?>" target="_blank" class="nav-link-admin text-secondary">
        <i class="bi bi-box-arrow-up-right"></i>
        <span>View Live Site</span>
    </a>
</nav>
