<?php
/**
 * Section: Daily Technical News & Developer Insights
 * High-traffic SEO section featuring technical articles & RSS feed trigger
 */
$allBlogs = !empty($blogs) ? $blogs : (!empty($publishedBlogs) ? $publishedBlogs : []);
$techBlogs = array_slice($allBlogs, 0, 4);
?>
<section class="cyber-tech-news-section py-5" aria-label="Daily Technical News and Insights">
    <div class="container">
        <!-- Header Row -->
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="badge badge-cyber-status">
                        <i class="bi bi-broadcast me-1 pulse-icon"></i>LIVE TECH DIGEST
                    </span>
                    <span class="text-secondary small font-mono">&bull; Updated Daily</span>
                </div>
                <h2 class="h3 fw-bold text-white font-title mb-0">Daily Technical News &amp; Developer Insights</h2>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="<?php echo BASE_URL; ?>rss.xml" target="_blank" class="cyber-btn cyber-btn-glass" aria-label="Subscribe to RSS Feed">
                    <i class="bi bi-rss-fill text-warning me-1.5"></i><span>RSS Feed</span>
                </a>
                <a href="<?php echo BASE_URL; ?>blogs" class="cyber-btn cyber-btn-primary" aria-label="View all blogs">
                    <span>View All</span> <i class="bi bi-arrow-right ms-1"></i>
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
                    <article class="cyber-news-card h-100 p-3 p-md-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="position-relative rounded-3 overflow-hidden mb-3" style="height: 200px;">
                                <img src="<?php echo htmlspecialchars($thumb); ?>" 
                                     alt="<?php echo htmlspecialchars($title); ?> Article Cover" 
                                     title="<?php echo htmlspecialchars($title); ?> Article Cover" 
                                     width="400" 
                                     height="225" 
                                     loading="lazy" 
                                     decoding="async" 
                                     class="w-100 h-100 object-fit-cover transition-transform">
                                <span class="position-absolute top-0 start-0 m-3 badge bg-dark bg-opacity-75 text-cyan border border-secondary border-opacity-50 px-2.5 py-1 rounded-pill small fw-semibold font-mono" style="z-index: 2; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);">
                                    <?php echo htmlspecialchars($category); ?>
                                </span>
                            </div>
                            <div class="text-secondary small font-mono mb-2">
                                <i class="bi bi-calendar-event me-1 text-cyan"></i><?php echo $date; ?>
                            </div>
                            <h3 class="h5 fw-bold text-white font-title mb-2">
                                <a href="<?php echo htmlspecialchars($blogUrl); ?>" class="text-white text-decoration-none hover-cyan">
                                    <?php echo htmlspecialchars($title); ?>
                                </a>
                            </h3>
                            <p class="text-secondary small mb-3 line-clamp-2" style="font-size: 0.88rem; line-height: 1.6;">
                                <?php echo htmlspecialchars($snippet); ?>
                            </p>
                        </div>
                        <div class="pt-3 border-top border-dark-subtle d-flex align-items-center justify-content-between">
                            <div class="d-flex gap-2 flex-wrap">
                                <?php if (!empty($blog['tags'])): ?>
                                    <?php foreach (array_slice($blog['tags'], 0, 2) as $tag): ?>
                                        <span class="cyber-mini-badge">#<?php echo htmlspecialchars($tag); ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo htmlspecialchars($blogUrl); ?>" class="fw-bold text-cyan font-mono small text-decoration-none" aria-label="Read full technical article">
                                Read Article <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
