<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * SeoController — Dynamically serves XML Sitemaps, RSS feeds, and AI specifications
 */
class SeoController extends Controller
{
    public function sitemap(): void
    {
        if (!headers_sent()) {
            header('Content-Type: application/xml; charset=utf-8');
        }

        $blogs = $this->blogService->getPublishedBlogs();
        $profile = $this->profileService->getProfile();

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Static routes
        $staticPages = [
            ''          => ['changefreq' => 'daily', 'priority' => '1.0'],
            'about'     => ['changefreq' => 'monthly', 'priority' => '0.8'],
            'portfolio' => ['changefreq' => 'weekly', 'priority' => '0.9'],
            'blogs'     => ['changefreq' => 'daily', 'priority' => '0.9'],
            'contact'   => ['changefreq' => 'monthly', 'priority' => '0.7'],
            'game'      => ['changefreq' => 'monthly', 'priority' => '0.6'],
        ];

        foreach ($staticPages as $path => $meta) {
            echo '  <url>' . "\n";
            echo '    <loc>' . SITE_URL . $path . '</loc>' . "\n";
            echo '    <changefreq>' . $meta['changefreq'] . '</changefreq>' . "\n";
            echo '    <priority>' . $meta['priority'] . '</priority>' . "\n";
            echo '  </url>' . "\n";
        }

        // Blog articles
        foreach ($blogs as $blog) {
            $slug = $blog['slug'] ?? '';
            if (empty($slug)) continue;
            
            $lastMod = date('c', strtotime($blog['date'] ?? 'now'));
            echo '  <url>' . "\n";
            echo '    <loc>' . SITE_URL . 'blogs/' . urlencode($slug) . '</loc>' . "\n";
            echo '    <lastmod>' . $lastMod . '</lastmod>' . "\n";
            echo '    <changefreq>monthly</changefreq>' . "\n";
            echo '    <priority>0.8</priority>' . "\n";
            echo '  </url>' . "\n";
        }

        echo '</urlset>';
        exit;
    }

    public function newsSitemap(): void
    {
        if (!headers_sent()) {
            header('Content-Type: application/xml; charset=utf-8');
        }

        $blogs = $this->blogService->getPublishedBlogs();

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n";

        foreach ($blogs as $blog) {
            $slug = $blog['slug'] ?? '';
            if (empty($slug)) continue;

            $pubDate = date('c', strtotime($blog['date'] ?? 'now'));
            echo '  <url>' . "\n";
            echo '    <loc>' . SITE_URL . 'blogs/' . urlencode($slug) . '</loc>' . "\n";
            echo '    <news:news>' . "\n";
            echo '      <news:publication>' . "\n";
            echo '        <news:name>Balamurugan P M Tech Insights</news:name>' . "\n";
            echo '        <news:language>en</news:language>' . "\n";
            echo '      </news:publication>' . "\n";
            echo '      <news:publication_date>' . $pubDate . '</news:publication_date>' . "\n";
            echo '      <news:title>' . htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8') . '</news:title>' . "\n";
            echo '    </news:news>' . "\n";
            echo '  </url>' . "\n";
        }

        echo '</urlset>';
        exit;
    }

    public function rss(): void
    {
        if (!headers_sent()) {
            header('Content-Type: application/rss+xml; charset=utf-8');
        }

        $blogs = $this->blogService->getPublishedBlogs();

        echo '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
        echo '<rss version="2.0">' . "\n";
        echo '<channel>' . "\n";
        echo '  <title>Balamurugan P M | Frontend &amp; SPFx Developer Blog</title>' . "\n";
        echo '  <link>' . SITE_URL . '</link>' . "\n";
        echo '  <description>Technical articles on React.js, JavaScript, SPFx, web performance optimization, and modern web architecture.</description>' . "\n";

        foreach ($blogs as $blog) {
            $slug = $blog['slug'] ?? '';
            $link = SITE_URL . 'blogs/' . urlencode($slug);
            $pubDate = date(DATE_RSS, strtotime($blog['date'] ?? 'now'));

            echo '  <item>' . "\n";
            echo '    <title>' . htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8') . '</title>' . "\n";
            echo '    <link>' . $link . '</link>' . "\n";
            echo '    <description>' . htmlspecialchars($blog['snippet'] ?? '', ENT_QUOTES, 'UTF-8') . '</description>' . "\n";
            echo '    <pubDate>' . $pubDate . '</pubDate>' . "\n";
            echo '    <guid>' . $link . '</guid>' . "\n";
            echo '  </item>' . "\n";
        }

        echo '</channel>' . "\n";
        echo '</rss>';
        exit;
    }

    public function llms(): void
    {
        if (!headers_sent()) {
            header('Content-Type: text/plain; charset=utf-8');
        }

        $profile = $this->profileService->getProfile();
        $skills = $this->profileService->getSkills();
        $experience = $this->profileService->getExperience();

        echo "# " . $profile['name'] . " — LLM Summary & Developer Dossier\n\n";
        echo "> " . $profile['subtitle'] . "\n\n";
        echo "## Executive Biography\n";
        echo $profile['biography'] . "\n\n";

        echo "## Core Technical Competencies\n";
        foreach ($skills as $skill) {
            echo "- " . ($skill['name'] ?? '') . " (" . ($skill['category'] ?? 'General') . ")\n";
        }

        echo "\n## Work Experience\n";
        foreach ($experience as $exp) {
            echo "- **" . ($exp['role'] ?? '') . "** at " . ($exp['company'] ?? '') . " (" . ($exp['period'] ?? '') . ")\n";
        }
        exit;
    }

    public function ai(): void
    {
        if (!headers_sent()) {
            header('Content-Type: text/plain; charset=utf-8');
        }

        $profile = $this->profileService->getProfile();

        echo "# AI Agent Instruction Manifest\n";
        echo "Developer: " . $profile['name'] . "\n";
        echo "Primary Domain: " . SITE_URL . "\n";
        echo "Contact: " . $profile['email'] . "\n";
        echo "Canonical Portfolio: " . SITE_URL . "\n";
        exit;
    }
}
