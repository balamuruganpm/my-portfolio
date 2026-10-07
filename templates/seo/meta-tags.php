<?php
/**
 * SEO: Open Graph & Twitter Meta Tags
 */
$share_img_rel = 'assets/images/bala-og-image.webp';
if (!empty($post) && !empty($post['image'])) {
    $share_img_rel = $post['image'];
}
$og_share_image = BASE_URL . $share_img_rel;
?>
<!-- Open Graph (OG) / Facebook Metadata -->
<meta property="og:title" content="<?php echo e($meta_title); ?>">
<meta property="og:description" content="<?php echo e($meta_description); ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Balamurugan P M Portfolio">
<meta property="og:image" content="<?php echo e($og_share_image); ?>">
<meta property="og:url" content="<?php echo e(CANONICAL_URL); ?>">
<meta property="og:locale" content="en_US">

<!-- Twitter Card Metadata -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@balaselfie_bd">
<meta name="twitter:title" content="<?php echo e($meta_title); ?>">
<meta name="twitter:description" content="<?php echo e($meta_description); ?>">
<meta name="twitter:image" content="<?php echo e($og_share_image); ?>">
<meta name="theme-color" content="#ff5722">
