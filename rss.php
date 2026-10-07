<?php
/**
 * Dynamic RSS 2.0 Feed Generator
 * Serves structured RSS XML for search engine indexers and news feed readers
 */
header('Content-Type: application/rss+xml; charset=utf-8');

define('PAGE_DEPTH', 0);
require_once __DIR__ . '/config/bootstrap.php';

$blogs = loadBlogs();

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/">
  <channel>
    <title><?php echo htmlspecialchars($profileName); ?> | Technical News &amp; Insights</title>
    <link><?php echo SITE_URL; ?></link>
    <description>Daily technical updates, frontend insights, React.js, JavaScript performance, and web design tips by <?php echo htmlspecialchars($profileName); ?>.</description>
    <language>en-us</language>
    <pubDate><?php echo date(DATE_RSS); ?></pubDate>
    <lastBuildDate><?php echo date(DATE_RSS); ?></lastBuildDate>
    <atom:link href="<?php echo SITE_URL; ?>rss.xml" rel="self" type="application/rss+xml" />

    <?php foreach ($blogs as $blog): 
        $blogUrl = !empty($blog['slug']) ? (SITE_URL . 'blogs/detail?slug=' . $blog['slug']) : (SITE_URL . 'blogs/detail?id=' . $blog['id']);
        $blogDate = !empty($blog['date']) ? date(DATE_RSS, strtotime($blog['date'])) : date(DATE_RSS);
        $title = !empty($blog['title']) ? $blog['title'] : 'Technical Post';
        $snippet = !empty($blog['snippet']) ? $blog['snippet'] : (!empty($blog['content']) ? substr(strip_tags($blog['content']), 0, 200) . '...' : '');
        $image = !empty($blog['image']) ? (SITE_URL . $blog['image']) : (SITE_URL . 'assets/images/balamurugan-pm.webp');
    ?>
    <item>
      <title><?php echo htmlspecialchars($title); ?></title>
      <link><?php echo htmlspecialchars($blogUrl); ?></link>
      <guid isPermaLink="true"><?php echo htmlspecialchars($blogUrl); ?></guid>
      <pubDate><?php echo $blogDate; ?></pubDate>
      <description><?php echo htmlspecialchars($snippet); ?></description>
      <content:encoded><![CDATA[<?php echo !empty($blog['content']) ? $blog['content'] : $snippet; ?>]]></content:encoded>
      <media:content url="<?php echo htmlspecialchars($image); ?>" medium="image" />
    </item>
    <?php endforeach; ?>
  </channel>
</rss>
