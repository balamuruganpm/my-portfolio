<?php
/**
 * Section: Daily Technical News & Developer Insights
 * High-traffic SEO bento section featuring technical articles & RSS feed trigger
 */
$techBlogs = !empty($blogs) ? array_slice($blogs, 0, 4) : [];
?>
<section class="mt-5 mb-5 pt-3" aria-label="Daily Technical News and Insights">
    <!-- Header Row -->
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-success-subtle text-success fw-semibold px-2.5 py-1 rounded-pill small" style="font-size: 0.75rem;">
                    <i class="bi bi-broadcast me-1 pulse-icon"></i>LIVE TECH DIGEST
                </span>
                <span class="text-secondary small">&bull; Updated Daily</span>
            </div>
            <h2 class="h3 fw-bold text-dark font-title mb-0">Daily Technical News &amp; Developer Insights</h2>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="<?php echo BASE_URL; ?>rss.xml" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1.5 small fw-semibold" aria-label="Subscribe to RSS Feed">
                <i class="bi bi-rss-fill text-warning me-1"></i>RSS Feed
            </a>
            <a href="<?php echo BASE_URL; ?>blogs" class="btn btn-sm btn-dark rounded-pill px-3 py-1.5 small fw-semibold" aria-label="View all blogs">
                View All <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    <!-- Tech News Grid -->
    <div class="row g-4">
        <?php foreach ($techBlogs as $index => $blog): 
            $blogUrl = !empty($blog['slug']) ? (BASE_URL . 'blogs/detail?slug=' . $blog['slug']) : (BASE_URL . 'blogs/detail?id=' . $blog['id']);
            $thumb = !empty($blog['image']) ? (BASE_URL . $blog['image']) : (BASE_URL . 'assets/images/balamurugan-pm.webp');
            $category = !empty($blog['category']) ? $blog['category'] : 'Tech News';
            $date = !empty($blog['date']) ? date('M d, Y', strtotime($blog['date'])) : date('M d, Y');
            $title = $blog['title'];
            $snippet = $blog['snippet'];
        ?>
            <div class="col-12 col-md-6">
                <article class="bento-card p-3 p-md-4 h-100 d-flex flex-column justify-content-between text-decoration-none">
                    <div>
                        <div class="position-relative rounded-4 overflow-hidden mb-3" style="height: 180px;">
                            <img src="<?php echo htmlspecialchars($thumb); ?>" 
                                 alt="<?php echo htmlspecialchars($title); ?> Article Cover" 
                                 title="<?php echo htmlspecialchars($title); ?> Article Cover" 
                                 width="400" 
                                 height="225" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-100 h-100 object-fit-cover transition-transform">
                            <span class="position-absolute top-0 start-0 m-3 badge bg-dark bg-opacity-75 text-white px-2.5 py-1 rounded-pill small fw-semibold shadow-sm" style="z-index: 2; backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);">
                                <?php echo htmlspecialchars($category); ?>
                            </span>
                        </div>
                        <div class="text-secondary small mb-1">
                            <i class="bi bi-calendar-event me-1"></i><?php echo $date; ?>
                        </div>
                        <h3 class="h5 fw-bold text-dark font-title mb-2">
                            <a href="<?php echo htmlspecialchars($blogUrl); ?>" class="text-dark text-decoration-none hover-accent">
                                <?php echo htmlspecialchars($title); ?>
                            </a>
                        </h3>
                        <p class="text-secondary small mb-3 line-clamp-2" style="font-size: 0.88rem; line-height: 1.5;">
                            <?php echo htmlspecialchars($snippet); ?>
                        </p>
                    </div>
                    <div class="pt-2 border-top border-secondary-subtle d-flex align-items-center justify-content-between">
                        <div class="d-flex gap-1 flex-wrap">
                            <?php if (!empty($blog['tags'])): ?>
                                <?php foreach (array_slice($blog['tags'], 0, 2) as $tag): ?>
                                    <span class="badge bg-secondary-subtle text-secondary small px-2 py-0.5" style="font-size: 0.7rem;">#<?php echo htmlspecialchars($tag); ?></span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo htmlspecialchars($blogUrl); ?>" class="fw-bold text-accent small text-decoration-none" aria-label="Read full technical article">
                            Read Article <i class="bi bi-arrow-right ms-0.5"></i>
                        </a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</section>
