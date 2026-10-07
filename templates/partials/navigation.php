<?php
/**
 * Partial: Ultra-Modern Top Navigation Dock (AlgoLift / PULSE.IO Style)
 */
$curr = strtolower(trim($thisPage ?? 'home'));
$isHome = ($curr === 'home' || $curr === '' || $curr === 'index');
$isAbout = ($curr === 'about' || $curr === 'about us' || $curr === 'about-us');
$isPortfolio = ($curr === 'portfolio' || $curr === 'projects' || $curr === 'works');
$isBlogs = ($curr === 'blogs' || $curr === 'blog' || $curr === 'articles' || $curr === 'category');
$isArcade = ($curr === 'game' || $curr === 'games' || $curr === 'arcade');
$isContact = ($curr === 'contact' || $curr === 'contact us' || $curr === 'contact-us');
?>
<!-- Fixed/Sticky Glassmorphic Top Navigation Bar -->
<header class="site-header-dock" aria-label="Main Navigation">
    <div class="header-dock-inner container d-flex align-items-center justify-content-between py-3">
        
        <!-- Left: Monogram / Brand Identity -->
        <a href="<?php echo BASE_URL; ?>" class="brand-identity d-flex align-items-center gap-2 text-decoration-none" aria-label="Balamurugan P M Home">
            <span class="brand-badge-dot" title="Available for hire"></span>
            <span class="brand-name font-mono fw-bold text-light tracking-wide">BALA<span class="text-accent">.DEV</span></span>
            <span class="status-indicator-pill d-none d-sm-inline-flex">
                <span class="pulse-dot"></span> AVAILABLE
            </span>
        </a>

        <!-- Center: Floating Navigation Pill Dock -->
        <nav class="nav-floating-dock d-none d-lg-flex align-items-center gap-1" aria-label="Primary Navigation">
            <a href="<?php echo BASE_URL; ?>" class="dock-link <?php echo $isHome ? 'active' : ''; ?>">Home</a>
            <a href="<?php echo BASE_URL; ?>about" class="dock-link <?php echo $isAbout ? 'active' : ''; ?>">About</a>
            <a href="<?php echo BASE_URL; ?>portfolio" class="dock-link <?php echo $isPortfolio ? 'active' : ''; ?>">Projects</a>
            <a href="<?php echo BASE_URL; ?>blogs" class="dock-link <?php echo $isBlogs ? 'active' : ''; ?>">Articles</a>
            <a href="<?php echo BASE_URL; ?>game" class="dock-link <?php echo $isArcade ? 'active' : ''; ?>">Arcade</a>
            <a href="<?php echo BASE_URL; ?>contact" class="dock-link <?php echo $isContact ? 'active' : ''; ?>">Contact</a>
        </nav>

        <!-- Right: Actions & Socials -->
        <div class="d-flex align-items-center gap-2">
            <!-- Social Icons (Desktop) -->
            <div class="d-none d-md-flex align-items-center gap-1.5 me-2">
                <?php if (!empty($socialsGithub)): ?>
                    <a href="<?php echo e($socialsGithub); ?>" target="_blank" rel="noopener noreferrer" class="dock-social-icon" aria-label="GitHub"><i class="bi bi-github"></i></a>
                <?php endif; ?>
                <?php if (!empty($socialsLinkedin)): ?>
                    <a href="<?php echo e($socialsLinkedin); ?>" target="_blank" rel="noopener noreferrer" class="dock-social-icon" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                <?php endif; ?>
            </div>

            <!-- Resume & Hire Me Pills -->
            <a href="<?php echo BASE_URL; ?>assets/Balamurugan-P-M-Resume.pdf" target="_blank" class="hud-btn hud-btn-glass d-none d-sm-inline-flex" aria-label="Download Resume PDF">
                <span>CV <i class="bi bi-arrow-up-right ms-1"></i></span>
            </a>
            <a href="<?php echo BASE_URL; ?>contact" class="hud-btn hud-btn-accent" aria-label="Hire me and get in touch">
                <span>HIRE ME</span>
            </a>

            <!-- Mobile Hamburger Toggle -->
            <button class="mobile-menu-toggle d-lg-none" id="mobile-menu-btn" aria-label="Toggle navigation menu" aria-expanded="false">
                <i class="bi bi-list fs-4"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div class="mobile-nav-drawer" id="mobile-nav-drawer">
        <div class="d-flex flex-column gap-2 p-4">
            <a href="<?php echo BASE_URL; ?>" class="mobile-nav-link <?php echo $isHome ? 'active' : ''; ?>">Home</a>
            <a href="<?php echo BASE_URL; ?>about" class="mobile-nav-link <?php echo $isAbout ? 'active' : ''; ?>">About</a>
            <a href="<?php echo BASE_URL; ?>portfolio" class="mobile-nav-link <?php echo $isPortfolio ? 'active' : ''; ?>">Projects</a>
            <a href="<?php echo BASE_URL; ?>blogs" class="mobile-nav-link <?php echo $isBlogs ? 'active' : ''; ?>">Articles</a>
            <a href="<?php echo BASE_URL; ?>game" class="mobile-nav-link <?php echo $isArcade ? 'active' : ''; ?>">Arcade Hub</a>
            <a href="<?php echo BASE_URL; ?>contact" class="mobile-nav-link <?php echo $isContact ? 'active' : ''; ?>">Contact</a>
            <div class="d-flex gap-2 mt-3 pt-3 border-top border-secondary-subtle">
                <a href="<?php echo BASE_URL; ?>assets/Balamurugan-P-M-Resume.pdf" target="_blank" class="hud-btn hud-btn-glass w-100 text-center justify-content-center">Resume PDF</a>
            </div>
        </div>
    </div>
</header>
