<?php
/**
 * Admin Module: Write & Edit Blog Article
 */
$admin_current_page = 'blogs';

require_once __DIR__ . '/../../config/admin-bootstrap.php';

$edit_id = isset($_GET['edit_id']) ? (int)$_GET['edit_id'] : 0;
$editing_blog = null;
$edit_idx = -1;

if ($edit_id > 0) {
    foreach ($blogs as $idx => $b) {
        if ((int)$b['id'] === $edit_id) {
            $editing_blog = $b;
            $edit_idx = $idx;
            break;
        }
    }
}

$page_title = $editing_blog ? 'Edit Article' : 'Write New Article';
$message = '';
$message_type = 'danger';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    verifyCsrfToken();
    $action = $_POST['action'];

    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $snippet = isset($_POST['snippet']) ? trim($_POST['snippet']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $category = isset($_POST['category']) ? trim($_POST['category']) : 'Blog';
    $custom_slug = isset($_POST['slug']) ? trim($_POST['slug']) : '';
    $tags_raw = isset($_POST['tags']) ? trim($_POST['tags']) : '';
    $tags = !empty($tags_raw) ? array_filter(array_map('trim', explode(',', $tags_raw))) : [];

    $seo_title = isset($_POST['seo_title']) ? trim($_POST['seo_title']) : '';
    $seo_keywords = isset($_POST['seo_keywords']) ? trim($_POST['seo_keywords']) : '';
    $seo_description = isset($_POST['seo_description']) ? trim($_POST['seo_description']) : '';

    // Job specific fields
    $company = isset($_POST['company']) ? trim($_POST['company']) : '';
    $job_location = isset($_POST['job_location']) ? trim($_POST['job_location']) : '';
    $salary = isset($_POST['salary']) ? trim($_POST['salary']) : '';
    $job_type = isset($_POST['job_type']) ? trim($_POST['job_type']) : '';
    $apply_link = isset($_POST['apply_link']) ? trim($_POST['apply_link']) : '';

    $image_path = $editing_blog['image'] ?? '';
    $pdf_path = $editing_blog['pdf'] ?? '';
    $video_path = $editing_blog['video'] ?? '';

    // Upload Handlers
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img_dir = BASE_PATH . 'uploads/images/';
        if (!is_dir($img_dir)) mkdir($img_dir, 0755, true);
        $fn = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", basename($_FILES['image']['name']));
        if (move_uploaded_file($_FILES['image']['tmp_name'], $img_dir . $fn)) {
            $image_path = 'uploads/images/' . $fn;
        }
    }

    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $pdf_dir = BASE_PATH . 'uploads/pdf/';
        if (!is_dir($pdf_dir)) mkdir($pdf_dir, 0755, true);
        $fn = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", basename($_FILES['pdf']['name']));
        if (move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_dir . $fn)) {
            $pdf_path = 'uploads/pdf/' . $fn;
        }
    }

    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $vid_dir = BASE_PATH . 'uploads/videos/';
        if (!is_dir($vid_dir)) mkdir($vid_dir, 0755, true);
        $fn = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", basename($_FILES['video']['name']));
        if (move_uploaded_file($_FILES['video']['tmp_name'], $vid_dir . $fn)) {
            $video_path = 'uploads/videos/' . $fn;
        }
    }

    if (!empty($title)) {
        // Slug resolution
        $slug = !empty($custom_slug) ? strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $custom_slug))) : strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        $slug = trim(preg_replace('/-+/', '-', $slug), '-');

        $blog_entry = [
            'id' => $editing_blog ? $editing_blog['id'] : time(),
            'title' => $title,
            'slug' => $slug,
            'category' => $category,
            'tags' => $tags,
            'snippet' => $snippet,
            'content' => $content,
            'image' => $image_path,
            'pdf' => $pdf_path,
            'video' => $video_path,
            'seo_title' => $seo_title,
            'seo_keywords' => $seo_keywords,
            'seo_description' => $seo_description,
            'company' => $company,
            'job_location' => $job_location,
            'salary' => $salary,
            'job_type' => $job_type,
            'apply_link' => $apply_link,
            'date' => $editing_blog ? $editing_blog['date'] : date('Y-m-d H:i:s'),
            'views' => $editing_blog['views'] ?? 0
        ];

        if ($action === 'add') {
            $blogs[] = $blog_entry;
            $redirect_msg = "added";
        } elseif ($action === 'edit' && $edit_idx >= 0) {
            $blogs[$edit_idx] = $blog_entry;
            $redirect_msg = "updated";
        }

        if (saveAdminBlogs($blogs)) {
            header("Location: index.php?message=" . $redirect_msg);
            exit();
        } else {
            $message = 'Failed to write blog entry to database.';
        }
    } else {
        $message = 'Article Title is required.';
    }
}

include __DIR__ . '/../../layout/header.php';
?>

<div class="mb-4 d-flex align-items-center gap-3">
    <a href="index.php" class="btn btn-admin-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
    <div>
        <h1 class="h3 fw-bold text-dark mb-1 font-title"><?php echo $editing_blog ? 'Edit Blog Article' : 'Write New Article'; ?></h1>
        <p class="text-secondary small mb-0">Compose articles with rich formatting, video attachments, and SEO metadata</p>
    </div>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-danger border-0 py-3 px-4 rounded-3 small d-flex align-items-center gap-2 mb-4" style="background: var(--admin-danger-bg); color: var(--admin-danger);">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div><?php echo e($message); ?></div>
    </div>
<?php endif; ?>

<form method="POST" action="add.php<?php echo $editing_blog ? '?edit_id=' . $edit_id : ''; ?>" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
    <input type="hidden" name="action" value="<?php echo $editing_blog ? 'edit' : 'add'; ?>">

    <div class="row g-4">
        <!-- Left: Editor & Core Body -->
        <div class="col-lg-8">
            <div class="card admin-card p-4 p-md-5 mb-4">
                <div class="mb-4">
                    <label class="form-label">Article Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Mastering React.js Performance" required value="<?php echo e($editing_blog['title'] ?? ''); ?>">
                </div>

                <div class="mb-4">
                    <label class="form-label">Lead Excerpt / Summary</label>
                    <textarea name="snippet" rows="3" class="form-control" placeholder="A concise 1-2 sentence lead overview of this article..." required><?php echo e($editing_blog['snippet'] ?? ''); ?></textarea>
                </div>

                <!-- WYSIWYG Editor Container -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <label class="form-label mb-0 fw-semibold text-dark">Article Content</label>
                            <span class="badge bg-light text-secondary border px-2.5 py-1" id="editor-mode-indicator" style="font-size: 0.72rem; font-weight: 600; letter-spacing: 0.3px;">Visual Mode</span>
                        </div>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Editor Mode Selection">
                            <button type="button" id="btn-visual-tab" class="btn btn-admin-primary active fw-semibold px-3"><i class="bi bi-eye-fill me-1"></i>Visual</button>
                            <button type="button" id="btn-html-tab" class="btn btn-admin-secondary fw-semibold px-3"><i class="bi bi-code-slash me-1"></i>Source Code</button>
                        </div>
                    </div>

                    <div id="rich-editor-container" class="rounded-3 border overflow-hidden shadow-sm" style="background: #ffffff;">
                        <div id="editor-toolbar" class="bg-light border-bottom p-2 d-flex flex-wrap align-items-center gap-1">
                            <button type="button" class="editor-btn" onclick="formatDoc('bold')" title="Bold (Ctrl+B)"><i class="bi bi-type-bold"></i></button>
                            <button type="button" class="editor-btn" onclick="formatDoc('italic')" title="Italic (Ctrl+I)"><i class="bi bi-type-italic"></i></button>
                            <button type="button" class="editor-btn" onclick="formatDoc('underline')" title="Underline (Ctrl+U)"><i class="bi bi-type-underline"></i></button>
                            <button type="button" class="editor-btn" onclick="formatDoc('strikeThrough')" title="Strikethrough"><i class="bi bi-type-strikethrough"></i></button>
                            <div class="editor-divider"></div>
                            <button type="button" class="editor-btn" onclick="formatDoc('formatBlock', '<h2>')" title="Heading 2 (H2)"><i class="bi bi-type-h2"></i></button>
                            <button type="button" class="editor-btn" onclick="formatDoc('formatBlock', '<h3>')" title="Heading 3 (H3)"><i class="bi bi-type-h3"></i></button>
                            <button type="button" class="editor-btn" onclick="formatDoc('formatBlock', '<p>')" title="Paragraph"><i class="bi bi-paragraph"></i></button>
                            <div class="editor-divider"></div>
                            <button type="button" class="editor-btn" onclick="formatDoc('insertUnorderedList')" title="Bullet List"><i class="bi bi-list-ul"></i></button>
                            <button type="button" class="editor-btn" onclick="formatDoc('insertOrderedList')" title="Numbered List"><i class="bi bi-list-ol"></i></button>
                            <button type="button" class="editor-btn" onclick="formatDoc('formatBlock', '<blockquote>')" title="Quote Block"><i class="bi bi-quote"></i></button>
                            <button type="button" class="editor-btn" onclick="formatDoc('formatBlock', '<pre>')" title="Code Block"><i class="bi bi-code-square"></i></button>
                            <div class="editor-divider"></div>
                            <button type="button" class="editor-btn" onclick="insertLink()" title="Insert Hyperlink"><i class="bi bi-link-45deg"></i></button>
                            <button type="button" class="editor-btn" onclick="insertImage()" title="Insert Image URL"><i class="bi bi-image"></i></button>
                            <button type="button" class="editor-btn" onclick="formatDoc('insertHorizontalRule')" title="Horizontal Line"><i class="bi bi-hr"></i></button>
                            <button type="button" class="editor-btn text-danger ms-auto" onclick="formatDoc('removeFormat')" title="Clear Formatting"><i class="bi bi-eraser"></i></button>
                        </div>

                        <div id="visual-editor" contenteditable="true" style="min-height: 420px; padding: 22px 26px; outline: none; background: #ffffff; color: #0f172a; font-size: 1rem; line-height: 1.7; overflow-y: auto;"><?php echo $editing_blog['content'] ?? ''; ?></div>
                        
                        <textarea name="content" id="html-editor" style="display: none; width: 100% !important; min-height: 420px !important; padding: 22px 26px !important; font-family: 'Fira Code', 'Consolas', monospace !important; font-size: 14px !important; line-height: 1.65 !important; background-color: #0f172a !important; color: #38bdf8 !important; border: none !important; outline: none !important; resize: vertical !important; tab-size: 4 !important; box-sizing: border-box !important;"><?php echo e($editing_blog['content'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Job Specific Fields (Conditional: Only shown when Category = Job) -->
            <div id="fields-for-job" class="conditional-section card admin-card p-4 mb-4" style="display: none;">
                <h3 class="h6 fw-bold text-dark mb-3 font-title"><i class="bi bi-briefcase-fill text-accent me-2"></i>Job Coordinates</h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Hiring Company</label>
                        <input type="text" name="company" class="form-control" placeholder="e.g. Acme Corp" value="<?php echo e($editing_blog['company'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Job Location</label>
                        <input type="text" name="job_location" class="form-control" placeholder="e.g. Remote / Chennai, India" value="<?php echo e($editing_blog['job_location'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Salary Range</label>
                        <input type="text" name="salary" class="form-control" placeholder="e.g. $80k - $100k / Competitive" value="<?php echo e($editing_blog['salary'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Job Type</label>
                        <select name="job_type" class="form-select">
                            <option value="Full-time" <?php echo (isset($editing_blog['job_type']) && $editing_blog['job_type'] === 'Full-time') ? 'selected' : ''; ?>>Full-time</option>
                            <option value="Part-time" <?php echo (isset($editing_blog['job_type']) && $editing_blog['job_type'] === 'Part-time') ? 'selected' : ''; ?>>Part-time</option>
                            <option value="Contract" <?php echo (isset($editing_blog['job_type']) && $editing_blog['job_type'] === 'Contract') ? 'selected' : ''; ?>>Contract</option>
                            <option value="Remote" <?php echo (isset($editing_blog['job_type']) && $editing_blog['job_type'] === 'Remote') ? 'selected' : ''; ?>>Remote</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Direct Apply URL</label>
                        <input type="url" name="apply_link" class="form-control" placeholder="https://..." value="<?php echo e($editing_blog['apply_link'] ?? ''); ?>">
                    </div>
                </div>
            </div>

            <!-- Tech / News Specific Fields (Conditional: Shown for Tech News / Tutorials) -->
            <div id="fields-for-tech" class="conditional-section card admin-card p-4 mb-4" style="display: none;">
                <h3 class="h6 fw-bold text-dark mb-3 font-title"><i class="bi bi-code-slash text-accent me-2"></i>Technical References &amp; News Sources</h3>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">External News / Reference Source URL</label>
                        <input type="url" name="source_url" class="form-control" placeholder="e.g. https://support.google.com/analytics or GitHub repo URL" value="<?php echo e($editing_blog['source_url'] ?? ''); ?>">
                    </div>
                </div>
            </div>

            <!-- SEO & Meta Card -->
            <div class="card admin-card p-4 p-md-5 mb-4">
                <h3 class="h6 fw-bold text-dark mb-3 font-title"><i class="bi bi-search text-accent me-2"></i>SEO &amp; Indexing Metadata</h3>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Custom URL Slug</label>
                        <input type="text" name="slug" id="slug-input" class="form-control" value="<?php echo e($editing_blog['slug'] ?? ''); ?>">
                        <span id="slug-preview" class="text-secondary small font-monospace d-block mt-1">/blogs/detail?slug=...</span>
                    </div>
                    <div class="col-12">
                        <label class="form-label">SEO Title Override</label>
                        <input type="text" name="seo_title" id="seo-title" class="form-control" value="<?php echo e($editing_blog['seo_title'] ?? ''); ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">SEO Keywords</label>
                        <input type="text" name="seo_keywords" class="form-control" value="<?php echo e($editing_blog['seo_keywords'] ?? ''); ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">SEO Meta Description</label>
                        <textarea name="seo_description" rows="2" class="form-control"><?php echo e($editing_blog['seo_description'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning-custom px-5 py-2.5">
                <i class="bi bi-check2-circle me-1"></i> <?php echo $editing_blog ? 'Save Article Changes' : 'Publish Article'; ?>
            </button>
        </div>

        <!-- Right: Publishing Options & Media Attachments -->
        <div class="col-lg-4">
            <div class="card admin-card p-4 mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="h6 fw-bold text-dark mb-0 font-title"><i class="bi bi-sliders text-accent me-2"></i>Taxonomy</h3>
                    <span id="taxonomy-badge" class="badge bg-secondary-subtle text-secondary small px-2 py-1">Standard</span>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <?php $current_cat = $editing_blog['category'] ?? 'Blog'; ?>
                    <select name="category" id="category-select" class="form-select fw-semibold">
                        <option value="Blog" <?php echo ($current_cat === 'Blog') ? 'selected' : ''; ?>>📰 Blog Article</option>
                        <option value="Tech News" <?php echo ($current_cat === 'Tech News') ? 'selected' : ''; ?>>⚡ Tech News &amp; Updates</option>
                        <option value="React.js" <?php echo ($current_cat === 'React.js') ? 'selected' : ''; ?>>⚛️ React.js &amp; Next.js</option>
                        <option value="JavaScript" <?php echo ($current_cat === 'JavaScript') ? 'selected' : ''; ?>>🟨 Modern JavaScript (ES2026)</option>
                        <option value="SharePoint SPFx" <?php echo ($current_cat === 'SharePoint SPFx') ? 'selected' : ''; ?>>💼 SharePoint SPFx</option>
                        <option value="Web Performance" <?php echo ($current_cat === 'Web Performance') ? 'selected' : ''; ?>>🚀 Web Performance</option>
                        <option value="Tutorial" <?php echo ($current_cat === 'Tutorial') ? 'selected' : ''; ?>>🎓 Technical Tutorial</option>
                        <option value="Career" <?php echo ($current_cat === 'Career') ? 'selected' : ''; ?>>💡 Career &amp; Insights</option>
                        <option value="Job" <?php echo ($current_cat === 'Job') ? 'selected' : ''; ?>>💼 Job Opportunity</option>
                        <option value="custom" <?php echo (!in_array($current_cat, ['Blog', 'Tech News', 'React.js', 'JavaScript', 'SharePoint SPFx', 'Web Performance', 'Tutorial', 'Career', 'Job'])) ? 'selected' : ''; ?>>✏️ Custom Category...</option>
                    </select>
                </div>

                <!-- Custom Category Input (shown if Custom selected) -->
                <div class="mb-3" id="custom-category-wrapper" style="<?php echo (!in_array($current_cat, ['Blog', 'Tech News', 'React.js', 'JavaScript', 'SharePoint SPFx', 'Web Performance', 'Tutorial', 'Career', 'Job'])) ? '' : 'display: none;'; ?>">
                    <label class="form-label">Custom Category Name</label>
                    <input type="text" name="custom_category" id="custom-category-input" class="form-control" placeholder="Enter custom category..." value="<?php echo e($current_cat); ?>">
                </div>

                <div>
                    <label class="form-label">Tags (comma-separated)</label>
                    <input type="text" name="tags" id="tags-input" class="form-control mb-2" placeholder="React, Performance, Hooks" value="<?php echo ($editing_blog && is_array($editing_blog['tags'])) ? e(implode(', ', $editing_blog['tags'])) : ''; ?>">
                    
                    <!-- Quick Tag Chips Helper -->
                    <div class="small text-secondary mb-1">Quick Tag Suggestions:</div>
                    <div class="d-flex flex-wrap gap-1" id="tag-suggestions">
                        <span class="badge bg-light text-dark border cursor-pointer tag-chip" data-tag="React 19">+ React 19</span>
                        <span class="badge bg-light text-dark border cursor-pointer tag-chip" data-tag="Next.js">+ Next.js</span>
                        <span class="badge bg-light text-dark border cursor-pointer tag-chip" data-tag="JavaScript">+ JavaScript</span>
                        <span class="badge bg-light text-dark border cursor-pointer tag-chip" data-tag="SPFx">+ SPFx</span>
                        <span class="badge bg-light text-dark border cursor-pointer tag-chip" data-tag="Web Performance">+ Web Performance</span>
                        <span class="badge bg-light text-dark border cursor-pointer tag-chip" data-tag="GA4 Bug">+ GA4 Bug</span>
                        <span class="badge bg-light text-dark border cursor-pointer tag-chip" data-tag="SEO News">+ SEO News</span>
                    </div>
                </div>
            </div>

            <div class="card admin-card p-4 mb-4">
                <h3 class="h6 fw-bold text-dark mb-3 font-title"><i class="bi bi-image-fill text-accent me-2"></i>Cover Image</h3>
                <?php if ($editing_blog && !empty($editing_blog['image'])): ?>
                    <div class="mb-3 text-center">
                        <img src="<?php echo BASE_URL . e($editing_blog['image']); ?>" alt="<?php echo e($editing_blog['title'] ?? 'Article'); ?> Cover Image" title="<?php echo e($editing_blog['title'] ?? 'Article'); ?> Cover Image" class="rounded-3 border border-secondary-subtle w-100" style="max-height: 140px; object-fit: cover;">
                    </div>
                <?php endif; ?>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="card admin-card p-4 mb-4">
                <h3 class="h6 fw-bold text-dark mb-3 font-title"><i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>PDF Document</h3>
                <?php if ($editing_blog && !empty($editing_blog['pdf'])): ?>
                    <div class="mb-2 text-secondary small">
                        <i class="bi bi-check-circle-fill text-success me-1"></i> Current document attached
                    </div>
                <?php endif; ?>
                <input type="file" name="pdf" class="form-control" accept="application/pdf">
            </div>

            <div class="card admin-card p-4">
                <h3 class="h6 fw-bold text-dark mb-3 font-title"><i class="bi bi-play-btn-fill text-success me-2"></i>Video Clip</h3>
                <?php if ($editing_blog && !empty($editing_blog['video'])): ?>
                    <div class="mb-2 text-secondary small">
                        <i class="bi bi-check-circle-fill text-success me-1"></i> Current video attached
                    </div>
                <?php endif; ?>
                <input type="file" name="video" class="form-control" accept="video/mp4,video/webm">
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category-select');
    const customCategoryWrapper = document.getElementById('custom-category-wrapper');
    const jobFields = document.getElementById('fields-for-job');
    const techFields = document.getElementById('fields-for-tech');
    const taxonomyBadge = document.getElementById('taxonomy-badge');
    const tagsInput = document.getElementById('tags-input');

    function updateTaxonomyFields() {
        const cat = categorySelect.value;
        
        // Show/hide custom category input
        if (cat === 'custom') {
            customCategoryWrapper.style.display = 'block';
        } else {
            customCategoryWrapper.style.display = 'none';
        }

        // Show/hide Job Coordinates
        if (cat === 'Job') {
            jobFields.style.display = 'block';
            taxonomyBadge.textContent = 'Job Opportunity';
            taxonomyBadge.className = 'badge bg-success-subtle text-success small px-2 py-1';
        } else {
            jobFields.style.display = 'none';
        }

        // Show/hide Tech References
        if (['Tech News', 'Tutorial', 'React.js', 'JavaScript', 'SharePoint SPFx', 'Web Performance'].includes(cat)) {
            techFields.style.display = 'block';
            taxonomyBadge.textContent = cat;
            taxonomyBadge.className = 'badge bg-primary-subtle text-primary small px-2 py-1';
        } else if (cat !== 'Job') {
            techFields.style.display = 'none';
            taxonomyBadge.textContent = cat === 'custom' ? 'Custom' : cat;
            taxonomyBadge.className = 'badge bg-secondary-subtle text-secondary small px-2 py-1';
        }
    }

    if (categorySelect) {
        categorySelect.addEventListener('change', updateTaxonomyFields);
        updateTaxonomyFields(); // Initial run
    }

    // Quick Tag Chips Click Handler
    document.querySelectorAll('.tag-chip').forEach(chip => {
        chip.addEventListener('click', function() {
            const tag = this.getAttribute('data-tag');
            let currentTags = tagsInput.value.split(',').map(t => t.trim()).filter(Boolean);
            if (!currentTags.includes(tag)) {
                currentTags.push(tag);
                tagsInput.value = currentTags.join(', ');
            }
        });
    });
});
</script>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
