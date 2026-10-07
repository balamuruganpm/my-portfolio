<?php
/**
 * Section: Contact Form and Information Cards (Pure View)
 * Note: POST submission logic is handled in includes/contact-handler.php
 */
?>
<!-- Contact Section -->
<section id="contact-section" class="py-2" aria-label="<?php echo e($contactLabel); ?>" data-mascot-speech="<?php echo e($contactSpeech); ?>">
    <div class="row mb-4">
        <div class="col-12">
            <span class="badge badge-accent-light mb-2">GET IN TOUCH</span>
            <h2 class="h3 fw-bold text-dark mb-1 font-title">Let's Connect & Collaborate</h2>
            <p class="text-secondary small leading-relaxed" style="max-width: 720px;">
                I am currently open to Frontend Developer opportunities, client projects, and engineering collaborations. Have a question or project in mind? Reach out anytime.
            </p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left: Contact Info Cards -->
        <div class="col-lg-5">
            <div class="d-flex flex-column gap-3">

                <!-- Email Card -->
                <div class="contact-info-card rounded-4 p-3.5 p-md-4 d-flex align-items-center gap-3">
                    <div class="contact-icon-circle bg-accent text-white shadow-sm flex-shrink-0">
                        <i class="bi bi-envelope-fill fs-5" aria-hidden="true"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="d-block text-secondary small fw-medium" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Email Address</span>
                        <a href="mailto:<?php echo e($profileEmail); ?>" class="contact-info-link fw-bold text-dark text-truncate d-block" style="font-size: 0.92rem;"><?php echo e($profileEmail); ?></a>
                    </div>
                </div>

                <!-- WhatsApp / Phone Card -->
                <?php if (!empty($profilePhone) && is_array($profilePhone)): ?>
                    <div class="contact-info-card rounded-4 p-3.5 p-md-4 d-flex align-items-center gap-3">
                        <div class="contact-icon-circle text-white shadow-sm flex-shrink-0" style="background: #25d366;">
                            <i class="bi bi-whatsapp fs-5" aria-hidden="true"></i>
                        </div>
                        <div class="overflow-hidden">
                            <span class="d-block text-secondary small fw-medium" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">WhatsApp & Phone</span>
                            <?php foreach ($profilePhone as $phone): ?>
                                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $phone); ?>" target="_blank" rel="noopener noreferrer" class="contact-info-link fw-bold text-dark d-block" style="font-size: 0.92rem;"><?php echo e($phone); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Location Card -->
                <div class="contact-info-card rounded-4 p-3.5 p-md-4 d-flex align-items-center gap-3">
                    <div class="contact-icon-circle bg-secondary text-white shadow-sm flex-shrink-0">
                        <i class="bi bi-geo-alt-fill fs-5" aria-hidden="true"></i>
                    </div>
                    <div class="overflow-hidden">
                        <span class="d-block text-secondary small fw-medium" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Location</span>
                        <span class="fw-bold text-dark d-block" style="font-size: 0.92rem;"><?php echo e($profileLocation); ?></span>
                    </div>
                </div>

                <!-- Social Connect Card -->
                <div class="contact-info-card rounded-4 p-3.5 p-md-4">
                    <span class="d-block text-secondary small fw-medium mb-3" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Social Profiles</span>
                    <div class="d-flex gap-2 flex-wrap" role="navigation" aria-label="Social media channels">
                        <?php renderSocialLinks($socialsData, 'contact-social-btn', 'fs-6'); ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="col-lg-7">
            <div class="contact-form-card rounded-4 p-4 p-md-5 h-100">
                <h3 class="h5 fw-bold text-dark mb-1 font-title">Send a Direct Message</h3>
                <p class="text-secondary small mb-4">Fill out the brief form below and I'll respond promptly.</p>
                
                <?php if (!empty($contactMsg)): ?>
                    <div class="alert alert-<?php echo e($contactMsgType); ?> alert-dismissible fade show rounded-3 small" role="alert">
                        <?php echo e($contactMsg); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" id="contactForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-dark small fw-semibold">Your Name <span class="text-accent">*</span></label>
                            <input type="text" name="name" class="form-control contact-input" placeholder="e.g. Alex Smith" required autocomplete="name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-dark small fw-semibold">Your Email <span class="text-accent">*</span></label>
                            <input type="email" name="email" class="form-control contact-input" placeholder="e.g. alex@example.com" required autocomplete="email">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-dark small fw-semibold">Subject <span class="text-accent">*</span></label>
                            <input type="text" name="subject" class="form-control contact-input" placeholder="Project Inquiry / Job Opportunity" value="<?php echo isset($_GET['subject']) ? e(trim($_GET['subject'])) : ''; ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-dark small fw-semibold">Message <span class="text-accent">*</span></label>
                            <textarea name="message" rows="5" class="form-control contact-input" placeholder="Describe your project, timeline, or requirements..." required></textarea>
                        </div>
                        <div class="col-12 pt-2">
                            <button type="submit" class="button w-100" aria-label="Send direct message">
                                <span class="button_lg w-100 justify-content-center py-3">
                                    <span class="button_sl"></span>
                                    <span class="button_text fs-6 fw-bold"><i class="bi bi-send-fill me-2"></i>SEND MESSAGE</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
