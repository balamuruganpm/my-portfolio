<?php
/**
 * Dynamic XML Sitemap Generator
 * Uses SITE_URL constant and clean URLs
 */
header('Content-Type: application/xml; charset=utf-8');

define('PAGE_DEPTH', 0);
require_once __DIR__ . '/config/bootstrap.php';

$blogs = loadBlogs();

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

    <!-- Homepage -->
    <url>
        <loc><?php echo SITE_URL; ?></loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
        <image:image>
            <image:loc><?php echo SITE_URL; ?>assets/images/balamurugan-pm.webp</image:loc>
            <image:title><?php echo e($profileName); ?> Portfolio Avatar</image:title>
        </image:image>
    </url>

    <!-- About Page -->
    <url>
        <loc><?php echo SITE_URL; ?>about</loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <!-- Portfolio Page -->
    <url>
        <loc><?php echo SITE_URL; ?>portfolio</loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <!-- Blogs List Page -->
    <url>
        <loc><?php echo SITE_URL; ?>blogs</loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.90</priority>
    </url>

    <!-- Contact Page -->
    <url>
        <loc><?php echo SITE_URL; ?>contact</loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>

    <!-- Programmatic SEO (pSEO) Category Hubs -->
    <?php
    $pseo_file = ADMIN_DATA_PATH . 'pseo_topics.json';
    if (file_exists($pseo_file)) {
        $topics = json_decode(file_get_contents($pseo_file), true) ?? [];
        foreach ($topics as $top):
            $catUrl = SITE_URL . 'blogs/category?name=' . $top['slug'];
    ?>
        <url>
            <loc><?php echo htmlspecialchars($catUrl); ?></loc>
            <lastmod><?php echo date('Y-m-d'); ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.85</priority>
        </url>
    <?php 
        endforeach;
    } 
    ?>

    <!-- Dynamic Blog Articles & Media -->
    <?php foreach ($blogs as $blog): 
        $blogUrl = !empty($blog['slug']) ? (SITE_URL . 'blogs/detail?slug=' . $blog['slug']) : (SITE_URL . 'blogs/detail?id=' . $blog['id']);
        $blogDate = !empty($blog['date']) ? date('Y-m-d', strtotime($blog['date'])) : date('Y-m-d');
    ?>
        <url>
            <loc><?php echo htmlspecialchars($blogUrl); ?></loc>
            <lastmod><?php echo $blogDate; ?></lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.80</priority>
            <?php if (!empty($blog['image'])): ?>
                <image:image>
                    <image:loc><?php echo SITE_URL . htmlspecialchars($blog['image']); ?></image:loc>
                    <image:title><?php echo htmlspecialchars($blog['title']); ?> Cover Image</image:title>
                </image:image>
            <?php endif; ?>
        </url>
    <?php endforeach; ?>

</urlset>
