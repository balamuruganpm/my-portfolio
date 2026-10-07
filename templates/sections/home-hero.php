<?php
/**
 * Section: Futuristic Developer Cyber Hero Stage
 * Ultra-modern dark monochrome hero with telemetry, orbital radar, and live ticker
 */
$socialsList = $socialsData ?? [];
$skillsList = $skillsData ?? [];
?>
<section class="cyber-hero-stage position-relative overflow-hidden pt-5 pb-4" aria-label="Developer Profile & Hero">
    <!-- Ambient Holographic Glow & Cyber Grid -->
    <div class="hero-cyber-ambient" aria-hidden="true"></div>
    <div class="hero-cyber-grid-overlay" aria-hidden="true"></div>

    <div class="container position-relative" style="z-index: 2;">
        <!-- Top Telemetry Status Header -->
        <div class="hero-telemetry-bar d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div class="d-flex align-items-center gap-2">
                <span class="hud-status-indicator pulse-cyan"></span>
                <span class="hud-mono-label font-mono">SYS_STATUS // <span class="text-cyan">ONLINE &amp; HIREABLE</span></span>
            </div>
            <div class="d-none d-md-flex align-items-center gap-3 text-secondary font-mono small">
                <span><i class="bi bi-geo-alt text-cyan me-1"></i><?php echo e($profileLocation ?? 'Salem, Tamil Nadu, India'); ?></span>
                <span class="text-secondary-subtle">|</span>
                <span><i class="bi bi-cpu text-cyan me-1"></i>STACK: REACT 19 &bull; SPFX &bull; TS</span>
                <span class="text-secondary-subtle">|</span>
                <span><i class="bi bi-shield-check text-cyan me-1"></i>SECURITY: 100%</span>
            </div>
        </div>

        <!-- Main Cyber Hero Center Stage -->
        <div class="hero-center-stage text-center py-4 py-lg-5">
            <!-- Central Orbital Radar & Avatar Nexus -->
            <div class="avatar-orbital-stage mx-auto mb-4 position-relative">
                <div class="radar-orbital-ring ring-outer" aria-hidden="true"></div>
                <div class="radar-orbital-ring ring-mid" aria-hidden="true"></div>
                <div class="radar-orbital-ring ring-inner" aria-hidden="true"></div>
                <div class="radar-sweep-beam" aria-hidden="true"></div>
                
                <?php 
                $heroAvatarUrl = !empty($profileAvatar) ? (BASE_URL . ltrim($profileAvatar, '/')) : (BASE_URL . 'assets/images/balamurugan-pm.webp');
                ?>
                <div class="avatar-core-frame">
                    <img src="<?php echo e($heroAvatarUrl); ?>" 
                         alt="<?php echo e($profileName); ?> Profile Avatar" 
                         title="<?php echo e($profileName); ?>" 
                         width="130" 
                         height="130" 
                         loading="eager" 
                         decoding="async" 
                         class="avatar-core-img">
                </div>

                <!-- Floating Cyber Badges Around Avatar -->
                <div class="floating-cyber-pill pill-top-right">
                    <i class="bi bi-patch-check-fill text-cyan"></i>
                    <span>Low Code Developer</span>
                </div>
                <div class="floating-cyber-pill pill-bottom-left">
                    <i class="bi bi-code-slash text-cyan"></i>
                    <span>Clean Code</span>
                </div>
            </div>

            <!-- Glitch & Holographic Name Title with Animated Typewriter -->
            <div class="hero-typography mb-3">
                <div class="d-flex justify-content-center mb-2">
                    <span class="hero-role-tag font-mono d-inline-flex align-items-center gap-1.5 px-3 py-1.5">
                        <span class="text-cyan fw-bold">&lt;</span>
                        <span id="hero-typewriter-text" 
                              class="typewriter-text text-white fw-semibold" 
                              data-roles='["Frontend Developer", "React.js Specialist", "SPFx &amp; SharePoint Engineer", "UI/UX &amp; Design Systems Architect", "High-Performance Web Engineer"]'>Frontend Developer</span>
                        <span class="typewriter-cursor text-cyan" aria-hidden="true">_</span>
                        <span class="text-cyan fw-bold">/&gt;</span>
                    </span>
                </div>
                <h1 class="hero-giant-title font-title mb-3">
                    <?php echo e($profileName); ?>
                </h1>
                <p class="hero-lead-text font-body mx-auto text-secondary mb-4">
                    Architecting high-performance web applications, scalable SharePoint frameworks, responsive component design systems, and engaging web experiences.
                </p>
            </div>

            <!-- High-Impact Action Command Buttons -->
            <div class="hero-actions-dock d-flex flex-wrap justify-content-center align-items-center gap-3 mb-5">
                <a href="<?php echo BASE_URL; ?>portfolio" class="cyber-btn cyber-btn-primary">
                    <i class="bi bi-terminal-fill me-2"></i>
                    <span>EXPLORE PORTFOLIO</span>
                    <i class="bi bi-arrow-right ms-2 arrow-shift"></i>
                </a>
                <a href="<?php echo BASE_URL; ?>assets/Balamurugan-P-M-Resume.pdf" target="_blank" download class="cyber-btn cyber-btn-secondary">
                    <i class="bi bi-file-earmark-code me-2"></i>
                    <span>GET RESUME (.PDF)</span>
                </a>
                <a href="<?php echo BASE_URL; ?>contact" class="cyber-btn cyber-btn-glass">
                    <i class="bi bi-chat-dots me-2"></i>
                    <span>INITIATE CONTACT</span>
                </a>
            </div>

            <!-- Quick Telemetry Specs Bar -->
            <div class="hero-telemetry-grid row g-3 justify-content-center pt-2 mb-2 mx-auto" style="max-width: 860px;">
                <div class="col-6 col-md-3">
                    <div class="telemetry-stat-card">
                        <span class="telemetry-label font-mono text-muted">SPECIALTY</span>
                        <strong class="telemetry-value font-title text-cyan">Frontend &amp; SPFx</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="telemetry-stat-card">
                        <span class="telemetry-label font-mono text-muted">FRAMEWORK</span>
                        <strong class="telemetry-value font-title text-white">React 19 &bull; TS</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="telemetry-stat-card">
                        <span class="telemetry-label font-mono text-muted">ARCHITECTURE</span>
                        <strong class="telemetry-value font-title text-white">Component MVC</strong>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="telemetry-stat-card">
                        <span class="telemetry-label font-mono text-muted">DISPATCH</span>
                        <strong class="telemetry-value font-title text-cyan">Available Now</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Infinite High-Tech Marquee Loop Ribbon -->
    <div class="cyber-marquee-ribbon mt-4" aria-hidden="true">
        <div class="cyber-marquee-track">
            <div class="cyber-marquee-group">
                <span class="marquee-item"><i class="bi bi-lightning-charge-fill text-cyan me-1"></i> REACT.JS 19</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-share text-cyan me-1"></i> SHAREPOINT SPFX</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-code-square text-cyan me-1"></i> TYPESCRIPT</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-braces text-cyan me-1"></i> JAVASCRIPT ES6+</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-palette text-cyan me-1"></i> UI/UX ARCHITECTURE</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-hdd-network text-cyan me-1"></i> REST &amp; GRAPH API</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-controller text-cyan me-1"></i> 2D CANVAS GAMES</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-speedometer2 text-cyan me-1"></i> 99.9% ACCESSIBLE</span>
                <span class="marquee-divider">&bull;</span>
            </div>
            <div class="cyber-marquee-group" aria-hidden="true">
                <span class="marquee-item"><i class="bi bi-lightning-charge-fill text-cyan me-1"></i> REACT.JS 19</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-share text-cyan me-1"></i> SHAREPOINT SPFX</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-code-square text-cyan me-1"></i> TYPESCRIPT</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-braces text-cyan me-1"></i> JAVASCRIPT ES6+</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-palette text-cyan me-1"></i> UI/UX ARCHITECTURE</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-hdd-network text-cyan me-1"></i> REST &amp; GRAPH API</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-controller text-cyan me-1"></i> 2D CANVAS GAMES</span>
                <span class="marquee-divider">&bull;</span>
                <span class="marquee-item"><i class="bi bi-speedometer2 text-cyan me-1"></i> 99.9% ACCESSIBLE</span>
                <span class="marquee-divider">&bull;</span>
            </div>
        </div>
    </div>
</section>
