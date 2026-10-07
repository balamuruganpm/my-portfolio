<?php
/**
 * Layout: Document Head (<head>)
 * Meta tags, CSS styles, fonts, favicons, SEO scripts, and Schema.org JSON-LD
 */
$meta_title = !empty($pageTitle) ? $pageTitle : (!empty($homeTitle) ? $homeTitle : 'Balamurugan P M | Frontend Developer & UI/UX Designer');
$meta_description = !empty($pageMetaDescription) ? $pageMetaDescription : (!empty($homeDesc) ? $homeDesc : 'Balamurugan P M is a Frontend Developer and UI/UX Designer from Tamil Nadu, specializing in React.js, JavaScript, responsive web development, SharePoint SPFx, and Figma.');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo e($meta_title); ?></title>
    <meta name="description" content="<?php echo e($meta_description); ?>">
    <?php if (!empty($pageMetaKeywords)): ?>
        <meta name="keywords" content="<?php echo e($pageMetaKeywords); ?>">
    <?php else: ?>
        <meta name="keywords" content="Balamurugan P M, Frontend Developer, React.js, JavaScript, SPFx, SharePoint, UI/UX Designer, Web Developer Portfolio, Web Performance">
    <?php endif; ?>
    <meta name="author" content="<?php echo e(!empty($profileName) ? $profileName : 'Balamurugan P M'); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta http-equiv="content-language" content="en">
    <link rel="alternate" hreflang="en" href="<?php echo e(CANONICAL_URL); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo e(CANONICAL_URL); ?>">

    <!-- Open Graph & Twitter Cards -->
    <?php include_once BASE_PATH . 'templates/seo/meta-tags.php'; ?>

    <!-- Preconnect to external asset domains -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Preload Critical Web Fonts & Hero Avatar (Accelerates LCP, FCP & eliminates CLS) -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/fonts/bootstrap-icons.woff2?dd67030699838ea613ee6dbda90effa6" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo BASE_URL; ?>assets/images/balamurugan-pm.webp" as="image" type="image/webp" fetchpriority="high">

    <link rel="canonical" href="<?php echo e(CANONICAL_URL); ?>">

    <!-- Google Fonts (Modern Tech & Coder Fonts) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Style Sheets (Cache-busted) -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.min.css?v=<?php echo CSS_VERSION; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/responsive.css?v=<?php echo CSS_VERSION; ?>">

    <!-- Favicons & Mobile Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="48x48" href="<?php echo BASE_URL; ?>favicon-48x48.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo BASE_URL; ?>favicon-96x96.png">
    <link rel="icon" type="image/svg+xml" href="<?php echo BASE_URL; ?>favicon.svg">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>apple-touch-icon.png">
    <meta name="apple-mobile-web-app-title" content="Bala">
    <link rel="manifest" href="<?php echo BASE_URL; ?>site.webmanifest">

    <!-- LLM, RSS, AEO & GEO Discovery Links -->
    <link rel="alternate" type="application/rss+xml" title="<?php echo e($profileName); ?> Technical RSS Feed" href="<?php echo BASE_URL; ?>rss.xml">
    <link rel="alternate" type="text/plain" title="LLM Digest" href="<?php echo BASE_URL; ?>llms.txt">
    <link rel="alternate" type="text/plain" title="AI Index" href="<?php echo BASE_URL; ?>ai.txt">

    <!-- Analytics Tracking Scripts -->
    <?php include_once BASE_PATH . 'templates/seo/analytics.php'; ?>

    <!-- Structured JSON-LD Schema -->
    <?php include_once BASE_PATH . 'templates/seo/schema.php'; ?>

    <?php 
    // Render Adcash AutoTag scripts only if ads are enabled in Admin Profile Settings AND user is on Game or Blog pages
    $_reqUri = strtolower($_SERVER['REQUEST_URI'] ?? '');
    $_isGamePage = (isset($thisPage) && $thisPage === 'Arcade') || strpos($_reqUri, '/game') !== false || strpos($_reqUri, '/arcade') !== false;
    $_isBlogPage = (isset($thisPage) && ($thisPage === 'Blogs' || $thisPage === 'Category')) || strpos($_reqUri, '/blog') !== false || strpos($_reqUri, '/category') !== false;
    if (!empty($adsEnabled) && ($_isGamePage || $_isBlogPage)): 
    ?>
    <!-- Adcash AutoTag Scripts (Game & Blog pages only) -->
    <script id="aclib" type="text/javascript" src="//acscdn.com/script/aclib.js"></script>
    <script type="text/javascript">
        aclib.runAutoTag({
            zoneId: '6vzmj1asna',
        });
    </script>
    <?php endif; ?>
</head>
