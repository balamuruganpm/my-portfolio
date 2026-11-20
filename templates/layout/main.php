<?php
/**
 * Master Main Layout
 * Native 100vw x 100vh Single-Viewport Web OS Experience
 */

// Include head
include __DIR__ . '/head.php';

// Include body start
include __DIR__ . '/body-start.php';

// Active page & dossier state
$rawPage = strtolower(trim($thisPage ?? 'home'));
$isHome = ($rawPage === 'home' || $rawPage === '' || $rawPage === 'index');
$activeApp = $isHome ? 'home' : $rawPage;
$isDossierOpen = !$isHome;
?>

<!-- Root Single-Viewport OS Stage (Strict 100vw x 100vh, Zero Overflow) -->
<div id="os-viewport" class="os-stage <?php echo $isDossierOpen ? 'dossier-active' : 'desktop-active'; ?>" data-active-app="<?php echo e($activeApp); ?>" data-base-url="<?php echo BASE_URL; ?>">

    <!-- ============================================================ -->
    <!-- MASTER DYNAMIC BACKGROUND LAYER (100vw x 100vh, Cover)       -->
    <!-- ============================================================ -->
    <div class="os-bg-layer" id="os-bg-layer" aria-hidden="true">
        <!-- Video Background for Home Page (Plays seamlessly, loop, muted, cover) -->
        <video id="os-home-video" class="os-bg-video" autoplay loop muted playsinline webkit-playsinline preload="auto">
            <source src="<?php echo BASE_URL; ?>assets/images/os/home-bg.mp4" type="video/mp4">
        </video>

        <!-- Dynamic Section Image Background (for about-bg.webp, projects-bg.webp, blog-bg.webp, games-bg.webp, contact-bg.webp) -->
        <div id="os-section-bg" class="os-bg-image" style="display: none;"></div>

        <!-- Ambient Atmospheric Overlay / Vignette -->
        <div class="os-bg-overlay"></div>
    </div>

    <!-- ============================================================ -->
    <!-- DESKTOP TOP HUD BAR (Widgets: Clock, Availability, Tech, Mode) -->
    <!-- ============================================================ -->
    <header class="os-hud-bar <?php echo $isDossierOpen ? 'fade-out' : ''; ?>" id="os-hud-bar" role="banner">
        <div class="hud-group hud-left">
            <!-- Available for Work Status -->
            <div class="os-hud-badge badge-status" title="Current Availability Status">
                <span class="status-pulse-dot" aria-hidden="true"></span>
                <span class="badge-text">Available for work</span>
            </div>

            <!-- Coimbatore, India Location -->
            <!-- <div class="os-hud-badge badge-location d-none d-md-flex" title="Current Base Location">
                <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                <span class="badge-text">Coimbatore, India</span>
            </div> -->
        </div>

        <div class="hud-group hud-right">
            <!-- Currently Learning -->
            <!-- <div class="os-hud-badge badge-learning d-none d-lg-flex" title="Active Learning Track">
                <i class="bi bi-mortarboard-fill text-cyan me-1"></i>
                <span class="badge-text">SharePoint, Power Platform &amp; React</span>
            </div> -->

            <!-- Live Clock & Date -->
            <div class="os-hud-badge badge-clock" id="os-live-clock" title="Local System Clock">
                <i class="bi bi-clock me-1 text-warning"></i>
                <span id="hud-time" class="font-mono">--:--:--</span>
                <span class="hud-divider">|</span>
                <span id="hud-date" class="font-mono">-- ---</span>
            </div>
        </div>
    </header>

    <!-- ============================================================ -->
    <!-- CENTRAL HERO TYPOGRAPHY (Artistic Poster Style from Reference) -->
    <!-- Large, expressive graphic center WITHOUT background container  -->
    <!-- ============================================================ -->
    <div class="os-central-hero <?php echo $isDossierOpen ? 'fade-out' : ''; ?>" id="os-central-hero" role="region" aria-label="Portfolio Introduction">
        <div class="central-hero-canvas" id="central-hero-tilt">
            
            <!-- 1. Top Oval Name Pill -->
            <div class="hero-oval-pill">
                <span class="oval-name"><?php echo e(!empty($profileName) ? $profileName : 'BALAMURUGAN P M'); ?></span>
            </div>

            <!-- 2. Massive PortFolio Title (Geometric Sans + Fluid Outline Script) -->
            <div class="hero-main-title">
                <span class="title-script">Port</span><span class="title-script">Folio</span>
            </div>

            <!-- 3. Year & Avatar Graphic Selection Bounding Box -->
            <div class="hero-year-row">
                <span class="year-num year-prefix">20</span>
                
                <div class="hero-selection-box" title="Hey, I'm Bala 👋">
                    <!-- Graphic Selection Handles (8 Anchor points) -->
                    <span class="sel-handle handle-tl" aria-hidden="true"></span>
                    <span class="sel-handle handle-tc" aria-hidden="true"></span>
                    <span class="sel-handle handle-tr" aria-hidden="true"></span>
                    <span class="sel-handle handle-mr" aria-hidden="true"></span>
                    <span class="sel-handle handle-br" aria-hidden="true"></span>
                    <span class="sel-handle handle-bc" aria-hidden="true"></span>
                    <span class="sel-handle handle-bl" aria-hidden="true"></span>
                    <span class="sel-handle handle-ml" aria-hidden="true"></span>

                    <!-- Avatar Media with Greeting Badge -->
                    <div class="sel-avatar-wrapper">
                        <img src="<?php echo BASE_URL; ?>assets/images/balamurugan-pm.webp" alt="<?php echo e(!empty($profileName) ? $profileName : 'Balamurugan P M'); ?>" class="sel-avatar-img" width="100" height="100">
                        <span class="sel-avatar-greeting">Hey, I'm Bala 👋</span>
                    </div>
                </div>

                <span class="year-num year-suffix">27</span>
            </div>

            <!-- 4. Interactive Skills Typewriter Element -->
            <div class="hero-typing-wrapper" aria-live="polite">
                <span class="typing-tag font-mono">// SKILLS:</span>
                <span id="hero-typing-skills" class="typing-text font-mono">Frontend Architecture</span><span class="typing-cursor" aria-hidden="true">_</span>
            </div>

            <!-- 5. Subtitle Disciplines Line -->
            <div class="hero-disciplines-row d-none d-sm-flex">
                <span class="discipline-tag">FRONTEND ARCHITECTURE</span>
                <span class="discipline-sep">•</span>
                <span class="discipline-tag">REACT &amp; TYPESCRIPT</span>
                <span class="discipline-sep">•</span>
                <span class="discipline-tag">SHAREPOINT SPFx</span>
                <span class="discipline-sep">•</span>
                <span class="discipline-tag">UI/UX SYSTEMS</span>
            </div>

            <!-- 6. Quick Interactive CTAs -->
            <div class="hero-cta-actions">
                <button type="button" class="central-cta-btn cta-primary" data-app="portfolio">
                    <i class="bi bi-grid-fill me-1"></i> Explore Works
                </button>
                <button type="button" class="central-cta-btn cta-secondary" data-app="about">
                    <i class="bi bi-person-fill me-1"></i> About Me
                </button>
            </div>

        </div>
    </div>

    <!-- ============================================================ -->
    <!-- DESKTOP ICONS LAYER (Prominent 3D WebP Icons on Left & Right) -->
    <!-- ============================================================ -->
    <div class="os-desktop-icons-layer <?php echo $isDossierOpen ? 'fade-out' : ''; ?>" id="os-desktop-grid" role="region" aria-label="Desktop Applications">
        
        <!-- Left Column -->
        <div class="os-desktop-col os-col-left">
            <!-- 1. Home -->
            <button type="button" class="os-desktop-icon-btn <?php echo ($activeApp === 'home') ? 'active' : ''; ?>" data-app="home" data-route="<?php echo BASE_URL; ?>" aria-label="Home Application">
                <div class="icon-media-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/home.webp" alt="Home" class="desktop-icon-img" width="90" height="90">
                    <div class="icon-halo" aria-hidden="true"></div>
                </div>
                <span class="desktop-icon-label">Home</span>
            </button>

            <!-- 2. Projects -->
            <button type="button" class="os-desktop-icon-btn <?php echo ($activeApp === 'portfolio') ? 'active' : ''; ?>" data-app="portfolio" data-route="<?php echo BASE_URL; ?>portfolio" aria-label="Projects Showcase">
                <div class="icon-media-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/projects.webp" alt="Projects" class="desktop-icon-img" width="90" height="90">
                    <div class="icon-halo" aria-hidden="true"></div>
                </div>
                <span class="desktop-icon-label">Projects</span>
            </button>

            <!-- 3. About Me -->
            <button type="button" class="os-desktop-icon-btn <?php echo ($activeApp === 'about') ? 'active' : ''; ?>" data-app="about" data-route="<?php echo BASE_URL; ?>about" aria-label="About Me Dossier">
                <div class="icon-media-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/about.webp" alt="About Me" class="desktop-icon-img" width="90" height="90">
                    <div class="icon-halo" aria-hidden="true"></div>
                </div>
                <span class="desktop-icon-label">About Me</span>
            </button>
        </div>

        <!-- Right Column -->
        <div class="os-desktop-col os-col-right">
            <!-- 4. Blogs -->
            <button type="button" class="os-desktop-icon-btn <?php echo ($activeApp === 'blogs') ? 'active' : ''; ?>" data-app="blogs" data-route="<?php echo BASE_URL; ?>blogs" aria-label="Blog Articles">
                <div class="icon-media-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/blog.webp" alt="Blogs" class="desktop-icon-img" width="90" height="90">
                    <div class="icon-halo" aria-hidden="true"></div>
                </div>
                <span class="desktop-icon-label">Blogs</span>
            </button>

            <!-- 5. Games -->
            <button type="button" class="os-desktop-icon-btn <?php echo ($activeApp === 'game') ? 'active' : ''; ?>" data-app="game" data-route="<?php echo BASE_URL; ?>game" aria-label="Retro Games Arcade">
                <div class="icon-media-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/games.webp" alt="Games" class="desktop-icon-img" width="90" height="90">
                    <div class="icon-halo" aria-hidden="true"></div>
                </div>
                <span class="desktop-icon-label">Games</span>
            </button>

            <!-- 6. Contact Us -->
            <button type="button" class="os-desktop-icon-btn <?php echo ($activeApp === 'contact') ? 'active' : ''; ?>" data-app="contact" data-route="<?php echo BASE_URL; ?>contact" aria-label="Contact Us Portal">
                <div class="icon-media-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/contact.webp" alt="Contact Us" class="desktop-icon-img" width="90" height="90">
                    <div class="icon-halo" aria-hidden="true"></div>
                </div>
                <span class="desktop-icon-label">Contact Us</span>
            </button>
        </div>

        <!-- Desktop Home Watermark -->
        <!-- <div class="os-desktop-watermark" aria-hidden="true">
            Bala @2027 – Portfolio
        </div> -->

    </div>

    <!-- ============================================================ -->
    <!-- FLOATING RECENT ACTIVITY TRIGGER & PANEL (Bottom-Left)       -->
    <!-- ============================================================ -->
    <div class="os-activity-corner <?php echo $isDossierOpen ? 'fade-out' : ''; ?>" id="os-activity-corner">
        <button type="button" class="os-activity-trigger-btn" id="os-activity-trigger" aria-label="View Recent Activity" title="Desktop Notifications &amp; Recent Activity">
            <span class="activity-pulse-dot" aria-hidden="true"></span>
            <i class="bi bi-bell-fill me-1.5"></i>
            <span class="activity-btn-label d-none d-sm-inline">Recent Activity</span>
            <span class="activity-badge-count">4</span>
        </button>

        <!-- Recent Activity Popup Panel -->
        <div class="os-activity-panel" id="os-activity-panel" role="dialog" aria-modal="false" aria-labelledby="activity-panel-title">
            <div class="activity-panel-header d-flex align-items-center justify-content-between mb-3 border-subbox-item pb-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="dossier-mono-tag" id="activity-panel-title">// NOTIFICATION_HUB</span>
                    <span class="activity-live-indicator">LIVE</span>
                </div>
                <button type="button" class="dossier-close-btn" id="activity-panel-close-btn" aria-label="Close Activity Panel">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="activity-panel-list d-flex flex-column gap-2">
                <!-- 1. Active Learning -->
                <div class="activity-tile">
                    <div class="activity-tile-icon icon-cyan">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="activity-tile-body">
                        <span class="activity-tile-tag text-cyan">Active Learning</span>
                        <h4 class="activity-tile-title">SharePoint &amp; Power Platform</h4>
                        <p class="activity-tile-desc">Mastering Power Apps, Power Automate workflow automation, SPFx solutions and modern React.</p>
                    </div>
                </div>

                <!-- 2. Latest Project -->
                <div class="activity-tile">
                    <div class="activity-tile-icon icon-amber">
                        <i class="bi bi-phone-fill"></i>
                    </div>
                    <div class="activity-tile-body">
                        <span class="activity-tile-tag text-warning">Latest Project</span>
                        <h4 class="activity-tile-title">Building Mobile UI</h4>
                        <p class="activity-tile-desc">Interactive mobile appointment scheduling, responsive calendar flows &amp; touch optimization.</p>
                    </div>
                </div>

                <!-- 3. Recently Updated -->
                <div class="activity-tile">
                    <div class="activity-tile-icon icon-purple">
                        <i class="bi bi-rocket-takeoff-fill"></i>
                    </div>
                    <div class="activity-tile-body">
                        <span class="activity-tile-tag text-purple">Recently Updated</span>
                        <h4 class="activity-tile-title">G7 Motive Added for Client</h4>
                        <p class="activity-tile-desc">Enterprise digital solutions, corporate branding, and modern client portal delivery.</p>
                    </div>
                </div>

                <!-- 4. GitHub Activity -->
                <div class="activity-tile">
                    <div class="activity-tile-icon icon-white">
                        <i class="bi bi-github"></i>
                    </div>
                    <div class="activity-tile-body">
                        <span class="activity-tile-tag text-white">GitHub Activity</span>
                        <h4 class="activity-tile-title">Active Open Source Commits</h4>
                        <a href="https://github.com/Balamuruganpm/" target="_blank" rel="noopener noreferrer" class="activity-tile-link">
                            <span>github.com/Balamuruganpm</span> <i class="bi bi-arrow-up-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- HOME BOTTOM 3D FEATURED PROJECTS DECK (Half-Hidden Peek)     -->
    <!-- Pure Image Only, 3D Perspective, Center Button               -->
    <!-- ============================================================ -->
    <?php 
    $topProjects = array_slice($projects ?? [], 0, 3);
    if (!empty($topProjects)): 
    ?>
    <div class="os-home-3d-deck <?php echo $isDossierOpen ? 'fade-out' : ''; ?>" id="os-home-3d-deck" role="region" aria-label="Featured Works 3D Deck">
        <!-- Center Action Button -->
        <div class="home-3d-deck-header text-center">
            <button type="button" class="home-3d-center-btn" data-app="portfolio" title="Explore All Featured Projects">
                <span class="center-btn-dot" aria-hidden="true"></span>
                <span>View All Projects (<?php echo count($projects ?? []); ?>)</span>
                <i class="bi bi-arrow-up-right ms-1"></i>
            </button>
        </div>

        <!-- 3D Half-Hidden Cards (Pure Images, No Text) -->
        <div class="home-3d-cards-row">
            <?php foreach ($topProjects as $idx => $p): 
                $pImg = !empty($p['image']) ? (BASE_URL . ltrim($p['image'], '/')) : '';
                $pTitle = !empty($p['title']) ? $p['title'] : 'Project ' . ($idx + 1);
                $cardPosClass = ($idx === 0) ? 'card-pos-left' : (($idx === 1) ? 'card-pos-center' : 'card-pos-right');
            ?>
            <div class="home-3d-card <?php echo $cardPosClass; ?>" data-app="portfolio" data-img="<?php echo e($pImg); ?>" data-title="<?php echo e($pTitle); ?>" role="button" tabindex="0" title="<?php echo e($pTitle); ?> — Click to open">
                <div class="home-3d-card-inner">
                    <img src="<?php echo e($pImg); ?>" alt="<?php echo e($pTitle); ?>" class="home-3d-img" loading="lazy">
                    <div class="home-3d-glare" aria-hidden="true"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- ============================================================ -->
    <!-- INTERACTIVE DOSSIER MODAL OVERLAY (Image 4 / Section Views)   -->
    <!-- All Glass Effects / Glassmorphic / Backdrop Blur              -->
    <!-- ============================================================ -->
    <section class="os-dossier-stage <?php echo $isDossierOpen ? 'visible' : ''; ?>" id="os-dossier-modal" role="dialog" aria-modal="true" aria-label="Developer Profile Dossier">
        <div class="os-dossier-dialog">
            
            <!-- Top Dossier Card: Background & Engineering Philosophy (Only shown on About Me) -->
            <?php include BASE_PATH . 'templates/sections/dossier-profile.php'; ?>

            <!-- Bottom Dossier Card: Dynamic Tab Capabilities Content -->
            <?php include BASE_PATH . 'templates/sections/dossier-bottom.php'; ?>

        </div>
    </section>

    <!-- ============================================================ -->
    <!-- FLOATING BOTTOM DOCK (Visible ONLY in Dossier / Section Mode) -->
    <!-- ============================================================ -->
    <nav class="os-bottom-dock <?php echo !$isDossierOpen ? 'd-none' : ''; ?>" id="os-dock" style="<?php echo !$isDossierOpen ? 'display: none !important;' : ''; ?>" aria-label="System Application Dock">
        <div class="dock-inner-container">
            
            <!-- Home -->
            <button type="button" class="dock-item <?php echo ($activeApp === 'home') ? 'active' : ''; ?>" data-app="home" data-route="<?php echo BASE_URL; ?>" aria-label="Home">
                <div class="dock-icon-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/home.webp" alt="Home" class="dock-img" width="48" height="48">
                    <div class="dock-active-halo" aria-hidden="true"></div>
                </div>
                <span class="dock-label">Home</span>
            </button>

            <!-- Blogs -->
            <button type="button" class="dock-item <?php echo ($activeApp === 'blogs') ? 'active' : ''; ?>" data-app="blogs" data-route="<?php echo BASE_URL; ?>blogs" aria-label="Blogs">
                <div class="dock-icon-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/blog.webp" alt="Blogs" class="dock-img" width="48" height="48">
                    <div class="dock-active-halo" aria-hidden="true"></div>
                </div>
                <span class="dock-label">Blogs</span>
            </button>

            <!-- Projects -->
            <button type="button" class="dock-item <?php echo ($activeApp === 'portfolio') ? 'active' : ''; ?>" data-app="portfolio" data-route="<?php echo BASE_URL; ?>portfolio" aria-label="Projects">
                <div class="dock-icon-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/projects.webp" alt="Projects" class="dock-img" width="48" height="48">
                    <div class="dock-active-halo" aria-hidden="true"></div>
                </div>
                <span class="dock-label">Projects</span>
            </button>

            <!-- Games -->
            <button type="button" class="dock-item <?php echo ($activeApp === 'game') ? 'active' : ''; ?>" data-app="game" data-route="<?php echo BASE_URL; ?>game" aria-label="Games">
                <div class="dock-icon-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/games.webp" alt="Games" class="dock-img" width="48" height="48">
                    <div class="dock-active-halo" aria-hidden="true"></div>
                </div>
                <span class="dock-label">Games</span>
            </button>

            <!-- About Me -->
            <button type="button" class="dock-item <?php echo ($activeApp === 'about') ? 'active' : ''; ?>" data-app="about" data-route="<?php echo BASE_URL; ?>about" aria-label="About Me">
                <div class="dock-icon-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/about.webp" alt="About Me" class="dock-img" width="48" height="48">
                    <div class="dock-active-halo" aria-hidden="true"></div>
                </div>
                <span class="dock-label">About Me</span>
            </button>

            <!-- Contact Us -->
            <button type="button" class="dock-item <?php echo ($activeApp === 'contact') ? 'active' : ''; ?>" data-app="contact" data-route="<?php echo BASE_URL; ?>contact" aria-label="Contact Us">
                <div class="dock-icon-wrapper">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/contact.webp" alt="Contact Us" class="dock-img" width="48" height="48">
                    <div class="dock-active-halo" aria-hidden="true"></div>
                </div>
                <span class="dock-label">Contact Us</span>
            </button>

        </div>

        <!-- Corner Watermark in Dossier View -->
        <!-- <div class="dock-corner-watermark d-none d-md-block" aria-hidden="true">
            Bala @2027 - Portfolio
        </div> -->
    </nav>

    <!-- ============================================================ -->
    <!-- ARTICLE READER MODAL (For reading full blog articles)         -->
    <!-- ============================================================ -->
    <div class="os-article-modal" id="os-article-modal" role="dialog" aria-modal="true" aria-labelledby="article-modal-title">
        <div class="os-article-dialog">
            <div class="dossier-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3 border-subbox-item pb-2">
                    <span class="dossier-mono-tag">// ARTICLE_VIEWPORT</span>
                    <button type="button" class="dossier-close-btn" id="article-modal-close-btn" aria-label="Close Article">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <h2 class="h4 fw-bold text-white mb-2" id="article-modal-title">Article Title</h2>
                <div class="text-secondary small font-mono mb-3" id="article-modal-meta">Meta Info</div>
                <div class="article-modal-body font-body text-secondary leading-relaxed" id="article-modal-content">
                    Loading content...
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- FULL IMAGE LIGHTBOX MODAL (Interactive Zoom & Pan Viewer)    -->
    <!-- ============================================================ -->
    <div class="os-image-lightbox" id="os-image-lightbox" role="dialog" aria-modal="true" aria-label="Full Image Viewer">
        <!-- Close Button -->
        <button type="button" class="lightbox-close-btn" id="lightbox-close-btn" aria-label="Close Full Image (Esc)" title="Close (Esc)">
            <i class="bi bi-x-lg"></i>
        </button>

        <!-- Floating Glass Zoom Controls Toolbar -->
        <div class="lightbox-zoom-toolbar" id="lightbox-zoom-toolbar" role="toolbar" aria-label="Image Zoom Controls">
            <button type="button" class="lightbox-zoom-btn" id="lightbox-zoom-out" title="Zoom Out (-)">
                <i class="bi bi-dash-lg"></i>
            </button>
            <span class="lightbox-zoom-val font-mono" id="lightbox-zoom-val">100%</span>
            <button type="button" class="lightbox-zoom-btn" id="lightbox-zoom-in" title="Zoom In (+)">
                <i class="bi bi-plus-lg"></i>
            </button>
            <div class="lightbox-zoom-divider"></div>
            <button type="button" class="lightbox-zoom-btn btn-mode" id="lightbox-zoom-fit" title="Fit to Screen">
                <i class="bi bi-arrows-angle-contract me-1"></i> <span>Fit Screen</span>
            </button>
            <button type="button" class="lightbox-zoom-btn btn-mode" id="lightbox-zoom-width" title="Readable Width / Scrollable View">
                <i class="bi bi-arrows-angle-expand me-1"></i> <span>Full Width</span>
            </button>
            <button type="button" class="lightbox-zoom-btn" id="lightbox-zoom-reset" title="Reset (0)">
                <i class="bi bi-arrow-counterclockwise"></i>
            </button>
        </div>

        <!-- Scrollable & Zoomable Image Viewport Container -->
        <div class="lightbox-scroll-viewport" id="lightbox-scroll-viewport">
            <div class="lightbox-img-canvas" id="lightbox-img-canvas">
                <img src="" alt="Full Portfolio View" id="lightbox-img" class="lightbox-img" draggable="false">
            </div>
        </div>

        <!-- Title Caption Bar at Bottom -->
        <div class="lightbox-title-bar" id="lightbox-title-bar">
            <span id="lightbox-caption" class="lightbox-caption font-mono"></span>
        </div>
    </div>

</div>

<?php
// Include footer
include __DIR__ . '/footer.php';

// Include body end
include __DIR__ . '/body-end.php';
