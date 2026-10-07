<?php
/**
 * Section: Professional Certifications
 */
$certificatesList = $certificatesList ?? $certificates ?? [];
?>
<section class="certifications-section py-1 mb-4" aria-label="Certifications Profile">
    <div class="cyber-card-frame p-4 p-md-5">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="hud-mono-tag font-mono text-cyan">// VERIFIED_CREDENTIALS</span>
        </div>
        <h2 class="h3 fw-bold font-title text-white mb-1">
            Certifications &amp; Accreditations
        </h2>
        <p class="text-secondary small font-mono mb-4">VERIFIED PROFESSIONAL CREDENTIALS</p>

        <div class="d-flex flex-column gap-3">
            <?php 
            foreach ($certificatesList as $cert) {
                $name = isset($cert['name']) ? $cert['name'] : '';
                $issuer = isset($cert['issuer']) ? $cert['issuer'] : '';
            ?>
                <div class="cyber-cert-row p-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 rounded-3">
                    <div class="d-flex align-items-center gap-3">
                        <?php 
                        $isGUVI = (strpos($issuer, 'GUVI') !== false);
                        $isCareerNinja = (strpos($issuer, 'CareerNinja') !== false);
                        $isGreatLearning = (strpos($issuer, 'Great Learning') !== false);
                        ?>
                        <div class="cyber-cert-icon d-flex align-items-center justify-content-center rounded-circle flex-shrink-0">
                            <?php if ($isGUVI): ?>
                                <img src="<?php echo BASE_URL; ?>assets/images/guvi-logo.webp" alt="GUVI Logo" title="GUVI Logo" loading="lazy" width="36" height="36" style="object-fit: cover; border-radius: 50%;">
                            <?php elseif ($isCareerNinja): ?>
                                <img src="<?php echo BASE_URL; ?>assets/images/careerninja-logo.webp" alt="CareerNinja Logo" title="CareerNinja Logo" loading="lazy" width="36" height="36" style="object-fit: cover; border-radius: 50%;">
                            <?php elseif ($isGreatLearning): ?>
                                <img src="<?php echo BASE_URL; ?>assets/images/great-learning-logo.webp" alt="Great Learning Logo" title="Great Learning Logo" loading="lazy" width="36" height="36" style="object-fit: cover; border-radius: 50%;">
                            <?php else: ?>
                                <i class="bi bi-patch-check-fill fs-5 text-cyan" aria-hidden="true"></i>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h3 class="h6 fw-bold text-white mb-0 font-title"><?php echo e($name); ?></h3>
                        </div>
                    </div>
                    <div>
                        <span class="badge bg-dark text-cyan border border-secondary border-opacity-50 font-mono small"><?php echo e($issuer); ?></span>
                    </div>
                </div>
            <?php 
            } 
            ?>
        </div>
    </div>
</section>
