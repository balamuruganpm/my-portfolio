<?php
/**
 * Section: Awards and Recognitions (Extracted from about.php mode 3)
 */
?>
<section class="awards-section py-1" aria-label="Awards and Recognitions">
    <div class="awards-container-card p-4 p-md-5">
        <div class="mb-4">
            <h3 class="h4 fw-bold font-title text-dark mb-1 d-flex align-items-center gap-2">
                <span class="title-accent-bar"></span> Awards & Recognition
            </h3>
            <p class="text-secondary small mb-0">Honors, hackathons, and technical event accomplishments</p>
        </div>

        <div class="row g-4 mx-0 mt-2">
            <?php 
            foreach ($awardsList as $award) {
                $title = isset($award['title']) ? $award['title'] : '';
                $description = isset($award['description']) ? $award['description'] : '';
            ?>
                <div class="col-md-6 col-12">
                    <div class="award-showcase-card p-4 h-100 d-flex gap-3 align-items-start border rounded-4">
                        <?php 
                        $isTNSkills = (strpos($title, 'TNSkills') !== false);
                        if ($isTNSkills): 
                        ?>
                            <div class="award-logo-wrapper d-flex align-items-center justify-content-center bg-light rounded-4" aria-hidden="true" style="width: 52px; height: 52px; flex-shrink: 0; border: 1px solid var(--border-color); overflow: hidden; padding: 2px;">
                                <img src="<?php echo BASE_URL; ?>assets/images/tn-gov-logo.webp" alt="Tamil Nadu Gov Logo" title="Tamil Nadu Government Logo" loading="lazy" width="48" height="48" style="object-fit: contain;">
                            </div>
                        <?php else: ?>
                            <div class="award-trophy-wrapper d-flex align-items-center justify-content-center bg-warning-subtle text-warning rounded-4" aria-hidden="true" style="width: 52px; height: 52px; flex-shrink: 0; border: 1px solid rgba(255, 179, 0, 0.2);">
                                <i class="bi bi-trophy-fill fs-4"></i>
                            </div>
                        <?php endif; ?>
                        <div>
                            <h4 class="h5 fw-bold text-dark mb-2 font-title"><?php echo e($title); ?></h4>
                            <p class="text-secondary small mb-0 font-body leading-relaxed"><?php echo e($description); ?></p>
                        </div>
                    </div>
                </div>
            <?php 
            } 
            ?>
        </div>
    </div>
</section>
