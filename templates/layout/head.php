<?php
/**
 * Layout: Document Head (<head>)
 * Single-Viewport OS Portfolio Architecture
 */
$meta_title = !empty($pageTitle) ? $pageTitle : (!empty($homeTitle) ? $homeTitle : 'Balamurugan P M | Frontend Developer & UI/UX Designer');
$meta_description = !empty($pageMetaDescription) ? $pageMetaDescription : (!empty($homeDesc) ? $homeDesc : 'Balamurugan P M is a Frontend Developer specializing in React.js, JavaScript, SPFx, SharePoint Online, and modern web applications in Tamil Nadu, India.');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">

    <title><?php echo e($meta_title); ?></title>
    <meta name="description" content="<?php echo e($meta_description); ?>">
    <?php if (!empty($pageMetaKeywords)): ?>
        <meta name="keywords" content="<?php echo e($pageMetaKeywords); ?>">
    <?php else: ?>
        <meta name="keywords" content="Balamurugan P M, Frontend Developer, React.js, JavaScript, SPFx, SharePoint, UI/UX Designer, Web Developer Portfolio, Web Performance">
    <?php endif; ?>
    <meta name="author" content="<?php echo e(!empty($profileName) ? $profileName : 'Balamurugan P M'); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta http-equiv="content-language" content="en">
    
    <!-- Geo & Local Entity Metadata (Top GEO Optimization) -->
    <meta name="geo.region" content="IN-TN">
    <meta name="geo.placename" content="Coimbatore, Tamil Nadu, India">
    <meta name="geo.position" content="11.0168;76.9558">
    <meta name="ICBM" content="11.0168, 76.9558">

    <link rel="alternate" hreflang="en" href="<?php echo e(CANONICAL_URL); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo e(CANONICAL_URL); ?>">

    <!-- AI & Generative Search Manifests (Top GEO/AEO) -->
    <link rel="author" type="text/plain" href="<?php echo BASE_URL; ?>llms.txt" title="LLM Context Manifest">
    <link rel="alternate" type="application/rss+xml" title="Balamurugan P M Tech RSS Feed" href="<?php echo BASE_URL; ?>rss.xml">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="<?php echo BASE_URL; ?>sitemap.xml">

    <!-- Open Graph & Twitter Cards -->
    <?php include_once BASE_PATH . 'templates/seo/meta-tags.php'; ?>

    <!-- Preconnect to external asset domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="canonical" href="<?php echo e(CANONICAL_URL); ?>">

    <!-- Google Fonts (Curated Multi-Font Typography Hierarchy) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Caveat:wght@500;600;700&family=Fira+Code:wght@400;500;600;700&family=Great+Vibes&family=Outfit:wght@400;500;600;700;800;900&family=Pinyon+Script&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Syne:wght@700;800&display=swap">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Preload Critical Background Video -->
    <link rel="preload" href="<?php echo BASE_URL; ?>assets/images/os/home-bg.mp4" as="video" type="video/mp4">

    <!-- Custom OS Stylesheets -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css?v=<?php echo CSS_VERSION; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/responsive.css?v=<?php echo CSS_VERSION; ?>">

    <!-- Favicons & Mobile Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="48x48" href="<?php echo BASE_URL; ?>favicon-48x48.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>apple-touch-icon.png">
    <link rel="manifest" href="<?php echo BASE_URL; ?>site.webmanifest">
    <meta name="theme-color" content="#0d0d12">

    <!-- Structured Data Schema.org JSON-LD -->
    <?php include_once BASE_PATH . 'templates/seo/schema.php'; ?>
</head>
