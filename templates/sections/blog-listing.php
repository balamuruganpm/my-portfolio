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
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="hud-mono-tag font-mono text-cyan">// DISPATCH_LOGS &amp; INSIGHTS</span>
            </div>
            <h1 class="h2 fw-bold text-white mb-2 font-title">Technical Articles &amp; Developer Notes</h1>
            <p class="text-secondary small font-body" style="max-width: 760px;">
                Explore engineering deep-dives, architectural notes, and tutorials covering JavaScript, React.js, SharePoint SPFx, web performance, and modern developer practices.
            </p>
        </div>
    </div>

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
            <button class="cyber-filter-pill active font-mono" data-filter="all" aria-pressed="true">ALL_LOGS</button>
            <?php foreach ($categories as $cat): ?>
                <button class="cyber-filter-pill font-mono" data-filter="<?php echo e(strtolower($cat)); ?>" aria-pressed="false"><?php echo e(strtoupper($cat)); ?></button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="row g-4" id="blog-cards-grid">
        <?php if (empty($blogs)): ?>
            <div class="col-12">
                <p class="text-secondary font-mono text-center py-5">NO_DISPATCHES_FOUND</p>
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
                $detailUrl = !empty($post['slug']) ? (BASE_URL . 'blogs/' . $post['slug']) : (BASE_URL . 'blogs/detail?id=' . $post['id']);
            ?>
                <div class="col-md-6 col-lg-4 col-12 blog-card-col" data-category="<?php echo e(strtolower($category)); ?>">
                    <article class="cyber-news-card h-100 p-3 d-flex flex-column justify-content-between">
                        <div>
                            <div class="position-relative rounded-3 overflow-hidden mb-3" style="height: 190px;">
                                <img src="<?php echo e(BASE_URL . $img); ?>" 
                                     alt="<?php echo e($post['title']); ?> Cover" 
                                     title="<?php echo e($post['title']); ?>" 
                                     loading="lazy" 
                                     width="380" 
                                     height="220" 
                                     class="w-100 h-100 object-fit-cover transition-transform">
                                <span class="position-absolute top-0 start-0 m-2.5 badge bg-dark bg-opacity-75 text-cyan border border-secondary border-opacity-50 px-2.5 py-1 rounded-pill small font-mono">
                                    <?php echo e($category); ?>
                                </span>
                            </div>
                            
                            <div class="text-secondary small font-mono mb-2">
                                <i class="bi bi-calendar-event me-1 text-cyan"></i><?php echo $dateFormatted; ?>
                            </div>
                            
                            <h3 class="h5 fw-bold text-white font-title mb-2">
                                <a href="<?php echo e($detailUrl); ?>" class="text-white text-decoration-none hover-cyan">
                                    <?php echo e($post['title']); ?>
                                </a>
                            </h3>
                            
                            <?php if (!empty($post['snippet'])): ?>
                                <p class="text-secondary small font-body line-clamp-2 mb-3" style="line-height: 1.6;">
                                    <?php echo htmlspecialchars($post['snippet']); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <div class="pt-3 border-top border-dark-subtle d-flex align-items-center justify-content-between">
                            <div class="d-flex gap-1 flex-wrap">
                                <?php if (!empty($tags)): ?>
                                    <?php foreach (array_slice($tags, 0, 2) as $tag): ?>
                                        <span class="cyber-mini-badge">#<?php echo e($tag); ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo e($detailUrl); ?>" class="fw-bold text-cyan font-mono small text-decoration-none">
                                READ_LOG <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
