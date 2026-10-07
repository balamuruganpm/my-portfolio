<?php
/**
 * Admin Module: Profile & Bio Management (Glassmorphic Dark Edition)
 */
$admin_current_page = 'profile';
$page_title = 'Edit Profile & Bio';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$message = '';
$message_type = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrfToken();

    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $subtitle = isset($_POST['subtitle']) ? trim($_POST['subtitle']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone_input = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $biography = isset($_POST['biography']) ? trim($_POST['biography']) : '';

    $phone_array = array_filter(array_map('trim', explode(',', $phone_input)));

    if (!empty($name) && !empty($title)) {
        $data['profile']['name'] = $name;
        $data['profile']['title'] = $title;
        $data['profile']['subtitle'] = $subtitle;
        $data['profile']['email'] = $email;
        $data['profile']['phone'] = $phone_array;
        $data['profile']['location'] = $location;
        $data['profile']['biography'] = $biography;

        $data['ads_enabled'] = isset($_POST['ads_enabled']) && $_POST['ads_enabled'] === '1';

        if (!isset($data['accessibility'])) {
            $data['accessibility'] = [];
        }
        $data['accessibility']['mascot']['default_speech'] = isset($_POST['mascot_default_speech']) ? trim($_POST['mascot_default_speech']) : 'Want to talk? Hire me! 👋';
        $data['accessibility']['mascot']['bento_speech'] = isset($_POST['mascot_bento_speech']) ? trim($_POST['mascot_bento_speech']) : '';
        $data['accessibility']['mascot']['whatsapp_message'] = isset($_POST['mascot_whatsapp_message']) ? trim($_POST['mascot_whatsapp_message']) : 'Hi, I saw your portfolio';
        $data['accessibility']['experience']['speech'] = isset($_POST['mascot_experience_speech']) ? trim($_POST['mascot_experience_speech']) : '';
        $data['accessibility']['skills']['speech'] = isset($_POST['mascot_skills_speech']) ? trim($_POST['mascot_skills_speech']) : '';
        $data['accessibility']['portfolio']['speech'] = isset($_POST['mascot_portfolio_speech']) ? trim($_POST['mascot_portfolio_speech']) : '';
        $data['accessibility']['blogs']['speech'] = isset($_POST['mascot_blogs_speech']) ? trim($_POST['mascot_blogs_speech']) : '';
        $data['accessibility']['contact']['speech'] = isset($_POST['mascot_contact_speech']) ? trim($_POST['mascot_contact_speech']) : '';
        $data['accessibility']['education']['speech'] = isset($_POST['mascot_education_speech']) ? trim($_POST['mascot_education_speech']) : '';

        if (saveAdminData($data)) {
            $message = 'Profile details and mascot speech configurations saved successfully!';
            $message_type = 'success';
        } else {
            $message = 'Failed to save changes to database file.';
            $message_type = 'danger';
        }
    } else {
        $message = 'Full Name and Primary Role Title are required fields.';
        $message_type = 'danger';
    }
}

$profile = $data['profile'] ?? [];
$phones = isset($profile['phone']) ? implode(', ', $profile['phone']) : '';
$accSettings = $data['accessibility'] ?? [];

include __DIR__ . '/../../layout/header.php';
?>

<div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-white mb-1">Profile & Executive Bio</h1>
        <p class="text-secondary small mb-0">Update core credentials, contact details, executive summary, and mascot speeches</p>
    </div>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $message_type; ?> border-0 py-3 px-4 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: <?php echo $message_type === 'success' ? 'var(--admin-success-bg)' : 'var(--admin-danger-bg)'; ?>; color: <?php echo $message_type === 'success' ? 'var(--admin-success)' : 'var(--admin-danger)'; ?>;">
        <i class="bi <?php echo $message_type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?>"></i>
        <div><?php echo e($message); ?></div>
    </div>
<?php endif; ?>

<div class="admin-card p-4 p-md-5">
    <form method="POST" action="index.php">
        <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">

        <div class="d-flex align-items-center gap-2 mb-4 pb-2 border-bottom border-secondary border-opacity-25">
            <div class="admin-brand-icon" style="width: 32px; height: 32px; font-size: 1rem;">
                <i class="bi bi-person-bounding-box"></i>
            </div>
            <h3 class="h6 fw-bold text-white mb-0 text-uppercase" style="letter-spacing: 0.8px;">Personal Credentials</h3>
        </div>
        
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo e($profile['name'] ?? ''); ?>" required placeholder="e.g. Balamurugan P M">
            </div>
            <div class="col-md-6">
                <label class="form-label">Primary Role / Job Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo e($profile['title'] ?? ''); ?>" required placeholder="e.g. Frontend Developer - React.js">
            </div>
            <div class="col-md-6">
                <label class="form-label">Header Subtitle Summary</label>
                <input type="text" name="subtitle" class="form-control" value="<?php echo e($profile['subtitle'] ?? ''); ?>" required placeholder="Short summary subtitle">
            </div>
            <div class="col-md-6">
                <label class="form-label">Primary Email Address</label>
                <input type="email" name="email" class="form-control" value="<?php echo e($profile['email'] ?? ''); ?>" required placeholder="email@example.com">
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone Coordinates (Comma Separated)</label>
                <input type="text" name="phone" class="form-control" value="<?php echo e($phones); ?>" required placeholder="+91 9677804820">
            </div>
            <div class="col-md-6">
                <label class="form-label">Location / Work Geography</label>
                <input type="text" name="location" class="form-control" value="<?php echo e($profile['location'] ?? ''); ?>" required placeholder="Salem, Tamil Nadu, India">
            </div>
            <div class="col-12">
                <label class="form-label">Executive Biography</label>
                <textarea name="biography" rows="4" class="form-control" required placeholder="Write a brief professional summary..."><?php echo e($profile['biography'] ?? ''); ?></textarea>
            </div>
            <div class="col-12">
                <div class="form-check form-switch p-3 rounded-3 border border-secondary border-opacity-25" style="background: rgba(15, 23, 42, 0.6); padding-left: 3.5em !important;">
                    <input class="form-check-input" type="checkbox" role="switch" id="ads_enabled" name="ads_enabled" value="1" <?php echo (!isset($data['ads_enabled']) || $data['ads_enabled']) ? 'checked' : ''; ?>>
                    <label class="form-check-label text-white small fw-bold" for="ads_enabled">Enable Global Advertisements</label>
                    <div class="text-secondary small">Toggle ad banners ON or OFF across public blog articles.</div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2 mb-4 pt-3 pb-2 border-bottom border-secondary border-opacity-25">
            <div class="admin-brand-icon" style="width: 32px; height: 32px; font-size: 1rem; background: var(--admin-secondary-gradient);">
                <i class="bi bi-chat-quote-fill"></i>
            </div>
            <h3 class="h6 fw-bold text-white mb-0 text-uppercase" style="letter-spacing: 0.8px;">Mascot Dialogues</h3>
        </div>
            
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Floating Idle Speech</label>
                <input type="text" name="mascot_default_speech" class="form-control" value="<?php echo e($accSettings['mascot']['default_speech'] ?? 'Want to talk? Hire me! 👋'); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Home Bento Grid Speech</label>
                <input type="text" name="mascot_bento_speech" class="form-control" value="<?php echo e($accSettings['mascot']['bento_speech'] ?? ''); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">WhatsApp Click Message</label>
                <input type="text" name="mascot_whatsapp_message" class="form-control" value="<?php echo e($accSettings['mascot']['whatsapp_message'] ?? 'Hi, I saw your portfolio'); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Experience Ladder Speech</label>
                <input type="text" name="mascot_experience_speech" class="form-control" value="<?php echo e($accSettings['experience']['speech'] ?? ''); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Skills Grid Speech</label>
                <input type="text" name="mascot_skills_speech" class="form-control" value="<?php echo e($accSettings['skills']['speech'] ?? ''); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Portfolio Gallery Speech</label>
                <input type="text" name="mascot_portfolio_speech" class="form-control" value="<?php echo e($accSettings['portfolio']['speech'] ?? ''); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Blogs Feed Speech</label>
                <input type="text" name="mascot_blogs_speech" class="form-control" value="<?php echo e($accSettings['blogs']['speech'] ?? ''); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Contact Form Speech</label>
                <input type="text" name="mascot_contact_speech" class="form-control" value="<?php echo e($accSettings['contact']['speech'] ?? ''); ?>">
            </div>
        </div>

        <div class="mt-5 pt-3 border-top border-secondary border-opacity-25">
            <button type="submit" class="btn btn-admin-primary px-4 py-2.5">
                <i class="bi bi-check2-circle me-1"></i> Save Profile Changes
            </button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
