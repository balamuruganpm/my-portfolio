<?php
/**
 * Page: Portfolio Works
 */
if (!defined('PAGE_DEPTH')) {
    define('PAGE_DEPTH', 1);
}

$pageTitle = "Portfolio Works | Balamurugan P M";
$thisPage = "Portfolio";

require_once __DIR__ . '/../config/bootstrap.php';

include BASE_PATH . 'templates/layout/head.php';
include BASE_PATH . 'templates/layout/body-start.php';
include BASE_PATH . 'templates/partials/navigation.php';

include BASE_PATH . 'templates/sections/portfolio-grid.php';

include BASE_PATH . 'templates/layout/footer.php';
include BASE_PATH . 'templates/layout/body-end.php';
