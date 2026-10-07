<?php
/**
 * Root Index & Clean URL Router
 * Dispatches clean URL paths to the appropriate page controller.
 */
define('PAGE_DEPTH', 0);

// Determine the web subfolder path if any (e.g., /Projects All/my-portfolio)
$_scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
if ($_scriptDir === '.' || $_scriptDir === '/') {
    $_scriptDir = '';
}

// Decode URL path to handle URL-encoded spaces (%20) and directory names
$_rawUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$_requestUri = urldecode($_rawUri);

// Strip the base directory from the request URI to get the relative route
if (!empty($_scriptDir) && strpos($_requestUri, $_scriptDir) === 0) {
    $_route = substr($_requestUri, strlen($_scriptDir));
} else {
    $_route = $_requestUri;
}

$_route = trim(strtolower($_route), '/');

// Route matching
switch ($_route) {
    case '':
    case 'home':
    case 'index':
    case 'index.php':
        require __DIR__ . '/pages/home.php';
        break;

    case 'about':
    case 'about-us':
    case 'about.php':
        require __DIR__ . '/pages/about.php';
        break;

    case 'portfolio':
    case 'portfolio.php':
        require __DIR__ . '/pages/portfolio.php';
        break;

    case 'blogs':
    case 'blogs.php':
        require __DIR__ . '/pages/blogs.php';
        break;

    case 'blogs/detail':
    case 'blogs/details':
    case 'blog-detail':
    case 'blog-detail.php':
        require __DIR__ . '/pages/blog-detail.php';
        break;

    case 'blogs/category':
    case 'blogs/category.php':
    case 'category':
        require __DIR__ . '/pages/category.php';
        break;

    case 'contact':
    case 'contact-us':
    case 'contact.php':
        require __DIR__ . '/pages/contact.php';
        break;

    case 'game':
    case 'games':
    case 'game.php':
    case 'arcade':
        require __DIR__ . '/pages/game.php';
        break;

    case 'sitemap.xml':
    case 'sitemap':
    case 'sitemap.php':
        require __DIR__ . '/sitemap.php';
        break;

    case 'news-sitemap.xml':
    case 'news-sitemap':
    case 'news-sitemap.php':
        require __DIR__ . '/news-sitemap.php';
        break;

    case 'rss.xml':
    case 'rss':
    case 'rss.php':
    case 'feed':
    case 'feed.xml':
        require __DIR__ . '/rss.php';
        break;

    case 'llms.txt':
    case 'llms':
    case 'llms.php':
        require __DIR__ . '/llms.php';
        break;

    case 'ai.txt':
    case 'ai':
    case 'ai.php':
        require __DIR__ . '/ai.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/pages/home.php';
        break;
}
