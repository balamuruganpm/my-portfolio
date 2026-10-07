<?php
/**
 * Page: About Us
 */
if (!defined('PAGE_DEPTH')) {
    define('PAGE_DEPTH', 1);
}

$pageTitle = "About Me | Balamurugan P M";
$thisPage = "About Us";

require_once __DIR__ . '/../config/bootstrap.php';

include BASE_PATH . 'templates/layout/head.php';
include BASE_PATH . 'templates/layout/body-start.php';
include BASE_PATH . 'templates/partials/navigation.php';

include BASE_PATH . 'templates/sections/about-intro.php';
include BASE_PATH . 'templates/sections/skills.php';
include BASE_PATH . 'templates/sections/experience-timeline.php';
include BASE_PATH . 'templates/sections/education.php';
include BASE_PATH . 'templates/sections/awards.php';
include BASE_PATH . 'templates/sections/certificates.php';

include BASE_PATH . 'templates/layout/footer.php';
include BASE_PATH . 'templates/layout/body-end.php';
