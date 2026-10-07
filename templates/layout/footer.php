<?php
/**
 * Layout: Footer Section
 * Pure HTML footer output with view counter and social links
 */
?>
</main>

<footer class="footer-section py-4 mt-5 border-top border-secondary-subtle" aria-label="Website Footer Info">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-center text-md-start">
            <div class="mb-2 mb-md-0">
                <p class="text-secondary small mb-2 font-body">
                    <?php echo e($profileName); ?> - <?php echo e($profileSubtitle); ?>
                </p>
                <p class="text-secondary small mb-1">&copy; <?php echo date('Y'); ?> <?php echo e($profileName); ?>. All rights reserved. &bull; <span class="text-muted font-body">Views: <?php echo number_format($viewCount); ?></span></p>
            </div>
            
            <div class="d-flex flex-wrap gap-2" role="navigation" aria-label="Social Profiles">
                <?php renderSocialLinks($socialsData, 'social-icon-circle', 'fs-6'); ?>
            </div>
        </div>
    </div>
</footer>
