<?php
/**
 * Section: Professional Certifications (Extracted from about.php mode 4)
 */
?>
<section class="certifications-section py-1 mt-4" aria-label="Certifications Profile">
    <div class="certifications-container-card p-4 p-md-5">
        <div class="mb-4">
            <h3 class="h4 fw-bold font-title text-dark mb-1 d-flex align-items-center gap-2">
                <span class="title-accent-bar"></span> Certifications
            </h3>
            <p class="text-secondary small mb-0">Professional credentials and course completions</p>
        </div>

        <div class="d-flex flex-column gap-3 mt-3">
            <?php 
            foreach ($certificatesList as $cert) {
                $name = isset($cert['name']) ? $cert['name'] : '';
                $issuer = isset($cert['issuer']) ? $cert['issuer'] : '';
            ?>
                <div class="certificate-row-card p-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 border rounded-4">
                    <div class="d-flex align-items-center gap-3">
                        <?php 
                        $isGUVI = (strpos($issuer, 'GUVI') !== false);
                        $isCareerNinja = (strpos($issuer, 'CareerNinja') !== false);
                        $isGreatLearning = (strpos($issuer, 'Great Learning') !== false);
                        ?>
                        <div class="certificate-badge-icon d-flex align-items-center justify-content-center rounded-circle" style="width: 44px; height: 44px; flex-shrink: 0; overflow: hidden;">
                            <?php if ($isGUVI): ?>
                                <img src="<?php echo BASE_URL; ?>assets/images/guvi-logo.webp" alt="GUVI Logo" title="GUVI Logo" loading="lazy" width="40" height="40" style="object-fit: cover;">
                            <?php elseif ($isCareerNinja): ?>
                                <img src="<?php echo BASE_URL; ?>assets/images/careerninja-logo.webp" alt="CareerNinja Logo" title="CareerNinja Logo" loading="lazy" width="40" height="40" style="object-fit: cover;">
                            <?php elseif ($isGreatLearning): ?>
                                <img src="<?php echo BASE_URL; ?>assets/images/great-learning-logo.webp" alt="Great Learning Logo" title="Great Learning Logo" loading="lazy" width="40" height="40" style="object-fit: cover;">
                            <?php else: ?>
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle" style="border: 1px solid rgba(40, 167, 69, 0.15);">
                                    <i class="bi bi-patch-check-fill fs-5" aria-hidden="true"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="h6 fw-bold text-dark mb-0 font-title"><?php echo e($name); ?></h4>
                        </div>
                    </div>
                    <div>
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold font-body text-wrap text-start" style="font-size: 0.8rem; white-space: normal;"><?php echo e($issuer); ?></span>
                    </div>
                </div>
            <?php 
            } 
            ?>
        </div>
    </div>
</section>
