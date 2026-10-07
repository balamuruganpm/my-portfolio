<?php
/**
 * SEO & Search Engine Indexing Dispatcher
 * Submits live sitemap URLs to Google and Bing IndexNow for instant crawling & indexing.
 */

define('PAGE_DEPTH', 0);
require_once __DIR__ . '/config/bootstrap.php';

$blogs = loadBlogs();

// Collect all indexable URLs
$urlsToIndex = [
    SITE_URL,
    SITE_URL . 'about',
    SITE_URL . 'portfolio',
    SITE_URL . 'blogs',
    SITE_URL . 'contact'
];

foreach ($blogs as $b) {
    if (!empty($b['slug'])) {
        $urlsToIndex[] = SITE_URL . 'blogs/detail?slug=' . urlencode($b['slug']);
    } else {
        $urlsToIndex[] = SITE_URL . 'blogs/detail?id=' . $b['id'];
    }
}

$results = [];
$action = $_POST['action'] ?? ($_GET['action'] ?? '');
$isCli = (php_sapi_name() === 'cli');

if ($action === 'submit' || $isCli) {
    $sitemapUrl = SITE_URL . 'sitemap.xml';

    // 1. Ping Google Sitemap
    $googlePingUrl = 'https://www.google.com/ping?sitemap=' . urlencode($sitemapUrl);
    $ch = curl_init($googlePingUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 8);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    $googleResp = curl_exec($ch);
    $googleHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $results['google_ping'] = [
        'service' => 'Google Sitemap Ping',
        'target'  => $googlePingUrl,
        'code'    => $googleHttpCode,
        'status'  => ($googleHttpCode >= 200 && $googleHttpCode < 400) ? 'Success' : 'Submitted'
    ];

    // 2. IndexNow Protocol (Bing, Yandex, Seznam, Naver)
    $host = parse_url(SITE_URL, PHP_URL_HOST);
    $indexNowKey = md5($host . 'portfolio_index_key');
    $indexNowPayload = json_encode([
        'host'        => $host,
        'key'         => $indexNowKey,
        'keyLocation' => SITE_URL . $indexNowKey . '.txt',
        'urlList'     => array_values(array_unique($urlsToIndex))
    ], JSON_UNESCAPED_SLASHES);

    $ch = curl_init('https://api.indexnow.org/indexnow');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $indexNowPayload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json; charset=utf-8'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $indexNowResp = curl_exec($ch);
    $indexNowHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $results['indexnow'] = [
        'service'   => 'IndexNow (Bing / Yandex / Seznam)',
        'urlsCount' => count($urlsToIndex),
        'code'      => $indexNowHttpCode,
        'status'    => ($indexNowHttpCode === 200 || $indexNowHttpCode === 202) ? 'Success' : 'Submitted (Code ' . $indexNowHttpCode . ')'
    ];

    if ($isCli) {
        echo "=== SEO Indexing Results ===" . PHP_EOL;
        echo "Google Ping: " . $results['google_ping']['status'] . " (HTTP " . $results['google_ping']['code'] . ")" . PHP_EOL;
        echo "IndexNow: " . $results['indexnow']['status'] . " (" . $results['indexnow']['urlsCount'] . " URLs submitted)" . PHP_EOL;
        exit(0);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEO Indexing Request Tool | <?php echo e($profileName); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0f172a;
            padding: 3rem 1rem;
        }
        .seo-tool-card {
            max-width: 780px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 2.5rem;
        }
        .btn-accent {
            background: #ff5722;
            color: #ffffff;
            font-weight: 700;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-accent:hover {
            background: #ff7043;
            color: #ffffff;
            transform: translateY(-2px);
        }
        .url-pill {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.4rem 0.75rem;
            font-size: 0.82rem;
            font-family: monospace;
        }
    </style>
</head>
<body>

<div class="seo-tool-card">
    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
        <div class="d-flex align-items-center justify-content-center bg-warning-subtle text-warning rounded-3" style="width: 48px; height: 48px; font-size: 1.5rem; color: #ff5722 !important; background: rgba(255,87,34,0.1) !important;">
            <i class="bi bi-radar"></i>
        </div>
        <div>
            <h1 class="h4 fw-bold mb-0">Search Engine Indexing Dispatcher</h1>
            <p class="text-secondary small mb-0">Submit live portfolio URLs instantly to Google and Bing IndexNow</p>
        </div>
    </div>

    <?php if (!empty($results)): ?>
        <div class="alert alert-success border-0 rounded-4 p-4 mb-4" style="background: rgba(22, 163, 74, 0.1); color: #16a34a;">
            <h2 class="h6 fw-bold mb-2"><i class="bi bi-check-circle-fill me-2"></i>Indexing Submissions Dispatched</h2>
            <ul class="mb-0 small">
                <li><strong>Google Ping:</strong> <?php echo $results['google_ping']['status']; ?> (HTTP <?php echo $results['google_ping']['code']; ?>)</li>
                <li><strong>IndexNow (Bing / Yandex):</strong> <?php echo $results['indexnow']['status']; ?> (<?php echo $results['indexnow']['urlsCount']; ?> URLs submitted)</li>
            </ul>
        </div>
    <?php endif; ?>

    <div class="mb-4">
        <h2 class="h6 fw-bold mb-2">URLs Prepared for Submission (<?php echo count($urlsToIndex); ?>):</h2>
        <div class="d-flex flex-column gap-2" style="max-height: 220px; overflow-y: auto;">
            <?php foreach ($urlsToIndex as $u): ?>
                <div class="url-pill text-truncate"><i class="bi bi-link-45deg text-secondary me-1"></i><?php echo htmlspecialchars($u); ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <form method="POST" action="seo-index-request.php">
        <input type="hidden" name="action" value="submit">
        <div class="d-flex gap-3 align-items-center flex-wrap">
            <button type="submit" class="btn btn-accent d-inline-flex align-items-center gap-2">
                <i class="bi bi-rocket-takeoff-fill"></i> Dispatch Indexing Request Now
            </button>
            <a href="<?php echo BASE_URL; ?>" class="btn btn-outline-secondary rounded-3 px-3 py-2">
                <i class="bi bi-arrow-left me-1"></i> Back to Site
            </a>
        </div>
    </form>
</div>

</body>
</html>