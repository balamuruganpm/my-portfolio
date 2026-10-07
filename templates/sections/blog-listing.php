<?php
/**
 * Section: Blog Articles Listing with Category Filters
 */
$blogs = loadBlogs();
if (!empty($blogs)) {
    $blogs = array_reverse($blogs);
    // Filter out 'Job' category blogs from public listing
    $blogs = array_filter($blogs, function($b) {
        return !isset($b['category']) || strtolower(trim($b['category'])) !== 'job';
    });
}
?>
<!-- Blogs Section -->
<section id="blogs-section" class="py-4" aria-label="<?php echo e($blogsLabel); ?>" data-mascot-speech="<?php echo e($blogsSpeech); ?>">
    <?php if ($adsEnabled): ?>
        <!-- Background Scripts -->
        <script src="https://pl31286313.profitableratecpmnetwork.com/e2/a9/87/e2a98719b38240fb664d2d652dee4b37.js"></script>
        <script src="https://pl31286316.profitableratecpmnetwork.com/42/a7/fe/42a7fe54f131cdff87ac27996fb1a2dc.js"></script>

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

    <div class="row mb-4">
        <div class="col-12">
            <h2 class="h3 fw-bold text-dark mb-1 font-title">Frontend Development Insights</h2>
            <p class="text-secondary small">Explore articles, tutorials, development notes, and practical experiences covering JavaScript, React.js, frontend development, web technologies, responsive design, and software development.</p>
        </div>
    </div>

    <?php if ($adsEnabled): ?>
        <!-- Sponsored Featured Links Bar -->
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="https://www.profitableratecpmnetwork.com/fg8vsabw0?key=85a6a5fcd471608b17da62bbd4c415d5" target="_blank" rel="noopener noreferrer" class="btn btn-warning-custom btn-sm rounded-pill px-3 py-1.5 text-white fw-semibold" style="background-color: var(--accent) !important;">
                <i class="bi bi-fire me-1"></i> Special Trending Offer 1
            </a>
            <a href="https://www.profitableratecpmnetwork.com/zhzy181j?key=a985ed396e845a0439a1f428f29b755a" target="_blank" rel="noopener noreferrer" class="btn btn-outline-dark btn-sm rounded-pill px-3 py-1.5 fw-semibold">
                <i class="bi bi-lightning-charge-fill text-warning me-1"></i> Special Bonus Link 2
            </a>
        </div>
    <?php endif; ?>

    <?php if (!empty($blogs)): 
        // Collect unique categories
        $categories = [];
        foreach ($blogs as $b) {
            if (!empty($b['category']) && !in_array($b['category'], $categories)) {
                $categories[] = $b['category'];
            }
        }
    ?>
        <!-- Category Filter Tabs -->
        <div class="d-flex gap-2 flex-wrap mb-4" id="blog-category-filters" role="tablist" aria-label="Filter by category">
            <button class="blog-filter-btn active" data-filter="all" aria-pressed="true">All</button>
            <?php foreach ($categories as $cat): ?>
                <button class="blog-filter-btn" data-filter="<?php echo e(strtolower($cat)); ?>" aria-pressed="false"><?php echo e($cat); ?></button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="row g-4 mx-0" id="blog-cards-grid">
        <?php if (empty($blogs)): ?>
            <div class="col-12">
                <p class="text-muted text-center py-4">No articles published yet.</p>
            </div>
        <?php else: ?>
            <?php 
            $cardIndex = 0;
            foreach ($blogs as $post): 
                $cardIndex++;
                $img = !empty($post['image']) ? $post['image'] : 'assets/images/placeholder.webp';
                $dateFormatted = date('M d, Y', strtotime($post['date']));
                $category = !empty($post['category']) ? $post['category'] : 'Blog';
                $tags = !empty($post['tags']) ? $post['tags'] : [];
                $detailUrl = !empty($post['slug']) ? (BASE_URL . 'blogs/detail?slug=' . $post['slug']) : (BASE_URL . 'blogs/detail?id=' . $post['id']);
            ?>
                <div class="col-md-6 col-lg-4 col-12 blog-card-col" data-category="<?php echo e(strtolower($category)); ?>">
                    <a href="<?php echo e($detailUrl); ?>" 
                       class="blog-bento-card d-block rounded-4 overflow-hidden position-relative border text-decoration-none" 
                       aria-label="Read article <?php echo e($post['title']); ?>">
                        
                        <!-- Background Image -->
                        <img src="<?php echo e(BASE_URL . $img); ?>" 
                             alt="<?php echo e($post['title']); ?> Article Cover" 
                             title="<?php echo e($post['title']); ?> Article Cover" 
                             loading="lazy" 
                             width="380" 
                             height="260" 
                             class="blog-card-bg-img">

                        <!-- Always Visible Dark Gradient Overlay -->
                        <div class="blog-card-gradient"></div>

                        <!-- Text Content (Always Visible) -->
                        <div class="blog-card-content">
                            <!-- Category Badge -->
                            <span class="blog-category-badge"><?php echo e($category); ?></span>

                            <!-- Bottom Text -->
                            <div class="blog-card-bottom">
                                <span class="blog-card-date"><?php echo $dateFormatted; ?></span>
                                <h3 class="blog-card-title font-title"><?php echo e($post['title']); ?></h3>
                                <?php if (!empty($tags)): ?>
                                    <div class="d-flex gap-1 flex-wrap mt-2">
                                        <?php foreach (array_slice($tags, 0, 3) as $tag): ?>
                                            <span class="blog-tag-badge"><?php echo e($tag); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>

                <?php if ($adsEnabled && $cardIndex === 3): ?>
                    <!-- Inline Banner Ad Card (300x250) -->
                    <div class="col-md-6 col-lg-4 col-12 d-flex align-items-center justify-content-center">
                        <div class="card p-3 border rounded-4 text-center w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: var(--bg-card);">
                            <span class="badge bg-secondary-subtle text-secondary mb-2 small">Advertisement</span>
                            <script type="text/javascript">
                              atOptions = {
                                'key' : '498c3786a2bea98f8854603be8642237',
                                'format' : 'iframe',
                                'height' : 250,
                                'width' : 300,
                                'params' : {}
                              };
                            </script>
                            <script type="text/javascript" src="https://www.highrevenueformat.com/498c3786a2bea98f8854603be8642237/invoke.js"></script>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($adsEnabled && $cardIndex === 6): ?>
                    <!-- Inline Banner Ad Card (160x300) -->
                    <div class="col-md-6 col-lg-4 col-12 d-flex align-items-center justify-content-center">
                        <div class="card p-3 border rounded-4 text-center w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: var(--bg-card);">
                            <span class="badge bg-secondary-subtle text-secondary mb-2 small">Sponsored</span>
                            <script type="text/javascript">
                              atOptions = {
                                'key' : 'd24d3fbbafec999f2684aa0f086b83ae',
                                'format' : 'iframe',
                                'height' : 300,
                                'width' : 160,
                                'params' : {}
                              };
                            </script>
                            <script type="text/javascript" src="https://www.highrevenueformat.com/d24d3fbbafec999f2684aa0f086b83ae/invoke.js"></script>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if ($adsEnabled): ?>
        <!-- Bottom Container & Banner Ad Section -->
        <div class="my-5 p-4 card border-0 rounded-4 text-center" style="background-color: var(--bg-card);">
            <h4 class="h6 text-secondary font-title mb-3">Sponsored Content</h4>
            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
                <!-- Container Ad -->
                <div>
                    <script async="async" data-cfasync="false" src="https://pl30967632.profitableratecpmnetwork.com/a006ed973d12be80f0e7a963ed44ffb7/invoke.js"></script>
                    <div id="container-a006ed973d12be80f0e7a963ed44ffb7"></div>
                </div>

                <!-- 468x60 Banner -->
                <div>
                    <script type="text/javascript">
                      atOptions = {
                        'key' : '15e936c9cbaac50c805ea0afef86fb6e',
                        'format' : 'iframe',
                        'height' : 60,
                        'width' : 468,
                        'params' : {}
                      };
                    </script>
                    <script type="text/javascript" src="https://www.highrevenueformat.com/15e936c9cbaac50c805ea0afef86fb6e/invoke.js"></script>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
