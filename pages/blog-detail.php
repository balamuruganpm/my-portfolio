<?php
/**
 * Page: Blog Article Detail & Comments
 */
if (!defined('PAGE_DEPTH')) {
    define('PAGE_DEPTH', 1);
}

require_once __DIR__ . '/../config/bootstrap.php';

// Read blogs
$blogs = loadBlogs();

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$blog_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$post = null;
$post_index = -1;

for ($i = 0; $i < count($blogs); $i++) {
    $b = $blogs[$i];
    if (!empty($slug) && isset($b['slug']) && $b['slug'] === $slug) {
        $post = $b;
        $post_index = $i;
        break;
    } elseif ($blog_id > 0 && (int)$b['id'] === $blog_id) {
        $post = $b;
        $post_index = $i;
        break;
    }
}

if (!$post) {
    header("Location: " . BASE_URL . "blogs");
    exit();
}

// Track and increment post views (once per session)
if ($post_index !== -1) {
    if (!isset($blogs[$post_index]['views'])) {
        $blogs[$post_index]['views'] = 0;
    }
    if (!isset($_SESSION['viewed_blog_' . $post['id']])) {
        $_SESSION['viewed_blog_' . $post['id']] = true;
        $blogs[$post_index]['views']++;
        $post['views'] = $blogs[$post_index]['views'];

        $blogs_file = ADMIN_DATA_PATH . 'blogs.json';
        @file_put_contents($blogs_file, json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}

$seo_title_fallback = !empty($post['seo_title']) ? $post['seo_title'] : $post['title'];
$pageTitle = e($seo_title_fallback) . " | Balamurugan P M";

$pageMetaDescription = !empty($post['seo_description']) ? e($post['seo_description']) : e($post['snippet']);
$seo_keywords_fallback = !empty($post['seo_keywords']) ? $post['seo_keywords'] : (!empty($post['tags']) ? implode(', ', $post['tags']) : '');
$pageMetaKeywords = e($seo_keywords_fallback);

$thisPage = "Blogs";

// Comments JSON database
$comments_file = ADMIN_DATA_PATH . 'comments.json';
$comments = [];
if (file_exists($comments_file)) {
    $comments = json_decode(file_get_contents($comments_file), true);
    if (!is_array($comments)) {
        $comments = [];
    }
}

// Handle Guest Comment submission
$comment_msg = '';
$comment_msg_type = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_comment') {
    $guest_name = isset($_POST['guest_name']) ? trim($_POST['guest_name']) : '';
    $guest_comment = isset($_POST['guest_comment']) ? trim($_POST['guest_comment']) : '';
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

    // Rate Limiting: max 3 comments in 1 minute per IP
    $ip_count = 0;
    $one_minute_ago = time() - 60;
    foreach ($comments as $c) {
        if (isset($c['ip']) && $c['ip'] === $ip_address) {
            $comment_time = isset($c['date']) ? strtotime($c['date']) : 0;
            if ($comment_time > $one_minute_ago) {
                $ip_count++;
            }
        }
    }

    if ($ip_count >= 3) {
        $comment_msg = 'Rate Limit Exceeded: Wait for cooldown period';
        $comment_msg_type = 'danger';
    } elseif (empty($guest_name) || empty($guest_comment)) {
        $comment_msg = 'Please fill out both Name and Comment fields.';
        $comment_msg_type = 'danger';
    } else {
        $new_comment = [
            'id' => time(),
            'blog_id' => $post['id'],
            'name' => $guest_name,
            'comment' => $guest_comment,
            'ip' => $ip_address,
            'date' => date('Y-m-d H:i:s')
        ];
        $comments[] = $new_comment;
        if (file_put_contents($comments_file, json_encode($comments, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) !== false) {
            $comment_msg = 'Your comment has been posted successfully!';
            $comment_msg_type = 'success';
        } else {
            $comment_msg = 'Failed to post your comment. Please try again.';
            $comment_msg_type = 'danger';
        }
    }
}

include BASE_PATH . 'templates/layout/head.php';
include BASE_PATH . 'templates/layout/body-start.php';
include BASE_PATH . 'templates/partials/navigation.php';
?>

<!-- Blog Article Details -->
<article class="py-4" id="blog-article-content">
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
        <a href="<?php echo BASE_URL; ?>blogs" class="btn btn-outline-dark btn-sm d-inline-flex align-items-center gap-2 border-secondary-subtle px-3" style="border-radius: 10px;">
            <i class="bi bi-arrow-left"></i> Back to Articles
        </a>
        <?php if ($adsEnabled): ?>
            <div class="d-flex gap-2">
                <a href="https://www.profitableratecpmnetwork.com/fg8vsabw0?key=85a6a5fcd471608b17da62bbd4c415d5" target="_blank" rel="noopener noreferrer" class="btn btn-warning-custom btn-sm rounded-pill px-3 text-white fw-semibold" style="background-color: var(--accent) !important;">
                    <i class="bi bi-gift me-1"></i> Special Offer 1
                </a>
                <a href="https://www.profitableratecpmnetwork.com/zhzy181j?key=a985ed396e845a0439a1f428f29b755a" target="_blank" rel="noopener noreferrer" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-semibold">
                    <i class="bi bi-star-fill text-warning me-1"></i> Special Offer 2
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="row g-4">
        <!-- Main Content Area Column -->
        <div class="col-lg-8 col-12">
            <div class="card header-card p-3 border-0 mb-4" style="background-color: var(--bg-card);">
                <header class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <?php if (!empty($post['category'])): ?>
                            <span class="blog-detail-category-badge"><?php echo e($post['category']); ?></span>
                        <?php endif; ?>
                        <span class="text-secondary small"><?php echo date('F d, Y', strtotime($post['date'])); ?></span>
                        <span class="text-secondary small ms-2"><i class="bi bi-eye"></i> <?php echo number_format(isset($post['views']) ? $post['views'] : 0); ?> views</span>
                    </div>
                    <h1 class="h2 fw-bold text-dark mb-3"><?php echo e($post['title']); ?></h1>
                    <p class="lead text-secondary-theme font-semibold"><?php echo e($post['snippet']); ?></p>

                    <!-- Social Share Bar & Shortlink Option -->
                    <?php
                    $absolute_share_url = CANONICAL_URL;
                    $encoded_share_url = urlencode($absolute_share_url);
                    $encoded_share_title = urlencode($post['title']);
                    $shortlink = BASE_URL . 'blogs/detail?id=' . $post['id'];
                    ?>
                    <div class="d-flex flex-wrap gap-2 align-items-center mt-3 pt-3 border-top">
                        <span class="small fw-semibold text-secondary me-2"><i class="bi bi-share-fill me-1"></i>Share:</span>

                        <a href="https://twitter.com/intent/tweet?url=<?php echo $encoded_share_url; ?>&text=<?php echo $encoded_share_title; ?>" target="_blank" class="btn btn-sm btn-outline-dark border-secondary-subtle rounded-3 py-1 px-2.5 d-inline-flex align-items-center gap-1.5" style="font-size: 0.82rem;" title="Share on Twitter" aria-label="Share this article on Twitter">
                            <i class="bi bi-twitter"></i> Twitter
                        </a>

                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encoded_share_url; ?>" target="_blank" class="btn btn-sm btn-outline-dark border-secondary-subtle rounded-3 py-1 px-2.5 d-inline-flex align-items-center gap-1.5" style="font-size: 0.82rem;" title="Share on Facebook" aria-label="Share this article on Facebook">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>

                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $encoded_share_url; ?>" target="_blank" class="btn btn-sm btn-outline-dark border-secondary-subtle rounded-3 py-1 px-2.5 d-inline-flex align-items-center gap-1.5" style="font-size: 0.82rem;" title="Share on LinkedIn" aria-label="Share this article on LinkedIn">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>

                        <button type="button" class="btn btn-sm btn-outline-dark border-secondary-subtle rounded-3 py-1 px-2.5 d-inline-flex align-items-center gap-1.5" style="font-size: 0.82rem;" onclick="copyToClipboard('<?php echo $absolute_share_url; ?>', this)" title="Copy absolute page URL">
                            <i class="bi bi-link-45deg"></i> Copy Link
                        </button>

                        <button type="button" class="btn btn-sm btn-warning-custom rounded-3 py-1 px-2.5 d-inline-flex align-items-center gap-1.5 text-xs text-white" style="font-size: 0.82rem; background-color: var(--accent) !important;" onclick="copyToClipboard('<?php echo $shortlink; ?>', this)" title="Copy simple shortlink URL">
                            <i class="bi bi-lightning-fill"></i> Get Shortlink
                        </button>
                    </div>

                    <!-- JavaScript Clipboard Copier Helper -->
                    <script>
                        function copyToClipboard(text, buttonElement) {
                            navigator.clipboard.writeText(text).then(function() {
                                const originalText = buttonElement.innerHTML;
                                buttonElement.innerHTML = '<i class="bi bi-check-lg"></i> Copied!';
                                buttonElement.classList.add('btn-success');
                                buttonElement.classList.remove('btn-outline-dark', 'btn-warning-custom');

                                setTimeout(function() {
                                    buttonElement.innerHTML = originalText;
                                    buttonElement.classList.remove('btn-success');
                                    if (buttonElement.getAttribute('onclick').includes('shortlink')) {
                                        buttonElement.classList.add('btn-warning-custom');
                                    } else {
                                        buttonElement.classList.add('btn-outline-dark');
                                    }
                                }, 2000);
                            }, function(err) {
                                console.error('Could not copy text: ', err);
                            });
                        }
                    </script>

                    <?php if (!empty($post['tags'])): ?>
                        <div class="d-flex gap-2 flex-wrap mt-3">
                            <?php foreach ($post['tags'] as $tag): ?>
                                <span class="badge bg-secondary-subtle text-secondary small px-2 py-1 rounded-pill"><?php echo e($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <?php if (!empty($post['image'])): ?>
                    <div class="blog-cover-wrapper mb-4 rounded-4 overflow-hidden" style="background-color: var(--border-color);">
                        <img src="<?php echo BASE_URL . e($post['image']); ?>"
                            alt="<?php echo e($post['title']); ?> - Cover Image"
                            title="<?php echo e($post['title']); ?> Cover Image"
                            loading="lazy"
                            width="800"
                            height="600"
                            class="w-100 h-auto"
                            style="object-fit: contain; display: block; max-height: none;">
                    </div>
                <?php endif; ?>

                <?php if (!empty($post['category']) && strtolower($post['category']) === 'job'): ?>
                    <div class="job-info-card p-4 rounded-4 border mb-4" style="background-color: var(--bg-page); border-color: var(--border-color);">
                        <h3 class="h5 fw-bold text-dark mb-3"><i class="bi bi-briefcase text-accent me-2"></i>Job Coordinates</h3>
                        <div class="row g-3">
                            <?php if (!empty($post['company'])): ?>
                                <div class="col-md-6 d-flex align-items-center gap-2">
                                    <i class="bi bi-building text-secondary"></i>
                                    <div>
                                        <span class="d-block text-secondary small" style="font-size: 0.75rem;">Company</span>
                                        <strong class="text-dark small"><?php echo e($post['company']); ?></strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($post['job_location'])): ?>
                                <div class="col-md-6 d-flex align-items-center gap-2">
                                    <i class="bi bi-geo-alt text-secondary"></i>
                                    <div>
                                        <span class="d-block text-secondary small" style="font-size: 0.75rem;">Location</span>
                                        <strong class="text-dark small"><?php echo e($post['job_location']); ?></strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($post['salary'])): ?>
                                <div class="col-md-6 d-flex align-items-center gap-2">
                                    <i class="bi bi-cash-stack text-secondary"></i>
                                    <div>
                                        <span class="d-block text-secondary small" style="font-size: 0.75rem;">Salary</span>
                                        <strong class="text-dark small"><?php echo e($post['salary']); ?></strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($post['job_type'])): ?>
                                <div class="col-md-6 d-flex align-items-center gap-2">
                                    <i class="bi bi-clock text-secondary"></i>
                                    <div>
                                        <span class="d-block text-secondary small" style="font-size: 0.75rem;">Job Type</span>
                                        <strong class="text-dark small"><?php echo e($post['job_type']); ?></strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($post['apply_link'])): ?>
                            <div class="mt-4 pt-3 border-top">
                                <a href="<?php echo e($post['apply_link']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-warning-custom px-4 py-2.5 text-white" style="background-color: var(--accent) !important; border-radius: 12px; font-weight: 600;">
                                    Apply for this Job <i class="bi bi-box-arrow-up-right ms-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Body text content -->
                <div class="blog-body text-secondary-theme leading-relaxed mb-3" style="white-space: pre-wrap; font-size: 1.05rem;"><?php echo $post['content']; ?></div>

                <!-- Video Player Attachment -->
                <?php if (!empty($post['video'])): ?>
                    <div class="blog-video-wrapper mb-4 p-4 border rounded-4 bg-transparent border-secondary-subtle">
                        <h4 class="h6 fw-bold text-dark mb-3"><i class="bi bi-play-circle me-1"></i>Video Presentation</h4>
                        <div class="ratio ratio-16x9 overflow-hidden rounded-3">
                            <video width="800" height="450" controls title="<?php echo e($post['title']); ?> Video Reel" aria-label="Blog post companion video clip">
                                <source src="<?php echo BASE_URL . e($post['video']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- PDF Document Downloads -->
                <?php if (!empty($post['pdf'])): ?>
                    <div class="blog-pdf-wrapper p-4 border rounded-4 bg-transparent border-secondary-subtle d-flex align-items-center justify-content-between gap-3 flex-wrap">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-file-earmark-pdf fs-2 text-danger"></i>
                            <div>
                                <span class="d-block fw-bold text-dark text-sm">Attachment Document</span>
                                <span class="text-secondary small">Read companion documentation for this post</span>
                            </div>
                        </div>
                        <a href="<?php echo BASE_URL . e($post['pdf']); ?>" download class="btn btn-warning-custom px-4 py-2" aria-label="Download companion PDF document">
                            <i class="bi bi-download me-1"></i> Download PDF
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Guest Comments Section -->
                <div class="mt-5 pt-5 border-top" id="comments-wrapper">
                    <h3 class="h4 fw-bold text-dark font-title mb-4"><i class="bi bi-chat-left-text me-2"></i>Discussion</h3>

                    <!-- Comment Submission Alert -->
                    <?php if (!empty($comment_msg)): ?>
                        <div id="comment-alert-box" class="alert alert-<?php echo $comment_msg_type; ?> alert-dismissible fade show rounded-4 border-0 py-3 px-4 mb-4 small" role="alert" style="background-color: <?php echo $comment_msg_type === 'success' ? 'rgba(var(--accent-rgb, 210, 140, 60), 0.1)' : 'rgba(220,53,69,0.1)'; ?>; color: <?php echo $comment_msg_type === 'success' ? 'var(--accent)' : '#dc3545'; ?>;">
                            <i class="bi <?php echo $comment_msg_type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?> me-2"></i>
                            <?php echo e($comment_msg); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <script>
                            setTimeout(function() {
                                const alertEl = document.getElementById('comment-alert-box');
                                if (alertEl) {
                                    alertEl.classList.remove('show');
                                    setTimeout(() => alertEl.remove(), 400);
                                }
                            }, 5000);
                        </script>
                    <?php endif; ?>

                    <!-- Comments Form -->
                    <form id="guest-comment-form" method="POST" action="#comments-wrapper" class="card border-0 p-4 p-md-5 rounded-4 mb-5 comment-form-card">
                        <input type="hidden" name="action" value="add_comment">
                        <h4 class="h6 fw-bold text-dark mb-3 font-title d-flex align-items-center gap-2"><i class="bi bi-pencil-square text-accent"></i>Leave a Guest Comment</h4>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small fw-semibold">Your Name</label>
                                <input type="text" name="guest_name" class="form-control border-secondary-subtle comment-form-control" placeholder="e.g. John Doe" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-secondary small fw-semibold">Comment</label>
                                <textarea name="guest_comment" rows="4" class="form-control border-secondary-subtle comment-form-control" placeholder="Share your thoughts or ask a question..." required style="resize: none;"></textarea>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-warning-custom px-4 py-2.5 small fw-semibold border-0 d-inline-flex align-items-center gap-2" style="border-radius: 12px; font-family: var(--font-inter); font-size: 0.9rem;">
                                    <i class="bi bi-chat-square-quote"></i> Post Comment
                                </button>
                            </div>
                        </div>
                    </form>

                    <?php if (!empty($comment_msg) && $comment_msg_type === 'success'): ?>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const form = document.getElementById('guest-comment-form');
                                if (form) {
                                    form.reset();
                                }
                            });
                        </script>
                    <?php endif; ?>

                    <!-- Comments List -->
                    <div class="comments-list d-flex flex-column gap-3">
                        <?php
                        $post_comments = [];
                        foreach ($comments as $c) {
                            if (isset($c['blog_id']) && $c['blog_id'] === $post['id']) {
                                $post_comments[] = $c;
                            }
                        }

                        usort($post_comments, function ($a, $b) {
                            return strtotime($b['date']) - strtotime($a['date']);
                        });

                        if (empty($post_comments)):
                        ?>
                            <div class="text-center py-5 border rounded-4 border-dashed" style="border-style: dashed !important; border-color: var(--border-color) !important;">
                                <i class="bi bi-chat-dots text-muted fs-3 mb-2 d-block"></i>
                                <p class="text-secondary small mb-0 font-medium">No comments yet. Be the first to share your thoughts!</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($post_comments as $c):
                                $cDate = date('F d, Y \a\t h:i A', strtotime($c['date']));
                                $colors = ['#ff5722', '#673ab7', '#3f51b5', '#009688', '#e91e63', '#4caf50', '#ffc107', '#03a9f4'];
                                $idx = ord(strtolower(substr($c['name'], 0, 1))) % count($colors);
                                $avatar_color = $colors[$idx];
                            ?>
                                <div class="comment-item p-4 rounded-4 bg-light d-flex align-items-start gap-3 border border-secondary-subtle" style="background-color: var(--bg-page) !important; transition: var(--transition);">
                                    <div class="comment-avatar d-flex align-items-center justify-content-center text-white fw-bold rounded-circle text-sm" style="width: 44px; height: 44px; min-width: 44px; background-color: <?php echo $avatar_color; ?> !important; font-size: 1.1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                                        <?php echo strtoupper(substr($c['name'], 0, 1)); ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-1">
                                            <span class="fw-bold text-dark" style="font-size: 0.95rem; font-family: var(--font-inter);"><?php echo e($c['name']); ?></span>
                                            <span class="text-secondary small d-inline-flex align-items-center gap-1" style="font-size: 0.76rem;"><i class="bi bi-clock"></i> <?php echo $cDate; ?></span>
                                        </div>
                                        <p class="text-secondary-theme mb-0 leading-relaxed font-body" style="white-space: pre-wrap; font-size: 0.92rem;"><?php echo e($c['comment']); ?></p>
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
            <?php
            $relatedBlogs = [];
            foreach ($blogs as $b) {
                if ($b['id'] !== $post['id']) {
                    $relatedBlogs[] = $b;
                }
            }
            $relatedBlogs = array_slice($relatedBlogs, 0, 4);

            if (!empty($relatedBlogs)):
            ?>
                <aside class="card header-card p-4 border-0 mb-4 sticky-lg-top" style="background-color: var(--bg-card); top: 20px; z-index: 10;">
                    <h3 class="h5 fw-bold text-dark font-title mb-3"><i class="bi bi-journal-text me-2 text-warning" style="color: var(--accent) !important;"></i>Related Articles</h3>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($relatedBlogs as $related):
                            $relImg = !empty($related['image']) ? $related['image'] : 'assets/images/placeholder.webp';
                            $relDate = date('M d, Y', strtotime($related['date']));
                            $relUrl = !empty($related['slug']) ? (BASE_URL . 'blogs/detail?slug=' . $related['slug']) : (BASE_URL . 'blogs/detail?id=' . $related['id']);
                        ?>
                            <a href="<?php echo e($relUrl); ?>" class="d-flex align-items-center gap-3 text-decoration-none group-aside-card" style="transition: var(--transition);">
                                <div class="overflow-hidden rounded-3 border-0" style="width: 76px; height: 60px; min-width: 76px;">
                                    <img src="<?php echo BASE_URL . e($relImg); ?>"
                                        alt="<?php echo e($related['title']); ?>"
                                        title="<?php echo e($related['title']); ?>"
                                        loading="lazy"
                                        width="76"
                                        height="60"
                                        class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s ease;">
                                </div>
                                <div>
                                    <span class="text-secondary small d-block mb-0.5" style="font-size: 0.72rem;"><?php echo $relDate; ?></span>
                                    <h4 class="fw-bold text-dark mb-0 font-title" style="font-size: 0.86rem; line-height: 1.25;"><?php echo e($related['title']); ?></h4>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </aside>
            <?php endif; ?>

            <?php if ($adsEnabled): ?>
                <!-- Sidebar Banner 1: 300x250 -->
                <div class="card p-3 border-0 mb-4 text-center overflow-auto" style="background-color: var(--bg-card);">
                    <span class="badge bg-secondary-subtle text-secondary mb-2 small d-block">Sponsored Ad</span>
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

                <!-- Sidebar Banner 2: 160x600 Skyscraper -->
                <div class="card p-3 border-0 mb-4 text-center overflow-auto" style="background-color: var(--bg-card);">
                    <span class="badge bg-secondary-subtle text-secondary mb-2 small d-block">Promoted Content</span>
                    <script type="text/javascript">
                      atOptions = {
                        'key' : 'c3a9052e628a187b8304abbadff1152f',
                        'format' : 'iframe',
                        'height' : 600,
                        'width' : 160,
                        'params' : {}
                      };
                    </script>
                    <script type="text/javascript" src="https://www.highrevenueformat.com/c3a9052e628a187b8304abbadff1152f/invoke.js"></script>
                </div>

                <!-- Sidebar Banner 3: 160x300 Banner -->
                <div class="card p-3 border-0 mb-4 text-center overflow-auto" style="background-color: var(--bg-card);">
                    <span class="badge bg-secondary-subtle text-secondary mb-2 small d-block">Recommended</span>
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

                <!-- Direct Links Promotional Box -->
                <div class="card p-4 border-0 mb-4 text-center rounded-4" style="background-color: var(--bg-card);">
                    <h4 class="h6 font-title text-dark mb-2">🔥 Exclusive Deals & Rewards</h4>
                    <p class="text-secondary small mb-3">Click below to check out verified sponsor offers!</p>
                    <div class="d-grid gap-2">
                        <a href="https://www.profitableratecpmnetwork.com/fg8vsabw0?key=85a6a5fcd471608b17da62bbd4c415d5" target="_blank" rel="noopener noreferrer" class="btn btn-warning-custom btn-sm text-white fw-bold py-2" style="background-color: var(--accent) !important; border-radius: 10px;">
                            Claim Sponsor Bonus <i class="bi bi-box-arrow-up-right ms-1"></i>
                        </a>
                        <a href="https://www.profitableratecpmnetwork.com/zhzy181j?key=a985ed396e845a0439a1f428f29b755a" target="_blank" rel="noopener noreferrer" class="btn btn-outline-dark btn-sm fw-semibold py-2" style="border-radius: 10px;">
                            Explore Hot Deal <i class="bi bi-lightning-fill text-warning ms-1"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
</article>

<?php 
include BASE_PATH . 'templates/layout/footer.php';
include BASE_PATH . 'templates/layout/body-end.php';
?>
