<?php
/**
 * Dossier Section: Profile Dossier Top Card
 * Displays professional background and engineering philosophy
 */
?>
<div class="dossier-card dossier-card-top" id="dossier-top-card">
    <div class="dossier-card-header d-flex align-items-center justify-content-between mb-2">
        <span class="dossier-mono-tag">// PROFILE_DOSSIER</span>
        <button type="button" class="dossier-close-btn" id="dossier-close-btn" aria-label="Close Dossier Window" title="Close (Esc)">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    
    <h2 class="dossier-card-title mb-4">
        Professional Background &amp; Engineering Philosophy
    </h2>
    
    <div class="dossier-card-text font-body" style="max-width: 82ch;">
        <p class="mb-3">
            I am <strong><?php echo e($profileName); ?></strong>, a Website Developer, Frontend Architect, and Enterprise SharePoint specialist based in <?php echo e($profileLocation); ?>, serving businesses and startups across <strong>Salem, Coimbatore, Chennai, Tamil Nadu</strong>, and remote clients worldwide.
        </p>
        <p class="mb-3">
            My core technical experience centers around <strong>React.js, TypeScript, JavaScript, HTML5/CSS3, PHP, SharePoint Online, and SharePoint Framework (SPFx)</strong>. I regularly integrate Microsoft Graph APIs, REST endpoints, and dynamic state management into enterprise workflows.
        </p>
        <p class="mb-3">
            I have a strong track record of transforming complex product requirements into accessible, pixel-perfect frontend implementations with a sharp focus on performance optimization, SEO compliance, and cross-platform reliability.
        </p>
        <p class="mb-0">
            Beyond coding, I bring deep hands-on expertise in Figma design systems and UX prototyping, bridging the gap between interactive visual design and clean modular code architecture.
        </p>
    </div>
</div>

