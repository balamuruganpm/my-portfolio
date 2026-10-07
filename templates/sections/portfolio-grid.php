<?php
/**
 * Section: Portfolio Projects Grid with Glassmorphic Modal
 */
?>
<!-- Portfolio Projects Section -->
<section id="portfolio-section" class="py-4" aria-label="<?php echo e($portfolioLabel); ?>" data-mascot-speech="<?php echo e($portfolioSpeech); ?>">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="h3 fw-bold text-dark mb-1 font-title">Frontend Development Projects</h2>
            <p class="text-secondary small">A collection of web applications and frontend projects demonstrating my experience with React.js, JavaScript, responsive web development, accessibility, and user-focused interface implementation.</p>
        </div>
    </div>

    <div class="row g-4 mx-0">
        <?php if (empty($projectsList)): ?>
            <div class="col-12">
                <p class="text-muted text-center py-4">No projects added yet.</p>
            </div>
        <?php else: ?>
            <?php foreach ($projectsList as $proj): 
                $img = isset($proj['image']) ? $proj['image'] : 'assets/images/favicon.webp';
                $link = isset($proj['link']) ? $proj['link'] : '#';
                $bullets = isset($proj['bullets']) ? $proj['bullets'] : [];
                $tags = isset($proj['tags']) ? $proj['tags'] : [];
            ?>
                <div class="col-md-6 col-12">
                    <div class="project-bento-card rounded-4 overflow-hidden position-relative border" 
                         role="button" 
                         tabindex="0"
                         aria-label="View details for <?php echo e($proj['title']); ?>"
                         data-project-title="<?php echo e($proj['title']); ?>"
                         data-project-tagline="<?php echo e($proj['tagline']); ?>"
                         data-project-bullets="<?php echo e(json_encode($bullets)); ?>"
                         data-project-tags="<?php echo e(json_encode($tags)); ?>"
                         data-project-link="<?php echo e($link); ?>"
                         data-project-image="<?php echo e(BASE_URL . $img); ?>">
                        
                        <div class="project-image-container w-100 h-100">
                            <img src="<?php echo e(BASE_URL . $img); ?>" 
                                 alt="<?php echo e($proj['title']); ?>" 
                                 title="<?php echo e($proj['title']); ?>" 
                                 loading="lazy" 
                                 width="500" 
                                 height="320" 
                                 class="w-100 h-100 project-bento-img" 
                                 style="object-fit: cover;">
                        </div>

                        <!-- Hover Overlay -->
                        <div class="project-bento-overlay d-flex flex-column justify-content-end p-4">
                            <div class="overlay-text-wrapper">
                                <h3 class="h5 fw-bold text-white mb-1 font-title"><?php echo e($proj['title']); ?></h3>
                                <p class="text-white-50 small mb-0 font-body"><?php echo e($proj['tagline']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Project Details Modal (Glassmorphic Popup) -->
<div id="project-modal" class="project-modal-overlay" aria-hidden="true" role="dialog">
    <div class="project-modal-content p-4">
        <button id="close-project-modal" class="btn-close-modal" aria-label="Close modal">&times;</button>
        
        <div class="project-modal-image-wrapper mb-3 rounded-4 overflow-hidden" style="height: 200px; border: 1px solid var(--border-color);">
            <img id="modal-project-img" src="" alt="Project Image" title="Project Thumbnail" loading="lazy" class="w-100 h-100" style="object-fit: cover;">
        </div>

        <h3 id="modal-project-title" class="h4 fw-bold text-dark font-title mb-1"></h3>
        <p id="modal-project-tagline" class="text-secondary small mb-3 font-body"></p>
        
        <div class="mb-3">
            <h5 class="small fw-bold text-dark-emphasis mb-2">Key Highlights:</h5>
            <ul id="modal-project-bullets" class="text-secondary small ps-3 font-body"></ul>
        </div>

        <div id="modal-project-tags" class="d-flex flex-wrap gap-2 mb-4"></div>

        <div class="d-flex justify-content-end gap-2">
            <a id="modal-project-link" href="" target="_blank" rel="noopener noreferrer" class="btn btn-warning-custom py-2 px-4 small font-body fw-semibold d-flex align-items-center gap-2">
                <i class="bi bi-box-arrow-up-right"></i>View Project
            </a>
        </div>
    </div>
</div>
