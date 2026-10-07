<?php
/**
 * Dynamic Google News XML Sitemap Generator
 * Formatted for Google News crawling and rapid indexation of tech articles
 */
header('Content-Type: application/xml; charset=utf-8');

define('PAGE_DEPTH', 0);
require_once __DIR__ . '/config/bootstrap.php';

$blogs = loadBlogs();

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

    <?php foreach ($blogs as $blog): 
        $blogUrl = !empty($blog['slug']) ? (SITE_URL . 'blogs/detail?slug=' . $blog['slug']) : (SITE_URL . 'blogs/detail?id=' . $blog['id']);
        $blogDate = !empty($blog['date']) ? date('Y-m-d\TH:i:sP', strtotime($blog['date'])) : date('c');
        $title = !empty($blog['title']) ? $blog['title'] : 'Technical Update';
        $keywords = !empty($blog['seo_keywords']) ? $blog['seo_keywords'] : 'Web Development, React, JavaScript, Tech News';
    ?>
    <url>
        <loc><?php echo htmlspecialchars($blogUrl); ?></loc>
        <news:news>
            <news:publication>
                <news:name><?php echo htmlspecialchars($profileName); ?> Tech Insights</news:name>
                <news:language>en</news:language>
            </news:publication>
            <news:publication_date><?php echo $blogDate; ?></news:publication_date>
            <news:title><?php echo htmlspecialchars($title); ?></news:title>
            <news:keywords><?php echo htmlspecialchars($keywords); ?></news:keywords>
        </news:news>
        <?php if (!empty($blog['image'])): ?>
            <image:image>
                <image:loc><?php echo SITE_URL . htmlspecialchars($blog['image']); ?></image:loc>
                <image:title><?php echo htmlspecialchars($title); ?></image:title>
            </image:image>
        <?php endif; ?>
    </url>
    <?php endforeach; ?>

</urlset>
