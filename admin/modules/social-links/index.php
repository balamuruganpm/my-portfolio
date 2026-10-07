<?php
/**
 * Admin Module: Social Media & Portfolio Links
 */
$admin_current_page = 'social-links';
$page_title = 'Social Links';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$message = '';
$message_type = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrfToken();

    $social_platforms = [
        'figma', 'linkedin', 'github', 'behance', 'dribbble', 
        'facebook', 'twitter', 'instagram', 'codepen', 'discord', 
        'whatsapp', 'contra'
    ];

    foreach ($social_platforms as $platform) {
        $data['socials'][$platform] = isset($_POST[$platform]) ? trim($_POST[$platform]) : '';
    }

    if (saveAdminData($data)) {
        $message = 'Social links updated successfully!';
        $message_type = 'success';
    } else {
        $message = 'Failed to write updates to data.json.';
        $message_type = 'danger';
    }
}

$socials = $data['socials'] ?? [];

include __DIR__ . '/../../layout/header.php';
?>

<div class="mb-4">
    <h1 class="h3 fw-bold text-dark mb-1 font-title">Social Links & External Profiles</h1>
    <p class="text-secondary small mb-0">Manage URL addresses to your design repositories, developer portfolios, and social communication channels</p>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $message_type; ?> border-0 py-3 px-4 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: <?php echo $message_type === 'success' ? 'var(--admin-success-bg)' : 'var(--admin-danger-bg)'; ?>; color: <?php echo $message_type === 'success' ? 'var(--admin-success)' : 'var(--admin-danger)'; ?>;">
        <i class="bi <?php echo $message_type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?>"></i>
        <div><?php echo e($message); ?></div>
    </div>
<?php endif; ?>

<div class="card admin-card p-4 p-md-5">
    <form method="POST" action="index.php">
        <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">

        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-bezier2 me-1 text-accent"></i>Figma Profile URL</label>
                <input type="url" name="figma" class="form-control" value="<?php echo e($socials['figma'] ?? ''); ?>" placeholder="https://www.figma.com/@...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-linkedin me-1 text-accent"></i>LinkedIn URL</label>
                <input type="url" name="linkedin" class="form-control" value="<?php echo e($socials['linkedin'] ?? ''); ?>" placeholder="https://www.linkedin.com/in/...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-github me-1 text-accent"></i>GitHub Profile URL</label>
                <input type="url" name="github" class="form-control" value="<?php echo e($socials['github'] ?? ''); ?>" placeholder="https://github.com/...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-bootstrap me-1 text-accent"></i>Behance Portfolio URL</label>
                <input type="url" name="behance" class="form-control" value="<?php echo e($socials['behance'] ?? ''); ?>" placeholder="https://www.behance.net/...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-dribbble me-1 text-accent"></i>Dribbble Profile URL</label>
                <input type="url" name="dribbble" class="form-control" value="<?php echo e($socials['dribbble'] ?? ''); ?>" placeholder="https://dribbble.com/...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-facebook me-1 text-accent"></i>Facebook Page URL</label>
                <input type="url" name="facebook" class="form-control" value="<?php echo e($socials['facebook'] ?? ''); ?>" placeholder="https://www.facebook.com/...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-twitter-x me-1 text-accent"></i>Twitter / X URL</label>
                <input type="url" name="twitter" class="form-control" value="<?php echo e($socials['twitter'] ?? ''); ?>" placeholder="https://twitter.com/...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-instagram me-1 text-accent"></i>Instagram Profile URL</label>
                <input type="url" name="instagram" class="form-control" value="<?php echo e($socials['instagram'] ?? ''); ?>" placeholder="https://instagram.com/...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-code-square me-1 text-accent"></i>CodePen Profile URL</label>
                <input type="url" name="codepen" class="form-control" value="<?php echo e($socials['codepen'] ?? ''); ?>" placeholder="https://codepen.io/...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-discord me-1 text-accent"></i>Discord Invite URL</label>
                <input type="url" name="discord" class="form-control" value="<?php echo e($socials['discord'] ?? ''); ?>" placeholder="https://discordapp.com/...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-whatsapp me-1 text-accent"></i>WhatsApp API Link</label>
                <input type="url" name="whatsapp" class="form-control" value="<?php echo e($socials['whatsapp'] ?? ''); ?>" placeholder="https://wa.me/...">
            </div>
            <div class="col-md-6">
                <label class="form-label"><i class="bi bi-link-45deg me-1 text-accent"></i>Contra Profile URL</label>
                <input type="url" name="contra" class="form-control" value="<?php echo e($socials['contra'] ?? ''); ?>" placeholder="https://...contra.com/">
            </div>
        </div>

        <div class="mt-5 pt-3 border-top border-secondary-subtle">
            <button type="submit" class="btn btn-warning-custom px-4 py-2.5">
                <i class="bi bi-check2-circle me-1"></i>Save Social Links
            </button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
