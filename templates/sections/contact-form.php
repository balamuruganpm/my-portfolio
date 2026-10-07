<?php
/**
 * Section: Contact Form and Information Cards (Pure View)
 * Note: POST submission logic is handled in includes/contact-handler.php
 */
?>
<!-- Contact Section -->
<section id="contact-section" class="py-4" aria-label="<?php echo e($contactLabel); ?>" data-mascot-speech="<?php echo e($contactSpeech); ?>">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="hud-mono-tag font-mono text-cyan">// DIRECT_TRANSMISSION_TERMINAL</span>
            </div>
            <h1 class="h2 fw-bold text-white mb-2 font-title">Get In Touch &amp; Collaborate</h1>
            <p class="text-secondary small font-body" style="max-width: 720px;">
                Available for Frontend Developer contracts, SharePoint enterprise solutions, UI/UX architecture, and technical consulting. Dispatch your requirements below.
            </p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left: Contact Info Cards -->
        <div class="col-lg-5">
            <div class="d-flex flex-column gap-3">

                <!-- Email Card -->
                <div class="cyber-contact-card p-4 d-flex align-items-center gap-3">
                    <div class="cyber-contact-icon text-cyan flex-shrink-0">
                        <i class="bi bi-envelope-fill fs-4" aria-hidden="true"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="d-block text-muted font-mono small">EMAIL_DISPATCH</span>
                        <a href="mailto:<?php echo e($profileEmail); ?>" class="fw-bold text-white text-decoration-none hover-cyan text-truncate d-block font-mono small"><?php echo e($profileEmail); ?></a>
                    </div>
                </div>

                <!-- WhatsApp / Phone Card -->
                <?php if (!empty($profilePhone) && is_array($profilePhone)): ?>
                    <div class="cyber-contact-card p-4 d-flex align-items-center gap-3">
                        <div class="cyber-contact-icon text-success flex-shrink-0">
                            <i class="bi bi-whatsapp fs-4" aria-hidden="true"></i>
                        </div>
                        <div class="overflow-hidden">
                            <span class="d-block text-muted font-mono small">INSTANT_MESSAGING</span>
                            <?php foreach ($profilePhone as $phone): ?>
                                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $phone); ?>" target="_blank" rel="noopener noreferrer" class="fw-bold text-white text-decoration-none hover-cyan d-block font-mono small"><?php echo e($phone); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Location Card -->
                <div class="cyber-contact-card p-4 d-flex align-items-center gap-3">
                    <div class="cyber-contact-icon text-cyan flex-shrink-0">
                        <i class="bi bi-geo-alt-fill fs-4" aria-hidden="true"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="d-block text-muted font-mono small">BASE_COORDINATES</span>
                        <span class="fw-bold text-white d-block font-mono small"><?php echo e($profileLocation); ?></span>
                    </div>
                </div>

                <!-- Social Connect Card -->
                <div class="cyber-contact-card p-4">
                    <span class="d-block text-muted font-mono small mb-3">SOCIAL_NODES</span>
                    <div class="d-flex gap-2 flex-wrap" role="navigation" aria-label="Social media channels">
                        <?php renderSocialLinks($socialsData, 'cyber-social-pill', 'fs-6'); ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="col-lg-7">
            <div class="cyber-form-card p-4 p-md-5 h-100">
                <h3 class="h4 fw-bold text-white mb-1 font-title">Send Transmission</h3>
                <p class="text-secondary small font-body mb-4">Complete the fields below to initiate communication.</p>
                
                <?php if (!empty($contactMsg)): ?>
                    <div class="alert alert-<?php echo e($contactMsgType); ?> alert-dismissible fade show rounded-3 small font-mono mb-4" role="alert">
                        <?php echo e($contactMsg); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" id="contactForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-secondary font-mono small">NAME <span class="text-cyan">*</span></label>
                            <input type="text" name="name" class="form-control cyber-input font-mono" placeholder="Your Name" required autocomplete="name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-secondary font-mono small">EMAIL <span class="text-cyan">*</span></label>
                            <input type="email" name="email" class="form-control cyber-input font-mono" placeholder="your@email.com" required autocomplete="email">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-secondary font-mono small">SUBJECT <span class="text-cyan">*</span></label>
                            <input type="text" name="subject" class="form-control cyber-input font-mono" placeholder="Project Inquiry / Job Collaboration" value="<?php echo isset($_GET['subject']) ? e(trim($_GET['subject'])) : ''; ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-secondary font-mono small">MESSAGE <span class="text-cyan">*</span></label>
                            <textarea name="message" rows="5" class="form-control cyber-input font-mono" placeholder="Describe your project, timeline, or engineering goals..." required></textarea>
                        </div>
                        <div class="col-12 pt-2">
                            <button type="submit" class="cyber-btn cyber-btn-primary w-100 py-3 d-inline-flex align-items-center justify-content-center fw-bold gap-2" aria-label="Send direct message">
                                <i class="bi bi-send-fill" aria-hidden="true"></i>
                                <span>TRANSMIT MESSAGE</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
