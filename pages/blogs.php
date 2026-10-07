<?php
/**
 * Page: Blogs & Articles Listing
 */
if (!defined('PAGE_DEPTH')) {
    define('PAGE_DEPTH', 1);
}

$pageTitle = "Blogs & Articles | Balamurugan P M";
$thisPage = "Blogs";

require_once __DIR__ . '/../config/bootstrap.php';

include BASE_PATH . 'templates/layout/head.php';
include BASE_PATH . 'templates/layout/body-start.php';
include BASE_PATH . 'templates/partials/navigation.php';

include BASE_PATH . 'templates/sections/blog-listing.php';

include BASE_PATH . 'templates/layout/footer.php';
include BASE_PATH . 'templates/layout/body-end.php';
