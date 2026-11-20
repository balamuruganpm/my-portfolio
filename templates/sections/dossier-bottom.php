<?php
/**
 * Dossier Section: Dynamic Capabilities Bottom Card
 * Hosts interactive tab panels for About, Projects, Blogs, Games, and Contact
 */
$currPage = strtolower(trim($thisPage ?? 'home'));
if ($currPage === '' || $currPage === 'index') {
    $currPage = 'about'; // Default tab when opening dossier from desktop
}

// Dynamic Header Mapping based on Active App
$appHeaders = [
    'about'     => ['tag' => '// TECHNICAL_CAPABILITIES', 'title' => 'Skills & Technology Stack'],
    'portfolio' => ['tag' => '// PORTFOLIO_SHOWCASE',     'title' => 'Featured Engineering Works & Projects'],
    'blogs'     => ['tag' => '// KNOWLEDGE_DISPATCH',     'title' => 'Technical Articles & Engineering Publications'],
    'game'      => ['tag' => '// ARCADE_MATRIX',         'title' => 'MiniCraft & Interactive Simulations'],
    'contact'   => ['tag' => '// TRANSMISSION_PORTAL',    'title' => 'Direct Communications & Inquiries'],
];
$activeHeader = $appHeaders[$currPage] ?? $appHeaders['about'];
?>
<div class="dossier-card dossier-card-bottom" id="dossier-bottom-card">
    
    <!-- Dynamic Header -->
    <div class="dossier-card-header d-flex align-items-center justify-content-between mb-2">
        <span class="dossier-mono-tag" id="bottom-tag"><?php echo $activeHeader['tag']; ?></span>
        <div class="d-flex align-items-center gap-2">
            <div class="dossier-tab-pills gap-2 d-none d-sm-flex align-items-center gap-1.5" role="tablist">
                <button type="button" class="dossier-mini-pill-btn <?php echo ($currPage === 'about') ? 'active' : ''; ?>" data-app="about">About</button>
                <button type="button" class="dossier-mini-pill-btn <?php echo ($currPage === 'portfolio') ? 'active' : ''; ?>" data-app="portfolio">Projects</button>
                <button type="button" class="dossier-mini-pill-btn <?php echo ($currPage === 'blogs') ? 'active' : ''; ?>" data-app="blogs">Articles</button>
                <button type="button" class="dossier-mini-pill-btn <?php echo ($currPage === 'game') ? 'active' : ''; ?>" data-app="game">Arcade</button>
                <button type="button" class="dossier-mini-pill-btn <?php echo ($currPage === 'contact') ? 'active' : ''; ?>" data-app="contact">Contact</button>
            </div>
            <!-- Close Button in Bottom Card (shown when top profile card is hidden) -->
            <button type="button" class="dossier-close-btn dossier-bottom-close-btn" id="dossier-bottom-close-btn" aria-label="Close Window" title="Close (Esc)">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
    
    <h2 class="dossier-card-title mb-3" id="bottom-title">
        <?php echo $activeHeader['title']; ?>
    </h2>

    <!-- Scrollable Internal Body -->
    <div class="dossier-card-scroll-body" id="dossier-scroll-body">
        
        <!-- ========================================== -->
        <!-- TAB 1: ABOUT ME (Skills, Exp, Edu, Awards) -->
        <!-- ========================================== -->
        <div class="dossier-panel <?php echo ($currPage === 'about') ? 'active' : ''; ?>" id="panel-about" role="tabpanel">
            
            <!-- Skills Categorized Grid -->
            <div class="mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="dossier-subbox p-3 rounded-3 h-100">
                            <h3 class="dossier-subbox-title font-mono small text-uppercase mb-2 text-cyan">
                                <i class="bi bi-code-slash me-1"></i> Frontend Architecture
                            </h3>
                            <div class="d-flex flex-wrap gap-1.5">
                                <span class="dossier-badge">React.js</span>
                                <span class="dossier-badge">TypeScript</span>
                                <span class="dossier-badge">JavaScript (ES6+)</span>
                                <span class="dossier-badge">HTML5 / CSS3</span>
                                <span class="dossier-badge">Responsive Design</span>
                                <span class="dossier-badge">Bootstrap 5</span>
                                <span class="dossier-badge">Tailwind CSS</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dossier-subbox p-3 rounded-3 h-100">
                            <h3 class="dossier-subbox-title font-mono small text-uppercase mb-2 text-warning">
                                <i class="bi bi-microsoft me-1"></i> Microsoft &amp; SPFx
                            </h3>
                            <div class="d-flex flex-wrap gap-1.5">
                                <span class="dossier-badge">SharePoint Online</span>
                                <span class="dossier-badge">SPFx Framework</span>
                                <span class="dossier-badge">Microsoft Graph API</span>
                                <span class="dossier-badge">PnP JS</span>
                                <span class="dossier-badge">Intranet Solutions</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dossier-subbox p-3 rounded-3 h-100">
                            <h3 class="dossier-subbox-title font-mono small text-uppercase mb-2 text-info">
                                <i class="bi bi-tools me-1"></i> Web &amp; Design Tools
                            </h3>
                            <div class="d-flex flex-wrap gap-1.5">
                                <span class="dossier-badge">PHP</span>
                                <span class="dossier-badge">REST APIs / JSON</span>
                                <span class="dossier-badge">Git &amp; GitHub</span>
                                <span class="dossier-badge">VS Code</span>
                                <span class="dossier-badge">Figma UI / UX</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Experience Timeline -->
            <div class="mb-4">
                <h3 class="h6 font-mono text-uppercase text-white mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-briefcase-fill text-accent"></i> Professional Career Timeline
                </h3>
                <div class="d-flex flex-column gap-3">
                    <?php if (!empty($experience) && is_array($experience)): ?>
                        <?php foreach ($experience as $exp): ?>
                            <div class="dossier-subbox p-3 rounded-3">
                                <div class="d-flex flex-column flex-sm-row sm-align-items-center justify-content-between mb-1.5">
                                    <h4 class="h6 fw-bold text-white mb-0"><?php echo e($exp['role'] ?? ''); ?> <span class="text-secondary fw-normal">@ <?php echo e($exp['company'] ?? ''); ?></span></h4>
                                    <span class="dossier-time-tag font-mono small text-accent"><?php echo e($exp['duration'] ?? ''); ?></span>
                                </div>
                                <div class="text-secondary small font-mono mb-2">
                                    <i class="bi bi-geo-alt me-1"></i><?php echo e($exp['location'] ?? ''); ?>
                                </div>
                                <?php if (!empty($exp['bullets']) && is_array($exp['bullets'])): ?>
                                    <ul class="dossier-bullet-list mb-0 small text-secondary">
                                        <?php foreach ($exp['bullets'] as $bullet): ?>
                                            <li><?php echo e($bullet); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Education & Awards -->
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="dossier-subbox p-3 rounded-3 h-100">
                        <h3 class="h6 font-mono text-uppercase text-white mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-mortarboard-fill text-info"></i> Education Journey
                        </h3>
                        <div class="d-flex flex-column gap-2.5">
                            <?php if (!empty($education) && is_array($education)): ?>
                                <?php foreach ($education as $edu): ?>
                                    <div class="border-subbox-item pb-2">
                                        <div class="fw-bold text-white small"><?php echo e($edu['degree'] ?? ''); ?></div>
                                        <div class="text-secondary small"><?php echo e($edu['institution'] ?? ''); ?> &bull; <span class="font-mono text-cyan"><?php echo e($edu['metric'] ?? ''); ?></span></div>
                                        <div class="text-muted font-mono" style="font-size: 0.72rem;"><?php echo e($edu['duration'] ?? ''); ?> | <?php echo e($edu['location'] ?? ''); ?></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dossier-subbox p-3 rounded-3 h-100">
                        <h3 class="h6 font-mono text-uppercase text-white mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-trophy-fill text-warning"></i> Certifications &amp; Honors
                        </h3>
                        <div class="d-flex flex-column gap-2 mb-3">
                            <?php if (!empty($awards) && is_array($awards)): ?>
                                <?php foreach ($awards as $award): ?>
                                    <div class="border-subbox-item pb-2">
                                        <div class="fw-bold text-warning small"><i class="bi bi-award me-1"></i><?php echo e($award['title'] ?? ''); ?></div>
                                        <div class="text-secondary small"><?php echo e($award['description'] ?? ''); ?></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex flex-wrap gap-1.5">
                            <?php if (!empty($certificates) && is_array($certificates)): ?>
                                <?php foreach ($certificates as $cert): ?>
                                    <span class="dossier-badge" title="Issuer: <?php echo e($cert['issuer'] ?? ''); ?>">
                                        <i class="bi bi-patch-check-fill text-cyan me-1"></i> <?php echo e($cert['name'] ?? ''); ?>
                                    </span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- TAB 2: PORTFOLIO SHOWCASE (Pure Images Only)-->
        <!-- Top Center Grid                            -->
        <!-- ========================================== -->
        <div class="dossier-panel <?php echo ($currPage === 'portfolio') ? 'active' : ''; ?>" id="panel-portfolio" role="tabpanel">
            <div class="portfolio-gallery-grid">
                <?php if (!empty($projects) && is_array($projects)): ?>
                    <?php foreach ($projects as $idx => $proj): ?>
                        <?php 
                            $projImg = !empty($proj['image']) ? (BASE_URL . ltrim($proj['image'], '/')) : (BASE_URL . 'assets/images/vocalease.webp');
                            $projTitle = !empty($proj['title']) ? $proj['title'] : 'Project ' . ($idx + 1);
                        ?>
                        <div class="portfolio-image-card" data-img="<?php echo e($projImg); ?>" data-title="<?php echo e($projTitle); ?>" role="button" tabindex="0" title="Click to view full image">
                            <div class="portfolio-image-wrap">
                                <img src="<?php echo e($projImg); ?>" alt="<?php echo e($projTitle); ?>" class="portfolio-pure-img" loading="lazy">
                                <div class="portfolio-image-hover">
                                    <div class="hover-zoom-icon">
                                        <i class="bi bi-arrows-fullscreen"></i>
                                    </div>
                                    <span class="hover-zoom-label font-mono">View Full Image</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-secondary small text-center py-4">No portfolio images found.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 3: BLOG ARTICLES FEED (Modern Responsive Grid) -->
        <!-- ========================================== -->
        <div class="dossier-panel <?php echo ($currPage === 'blogs' && empty($activePost)) ? 'active' : ''; ?>" id="panel-blogs" role="tabpanel">
            <div class="blog-cards-grid">
                <?php if (!empty($blogs) && is_array($blogs)): ?>
                    <?php foreach ($blogs as $blog): ?>
                        <?php 
                            $blogImg = !empty($blog['image']) ? (BASE_URL . ltrim($blog['image'], '/')) : (BASE_URL . 'assets/images/core-web-vitals.webp');
                            $wordCount = str_word_count(strip_tags($blog['content'] ?? ''));
                            $readTime = max(1, ceil($wordCount / 200));
                        ?>
                        <article class="blog-grid-card dossier-subbox" data-slug="<?php echo e($blog['slug'] ?? ''); ?>">
                            <!-- Card Media Banner -->
                            <div class="blog-card-media-wrap mb-3">
                                <img src="<?php echo e($blogImg); ?>" alt="<?php echo e($blog['title'] ?? 'Article Thumbnail'); ?>" class="blog-card-img" loading="lazy">
                                <div class="blog-media-badge-overlay">
                                    <span class="blog-category-chip font-mono"><?php echo e($blog['category'] ?? 'Tech'); ?></span>
                                    <span class="blog-time-chip font-mono"><i class="bi bi-clock me-1"></i><?php echo $readTime; ?> min read</span>
                                </div>
                            </div>

                            <!-- Card Content Body -->
                            <div class="blog-card-body d-flex flex-column justify-content-between p-3.5 flex-grow-1">
                                <div>
                                    <div class="d-flex align-items-center gap-3 text-secondary font-mono small mb-2" style="font-size: 0.72rem;">
                                        <span><i class="bi bi-calendar3 me-1 text-cyan"></i><?php echo date('M d, Y', strtotime($blog['date'] ?? 'now')); ?></span>
                                        <span><i class="bi bi-eye me-1 text-cyan"></i><?php echo number_format($blog['views'] ?? 0); ?> views</span>
                                    </div>

                                    <h3 class="h6 fw-bold text-white mb-2 blog-card-title leading-snug">
                                        <a href="<?php echo BASE_URL; ?>blogs/<?php echo e($blog['slug'] ?? ''); ?>" class="text-white text-decoration-none blog-link-btn hover-cyan" data-slug="<?php echo e($blog['slug'] ?? ''); ?>">
                                            <?php echo e($blog['title'] ?? ''); ?>
                                        </a>
                                    </h3>

                                    <p class="blog-card-snippet font-body mb-3">
                                        <?php echo e($blog['snippet'] ?? ''); ?>
                                    </p>
                                </div>

                                <div>
                                    <!-- Tags Row -->
                                    <div class="d-flex flex-wrap gap-1 mb-3">
                                        <?php if (!empty($blog['tags']) && is_array($blog['tags'])): ?>
                                            <?php foreach (array_slice($blog['tags'], 0, 3) as $tag): ?>
                                                <span class="badge-mini-tag">#<?php echo e($tag); ?></span>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Read Action Button -->
                                    <button type="button" class="dossier-action-btn w-100 justify-content-center py-2 read-blog-btn" data-slug="<?php echo e($blog['slug'] ?? ''); ?>" data-title="<?php echo e($blog['title'] ?? ''); ?>">
                                        Read Article <i class="bi bi-arrow-right ms-1.5"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-secondary small text-center py-5 col-12">No technical dispatches found.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 3B: FULL ARTICLE READER VIEWPORT       -->
        <!-- ========================================== -->
        <div class="dossier-panel <?php echo (!empty($activePost)) ? 'active' : ''; ?>" id="panel-blog-detail" role="tabpanel">
            <div class="blog-detail-container dossier-subbox p-4 rounded-4 position-relative">
                
                <!-- Back navigation & Actions Header -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4 pb-3 border-subbox-item">
                    <button type="button" class="dossier-action-btn" id="blog-back-btn">
                        <i class="bi bi-arrow-left me-1.5"></i> Back to All Articles
                    </button>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="dossier-action-btn" id="blog-copy-link-btn" title="Copy Article URL">
                            <i class="bi bi-link-45deg me-1"></i> <span id="copy-btn-label">Copy Link</span>
                        </button>
                    </div>
                </div>

                <!-- Article Content Container -->
                <article id="detail-article-container">
                    <header class="mb-4">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2.5">
                            <span class="dossier-badge font-mono text-cyan" id="detail-category"><?php echo e($activePost['category'] ?? 'Technology'); ?></span>
                            <span class="text-secondary font-mono small" id="detail-date"><i class="bi bi-calendar3 me-1 text-cyan"></i><?php echo !empty($activePost['date']) ? date('M d, Y', strtotime($activePost['date'])) : ''; ?></span>
                            <span class="text-secondary font-mono small" id="detail-views"><i class="bi bi-eye text-cyan me-1"></i><?php echo number_format($activePost['views'] ?? 0); ?> views</span>
                        </div>
                        <h1 class="h2 fw-bold text-white mb-3" id="detail-title" style="letter-spacing: -0.02em; line-height: 1.35;">
                            <?php echo e($activePost['title'] ?? 'Technical Article'); ?>
                        </h1>
                        <?php if (!empty($activePost['snippet'])): ?>
                            <p class="lead text-light small font-body mb-3.5 opacity-90" id="detail-snippet">
                                <?php echo e($activePost['snippet']); ?>
                            </p>
                        <?php endif; ?>
                    </header>

                    <!-- Featured Article Media (if present) -->
                    <?php if (!empty($activePost['image'])): ?>
                        <div class="mb-4 rounded-4 overflow-hidden border-subbox-item" id="detail-image-box">
                            <img src="<?php echo BASE_URL . ltrim($activePost['image'], '/'); ?>" alt="<?php echo e($activePost['title'] ?? 'Article'); ?>" class="img-fluid w-100 rounded-3" style="max-height: 360px; object-fit: cover;" id="detail-img">
                        </div>
                    <?php endif; ?>

                    <!-- Formatted HTML Body Content (High Contrast & Clean Typography) -->
                    <div class="article-rich-body font-body text-light leading-relaxed mb-4" id="detail-body">
                        <?php echo !empty($activePost['content']) ? $activePost['content'] : '<div class="text-center py-4"><span class="spinner-border spinner-border-sm text-cyan me-1"></span> Loading article content...</div>'; ?>
                    </div>

                    <!-- Article Tags Footer -->
                    <div class="d-flex flex-wrap align-items-center gap-1.5 pt-3 border-subbox-item mb-4" id="detail-tags">
                        <?php if (!empty($activePost['tags']) && is_array($activePost['tags'])): ?>
                            <?php foreach ($activePost['tags'] as $t): ?>
                                <span class="badge-mini-tag">#<?php echo e($t); ?></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Social Share Strip -->
                    <div class="d-flex flex-wrap align-items-center gap-2 p-3 rounded-3 mb-2" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08);">
                        <span class="text-cyan font-mono small me-2"><i class="bi bi-share-fill me-1"></i>SHARE ARTICLE:</span>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(CANONICAL_URL); ?>&text=<?php echo urlencode($activePost['title'] ?? ''); ?>" target="_blank" rel="noopener noreferrer" class="dossier-mini-pill-btn text-white text-decoration-none">
                            <i class="bi bi-twitter-x me-1"></i> X / Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(CANONICAL_URL); ?>" target="_blank" rel="noopener noreferrer" class="dossier-mini-pill-btn text-white text-decoration-none">
                            <i class="bi bi-linkedin me-1"></i> LinkedIn
                        </a>
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(($activePost['title'] ?? '') . ' - ' . CANONICAL_URL); ?>" target="_blank" rel="noopener noreferrer" class="dossier-mini-pill-btn text-white text-decoration-none">
                            <i class="bi bi-whatsapp me-1 text-success"></i> WhatsApp
                        </a>
                    </div>
                </article>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 4: ARCADE & RETRO GAMES (COMING SOON)  -->
        <!-- ========================================== -->
        <div class="dossier-panel <?php echo ($currPage === 'game') ? 'active' : ''; ?>" id="panel-game" role="tabpanel">
            <div class="dossier-subbox p-4 rounded-4 text-center d-flex flex-column align-items-center justify-content-center" style="min-height: 260px;">
                <div class="mb-3">
                    <img src="<?php echo BASE_URL; ?>assets/images/os/games.webp" alt="Games" width="80" height="80" style="filter: drop-shadow(0 12px 24px rgba(245, 158, 11, 0.45));">
                </div>
                <div class="dossier-mono-tag mb-2">// ARCADE_SIMULATION</div>
                <h3 class="h3 fw-bold text-white mb-2" style="letter-spacing: 0.5px;">Coming Soon</h3>
                <p class="text-secondary mx-auto mb-3" style="max-width: 480px; font-size: 0.95rem; line-height: 1.6;">
                    The Web OS Retro Arcade and interactive simulation experiences are currently under development. Stay tuned for future release updates!
                </p>
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill" style="background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.14); font-family: var(--font-mono); font-size: 0.8rem; color: var(--accent-cyan);">
                    <span class="spinner-grow spinner-grow-sm" style="width: 8px; height: 8px;" role="status"></span>
                    <span>Status: IN_DEVELOPMENT &bull; 2027</span>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 5: CONTACT & INQUIRIES                 -->
        <!-- Balanced Modern Layout & Crisp Aesthetics  -->
        <!-- ========================================== -->
        <div class="dossier-panel <?php echo ($currPage === 'contact') ? 'active' : ''; ?>" id="panel-contact" role="tabpanel">
            
            <div class="row g-4 align-items-stretch">
                <!-- Left Column: Direct Coordinates, Verified Social Grid & Quick Status -->
                <div class="col-lg-5">
                    <div class="d-flex flex-column gap-3.5 h-100">
                        
                        <!-- Direct Coordinates Card -->
                        <div class="contact-subcard dossier-subbox p-4 rounded-4">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-subbox-item">
                                <h3 class="h6 font-mono text-uppercase text-white mb-0 d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-broadcast text-cyan"></i> Direct Coordinates
                                </h3>
                                <span class="activity-live-indicator">ACTIVE NOW</span>
                            </div>

                            <div class="contact-info-list d-flex flex-column gap-2 g-3 mb-3.5">
                                <div class="contact-info-item p-3 rounded-3">
                                    <span class="contact-label font-mono">OFFICIAL EMAIL</span>
                                    <a href="mailto:<?php echo e($profileEmail); ?>" class="contact-value text-white text-decoration-none font-mono hover-cyan d-flex align-items-center">
                                        <i class="bi bi-envelope-at text-cyan me-2 fs-6"></i> <?php echo e($profileEmail); ?>
                                    </a>
                                </div>
                                <div class="contact-info-item p-3 rounded-3">
                                    <span class="contact-label font-mono">DIRECT PHONE &amp; WHATSAPP</span>
                                    <div class="d-flex flex-wrap gap-2 g-3 mt-1">
                                        <?php if (!empty($profilePhone) && is_array($profilePhone)): ?>
                                            <?php foreach ($profilePhone as $ph): ?>
                                                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $ph); ?>" target="_blank" rel="noopener noreferrer" class="contact-value text-white text-decoration-none font-mono hover-cyan d-inline-flex align-items-center">
                                                    <i class="bi bi-whatsapp text-success me-1.5 fs-6"></i> <?php echo e($ph); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="contact-info-item p-3 rounded-3">
                                    <span class="contact-label font-mono">LOCATION BASE</span>
                                    <span class="contact-value text-white font-mono d-flex align-items-center gap-2 mt-1">
                                        <i class="bi bi-geo-alt-fill text-danger fs-6"></i> <?php echo e($profileLocation); ?>
                                        <span class="badge-mini-tag ms-1">(Remote / Worldwide)</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Resume Download CTA -->
                            <a href="<?php echo BASE_URL; ?>assets/Balamurugan-P-M-Resume.pdf" target="_blank" class="contact-resume-btn w-100 mt-3 text-center justify-content-center py-2.5 rounded-3 text-white font-mono">
                                <i class="bi bi-file-earmark-pdf-fill me-1.5 text-danger"></i> Download Official Resume PDF <i class="bi bi-arrow-up-right ms-1 text-cyan"></i>
                            </a>
                        </div>

                        <!-- All 12 Verified Social Profiles Grid & Availability -->
                        <div class="contact-subcard dossier-subbox p-4 rounded-4 flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-subbox-item">
                                    <span class="contact-label font-mono mb-0 text-white" style="font-size: 0.78rem;">CONNECT ACROSS PLATFORMS</span>
                                    <span class="badge-mini-tag text-cyan">12 Verified</span>
                                </div>
                                <div class="contact-social-grid">
                                    <?php 
                                    $socialNetworkList = [
                                        ['name' => 'GitHub',    'icon' => 'bi-github',       'url' => $socialsGithub ?? 'https://github.com/Balamuruganpm', 'color' => '#ffffff'],
                                        ['name' => 'LinkedIn',  'icon' => 'bi-linkedin',     'url' => $socialsLinkedin ?? 'https://www.linkedin.com/in/balamurugan-p-m', 'color' => '#38bdf8'],
                                        ['name' => 'Figma',     'icon' => 'bi-palette-fill', 'url' => $socialsFigma ?? 'https://www.figma.com/@balamuruganpm', 'color' => '#f43f5e'],
                                        ['name' => 'Behance',   'icon' => 'bi-behance',      'url' => $socialsBehance ?? 'https://www.behance.net/balamuruganpm', 'color' => '#3b82f6'],
                                        ['name' => 'Dribbble',  'icon' => 'bi-dribbble',     'url' => $socialsDribbble ?? 'https://dribbble.com/balamuruganedsty', 'color' => '#ec4899'],
                                        ['name' => 'CodePen',   'icon' => 'bi-code-slash',   'url' => $socialsCodepen ?? 'https://codepen.io/balamurugan_pm', 'color' => '#a855f7'],
                                        ['name' => 'Contra',    'icon' => 'bi-briefcase-fill','url' => $socialsContra ?? 'https://balamuruganpm.contra.com/', 'color' => '#f97316'],
                                        ['name' => 'Discord',   'icon' => 'bi-discord',      'url' => $socialsDiscord ?? 'https://discordapp.com/users/1104967812440670269', 'color' => '#818cf8'],
                                        ['name' => 'X / Twitter','icon' => 'bi-twitter-x',   'url' => $socialsTwitter ?? 'https://twitter.com/balaselfie_bd', 'color' => '#ffffff'],
                                        ['name' => 'WhatsApp',  'icon' => 'bi-whatsapp',     'url' => $socialsWhatsapp ?? 'https://wa.me/+919677804820', 'color' => '#22c55e'],
                                        ['name' => 'Instagram', 'icon' => 'bi-instagram',    'url' => $socialsInstagram ?? 'https://instagram.com/balamurugan.pm', 'color' => '#e11d48'],
                                        ['name' => 'Facebook',  'icon' => 'bi-facebook',     'url' => $socialsFacebook ?? 'https://www.facebook.com/balaselfiebd', 'color' => '#2563eb'],
                                    ];
                                    ?>
                                    <?php foreach ($socialNetworkList as $net): ?>
                                        <?php if (!empty($net['url'])): ?>
                                            <a href="<?php echo e($net['url']); ?>" target="_blank" rel="noopener noreferrer" class="social-grid-tile" title="<?php echo e($net['name']); ?>">
                                                <i class="bi <?php echo e($net['icon']); ?>" style="color: <?php echo e($net['color']); ?>;"></i>
                                                <span class="social-tile-name"><?php echo e($net['name']); ?></span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Working Hours & Fast SLA Strip -->
                            <div class="contact-hours-strip p-2.5 rounded-3 d-flex flex-wrap align-items-center justify-content-between gap-2 mt-3">
                                <span class="text-secondary font-mono small"><i class="bi bi-clock-history text-warning me-1"></i> Mon – Sat: 09:00 – 19:00 IST</span>
                                <span class="text-cyan font-mono small fw-bold"><i class="bi bi-lightning-charge-fill me-0.5"></i> &lt; 24h Response</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right Column: Encrypted Transmission Form -->
                <div class="col-lg-7">
                    <div class="contact-subcard dossier-subbox p-4 rounded-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-subbox-item">
                                <h3 class="h6 font-mono text-uppercase text-white mb-0 d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-send-fill text-warning"></i> Send Transmission
                                </h3>
                                <span class="activity-live-indicator" style="color: #38bdf8; background: rgba(56, 189, 248, 0.15); border-color: rgba(56, 189, 248, 0.3);">ENCRYPTED CHANNEL</span>
                            </div>

                            <form id="dossier-contact-form" method="POST" action="<?php echo BASE_URL; ?>contact">
                                <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
                                <div id="contact-alert-box" class="d-none mb-3 p-2.5 rounded-3 small"></div>

                                <div class="row g-3 mb-3">
                                    <div class="col-sm-6">
                                        <label for="c-name" class="contact-field-label font-mono">YOUR FULL NAME *</label>
                                        <input type="text" name="name" id="c-name" class="dossier-input" placeholder="e.g. Alex Henderson" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="c-email" class="contact-field-label font-mono">YOUR BUSINESS EMAIL *</label>
                                        <input type="email" name="email" id="c-email" class="dossier-input" placeholder="e.g. alex@company.com" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="c-subject" class="contact-field-label font-mono">PROJECT INQUIRY / SUBJECT *</label>
                                    <input type="text" name="subject" id="c-subject" class="dossier-input" placeholder="e.g. Enterprise React / SharePoint Modernization Project" required>
                                </div>
                                <div class="mb-3.5">
                                    <label for="c-message" class="contact-field-label font-mono">PROJECT SPECIFICATIONS &amp; GOALS *</label>
                                    <textarea name="message" id="c-message" rows="5" class="dossier-input" placeholder="Provide details regarding scope, timeline, tech stack, and goals..." required></textarea>
                                </div>
                                <button type="submit" class="contact-dispatch-btn w-100 justify-content-center py-3 rounded-3 font-mono" id="c-submit-btn">
                                    <i class="bi bi-send me-2"></i> Dispatch Transmission <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Mini Trust & Assurance Badges Footer -->
                        <div class="contact-trust-bar d-flex flex-wrap align-items-center justify-content-between gap-2 rounded-3 mt-3.5">
                            <span class="d-flex align-items-center gap-1.5"><i class="bi bi-patch-check-fill text-cyan"></i> React &amp; SPFx Specialist</span>
                            <span class="d-flex align-items-center gap-1.5"><i class="bi bi-shield-check text-success"></i> 100% IP &amp; NDA Covered</span>
                            <span class="d-flex align-items-center gap-1.5"><i class="bi bi-globe2 text-warning"></i> Global Remote Available</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Embedded Datasets for Instant Client Rendering -->
    <script id="blogs-data" type="application/json">
        <?php echo json_encode($blogs ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>
    </script>
    <script id="projects-data" type="application/json">
        <?php echo json_encode($projects ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>
    </script>
</div>

