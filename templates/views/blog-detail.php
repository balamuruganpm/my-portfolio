<?php
/**
 * View: Blog Article Details & Comments
 */
?>
<div class="container py-4">
<!-- Blog Article Details -->
<article class="py-2" id="blog-article-content">
    <?php if ($adsEnabled): ?>
        <!-- Top Leaderboard Ad (728x90) -->
        <div class="my-3 text-center overflow-auto">
            <script type="text/javascript">
              atOptions = {
                'key' : 'eff49cbb9e486773112180b4e21c171d',
                'format' : 'iframe',
                'height' : 90,
                'width' : 728,
                'params' : {}
              };
            </script>
            <script type="text/javascript" src="https://www.highrevenueformat.com/eff49cbb9e486773112180b4e21c171d/invoke.js"></script>
        </div>
    <?php endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const el = document.getElementById("blog-article-content");
            if (el) {
                el.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }
        });
    </script>
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
        <a href="<?php echo BASE_URL; ?>blogs" class="cyber-btn cyber-btn-glass">
            <i class="bi bi-arrow-left me-1"></i> Back to Articles
        </a>
        <?php if ($adsEnabled): ?>
            <div class="d-flex gap-2">
                <a href="https://www.profitableratecpmnetwork.com/fg8vsabw0?key=85a6a5fcd471608b17da62bbd4c415d5" target="_blank" rel="noopener noreferrer" class="cyber-btn cyber-btn-primary py-1 px-3" style="font-size: 0.8rem;">
                    <i class="bi bi-gift me-1"></i> Special Offer 1
                </a>
                <a href="https://www.profitableratecpmnetwork.com/zhzy181j?key=a985ed396e845a0439a1f428f29b755a" target="_blank" rel="noopener noreferrer" class="cyber-btn cyber-btn-secondary py-1 px-3" style="font-size: 0.8rem;">
                    <i class="bi bi-star-fill text-warning me-1"></i> Special Offer 2
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="row g-4">
        <!-- Main Content Area Column -->
        <div class="col-lg-8 col-12">
            <div class="cyber-card-frame p-4 p-md-5 mb-4 position-relative">
                <header class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
                        <?php if (!empty($post['category'])): ?>
                            <span class="badge badge-cyber-status">
                                <i class="bi bi-tag me-1"></i><?php echo e($post['category']); ?>
                            </span>
                        <?php endif; ?>
                        <span class="text-secondary small font-mono">
                            <i class="bi bi-calendar-event me-1 text-cyan"></i><?php echo date('F d, Y', strtotime($post['date'])); ?>
                        </span>
                        <span class="text-secondary small font-mono ms-2">
                            <i class="bi bi-eye text-cyan me-1"></i><?php echo number_format(isset($post['views']) ? $post['views'] : 0); ?> views
                        </span>
                    </div>
                    <h1 class="h2 fw-bold text-white font-title mb-3" style="letter-spacing: -0.02em; line-height: 1.25;">
                        <?php echo e($post['title']); ?>
                    </h1>
                    <?php if (!empty($post['snippet'])): ?>
                        <p class="lead text-secondary font-body mb-3" style="font-size: 1.05rem; line-height: 1.7; color: #94a3b8 !important;">
                            <?php echo e($post['snippet']); ?>
                        </p>
                    <?php endif; ?>

                    <!-- Social Share Bar & Shortlink Option -->
                    <?php
                    $absolute_share_url = CANONICAL_URL;
                    $encoded_share_url = urlencode($absolute_share_url);
                    $encoded_share_title = urlencode($post['title']);
                    $shortlink = !empty($post['slug']) ? (BASE_URL . 'blogs/' . $post['slug']) : (BASE_URL . 'blogs/detail?id=' . $post['id']);
                    ?>
                    <div class="d-flex flex-wrap gap-2 align-items-center mt-3 pt-3 border-top border-secondary border-opacity-25">
                        <span class="small font-mono text-cyan me-2"><i class="bi bi-share-fill me-1"></i>SHARE:</span>

                        <a href="https://twitter.com/intent/tweet?url=<?php echo $encoded_share_url; ?>&text=<?php echo $encoded_share_title; ?>" target="_blank" rel="noopener noreferrer" class="cyber-btn cyber-btn-glass py-1 px-2.5" style="font-size: 0.78rem;" title="Share on Twitter" aria-label="Share this article on Twitter">
                            <i class="bi bi-twitter"></i> Twitter
                        </a>

                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encoded_share_url; ?>" target="_blank" rel="noopener noreferrer" class="cyber-btn cyber-btn-glass py-1 px-2.5" style="font-size: 0.78rem;" title="Share on Facebook" aria-label="Share this article on Facebook">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>

                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $encoded_share_url; ?>" target="_blank" rel="noopener noreferrer" class="cyber-btn cyber-btn-glass py-1 px-2.5" style="font-size: 0.78rem;" title="Share on LinkedIn" aria-label="Share this article on LinkedIn">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>

                        <button type="button" class="cyber-btn cyber-btn-glass py-1 px-2.5" style="font-size: 0.78rem;" onclick="copyToClipboard('<?php echo $absolute_share_url; ?>', this)" title="Copy absolute page URL">
                            <i class="bi bi-link-45deg"></i> Copy Link
                        </button>

                        <button type="button" class="cyber-btn cyber-btn-primary py-1 px-2.5" style="font-size: 0.78rem;" onclick="copyToClipboard('<?php echo $shortlink; ?>', this)" title="Copy article URL">
                            <i class="bi bi-lightning-fill"></i> Get Link
                        </button>
                    </div>

                    <script>
                        function copyToClipboard(text, buttonElement) {
                            navigator.clipboard.writeText(text).then(function() {
                                const originalText = buttonElement.innerHTML;
                                buttonElement.innerHTML = '<i class="bi bi-check-lg text-success"></i> Copied!';
                                buttonElement.classList.add('border-success');

                                setTimeout(function() {
                                    buttonElement.innerHTML = originalText;
                                    buttonElement.classList.remove('border-success');
                                }, 2000);
                            }, function(err) {
                                console.error('Could not copy text: ', err);
                            });
                        }
                    </script>

                    <?php if (!empty($post['tags'])): ?>
                        <div class="d-flex gap-2 flex-wrap mt-3">
                            <?php foreach ($post['tags'] as $tag): ?>
                                <span class="cyber-mini-badge">#<?php echo e($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <?php if (!empty($post['image'])): ?>
                    <div class="blog-cover-wrapper mb-4 rounded-3 overflow-hidden border border-secondary border-opacity-25" style="background-color: var(--bg-surface); max-height: 480px;">
                        <img src="<?php echo BASE_URL . e($post['image']); ?>"
                            alt="<?php echo e($post['title']); ?> - Cover Image"
                            title="<?php echo e($post['title']); ?> Cover Image"
                            loading="lazy"
                            width="800"
                            height="450"
                            class="w-100 h-auto object-fit-cover"
                            style="display: block;">
                    </div>
                <?php endif; ?>

                <?php if (!empty($post['category']) && strtolower($post['category']) === 'job'): ?>
                    <div class="job-info-card p-4 rounded-3 border border-secondary border-opacity-25 mb-4" style="background: rgba(12, 16, 26, 0.85);">
                        <h3 class="h5 fw-bold text-white mb-3 font-title"><i class="bi bi-briefcase text-cyan me-2"></i>Job Coordinates</h3>
                        <div class="row g-3">
                            <?php if (!empty($post['company'])): ?>
                                <div class="col-md-6 d-flex align-items-center gap-2">
                                    <i class="bi bi-building text-cyan"></i>
                                    <div>
                                        <span class="d-block text-secondary small font-mono" style="font-size: 0.75rem;">Company</span>
                                        <strong class="text-white small"><?php echo e($post['company']); ?></strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($post['job_location'])): ?>
                                <div class="col-md-6 d-flex align-items-center gap-2">
                                    <i class="bi bi-geo-alt text-cyan"></i>
                                    <div>
                                        <span class="d-block text-secondary small font-mono" style="font-size: 0.75rem;">Location</span>
                                        <strong class="text-white small"><?php echo e($post['job_location']); ?></strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($post['salary'])): ?>
                                <div class="col-md-6 d-flex align-items-center gap-2">
                                    <i class="bi bi-cash-stack text-cyan"></i>
                                    <div>
                                        <span class="d-block text-secondary small font-mono" style="font-size: 0.75rem;">Salary</span>
                                        <strong class="text-white small"><?php echo e($post['salary']); ?></strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($post['job_type'])): ?>
                                <div class="col-md-6 d-flex align-items-center gap-2">
                                    <i class="bi bi-clock text-cyan"></i>
                                    <div>
                                        <span class="d-block text-secondary small font-mono" style="font-size: 0.75rem;">Job Type</span>
                                        <strong class="text-white small"><?php echo e($post['job_type']); ?></strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($post['apply_link'])): ?>
                            <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                                <a href="<?php echo e($post['apply_link']); ?>" target="_blank" rel="noopener noreferrer" class="cyber-btn cyber-btn-primary px-4 py-2">
                                    Apply for this Job <i class="bi bi-box-arrow-up-right ms-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Body text content -->
                <div class="blog-body article-content leading-relaxed mb-4">
                    <?php echo $post['content']; ?>
                </div>

                <!-- Video Player Attachment -->
                <?php if (!empty($post['video'])): ?>
                    <div class="blog-video-wrapper mb-4 p-4 border rounded-3 border-secondary border-opacity-25" style="background: rgba(12, 16, 26, 0.6);">
                        <h4 class="h6 fw-bold text-white mb-3 font-title"><i class="bi bi-play-circle text-cyan me-2"></i>Video Presentation</h4>
                        <div class="ratio ratio-16x9 overflow-hidden rounded-3 border border-secondary border-opacity-25">
                            <video width="800" height="450" controls title="<?php echo e($post['title']); ?> Video Reel" aria-label="Blog post companion video clip">
                                <source src="<?php echo BASE_URL . e($post['video']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- PDF Document Downloads -->
                <?php if (!empty($post['pdf'])): ?>
                    <div class="blog-pdf-wrapper p-4 border rounded-3 border-secondary border-opacity-25 d-flex align-items-center justify-content-between gap-3 flex-wrap" style="background: rgba(12, 16, 26, 0.6);">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-file-earmark-pdf fs-2 text-danger"></i>
                            <div>
                                <span class="d-block fw-bold text-white text-sm font-title">Attachment Document</span>
                                <span class="text-secondary small">Read companion documentation for this post</span>
                            </div>
                        </div>
                        <a href="<?php echo BASE_URL . e($post['pdf']); ?>" download class="cyber-btn cyber-btn-secondary px-4 py-2" aria-label="Download companion PDF document">
                            <i class="bi bi-download me-1 text-cyan"></i> Download PDF
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Guest Comments Section -->
                <div class="mt-5 pt-4 border-top border-secondary border-opacity-25" id="comments-wrapper">
                    <h3 class="h4 fw-bold text-white font-title mb-4">
                        <i class="bi bi-chat-left-text me-2 text-cyan"></i>Discussion
                    </h3>

                    <!-- Comment Submission Alert -->
                    <?php if (!empty($commentMessage)): ?>
                        <div id="comment-alert-box" class="alert alert-info alert-dismissible fade show rounded-3 border-0 py-3 px-4 mb-4 small" role="alert" style="background: rgba(0, 242, 254, 0.15); color: #00f2fe; border: 1px solid rgba(0, 242, 254, 0.3);">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <?php echo e($commentMessage); ?>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Comments Form -->
                    <form id="guest-comment-form" method="POST" action="#comments-wrapper" class="cyber-card-frame p-4 p-md-4 rounded-3 mb-4 comment-form-card" style="background: rgba(12, 16, 26, 0.85); border: 1px solid rgba(0, 242, 254, 0.25);">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                        <input type="hidden" name="action" value="add_comment">
                        <h4 class="h6 fw-bold text-white mb-3 font-title d-flex align-items-center gap-2">
                            <i class="bi bi-pencil-square text-cyan"></i>Leave a Guest Comment
                        </h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-cyan font-mono small fw-semibold">Your Name</label>
                                <input type="text" name="author_name" class="form-control cyber-input" placeholder="e.g. John Doe" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-cyan font-mono small fw-semibold">Comment</label>
                                <textarea name="comment_text" rows="4" class="form-control cyber-input" placeholder="Share your thoughts or ask a question..." required style="resize: vertical; min-height: 100px;"></textarea>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="cyber-btn cyber-btn-primary px-4 py-2 fw-bold d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-chat-square-quote"></i> Post Comment
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Comments List -->
                    <div class="comments-list d-flex flex-column gap-3">
                        <?php if (empty($comments)): ?>
                            <div class="text-center py-5 border rounded-3" style="border-style: dashed !important; border-color: rgba(255, 255, 255, 0.1) !important; background: rgba(10, 14, 23, 0.5);">
                                <i class="bi bi-chat-dots text-secondary fs-3 mb-2 d-block"></i>
                                <p class="text-secondary small mb-0 font-mono">No comments yet. Be the first to share your thoughts!</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($comments as $c):
                                $cDate = date('F d, Y \a\t h:i A', is_numeric($c['date']) ? $c['date'] : strtotime($c['date']));
                                $colors = ['#00f2fe', '#8b5cf6', '#3b82f6', '#10b981', '#f59e0b', '#ec4899', '#06b6d4', '#14b8a6'];
                                $idx = ord(strtolower(substr($c['name'], 0, 1))) % count($colors);
                                $avatar_color = $colors[$idx];
                            ?>
                                <div class="comment-item p-3.5 p-md-4 rounded-3 d-flex align-items-start gap-3 border border-secondary border-opacity-25" style="background: rgba(12, 16, 26, 0.75);">
                                    <div class="comment-avatar d-flex align-items-center justify-content-center text-dark fw-bold rounded-circle" style="width: 40px; height: 40px; min-width: 40px; background-color: <?php echo $avatar_color; ?> !important; font-size: 1rem; box-shadow: 0 0 12px rgba(0, 242, 254, 0.3);">
                                        <?php echo strtoupper(substr($c['name'], 0, 1)); ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1 flex-wrap gap-1">
                                            <span class="fw-bold text-white font-title" style="font-size: 0.95rem;"><?php echo e($c['name']); ?></span>
                                            <span class="text-secondary small font-mono d-inline-flex align-items-center gap-1" style="font-size: 0.75rem;"><i class="bi bi-clock text-cyan"></i> <?php echo $cDate; ?></span>
                                        </div>
                                        <p class="text-secondary font-body mb-0 leading-relaxed" style="white-space: pre-wrap; font-size: 0.92rem; color: #cbd5e1 !important;"><?php echo e($c['comment']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <?php if ($adsEnabled): ?>
                        <div class="my-4 text-center">
                            <script async="async" data-cfasync="false" src="https://pl30967632.profitableratecpmnetwork.com/a006ed973d12be80f0e7a963ed44ffb7/invoke.js"></script>
                            <div id="container-a006ed973d12be80f0e7a963ed44ffb7"></div>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>

        <!-- Sidebar Section Column -->
        <div class="col-lg-4 col-12">
            <?php if (!empty($relatedBlogs)): ?>
                <aside class="cyber-card-frame p-4 mb-4 sticky-lg-top" style="top: 90px; z-index: 10;">
                    <h3 class="h5 fw-bold text-white font-title mb-3">
                        <i class="bi bi-journal-text me-2 text-cyan"></i>Related Articles
                    </h3>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($relatedBlogs as $related):
                            $relImg = !empty($related['image']) ? $related['image'] : 'assets/images/placeholder.webp';
                            $relDate = date('M d, Y', strtotime($related['date']));
                            $relUrl = !empty($related['slug']) ? (BASE_URL . 'blogs/' . $related['slug']) : (BASE_URL . 'blogs/detail?id=' . $related['id']);
                        ?>
                            <a href="<?php echo e($relUrl); ?>" class="d-flex align-items-center gap-3 text-decoration-none p-2 rounded-3 transition-all hover-cyber-rel" style="transition: all 0.2s ease;">
                                <div class="overflow-hidden rounded-2 border border-secondary border-opacity-25" style="width: 76px; height: 60px; min-width: 76px;">
                                    <img src="<?php echo BASE_URL . e($relImg); ?>"
                                        alt="<?php echo e($related['title']); ?>"
                                        title="<?php echo e($related['title']); ?>"
                                        loading="lazy"
                                        width="76"
                                        height="60"
                                        class="w-100 h-100 object-fit-cover"
                                        style="transition: transform 0.3s ease;">
                                </div>
                                <div>
                                    <span class="text-secondary small font-mono d-block mb-1" style="font-size: 0.72rem;">
                                        <i class="bi bi-calendar-event me-1 text-cyan"></i><?php echo $relDate; ?>
                                    </span>
                                    <h4 class="fw-bold text-white mb-0 font-title hover-cyan" style="font-size: 0.88rem; line-height: 1.35;">
                                        <?php echo e($related['title']); ?>
                                    </h4>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </aside>
            <?php endif; ?>

            <?php if ($adsEnabled): ?>
                <!-- Sidebar Banner 1: 300x250 -->
                <div class="cyber-card-frame p-3 mb-4 text-center overflow-auto">
                    <span class="badge badge-cyber-status mb-2 d-inline-block">Sponsored Ad</span>
                    <script type="text/javascript">
                        atOptions = {
                            'key': '498c3786a2bea98f8854603be8642237',
                            'format': 'iframe',
                            'height': 250,
                            'width': 300,
                            'params': {}
                        };
                    </script>
                    <script type="text/javascript" src="https://www.highrevenueformat.com/498c3786a2bea98f8854603be8642237/invoke.js"></script>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>
</div>
