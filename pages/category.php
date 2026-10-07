<?php
/**
 * Programmatic SEO (pSEO) Category Landing Page Controller
 * Dynamically targets high-intent search queries, renders rich JSON-LD collection schemas,
 * and builds automated topic landing hubs.
 */
if (!defined('PAGE_DEPTH')) {
    define('PAGE_DEPTH', 1);
}

require_once __DIR__ . '/../config/bootstrap.php';

// Load pSEO topics dataset
$pseo_file = ADMIN_DATA_PATH . 'pseo_topics.json';
$pseo_topics = [];
if (file_exists($pseo_file)) {
    $pseo_topics = json_decode(file_get_contents($pseo_file), true) ?? [];
}

// Load blog posts
$blogs = loadBlogs();

// Determine requested category target
$raw_cat = isset($_GET['name']) ? trim($_GET['name']) : (isset($_GET['cat']) ? trim($_GET['cat']) : '');
$cat_slug = strtolower(str_replace([' ', '_', '.'], ['-', '-', ''], $raw_cat));

// Match topic in pSEO dataset or fallback dynamically
$current_topic = null;
foreach ($pseo_topics as $topic) {
    if ($topic['slug'] === $cat_slug || strtolower($topic['category']) === strtolower($raw_cat)) {
        $current_topic = $topic;
        break;
    }
}

// Fallback topic metadata if not in dataset
if (!$current_topic) {
    $display_name = !empty($raw_cat) ? ucwords(str_replace('-', ' ', $raw_cat)) : 'Web Development';
    $current_topic = [
        'slug' => $cat_slug,
        'name' => $display_name . " Developer Insights",
        'category' => $display_name,
        'headline' => $display_name . " Technical Guides & Engineering Insights",
        'description' => "Explore articles, tutorials, architectural patterns, and performance optimizations focused on " . $display_name . ".",
        'keywords' => [$display_name, "Web Development", "Frontend Architecture", "Software Engineering"],
        'icon' => 'bi-folder2-open',
        'faqs' => []
    ];
}

// Filter matching blogs
$filtered_blogs = [];
foreach ($blogs as $b) {
    $b_cat = isset($b['category']) ? strtolower(trim($b['category'])) : '';
    $b_slug = strtolower(str_replace([' ', '_', '.'], ['-', '-', ''], $b_cat));
    if ($b_slug === $cat_slug || $b_cat === strtolower($current_topic['category']) || strpos($b_slug, $cat_slug) !== false || strpos($cat_slug, $b_slug) !== false) {
        $filtered_blogs[] = $b;
    }
}

// SEO Meta Variables
$pageTitle = e($current_topic['headline']) . " | " . e($profileName);
$pageMetaDescription = e($current_topic['description']);
$pageMetaKeywords = implode(', ', $current_topic['keywords']);
$thisPage = "Blogs";

include BASE_PATH . 'templates/layout/head.php';
include BASE_PATH . 'templates/layout/body-start.php';
include BASE_PATH . 'templates/partials/navigation.php';
?>

<!-- pSEO Category Landing Page Hero -->
<section class="py-4" id="pseo-category-hero">
    <div class="card bento-card p-4 p-md-5 mb-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-1.5 rounded-pill small fw-semibold border border-warning-subtle">
                <i class="bi <?php echo e($current_topic['icon']); ?> me-1"></i>TOPIC HUB
            </span>
            <span class="text-secondary small">&bull; <?php echo count($filtered_blogs); ?> Articles Published</span>
        </div>
        <h1 class="h2 fw-bold text-dark font-title mb-3"><?php echo e($current_topic['headline']); ?></h1>
        <p class="lead text-secondary font-body leading-relaxed mb-4" style="max-width: 850px; font-size: 1.05rem;">
            <?php echo e($current_topic['description']); ?>
        </p>

        <!-- Topic Target Keyword Tags -->
        <div class="d-flex flex-wrap gap-2">
            <span class="small fw-semibold text-secondary me-1 align-self-center"><i class="bi bi-tags-fill me-1 text-accent"></i>Target Keywords:</span>
            <?php foreach ($current_topic['keywords'] as $kw): ?>
                <span class="badge bg-white text-dark border px-2.5 py-1 rounded-pill small fw-normal shadow-2xs"><?php echo e($kw); ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Filtered Category Articles Grid -->
<section class="pb-4" id="pseo-articles-grid" aria-label="<?php echo e($current_topic['name']); ?> Articles">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="h4 fw-bold text-dark font-title mb-0">Articles in <?php echo e($current_topic['category']); ?></h2>
        <a href="<?php echo BASE_URL; ?>blogs" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold">
            <i class="bi bi-grid-fill me-1"></i> All Categories
        </a>
    </div>

    <div class="row g-4">
        <?php if (empty($filtered_blogs)): ?>
            <div class="col-12 text-center py-5 bg-light rounded-4 border">
                <i class="bi bi-journal-x fs-1 text-muted d-block mb-2"></i>
                <p class="text-secondary small mb-0">No specific articles filed under "<?php echo e($current_topic['category']); ?>" yet.</p>
                <a href="<?php echo BASE_URL; ?>blogs" class="btn btn-warning-custom btn-sm mt-3 px-4">Browse All Tech Insights</a>
            </div>
        <?php else: ?>
            <?php foreach ($filtered_blogs as $post): 
                $img = !empty($post['image']) ? (BASE_URL . $post['image']) : (BASE_URL . 'assets/images/placeholder.webp');
                $detailUrl = !empty($post['slug']) ? (BASE_URL . 'blogs/detail?slug=' . $post['slug']) : (BASE_URL . 'blogs/detail?id=' . $post['id']);
                $date = date('M d, Y', strtotime($post['date']));
            ?>
                <div class="col-md-6 col-lg-4 col-12">
                    <article class="bento-card p-3 p-md-4 h-100 d-flex flex-column justify-content-between text-decoration-none">
                        <div>
                            <div class="position-relative rounded-4 overflow-hidden mb-3" style="height: 180px;">
                                <img src="<?php echo htmlspecialchars($img); ?>" 
                                     alt="<?php echo htmlspecialchars($post['title']); ?> Article Cover" 
                                     title="<?php echo htmlspecialchars($post['title']); ?> Article Cover" 
                                     width="400" 
                                     height="225" 
                                     loading="lazy" 
                                     decoding="async" 
                                     class="w-100 h-100 object-fit-cover transition-transform">
                                <span class="position-absolute top-0 start-0 m-3 badge bg-dark text-white px-2.5 py-1 rounded-pill small fw-semibold">
                                    <?php echo htmlspecialchars($post['category'] ?? 'Tech'); ?>
                                </span>
                            </div>
                            <div class="text-secondary small mb-1">
                                <i class="bi bi-calendar-event me-1"></i><?php echo $date; ?>
                            </div>
                            <h3 class="h5 fw-bold text-dark font-title mb-2">
                                <a href="<?php echo htmlspecialchars($detailUrl); ?>" class="text-dark text-decoration-none hover-accent">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </a>
                            </h3>
                            <p class="text-secondary small mb-3 line-clamp-2" style="font-size: 0.88rem; line-height: 1.5;">
                                <?php echo htmlspecialchars($post['snippet']); ?>
                            </p>
                        </div>
                        <div class="pt-2 border-top border-secondary-subtle d-flex align-items-center justify-content-between">
                            <div class="d-flex gap-1 flex-wrap">
                                <?php if (!empty($post['tags'])): ?>
                                    <?php foreach (array_slice($post['tags'], 0, 2) as $tag): ?>
                                        <span class="badge bg-secondary-subtle text-secondary small px-2 py-0.5" style="font-size: 0.7rem;">#<?php echo htmlspecialchars($tag); ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo htmlspecialchars($detailUrl); ?>" class="fw-bold text-accent small text-decoration-none" aria-label="Read full article">
                                Read Article <i class="bi bi-arrow-right ms-0.5"></i>
                            </a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Programmatic Topic FAQ Section (Structured SEO snippet value) -->
<?php if (!empty($current_topic['faqs'])): ?>
<section class="py-4" id="pseo-faq-section">
    <div class="card bento-card p-4 p-md-5">
        <h3 class="h4 fw-bold text-dark font-title mb-4"><i class="bi bi-question-circle-fill text-accent me-2"></i>Frequently Asked Questions: <?php echo e($current_topic['category']); ?></h3>
        <div class="accordion accordion-flush" id="pseoFaqAccordion">
            <?php foreach ($current_topic['faqs'] as $idx => $faq): ?>
                <div class="accordion-item bg-transparent border-bottom mb-2">
                    <h4 class="accordion-header" id="heading<?php echo $idx; ?>">
                        <button class="accordion-button collapsed bg-transparent fw-bold text-dark font-title shadow-none py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $idx; ?>" aria-expanded="false" aria-controls="collapse<?php echo $idx; ?>">
                            <?php echo e($faq['q']); ?>
                        </button>
                    </h4>
                    <div id="collapse<?php echo $idx; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $idx; ?>" data-bs-parent="#pseoFaqAccordion">
                        <div class="accordion-body text-secondary leading-relaxed font-body pb-4" style="font-size: 0.96rem;">
                            <?php echo e($faq['a']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- pSEO Interlink Directory Matrix -->
<section class="py-4" id="pseo-directory-matrix">
    <div class="card bento-card p-4">
        <h3 class="h6 fw-bold text-dark font-title mb-3"><i class="bi bi-diagram-3-fill text-accent me-2"></i>Explore All Technical Topics</h3>
        <div class="d-flex flex-wrap gap-2">
            <?php foreach ($pseo_topics as $top): 
                $topUrl = BASE_URL . 'blogs/category?name=' . $top['slug'];
                $isActive = ($top['slug'] === $cat_slug);
            ?>
                <a href="<?php echo $topUrl; ?>" class="btn btn-sm <?php echo $isActive ? 'btn-dark' : 'btn-outline-secondary'; ?> rounded-pill px-3 py-1 fw-semibold" style="font-size: 0.82rem;">
                    <?php echo e($top['name']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php 
include BASE_PATH . 'templates/layout/footer.php';
include BASE_PATH . 'templates/layout/body-end.php';
?>
