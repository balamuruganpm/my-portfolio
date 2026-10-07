<?php
/**
 * Section: Awards and Recognitions
 */
$awardsList = $awardsList ?? $awards ?? [];
?>
<section class="awards-section py-1 mb-4" aria-label="Awards and Recognitions">
    <div class="cyber-card-frame p-4 p-md-5">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="hud-mono-tag font-mono text-cyan">// RECOGNITIONS &amp; HONORS</span>
        </div>
        <h2 class="h3 fw-bold font-title text-white mb-1">
            Awards &amp; Competitions
        </h2>
        <p class="text-secondary small font-mono mb-4">HONORS, HACKATHONS, AND TECHNICAL EXCELLENCE ACCOMPLISHMENTS</p>

        <div class="row g-4">
            <?php 
            foreach ($awardsList as $award) {
                $title = isset($award['title']) ? $award['title'] : '';
                $description = isset($award['description']) ? $award['description'] : '';
            ?>
                <div class="col-md-6 col-12">
                    <div class="cyber-award-card p-4 h-100 d-flex gap-3 align-items-start rounded-3">
                        <?php 
                        $isTNSkills = (strpos($title, 'TNSkills') !== false);
                        if ($isTNSkills): 
                        ?>
                            <div class="award-logo-wrapper d-flex align-items-center justify-content-center bg-dark rounded-3" aria-hidden="true" style="width: 48px; height: 48px; flex-shrink: 0; border: 1px solid var(--cyber-border); overflow: hidden; padding: 2px;">
                                <img src="<?php echo BASE_URL; ?>assets/images/tn-gov-logo.webp" alt="Tamil Nadu Gov Logo" title="Tamil Nadu Government Logo" loading="lazy" width="40" height="40" style="object-fit: contain;">
                            </div>
                        <?php else: ?>
                            <div class="award-trophy-wrapper d-flex align-items-center justify-content-center bg-dark text-warning rounded-3" aria-hidden="true" style="width: 48px; height: 48px; flex-shrink: 0; border: 1px solid rgba(255, 179, 0, 0.3);">
                                <i class="bi bi-trophy-fill fs-4 text-warning"></i>
                            </div>
                        <?php endif; ?>
                        <div>
                            <h3 class="h5 fw-bold text-white mb-2 font-title"><?php echo e($title); ?></h3>
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
