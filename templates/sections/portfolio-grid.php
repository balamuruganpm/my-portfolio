<?php
/**
 * Section: Portfolio Projects Grid with Glassmorphic Cyber Modal
 */
?>
<!-- Portfolio Projects Section -->
<section id="portfolio-section" class="py-4" aria-label="<?php echo e($portfolioLabel); ?>" data-mascot-speech="<?php echo e($portfolioSpeech); ?>">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="hud-mono-tag font-mono text-cyan">// DEPLOYED_WORK_REGISTRY</span>
            </div>
            <h1 class="h2 fw-bold text-white mb-2 font-title">Frontend &amp; Engineering Projects</h1>
            <p class="text-secondary small font-body" style="max-width: 760px;">
                A curated catalog of production web applications, enterprise SharePoint solutions, responsive web interfaces, accessibility implementations, and custom interactive experiments.
            </p>
        </div>
    </div>

    <div class="row g-4">
        <?php if (empty($projectsList)): ?>
            <div class="col-12">
                <p class="text-secondary text-center py-5 font-mono">NO_PROJECTS_REGISTERED</p>
            </div>
        <?php else: ?>
            <?php foreach ($projectsList as $index => $proj): 
                $img = isset($proj['image']) ? $proj['image'] : 'assets/images/favicon.webp';
                $link = isset($proj['link']) ? $proj['link'] : '#';
                $bullets = isset($proj['bullets']) ? $proj['bullets'] : [];
                $tags = isset($proj['tags']) ? $proj['tags'] : [];
            ?>
                <div class="col-md-6 col-12">
                    <div class="cyber-project-card position-relative" 
                         role="button" 
                         tabindex="0"
                         aria-label="View details for <?php echo e($proj['title']); ?>"
                         data-project-title="<?php echo e($proj['title']); ?>"
                         data-project-tagline="<?php echo e($proj['tagline']); ?>"
                         data-project-bullets="<?php echo e(json_encode($bullets)); ?>"
                         data-project-tags="<?php echo e(json_encode($tags)); ?>"
                         data-project-link="<?php echo e($link); ?>"
                         data-project-image="<?php echo e(BASE_URL . $img); ?>">
                        
                        <div class="cyber-project-img-frame position-relative overflow-hidden">
                            <img src="<?php echo e(BASE_URL . $img); ?>" 
                                 alt="<?php echo e($proj['title']); ?>" 
                                 title="<?php echo e($proj['title']); ?>" 
                                 loading="lazy" 
                                 width="500" 
                                 height="300" 
                                 class="w-100 h-100 cyber-project-img">
                            <span class="cyber-project-id font-mono">PRJ_0<?php echo $index + 1; ?></span>
                            <div class="cyber-scanline" aria-hidden="true"></div>
                        </div>

                        <div class="cyber-project-info p-4">
                            <div class="d-flex flex-wrap gap-1.5 mb-2">
                                <?php foreach (array_slice($tags, 0, 3) as $t): ?>
                                    <span class="cyber-mini-badge"><?php echo e($t); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <h3 class="h4 fw-bold text-white font-title mb-2"><?php echo e($proj['title']); ?></h3>
                            <p class="text-secondary small font-body mb-3"><?php echo e($proj['tagline']); ?></p>
                            
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top border-dark-subtle">
                                <span class="font-mono text-cyan small">CLICK_TO_INSPECT</span>
                                <span class="font-mono text-muted small"><i class="bi bi-arrow-up-right"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Project Details Modal (Glassmorphic Dark Cyber Popup) -->
<div id="project-modal" class="project-modal-overlay" aria-hidden="true" role="dialog">
    <div class="project-modal-content cyber-modal-box p-4 p-md-5">
        <button id="close-project-modal" class="btn-close-modal" aria-label="Close modal">&times;</button>
        
        <div class="project-modal-image-wrapper mb-3 rounded-3 overflow-hidden position-relative" style="height: 240px;">
            <img id="modal-project-img" src="" alt="Project Image" title="Project Thumbnail" loading="lazy" class="w-100 h-100 object-fit-cover">
            <div class="showcase-scanline"></div>
        </div>

        <h3 id="modal-project-title" class="h4 fw-bold text-white font-title mb-1"></h3>
        <p id="modal-project-tagline" class="text-secondary small mb-3 font-body"></p>
        
        <div class="mb-3">
            <h5 class="small fw-bold text-cyan font-mono mb-2">// KEY_SPECIFICATIONS</h5>
            <ul id="modal-project-bullets" class="text-secondary small ps-3 font-body"></ul>
        </div>

        <div id="modal-project-tags" class="d-flex flex-wrap gap-2 mb-4"></div>

        <div class="d-flex justify-content-end gap-2">
            <a id="modal-project-link" href="" target="_blank" rel="noopener noreferrer" class="cyber-btn cyber-btn-primary">
                <i class="bi bi-box-arrow-up-right me-1.5"></i><span>LAUNCH APPLICATION</span>
            </a>
        </div>
    </div>
</div>
