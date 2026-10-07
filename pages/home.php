<?php
/**
 * Legacy Wrapper: Home Page
 */
require_once __DIR__ . '/../config/bootstrap.php';
$app = \App\Core\App::getInstance();
$controller = new \App\Controllers\HomeController(
    new \App\Core\View(BASE_PATH),
    new \App\Services\ProfileService(new \App\Services\DataService(ADMIN_DATA_PATH)),
    new \App\Services\BlogService(new \App\Services\DataService(ADMIN_DATA_PATH)),
    new \App\Services\PortfolioService(new \App\Services\DataService(ADMIN_DATA_PATH)),
    new \App\Services\MessageService(new \App\Services\DataService(ADMIN_DATA_PATH))
);
$controller->index();
