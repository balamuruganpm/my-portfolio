<?php
/**
 * Front Controller & MVC Router Dispatcher
 * Native PHP High-Performance Portfolio Architecture
 */

require_once __DIR__ . '/config/bootstrap.php';

use App\Core\App;
use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\PortfolioController;
use App\Controllers\BlogController;
use App\Controllers\ContactController;
use App\Controllers\ArcadeController;
use App\Controllers\SeoController;

$app = App::getInstance();
$router = $app->getRouter();

// Home Routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);
$router->get('/index', [HomeController::class, 'index']);
$router->get('/index.php', [HomeController::class, 'index']);

// About Routes
$router->get('/about', [AboutController::class, 'index']);
$router->get('/about-us', [AboutController::class, 'index']);
$router->get('/about.php', [AboutController::class, 'index']);

// Portfolio Routes
$router->get('/portfolio', [PortfolioController::class, 'index']);
$router->get('/portfolio.php', [PortfolioController::class, 'index']);

// Blog Routes (Clean URL & Slug support)
$router->get('/blogs', [BlogController::class, 'index']);
$router->get('/blogs.php', [BlogController::class, 'index']);
$router->get('/blogs/{slug}', [BlogController::class, 'detail']);
$router->get('/category/{category}', [BlogController::class, 'category']);
$router->get('/category', [BlogController::class, 'category']);
$router->get('/blogs/detail', [BlogController::class, 'detail']);
$router->get('/blog-detail', [BlogController::class, 'detail']);
$router->get('/blog-detail.php', [BlogController::class, 'detail']);
$router->post('/blogs/{slug}', [BlogController::class, 'detail']);
$router->post('/blogs/detail', [BlogController::class, 'detail']);
$router->post('/blog-detail.php', [BlogController::class, 'detail']);

// Contact Routes
$router->get('/contact', [ContactController::class, 'index']);
$router->get('/contact-us', [ContactController::class, 'index']);
$router->get('/contact.php', [ContactController::class, 'index']);
$router->post('/contact', [ContactController::class, 'index']);
$router->post('/contact-us', [ContactController::class, 'index']);
$router->post('/contact.php', [ContactController::class, 'index']);

// Game & Arcade Routes
$router->get('/game', [ArcadeController::class, 'index']);
$router->get('/games', [ArcadeController::class, 'index']);
$router->get('/game.php', [ArcadeController::class, 'index']);
$router->get('/arcade', [ArcadeController::class, 'index']);

// SEO & AI Manifest Routes
$router->get('/sitemap.xml', [SeoController::class, 'sitemap']);
$router->get('/sitemap', [SeoController::class, 'sitemap']);
$router->get('/sitemap.php', [SeoController::class, 'sitemap']);

$router->get('/news-sitemap.xml', [SeoController::class, 'newsSitemap']);
$router->get('/news-sitemap', [SeoController::class, 'newsSitemap']);
$router->get('/news-sitemap.php', [SeoController::class, 'newsSitemap']);

$router->get('/rss.xml', [SeoController::class, 'rss']);
$router->get('/rss', [SeoController::class, 'rss']);
$router->get('/rss.php', [SeoController::class, 'rss']);
$router->get('/feed', [SeoController::class, 'rss']);

$router->get('/llms.txt', [SeoController::class, 'llms']);
$router->get('/llms', [SeoController::class, 'llms']);
$router->get('/llms.php', [SeoController::class, 'llms']);

$router->get('/ai.txt', [SeoController::class, 'ai']);
$router->get('/ai', [SeoController::class, 'ai']);
$router->get('/ai.php', [SeoController::class, 'ai']);

// Dispatch Application
$app->run();
