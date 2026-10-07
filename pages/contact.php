<?php
/**
 * Page: Contact Us
 */
if (!defined('PAGE_DEPTH')) {
    define('PAGE_DEPTH', 1);
}

$pageTitle = "Contact Us | Balamurugan P M";
$thisPage = "Contact Us";

require_once __DIR__ . '/../config/bootstrap.php';
require_once BASE_PATH . 'includes/contact-handler.php';

include BASE_PATH . 'templates/layout/head.php';
include BASE_PATH . 'templates/layout/body-start.php';
include BASE_PATH . 'templates/partials/navigation.php';

include BASE_PATH . 'templates/sections/contact-form.php';

include BASE_PATH . 'templates/layout/footer.php';
include BASE_PATH . 'templates/layout/body-end.php';
