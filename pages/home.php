<?php
/**
 * Page: Home
 */
if (!defined('PAGE_DEPTH')) {
    define('PAGE_DEPTH', 1);
}

$pageTitle = "Balamurugan P M | Frontend Developer | React.js | JavaScript | SPFx";
$thisPage = "Home";

require_once __DIR__ . '/../config/bootstrap.php';

include BASE_PATH . 'templates/layout/head.php';
include BASE_PATH . 'templates/layout/body-start.php';
include BASE_PATH . 'templates/partials/navigation.php';

include BASE_PATH . 'templates/sections/home-bento.php';
include BASE_PATH . 'templates/sections/tech-news.php';

include BASE_PATH . 'templates/layout/footer.php';
include BASE_PATH . 'templates/layout/body-end.php';
