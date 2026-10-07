<?php
/**
 * Layout: Body Start
 * Opens <body>, renders preloader overlay, mascot character scene, and opens <main>
 */
?>
<body class="preloader-active">

    <!-- Futuristic Scanner Preloader Overlay -->
    <div id="preloader" class="preloader-overlay" aria-label="System Initializing" role="dialog" aria-modal="true">
        <div class="preloader-content text-center">
            <!-- Holographic Radar Target Scanner -->
            <div class="preloader-scanner-box position-relative mx-auto mb-4">
                <div class="scanner-laser-beam" aria-hidden="true"></div>
                <div class="scanner-corner-bracket sc-tl" aria-hidden="true"></div>
                <div class="scanner-corner-bracket sc-tr" aria-hidden="true"></div>
                <div class="scanner-corner-bracket sc-bl" aria-hidden="true"></div>
                <div class="scanner-corner-bracket sc-br" aria-hidden="true"></div>
                
                <div class="scanner-avatar-target position-relative">
                    <img src="<?php echo BASE_URL; ?>assets/images/balamurugan-pm.webp" 
                         alt="Target Candidate" 
                         width="90" 
                         height="90" 
                         class="scanner-target-img">
                    <div class="target-crosshair" aria-hidden="true"></div>
                </div>
            </div>

            <!-- Dynamic Scan Status Badge & Text Sequence -->
            <div class="preloader-telemetry font-mono">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-2 preloader-status-badge">
                    <span class="scanner-pulse-dot"></span>
                    <span id="preloader-phase-tag" class="text-cyan small fw-bold">SEARCH_PROTOCOL_ACTIVE</span>
                </div>
                <div id="preloader-phrase" class="preloader-lead-text text-white fw-bold mb-3">
                    Scanning for the best web developer...
                </div>
                
                <!-- Progress Bar -->
                <div class="preloader-progress-track mx-auto mb-2">
                    <div id="preloader-progress-fill" class="preloader-progress-fill"></div>
                </div>
                <div class="d-flex justify-content-between mx-auto text-secondary small px-1" style="max-width: 290px;">
                    <span class="font-mono text-muted">TARGET: REACT &bull; SPFX</span>
                    <span id="preloader-percent-text" class="font-mono text-cyan fw-bold">0%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Mascot Character -->
    <?php include BASE_PATH . 'templates/partials/mascot-svg.php'; ?>

    <main class="site-main-content animate-fade-in">
