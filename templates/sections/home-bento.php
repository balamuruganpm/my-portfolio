<?php
/**
 * Section: Dynamic Home Bento Grid Dashboard
 * Renders live project showcase, latest article preview, interactive skill pills, and clean contact actions.
 */

// Get latest featured project
$featured_project = !empty($projectsList) ? $projectsList[0] : null;

// Get latest published blog article
$latest_blog = !empty($blogs) ? end($blogs) : null;
?>
<!-- Bento Grid Home Section -->
<section id="bento-home-section" class="py-2" aria-label="Bento Navigation Dashboard" data-mascot-speech="<?php echo e($bentoMascotSpeech); ?>">
    <div class="row g-4">
        
        <!-- Bento Cell 1: About Me & Core Tech Stack (Large) -->
        <div class="col-lg-8" role="region" aria-label="About and Core Skills Bento Card">
            <div class="card bento-card bento-card-about p-4 p-md-5 h-100">
                <div class="d-flex flex-column h-100">
                    <span class="badge badge-accent-light mb-3 align-self-start">ABOUT & TECH STACKS</span>
                    <h2 class="h3 fw-bold text-dark mb-3 font-title">Building Modern Web Interfaces</h2>
                    <p class="text-secondary leading-relaxed mb-4">
                        Specialized in developing responsive, accessible, and user-centric web applications. Focused on component architecture, performance optimization, and scalable web solutions.
                    </p>

                    <!-- Interactive Tech Stack Pills -->
                    <div class="mb-4">
                        <span class="d-block text-secondary small fw-semibold mb-2">Core Competencies:</span>
                        <div class="d-flex flex-wrap gap-2">
                            <?php 
                            $featured_skills = ['React.js', 'JavaScript', 'HTML5', 'CSS3', 'SPFx', 'SharePoint Online', 'PHP', 'Bootstrap', 'Figma'];
                            foreach ($featured_skills as $skill_name): 
                            ?>
                                <span class="badge bg-white text-dark border px-3 py-2 rounded-pill small fw-semibold d-inline-flex align-items-center gap-1.5 shadow-sm" style="font-size: 0.82rem; border-color: var(--border-color) !important;">
                                    <i class="<?php echo getTechIconClass($skill_name); ?> text-accent"></i> <?php echo e($skill_name); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="mt-auto pt-2 d-flex gap-3 flex-wrap">
                        <a href="<?php echo BASE_URL; ?>about" class="button button-sm" aria-label="View my career timeline and credentials">
                            <span class="button_sm">
                                <span class="button_sl"></span>
                                <span class="button_text">EXPLORE EXPERIENCE <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i></span>
                            </span>
                        </a>
                        <a href="<?php echo BASE_URL; ?>assets/Balamurugan-P-M-Resume.pdf" target="_blank" class="button button-sm button-outline" aria-label="Download Balamurugan P M Resume PDF">
                            <span class="button_sm">
                                <span class="button_sl"></span>
                                <span class="button_text">DOWNLOAD RESUME <i class="bi bi-download ms-1" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bento Cell 2: Featured Work (Medium) -->
        <div class="col-lg-4" role="region" aria-label="Featured Portfolio Bento Card">
            <div class="card bento-card bento-card-portfolio p-4 h-100">
                <div class="d-flex flex-column h-100">
                    <span class="badge badge-accent-light mb-3 align-self-start">PORTFOLIO</span>
                    <h2 class="h4 fw-bold text-dark mb-3 font-title">Featured Work</h2>
                    
                    <?php if ($featured_project): 
                        $proj_img = !empty($featured_project['image']) ? BASE_URL . $featured_project['image'] : BASE_URL . 'assets/images/placeholder.webp';
                    ?>
                        <div class="rounded-4 overflow-hidden mb-3 border position-relative" style="height: 130px; border-color: var(--border-color) !important;">
                            <img src="<?php echo e($proj_img); ?>" alt="<?php echo e($featured_project['title']); ?> Featured Project Thumbnail" title="<?php echo e($featured_project['title']); ?> Featured Project Thumbnail" class="w-100 h-100 object-fit-cover">
                        </div>
                        <h3 class="h6 fw-bold text-dark mb-1 font-title"><?php echo e($featured_project['title']); ?></h3>
                        <p class="text-secondary small mb-3 text-truncate"><?php echo e($featured_project['tagline'] ?? ''); ?></p>
                        
                        <div class="d-flex flex-wrap gap-1 mb-3">
                            <?php foreach (array_slice($featured_project['tags'] ?? [], 0, 3) as $tag): ?>
                                <span class="badge bg-white text-secondary border small px-2 py-1" style="font-size: 0.72rem; border-color: var(--border-color) !important;"><?php echo e($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-secondary small mb-4">
                            Explore selected frontend development and web application projects demonstrating modern responsive design.
                        </p>
                        <div class="bento-media-teaser mb-4 d-flex align-items-center justify-content-center rounded-4 p-3 flex-grow-1">
                            <i class="bi bi-folder2-open fs-1 text-secondary opacity-50" aria-hidden="true"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mt-auto pt-2">
                        <a href="<?php echo BASE_URL; ?>portfolio" class="button button-sm button-outline w-100 text-center" aria-label="Browse full portfolio gallery">
                            <span class="button_sm">
                                <span class="button_sl"></span>
                                <span class="button_text">ALL PROJECTS <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bento Cell 3: Blogs & Articles (Medium) -->
        <div class="col-lg-4" role="region" aria-label="Blogs and Articles Bento Card">
            <div class="card bento-card bento-card-blogs p-4 h-100">
                <div class="d-flex flex-column h-100">
                    <span class="badge badge-accent-light mb-3 align-self-start">LATEST ARTICLE</span>
                    <h2 class="h4 fw-bold text-dark mb-3 font-title">Tech Notes & Insights</h2>
                    
                    <?php if ($latest_blog): 
                        $blog_url = !empty($latest_blog['slug']) ? (BASE_URL . 'blogs/detail?slug=' . urlencode($latest_blog['slug'])) : (BASE_URL . 'blogs/detail?id=' . $latest_blog['id']);
                    ?>
                        <div class="p-3 rounded-4 border mb-3 flex-grow-1" style="background: var(--bg-page); border-color: var(--border-color) !important;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-warning text-dark small fw-semibold" style="font-size: 0.72rem;"><?php echo e($latest_blog['category'] ?? 'Article'); ?></span>
                                <span class="text-secondary small" style="font-size: 0.75rem;"><?php echo date('M d, Y', strtotime($latest_blog['date'])); ?></span>
                            </div>
                            <h3 class="h6 fw-bold text-dark mb-1 font-title leading-snug"><?php echo e($latest_blog['title']); ?></h3>
                            <p class="text-secondary small mb-0" style="font-size: 0.8rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?php echo e($latest_blog['snippet'] ?? ''); ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-secondary small mb-4">
                            Articles, tutorials, development notes, and practical insights covering frontend architecture and web technologies.
                        </p>
                        <div class="bento-media-teaser mb-4 d-flex align-items-center justify-content-center rounded-4 p-3 flex-grow-1">
                            <i class="bi bi-journal-text fs-1 text-secondary opacity-50" aria-hidden="true"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mt-auto pt-2">
                        <a href="<?php echo BASE_URL; ?>blogs" class="button button-sm button-outline w-100 text-center" aria-label="Read developer articles and guides">
                            <span class="button_sm">
                                <span class="button_sl"></span>
                                <span class="button_text">EXPLORE ARTICLES <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bento Cell 4: Let's Connect (Large) -->
        <div class="col-lg-8" role="region" aria-label="Contact and Social Bento Card">
            <div class="card bento-card bento-card-contact p-4 p-md-5 h-100">
                <div class="d-flex flex-column h-100">
                    <span class="badge badge-accent-light mb-3 align-self-start">GET IN TOUCH</span>
                    <h2 class="h3 fw-bold text-dark mb-2 font-title">Let's Build Something Great</h2>
                    <p class="text-secondary leading-relaxed mb-4">
                        Available for frontend development roles, client engagements, and engineering collaborations. Feel free to reach out directly.
                    </p>
                    
                    <!-- Clean Contact Channels Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <a href="mailto:<?php echo e($profileEmail); ?>" class="contact-quick-card d-flex align-items-center gap-3 p-3 rounded-4 text-decoration-none h-100" aria-label="Send email to <?php echo e($profileEmail); ?>">
                                <div class="contact-quick-icon contact-icon-email d-flex align-items-center justify-content-center rounded-3 shadow-sm flex-shrink-0">
                                    <i class="bi bi-envelope-fill fs-5" aria-hidden="true"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <span class="d-block text-secondary small fw-medium" style="font-size: 0.74rem; text-transform: uppercase; letter-spacing: 0.5px;">Email Address</span>
                                    <span class="d-block text-dark fw-bold text-truncate font-body" style="font-size: 0.88rem;"><?php echo e($profileEmail); ?></span>
                                </div>
                            </a>
                        </div>
                        <?php if (!empty($profilePhone[0])): ?>
                        <div class="col-md-6">
                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $profilePhone[0]); ?>" target="_blank" rel="noopener noreferrer" class="contact-quick-card d-flex align-items-center gap-3 p-3 rounded-4 text-decoration-none h-100" aria-label="Chat on WhatsApp with <?php echo e($profilePhone[0]); ?>">
                                <div class="contact-quick-icon contact-icon-whatsapp d-flex align-items-center justify-content-center rounded-3 shadow-sm flex-shrink-0">
                                    <i class="bi bi-whatsapp fs-5" aria-hidden="true"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <span class="d-block text-secondary small fw-medium" style="font-size: 0.74rem; text-transform: uppercase; letter-spacing: 0.5px;">WhatsApp Chat</span>
                                    <span class="d-block text-dark fw-bold font-body" style="font-size: 0.88rem;"><?php echo e($profilePhone[0]); ?></span>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mt-auto pt-2 d-flex flex-wrap gap-3">
                        <a href="<?php echo BASE_URL; ?>contact" class="button button-sm" aria-label="Go to contact page to send me an email">
                            <span class="button_sm">
                                <span class="button_sl"></span>
                                <span class="button_text">SEND INQUIRY <i class="bi bi-send-fill ms-1" aria-hidden="true"></i></span>
                            </span>
                        </a>
                        <a href="<?php echo BASE_URL; ?>contact?subject=project_collaboration" class="button button-sm button-outline" aria-label="Hire me for a project">
                            <span class="button_sm">
                                <span class="button_sl"></span>
                                <span class="button_text">HIRE ME <i class="bi bi-briefcase-fill ms-1" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
