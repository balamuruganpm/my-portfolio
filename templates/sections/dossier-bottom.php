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
            <div class="mb-5">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="dossier-subbox p-4 rounded-4 h-100">
                            <h3 class="dossier-subbox-title font-mono small text-uppercase mb-3 text-cyan">
                                <i class="bi bi-code-slash me-1"></i> Frontend Architecture
                            </h3>
                            <div class="d-flex flex-wrap gap-2">
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
                        <div class="dossier-subbox p-4 rounded-4 h-100">
                            <h3 class="dossier-subbox-title font-mono small text-uppercase mb-3 text-warning">
                                <i class="bi bi-microsoft me-1"></i> Microsoft &amp; SPFx
                            </h3>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="dossier-badge">SharePoint Online</span>
                                <span class="dossier-badge">SPFx Framework</span>
                                <span class="dossier-badge">Microsoft Graph API</span>
                                <span class="dossier-badge">PnP JS</span>
                                <span class="dossier-badge">Intranet Solutions</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dossier-subbox p-4 rounded-4 h-100">
                            <h3 class="dossier-subbox-title font-mono small text-uppercase mb-3 text-info">
                                <i class="bi bi-tools me-1"></i> Web &amp; Design Tools
                            </h3>
                            <div class="d-flex flex-wrap gap-2">
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
            <div class="mb-5">
                <h3 class="h6 font-mono text-uppercase text-white mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-briefcase-fill text-accent"></i> Professional Career Timeline
                </h3>
                <div class="d-flex flex-column gap-3">
                    <?php if (!empty($experience) && is_array($experience)): ?>
                        <?php foreach ($experience as $exp): ?>
                            <div class="dossier-subbox p-4 rounded-4">
                                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-1 mb-2">
                                    <h4 class="h6 fw-bold text-white mb-0"><?php echo e($exp['role'] ?? ''); ?> <span class="text-secondary fw-normal">@ <?php echo e($exp['company'] ?? ''); ?></span></h4>
                                    <span class="dossier-time-tag font-mono small text-accent"><?php echo e($exp['duration'] ?? ''); ?></span>
                                </div>
                                <div class="text-secondary small font-mono mb-3">
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
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="dossier-subbox p-4 rounded-4 h-100">
                        <h3 class="h6 font-mono text-uppercase text-white mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-mortarboard-fill text-info"></i> Education Journey
                        </h3>
                        <div class="d-flex flex-column gap-3">
                            <?php if (!empty($education) && is_array($education)): ?>
                                <?php foreach ($education as $edu): ?>
                                    <div class="dossier-clean-item">
                                        <div class="fw-bold text-white small mb-1"><?php echo e($edu['degree'] ?? ''); ?></div>
                                        <div class="text-secondary small mb-1"><?php echo e($edu['institution'] ?? ''); ?> &bull; <span class="font-mono text-cyan"><?php echo e($edu['metric'] ?? ''); ?></span></div>
                                        <div class="text-muted font-mono" style="font-size: 0.74rem;"><?php echo e($edu['duration'] ?? ''); ?> | <?php echo e($edu['location'] ?? ''); ?></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dossier-subbox p-4 rounded-4 h-100">
                        <h3 class="h6 font-mono text-uppercase text-white mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-trophy-fill text-warning"></i> Certifications &amp; Honors
                        </h3>
                        <div class="d-flex flex-column gap-3 mb-3">
                            <?php if (!empty($awards) && is_array($awards)): ?>
                                <?php foreach ($awards as $award): ?>
                                    <div class="dossier-clean-item">
                                        <div class="fw-bold text-warning small mb-1"><i class="bi bi-award me-1"></i><?php echo e($award['title'] ?? ''); ?></div>
                                        <div class="text-secondary small"><?php echo e($award['description'] ?? ''); ?></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
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
                                    <span class="hover-project-title"><?php echo e($projTitle); ?></span>
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
        <!-- TAB 3: BLOG ARTICLES FEED (Minimal Editorial Grid) -->
        <!-- ========================================== -->
        <div class="dossier-panel <?php echo ($currPage === 'blogs' && empty($activePost)) ? 'active' : ''; ?>" id="panel-blogs" role="tabpanel">
            <!-- Minimal Filter & View All Bar -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
                <div class="d-flex flex-wrap align-items-center gap-2" id="blog-filter-bar">
                    <button type="button" class="dossier-mini-pill-btn blog-cat-filter active" data-cat="all">
                        View All (<?php echo count($blogs ?? []); ?>)
                    </button>
                    <?php if (!empty($categories) && is_array($categories)): ?>
                        <?php foreach (array_slice($categories, 0, 5, true) as $catName => $catCount): ?>
                            <button type="button" class="dossier-mini-pill-btn blog-cat-filter" data-cat="<?php echo e(strtolower($catName)); ?>">
                                <?php echo e($catName); ?> (<?php echo (int)$catCount; ?>)
                            </button>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="blog-cards-grid" id="blog-cards-grid">
                <?php if (!empty($blogs) && is_array($blogs)): ?>
                    <?php foreach ($blogs as $blog): ?>
                        <?php 
                            $blogImg = !empty($blog['image']) ? (BASE_URL . ltrim($blog['image'], '/')) : (BASE_URL . 'assets/images/core-web-vitals.webp');
                            $wordCount = str_word_count(strip_tags($blog['content'] ?? ''));
                            $readTime = max(1, ceil($wordCount / 200));
                            $shortUrl = BASE_URL . 'b/' . (int)($blog['id'] ?? 0);
                            $blogCat = strtolower(trim($blog['category'] ?? 'tech'));
                        ?>
                        <article class="blog-grid-card dossier-subbox" data-slug="<?php echo e($blog['slug'] ?? ''); ?>" data-category="<?php echo e($blogCat); ?>">
                            <!-- Card Media Banner (Clean, Unobstructed) -->
                            <div class="blog-card-media-wrap">
                                <img src="<?php echo e($blogImg); ?>" alt="<?php echo e($blog['title'] ?? 'Article Thumbnail'); ?>" class="blog-card-img" loading="lazy">
                            </div>

                            <!-- Minimal Card Body -->
                            <div class="blog-card-body d-flex flex-column justify-content-between flex-grow-1">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                        <span class="blog-category-chip font-mono"><?php echo e($blog['category'] ?? 'Tech'); ?></span>
                                        <span class="blog-time-chip font-mono"><?php echo $readTime; ?> min &bull; <?php echo date('M d, Y', strtotime($blog['date'] ?? 'now')); ?></span>
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

                                <div class="d-flex align-items-center gap-2 pt-1">
                                    <button type="button" class="dossier-action-btn flex-grow-1 justify-content-center py-2 read-blog-btn" data-slug="<?php echo e($blog['slug'] ?? ''); ?>" data-title="<?php echo e($blog['title'] ?? ''); ?>">
                                        Read Article <i class="bi bi-arrow-right ms-1"></i>
                                    </button>
                                    <button type="button" class="dossier-action-btn py-2 px-3 copy-shortlink-btn" data-shortlink="<?php echo e($shortUrl); ?>" title="Copy Shortlink (<?php echo e($shortUrl); ?>)" aria-label="Copy Shortlink">
                                        <i class="bi bi-link-45deg"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-secondary small text-center py-5 col-12">No technical dispatches found.</div>
                <?php endif; ?>
            </div>

            <?php if (!empty($adsEnabled)): ?>
                <!-- Blog Feed Sponsored Ad Slot -->
                <div class="ad-slot-frame mt-4 text-center">
                    <span class="ad-slot-label font-mono">SPONSORED</span>
                    <script async="async" data-cfasync="false" src="https://pl30967632.profitableratecpmnetwork.com/a006ed973d12be80f0e7a963ed44ffb7/invoke.js"></script>
                    <div id="container-a006ed973d12be80f0e7a963ed44ffb7"></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- ========================================== -->
        <!-- TAB 3B: FULL ARTICLE READER VIEWPORT       -->
        <!-- ========================================== -->
        <div class="dossier-panel <?php echo (!empty($activePost)) ? 'active' : ''; ?>" id="panel-blog-detail" role="tabpanel">
            <div class="blog-detail-container dossier-subbox p-4 p-md-5 rounded-4 position-relative mx-auto" style="max-width: 860px;">
                
                <!-- Back navigation & Actions Header -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
                    <button type="button" class="dossier-action-btn" id="blog-back-btn">
                        <i class="bi bi-arrow-left me-1.5"></i> Back to All Articles
                    </button>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <button type="button" class="dossier-action-btn copy-shortlink-btn" id="blog-copy-shortlink-btn" data-shortlink="<?php echo !empty($activePost['id']) ? e(BASE_URL . 'b/' . (int)$activePost['id']) : ''; ?>" title="Copy Shortlink">
                            <i class="bi bi-lightning-charge-fill text-warning me-1"></i> <span id="shortlink-btn-label">Copy Shortlink</span>
                        </button>
                        <button type="button" class="dossier-action-btn" id="blog-copy-link-btn" title="Copy Full Article URL">
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

                    <?php if (!empty($adsEnabled)): ?>
                        <!-- Article Detail Leaderboard Ad (728x90) -->
                        <div class="ad-slot-frame mt-4 text-center overflow-auto">
                            <span class="ad-slot-label font-mono">SPONSORED</span>
                            <script type="text/javascript">
                                atOptions = {
                                    'key': 'eff49cbb9e486773112180b4e21c171d',
                                    'format': 'iframe',
                                    'height': 90,
                                    'width': 728,
                                    'params': {}
                                };
                            </script>
                            <script type="text/javascript" src="https://www.highrevenueformat.com/eff49cbb9e486773112180b4e21c171d/invoke.js"></script>
                        </div>
                    <?php endif; ?>
                </article>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 4: ARCADE & RETRO GAMES (2 GAMES)      -->
        <!-- ========================================== -->
        <div class="dossier-panel <?php echo ($currPage === 'game') ? 'active' : ''; ?>" id="panel-game" role="tabpanel">
            <div class="arcade-shell dossier-subbox p-4 rounded-4">
                <!-- Top Game Switcher & Action Controls -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                    <div class="d-flex flex-wrap align-items-center gap-2" role="tablist">
                        <button type="button" class="dossier-mini-pill-btn arcade-game-tab active" data-game="snake">
                            <i class="bi bi-joystick me-1 text-cyan"></i> Neon Snake
                        </button>
                        <button type="button" class="dossier-mini-pill-btn arcade-game-tab" data-game="breaker">
                            <i class="bi bi-grid-3x3-gap-fill me-1 text-warning"></i> Cyber Breaker
                        </button>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="dossier-action-btn" id="arcade-start-btn"><i class="bi bi-play-fill me-1 text-success"></i> Start</button>
                        <button type="button" class="dossier-action-btn" id="arcade-pause-btn"><i class="bi bi-pause-fill me-1 text-warning"></i> Pause</button>
                        <button type="button" class="dossier-action-btn" id="arcade-restart-btn"><i class="bi bi-arrow-counterclockwise me-1 text-cyan"></i> Restart</button>
                    </div>
                </div>

                <!-- Live Arcade HUD -->
                <div class="arcade-hud mb-3">
                    <div class="arcade-hud-chip font-mono">SCORE: <strong id="arcade-score" class="text-cyan">0</strong></div>
                    <div class="arcade-hud-chip font-mono">BEST: <strong id="arcade-best" class="text-warning">0</strong></div>
                    <div class="arcade-hud-chip font-mono">LIVES: <strong id="arcade-lives" class="text-white">1</strong></div>
                    <div class="arcade-hud-chip font-mono flex-grow-1 text-end d-none d-sm-block"><span id="arcade-status" class="text-secondary">Ready</span></div>
                </div>

                <!-- Responsive Game Canvas -->
                <div class="arcade-canvas-wrap">
                    <canvas id="arcade-canvas" width="480" height="360" class="arcade-canvas"></canvas>
                </div>

                <!-- Touch D-Pad for Mobile Snake -->
                <div class="arcade-dpad mt-3 d-flex d-md-none flex-column align-items-center gap-1" id="arcade-dpad-wrap">
                    <button type="button" class="dossier-action-btn arcade-dpad-btn" data-dir="up" aria-label="Up"><i class="bi bi-chevron-up"></i></button>
                    <div class="d-flex gap-2">
                        <button type="button" class="dossier-action-btn arcade-dpad-btn" data-dir="left" aria-label="Left"><i class="bi bi-chevron-left"></i></button>
                        <button type="button" class="dossier-action-btn arcade-dpad-btn" data-dir="down" aria-label="Down"><i class="bi bi-chevron-down"></i></button>
                        <button type="button" class="dossier-action-btn arcade-dpad-btn" data-dir="right" aria-label="Right"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>

                <p class="text-secondary small font-mono text-center mt-3 mb-0">
                    Controls: Arrow Keys / WASD (Snake) &bull; Mouse / Touch / Arrows (Cyber Breaker) &bull; Space to Pause
                </p>
            </div>

            <?php if (!empty($adsEnabled)): ?>
                <!-- Arcade Page Sponsored Ad Slot (728x90) -->
                <div class="ad-slot-frame mt-4 text-center overflow-auto">
                    <span class="ad-slot-label font-mono">SPONSORED</span>
                    <script type="text/javascript">
                        atOptions = {
                            'key': 'eff49cbb9e486773112180b4e21c171d',
                            'format': 'iframe',
                            'height': 90,
                            'width': 728,
                            'params': {}
                        };
                    </script>
                    <script type="text/javascript" src="https://www.highrevenueformat.com/eff49cbb9e486773112180b4e21c171d/invoke.js"></script>
                </div>
            <?php endif; ?>
        </div>

        <!-- ========================================== -->
        <!-- TAB 5: CONTACT & INQUIRIES (Minimal UI)    -->
        <!-- ========================================== -->
        <div class="dossier-panel <?php echo ($currPage === 'contact') ? 'active' : ''; ?>" id="panel-contact" role="tabpanel">
            <div class="row g-4 g-lg-5 align-items-start">
                <!-- Left Column: Minimal Coordinates & Social Icons -->
                <div class="col-lg-5">
                    <div class="dossier-subbox p-4 p-md-5 rounded-4 d-flex flex-column gap-4">
                        <div>
                            <span class="contact-label font-mono mb-2">DIRECT CONTACT</span>
                            <h3 class="h5 fw-bold text-white mb-2">Let&apos;s build something great.</h3>
                            <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                Available for frontend architecture, React/TypeScript, and SharePoint SPFx projects worldwide.
                            </p>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            <a href="mailto:<?php echo e($profileEmail); ?>" class="contact-info-item text-decoration-none d-flex align-items-center gap-3">
                                <i class="bi bi-envelope-at text-cyan fs-5"></i>
                                <div class="min-w-0">
                                    <span class="contact-label font-mono mb-0">EMAIL</span>
                                    <span class="contact-value d-block text-truncate"><?php echo e($profileEmail); ?></span>
                                </div>
                            </a>

                            <?php if (!empty($profilePhone) && is_array($profilePhone)): ?>
                                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $profilePhone[0]); ?>" target="_blank" rel="noopener noreferrer" class="contact-info-item text-decoration-none d-flex align-items-center gap-3">
                                    <i class="bi bi-whatsapp text-success fs-5"></i>
                                    <div class="min-w-0">
                                        <span class="contact-label font-mono mb-0">PHONE / WHATSAPP</span>
                                        <span class="contact-value d-block"><?php echo e($profilePhone[0]); ?></span>
                                    </div>
                                </a>
                            <?php endif; ?>

                            <div class="contact-info-item d-flex align-items-center gap-3">
                                <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
                                <div>
                                    <span class="contact-label font-mono mb-0">LOCATION</span>
                                    <span class="contact-value d-block"><?php echo e($profileLocation); ?></span>
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo BASE_URL; ?>assets/Balamurugan-P-M-Resume.pdf" target="_blank" class="contact-resume-btn w-100 justify-content-center text-white font-mono">
                            <i class="bi bi-file-earmark-pdf-fill me-2 text-danger"></i> Download Resume PDF
                        </a>

                        <!-- Minimal Social Links Row -->
                        <div>
                            <span class="contact-label font-mono mb-2">PROFILES</span>
                            <div class="d-flex flex-wrap gap-2">
                                <?php 
                                $socialNetworkList = [
                                    ['name' => 'GitHub',    'icon' => 'bi-github',       'url' => $socialsGithub ?? 'https://github.com/Balamuruganpm'],
                                    ['name' => 'LinkedIn',  'icon' => 'bi-linkedin',     'url' => $socialsLinkedin ?? 'https://www.linkedin.com/in/balamurugan-p-m'],
                                    ['name' => 'Figma',     'icon' => 'bi-palette-fill', 'url' => $socialsFigma ?? 'https://www.figma.com/@balamuruganpm'],
                                    ['name' => 'Behance',   'icon' => 'bi-behance',      'url' => $socialsBehance ?? 'https://www.behance.net/balamuruganpm'],
                                    ['name' => 'Dribbble',  'icon' => 'bi-dribbble',     'url' => $socialsDribbble ?? 'https://dribbble.com/balamuruganedsty'],
                                    ['name' => 'CodePen',   'icon' => 'bi-code-slash',   'url' => $socialsCodepen ?? 'https://codepen.io/balamurugan_pm'],
                                    ['name' => 'X',         'icon' => 'bi-twitter-x',    'url' => $socialsTwitter ?? 'https://twitter.com/balaselfie_bd'],
                                    ['name' => 'Instagram', 'icon' => 'bi-instagram',    'url' => $socialsInstagram ?? 'https://instagram.com/balamurugan.pm'],
                                ];
                                foreach ($socialNetworkList as $net):
                                    if (!empty($net['url'])):
                                ?>
                                    <a href="<?php echo e($net['url']); ?>" target="_blank" rel="noopener noreferrer" class="social-icon-pill" title="<?php echo e($net['name']); ?>" aria-label="<?php echo e($net['name']); ?>">
                                        <i class="bi <?php echo e($net['icon']); ?>"></i>
                                    </a>
                                <?php endif; endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Minimal Message Form -->
                <div class="col-lg-7">
                    <div class="dossier-subbox p-4 p-md-5 rounded-4">
                        <form id="dossier-contact-form" method="POST" action="<?php echo BASE_URL; ?>contact">
                            <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
                            <div id="contact-alert-box" class="d-none mb-4 p-3 rounded-3 small"></div>

                            <div class="row g-4 mb-4">
                                <div class="col-sm-6">
                                    <label for="c-name" class="contact-field-label font-mono">NAME *</label>
                                    <input type="text" name="name" id="c-name" class="dossier-input" placeholder="Alex Henderson" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="c-email" class="contact-field-label font-mono">EMAIL *</label>
                                    <input type="email" name="email" id="c-email" class="dossier-input" placeholder="alex@company.com" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="c-subject" class="contact-field-label font-mono">SUBJECT *</label>
                                <input type="text" name="subject" id="c-subject" class="dossier-input" placeholder="Project Inquiry / Collaboration" required>
                            </div>

                            <div class="mb-4">
                                <label for="c-message" class="contact-field-label font-mono">MESSAGE *</label>
                                <textarea name="message" id="c-message" rows="5" class="dossier-input" placeholder="Tell me about your project, timeline, and goals..." required></textarea>
                            </div>

                            <button type="submit" class="contact-dispatch-btn w-100 justify-content-center font-mono" id="c-submit-btn">
                                Send Message <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </form>
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

