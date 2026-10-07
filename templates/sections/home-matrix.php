<?php
/**
 * Section: Home Cyber Matrix
 * Comprehensive modern showcase replacing bento boxes with interactive matrix panels
 */
$allProjects = !empty($projectsList) ? $projectsList : (!empty($projects) ? $projects : []);
$topProjects = array_slice($allProjects, 0, 4);
$allBlogs = !empty($blogs) ? $blogs : (!empty($publishedBlogs) ? $publishedBlogs : []);
$recentBlogs = array_slice($allBlogs, 0, 3);
?>
<section class="cyber-matrix-showcase py-5" aria-label="Core Engineering Showcase">
    <div class="container">
        
        <!-- SECTION 01: Core Competency Architecture Matrix -->
        <div class="matrix-section-header mb-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <span class="hud-mono-tag font-mono text-cyan mb-1 d-inline-block">// 01_ARSENAL</span>
                    <h2 class="h3 fw-bold text-white font-title mb-0">Core Engineering Arsenal</h2>
                </div>
                <a href="<?php echo BASE_URL; ?>about" class="cyber-link-subtle font-mono small">
                    FULL_EXPERIENCE_LOG <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <!-- Matrix Module 1: Modern Frontend -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="cyber-module-card h-100">
                    <div class="module-corner top-l"></div>
                    <div class="module-corner top-r"></div>
                    <div class="module-corner bot-l"></div>
                    <div class="module-corner bot-r"></div>
                    
                    <div class="module-icon-wrap mb-3 text-cyan">
                        <i class="bi bi-code-slash fs-2"></i>
                    </div>
                    <span class="font-mono text-muted small">MODULE_01</span>
                    <h3 class="h5 fw-bold text-white font-title mb-2">Frontend Architecture</h3>
                    <p class="text-secondary small font-body mb-3">
                        Building responsive, accessible interfaces with React 19, TypeScript, and modern state workflows.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mt-auto">
                        <span class="cyber-mini-badge">React</span>
                        <span class="cyber-mini-badge">TypeScript</span>
                        <span class="cyber-mini-badge">Next.js</span>
                    </div>
                </div>
            </div>

            <!-- Matrix Module 2: Enterprise SharePoint & SPFx -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="cyber-module-card h-100">
                    <div class="module-corner top-l"></div>
                    <div class="module-corner top-r"></div>
                    <div class="module-corner bot-l"></div>
                    <div class="module-corner bot-r"></div>
                    
                    <div class="module-icon-wrap mb-3 text-cyan">
                        <i class="bi bi-microsoft fs-2"></i>
                    </div>
                    <span class="font-mono text-muted small">MODULE_02</span>
                    <h3 class="h5 fw-bold text-white font-title mb-2">SharePoint &amp; SPFx</h3>
                    <p class="text-secondary small font-body mb-3">
                        Enterprise web parts, Microsoft Graph API integration, custom workflows, and tenant deployment.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mt-auto">
                        <span class="cyber-mini-badge">SPFx</span>
                        <span class="cyber-mini-badge">MS Graph</span>
                        <span class="cyber-mini-badge">PnP JS</span>
                    </div>
                </div>
            </div>

            <!-- Matrix Module 3: UI/UX & Design Systems -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="cyber-module-card h-100">
                    <div class="module-corner top-l"></div>
                    <div class="module-corner top-r"></div>
                    <div class="module-corner bot-l"></div>
                    <div class="module-corner bot-r"></div>
                    
                    <div class="module-icon-wrap mb-3 text-cyan">
                        <i class="bi bi-layers-half fs-2"></i>
                    </div>
                    <span class="font-mono text-muted small">MODULE_03</span>
                    <h3 class="h5 fw-bold text-white font-title mb-2">Design Engineering</h3>
                    <p class="text-secondary small font-body mb-3">
                        High-polish micro-interactions, dark glassmorphism, responsive grids, and design tokens.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mt-auto">
                        <span class="cyber-mini-badge">CSS3</span>
                        <span class="cyber-mini-badge">Bootstrap</span>
                        <span class="cyber-mini-badge">Figma</span>
                    </div>
                </div>
            </div>

            <!-- Matrix Module 4: Performance & Backend Integration -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="cyber-module-card h-100">
                    <div class="module-corner top-l"></div>
                    <div class="module-corner top-r"></div>
                    <div class="module-corner bot-l"></div>
                    <div class="module-corner bot-r"></div>
                    
                    <div class="module-icon-wrap mb-3 text-cyan">
                        <i class="bi bi-speedometer2 fs-2"></i>
                    </div>
                    <span class="font-mono text-muted small">MODULE_04</span>
                    <h3 class="h5 fw-bold text-white font-title mb-2">High Performance</h3>
                    <p class="text-secondary small font-body mb-3">
                        Lighthouse 95+, asset minification, WCAG 2.2 AA accessibility, and RESTful API integrations.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mt-auto">
                        <span class="cyber-mini-badge">PHP</span>
                        <span class="cyber-mini-badge">Node.js</span>
                        <span class="cyber-mini-badge">REST API</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 02: Featured Work Showcases -->
        <div class="matrix-section-header mb-4 pt-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <span class="hud-mono-tag font-mono text-cyan mb-1 d-inline-block">// 02_DEPLOYMENTS</span>
                    <h2 class="h3 fw-bold text-white font-title mb-0">Featured Project Spotlights</h2>
                </div>
                <a href="<?php echo BASE_URL; ?>portfolio" class="cyber-link-subtle font-mono small">
                    VIEW_ALL_REPOSITORIES (<?php echo count($allProjects); ?>) <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <?php foreach ($topProjects as $index => $proj): 
                $img = isset($proj['image']) ? $proj['image'] : 'assets/images/favicon.webp';
                $link = isset($proj['link']) ? $proj['link'] : '#';
                $tags = isset($proj['tags']) ? $proj['tags'] : [];
                $bullets = isset($proj['bullets']) ? $proj['bullets'] : [];
            ?>
                <div class="col-12 col-md-6">
                    <article class="cyber-showcase-card h-100 position-relative overflow-hidden">
                        <div class="showcase-img-viewport position-relative overflow-hidden">
                            <img src="<?php echo e(BASE_URL . $img); ?>" 
                                 alt="<?php echo e($proj['title']); ?>" 
                                 loading="lazy" 
                                 width="600" 
                                 height="340" 
                                 class="w-100 showcase-img">
                            <div class="showcase-scanline" aria-hidden="true"></div>
                            <span class="showcase-index-badge font-mono">0<?php echo $index + 1; ?></span>
                        </div>
                        
                        <div class="showcase-body p-4">
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                <?php foreach (array_slice($tags, 0, 3) as $t): ?>
                                    <span class="cyber-mini-badge"><?php echo e($t); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <h3 class="h4 fw-bold text-white font-title mb-2">
                                <a href="<?php echo e($link); ?>" target="_blank" rel="noopener noreferrer" class="text-white text-decoration-none hover-cyan">
                                    <?php echo e($proj['title']); ?>
                                </a>
                            </h3>
                            <p class="text-secondary small font-body mb-3">
                                <?php echo e($proj['tagline']); ?>
                            </p>
                            
                            <?php if (!empty($bullets)): ?>
                                <div class="showcase-bullets-box font-mono small text-secondary-subtle mb-3">
                                    <i class="bi bi-terminal text-cyan me-1.5"></i><?php echo e($bullets[0]); ?>
                                </div>
                            <?php endif; ?>

                            <div class="d-flex align-items-center justify-content-between pt-3 border-top border-dark-subtle">
                                <span class="font-mono text-muted small">STATUS: LIVE</span>
                                <a href="<?php echo e($link); ?>" target="_blank" rel="noopener noreferrer" class="cyber-action-link font-mono small">
                                    LAUNCH_PREVIEW <i class="bi bi-box-arrow-up-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- SECTION 03: Arcade & Interactive Labs Banner -->
        <div class="arcade-cyber-banner p-4 p-md-5 mb-5 position-relative overflow-hidden">
            <div class="row align-items-center g-4 position-relative" style="z-index: 2;">
                <div class="col-12 col-lg-8">
                    <span class="hud-mono-tag font-mono text-cyan mb-2 d-inline-block">// 03_LABS &amp; ARCADE</span>
                    <h2 class="h3 fw-bold text-white font-title mb-2">Interactive 2D Developer Arcade</h2>
                    <p class="text-secondary font-body mb-3" style="max-width: 600px;">
                        Step away from standard UI and experience custom HTML5 Canvas simulations including <strong>MiniCraft 2D</strong>, <strong>Retro Snake</strong>, and <strong>Memory Matrix</strong>. Built with zero external gaming engines.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?php echo BASE_URL; ?>game" class="cyber-btn cyber-btn-primary">
                            <i class="bi bi-controller me-2"></i>
                            <span>ENTER THE ARCADE</span>
                        </a>
                        <a href="<?php echo BASE_URL; ?>contact" class="cyber-btn cyber-btn-glass">
                            <i class="bi bi-envelope me-2"></i>
                            <span>SEND COLLABORATION INQUIRY</span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 text-center">
                    <div class="arcade-graphic-wrapper">
                        <div class="retro-screen-frame">
                            <i class="bi bi-dpad fs-1 text-cyan mb-2"></i>
                            <div class="font-mono text-muted small">CANVAS 2D &bull; 60 FPS</div>
                            <div class="font-mono text-cyan small mt-1">PRESS START</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 04: Fast Contact Nexus -->
        <div class="contact-nexus-card p-4 p-md-5 position-relative overflow-hidden">
            <div class="row align-items-center g-4">
                <div class="col-12 col-lg-7">
                    <span class="hud-mono-tag font-mono text-cyan mb-2 d-inline-block">// 04_TRANSMISSION</span>
                    <h2 class="h3 fw-bold text-white font-title mb-2">Have a project in mind?</h2>
                    <p class="text-secondary font-body mb-0">
                        Whether you need enterprise SharePoint architecture, high-converting React apps, or modern UI consulting, let's create something extraordinary.
                    </p>
                </div>
                <div class="col-12 col-lg-5 text-lg-end">
                    <div class="d-flex flex-column flex-sm-row justify-content-lg-end gap-2">
                        <a href="mailto:balamuruganedsty@gmail.com" class="cyber-btn cyber-btn-primary">
                            <i class="bi bi-envelope-fill me-2"></i>
                            <span>EMAIL DIRECTLY</span>
                        </a>
                        <a href="https://wa.me/919677804820" target="_blank" rel="noopener noreferrer" class="cyber-btn cyber-btn-glass">
                            <i class="bi bi-whatsapp text-success me-2"></i>
                            <span>WHATSAPP</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
