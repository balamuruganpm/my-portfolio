<?php
/**
 * Partial: Main Navigation & Profile Header Card
 * Optimized for desktop and mobile responsiveness.
 */
$isHome = isset($thisPage) && $thisPage === 'Home';
?>
<!-- Profile Header Card Component -->
<header class="header-card p-3 p-md-4 mb-4" aria-label="Portfolio Header Card">
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
        
        <!-- Left: Profile Info -->
        <div class="d-flex align-items-center gap-3 text-start w-100 w-md-auto">
            <div class="profile-avatar-wrapper profile-avatar-compact flex-shrink-0" aria-hidden="true">
                <div class="profile-avatar-container">
                    <img src="<?php echo BASE_URL; ?>assets/images/balamurugan-pm.webp" 
                         alt="<?php echo e($profileName); ?> - Profile Avatar" 
                         title="<?php echo e($profileName); ?> Profile Avatar" 
                         fetchpriority="high" 
                         decoding="async" 
                         width="75" 
                         height="75" 
                         class="profile-avatar-img img-fluid">
                </div>
            </div>

            <div class="flex-grow-1 overflow-hidden">
                <h1 class="h4 mb-0.5 fw-bold text-dark font-title text-truncate">
                    <?php echo $isHome ? "Hey, I'm " . e($profileName) : e($profileName); ?>
                </h1>
                <p class="text-accent fw-semibold mb-1 font-body small text-truncate" style="font-size: 0.86rem;">
                    <?php echo e($profileSubtitle); ?>
                </p>
                <div class="d-flex align-items-center gap-2 text-secondary small flex-wrap" style="font-size: 0.76rem;">
                    <span><i class="bi bi-geo-alt-fill text-accent me-1"></i><?php echo e($profileLocation); ?></span>
                    <span class="d-none d-sm-inline">&bull;</span>
                    <span class="text-success fw-semibold"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Available for Hire</span>
                </div>
            </div>
        </div>

        <!-- Right: Primary Action Buttons -->
        <div class="d-flex align-items-center gap-2 w-100 w-md-auto justify-content-start justify-content-md-end flex-wrap flex-sm-nowrap">
            <a href="<?php echo BASE_URL; ?>contact" class="button button-sm flex-grow-1 flex-md-grow-0 text-center" aria-label="Hire me and get in touch">
                <span class="button_sm w-100 justify-content-center">
                    <span class="button_sl"></span>
                    <span class="button_text"><i class="bi bi-envelope-fill me-1"></i>HIRE ME</span>
                </span>
            </a>
            <a href="<?php echo BASE_URL; ?>assets/Balamurugan-P-M-Resume.pdf" target="_blank" class="button button-sm button-outline flex-grow-1 flex-md-grow-0 text-center" aria-label="Download Resume PDF">
                <span class="button_sm w-100 justify-content-center">
                    <span class="button_sl"></span>
                    <span class="button_text"><i class="bi bi-download me-1"></i>RESUME</span>
                </span>
            </a>
        </div>
    </div>

    <!-- Navigation Menu Bar -->
    <div class="mt-3 pt-3 border-top border-secondary-subtle d-flex align-items-center justify-content-between gap-2 overflow-x-auto">
        <nav class="header-nav d-flex align-items-center gap-3 gap-md-4 py-1" aria-label="Main Navigation Links">
            <a href="<?php echo BASE_URL; ?>" class="header-nav-link text-nowrap <?php echo ($thisPage === 'Home') ? 'active' : ''; ?>" aria-label="Go to Home page">Home</a>
            <a href="<?php echo BASE_URL; ?>about" class="header-nav-link text-nowrap <?php echo ($thisPage === 'About Us') ? 'active' : ''; ?>" aria-label="Read more About Us">About Us</a>
            <a href="<?php echo BASE_URL; ?>portfolio" class="header-nav-link text-nowrap <?php echo ($thisPage === 'Portfolio') ? 'active' : ''; ?>" aria-label="View my Portfolio Projects">Portfolio</a>
            <a href="<?php echo BASE_URL; ?>blogs" class="header-nav-link text-nowrap <?php echo ($thisPage === 'Blogs') ? 'active' : ''; ?>" aria-label="Read my Blogs and Articles">Blogs</a>
            <a href="<?php echo BASE_URL; ?>game" class="header-nav-link text-nowrap <?php echo ($thisPage === 'Arcade') ? 'active' : ''; ?>" aria-label="Play Arcade Mini Games">Arcade 🎮</a>
            <a href="<?php echo BASE_URL; ?>contact" class="header-nav-link text-nowrap <?php echo ($thisPage === 'Contact Us') ? 'active' : ''; ?>" aria-label="Navigate to Contact Us page">Contact Us</a>
        </nav>

        <!-- Social Icons Quick Row (Desktop only) -->
        <div class="d-none d-md-flex align-items-center gap-2">
            <?php if (!empty($socialsGithub)): ?>
                <a href="<?php echo e($socialsGithub); ?>" target="_blank" rel="noopener noreferrer" class="text-secondary hover-accent p-1" aria-label="GitHub"><i class="bi bi-github"></i></a>
            <?php endif; ?>
            <?php if (!empty($socialsLinkedin)): ?>
                <a href="<?php echo e($socialsLinkedin); ?>" target="_blank" rel="noopener noreferrer" class="text-secondary hover-accent p-1" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <?php endif; ?>
            <?php if (!empty($socialsWhatsapp)): ?>
                <a href="<?php echo e($socialsWhatsapp); ?>" target="_blank" rel="noopener noreferrer" class="text-secondary hover-accent p-1" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            <?php endif; ?>
        </div>
    </div>
</header>
