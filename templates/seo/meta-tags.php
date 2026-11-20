<?php
/**
 * SEO: Open Graph & Twitter Meta Tags (Top SEO / AEO / Social Graphs)
 */
$share_img_rel = 'assets/images/bala-og-image.webp';
$og_type = 'website';

if (!empty($post) && !empty($post['title'])) {
    $og_type = 'article';
    if (!empty($post['image'])) {
        $share_img_rel = ltrim($post['image'], '/');
    }
} elseif (isset($thisPage) && strtolower($thisPage) === 'about') {
    $og_type = 'profile';
}

$og_share_image = BASE_URL . $share_img_rel;
?>
<!-- Open Graph (OG) / Facebook Metadata -->
<meta property="og:title" content="<?php echo e($meta_title); ?>">
<meta property="og:description" content="<?php echo e($meta_description); ?>">
<meta property="og:type" content="<?php echo e($og_type); ?>">
<meta property="og:site_name" content="Balamurugan P M | Frontend &amp; Enterprise SPFx Portfolio">
<meta property="og:image" content="<?php echo e($og_share_image); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?php echo e($meta_title); ?>">
<meta property="og:url" content="<?php echo e(CANONICAL_URL); ?>">
<meta property="og:locale" content="en_US">

<?php if ($og_type === 'article' && !empty($post)): ?>
<meta property="article:published_time" content="<?php echo date('c', strtotime($post['date'] ?? 'now')); ?>">
<meta property="article:author" content="<?php echo e($profileName ?? 'Balamurugan P M'); ?>">
<meta property="article:section" content="<?php echo e($post['category'] ?? 'Technology'); ?>">
<?php if (!empty($post['tags']) && is_array($post['tags'])): ?>
<?php foreach ($post['tags'] as $tg): ?>
<meta property="article:tag" content="<?php echo e($tg); ?>">
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>

<!-- Twitter Card Metadata -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@balaselfie_bd">
<meta name="twitter:creator" content="@balaselfie_bd">
<meta name="twitter:title" content="<?php echo e($meta_title); ?>">
<meta name="twitter:description" content="<?php echo e($meta_description); ?>">
<meta name="twitter:image" content="<?php echo e($og_share_image); ?>">
<meta name="twitter:image:alt" content="<?php echo e($meta_title); ?>">
<meta name="theme-color" content="#0d0d12">
