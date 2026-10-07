<?php
namespace App\Services;

/**
 * BlogService — Manages articles, views, categories, and comments
 */
class BlogService
{
    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    /**
     * Get all published blogs (sorted newest first)
     */
    public function getPublishedBlogs(): array
    {
        $blogs = $this->dataService->getBlogs();
        $published = array_filter($blogs, function ($b) {
            return !isset($b['status']) || $b['status'] === 'published';
        });

        usort($published, function ($a, $b) {
            $dateA = strtotime($a['date'] ?? '1970-01-01');
            $dateB = strtotime($b['date'] ?? '1970-01-01');
            return $dateB <=> $dateA;
        });

        return array_values($published);
    }

    /**
     * Find blog by slug or ID
     */
    public function findBlog(string $slug = '', int $id = 0): ?array
    {
        $blogs = $this->dataService->getBlogs();
        foreach ($blogs as $b) {
            if (!empty($slug) && isset($b['slug']) && strtolower($b['slug']) === strtolower($slug)) {
                return $b;
            }
            if ($id > 0 && isset($b['id']) && (int)$b['id'] === $id) {
                return $b;
            }
        }
        return null;
    }

    /**
     * Increment post view count once per session
     */
    public function incrementViews(int $blogId): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $sessionKey = 'viewed_blog_' . $blogId;
        if (!isset($_SESSION[$sessionKey])) {
            $_SESSION[$sessionKey] = true;

            $blogs = $this->dataService->getBlogs();
            foreach ($blogs as $idx => &$b) {
                if (isset($b['id']) && (int)$b['id'] === $blogId) {
                    $b['views'] = isset($b['views']) ? (int)$b['views'] + 1 : 1;
                    break;
                }
            }
            $this->dataService->saveBlogs($blogs);
        }
    }

    /**
     * Get blogs by category
     */
    public function getBlogsByCategory(string $category): array
    {
        $blogs = $this->getPublishedBlogs();
        $target = strtolower(trim($category));
        if ($target === '' || $target === 'all') {
            return $blogs;
        }

        return array_values(array_filter($blogs, function ($b) use ($target) {
            $cat = strtolower(trim($b['category'] ?? ''));
            return $cat === $target || str_replace('-', ' ', $cat) === str_replace('-', ' ', $target);
        }));
    }

    /**
     * Get unique categories with article counts
     */
    public function getCategories(): array
    {
        $blogs = $this->getPublishedBlogs();
        $categories = [];
        foreach ($blogs as $b) {
            $cat = trim($b['category'] ?? 'General');
            if (!empty($cat)) {
                $categories[$cat] = ($categories[$cat] ?? 0) + 1;
            }
        }
        return $categories;
    }

    /**
     * Get related blogs based on category or tags
     */
    public function getRelatedBlogs(int $currentId, string $category, int $limit = 3): array
    {
        $blogs = $this->getPublishedBlogs();
        $related = array_filter($blogs, function ($b) use ($currentId, $category) {
            return (int)($b['id'] ?? 0) !== $currentId && strtolower($b['category'] ?? '') === strtolower($category);
        });

        if (count($related) < $limit) {
            foreach ($blogs as $b) {
                if ((int)($b['id'] ?? 0) !== $currentId && !in_array($b, $related)) {
                    $related[] = $b;
                    if (count($related) >= $limit) break;
                }
            }
        }

        return array_slice(array_values($related), 0, $limit);
    }

    /**
     * Load comments for a specific blog post
     */
    public function getComments(int $blogId): array
    {
        $comments = $this->dataService->readJson('comments.json');
        return $comments[(string)$blogId] ?? [];
    }

    /**
     * Save a new comment for a blog post
     */
    public function addComment(int $blogId, string $name, string $comment): bool
    {
        $allComments = $this->dataService->readJson('comments.json');
        if (!isset($allComments[(string)$blogId])) {
            $allComments[(string)$blogId] = [];
        }

        $allComments[(string)$blogId][] = [
            'id' => time(),
            'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            'comment' => htmlspecialchars($comment, ENT_QUOTES, 'UTF-8'),
            'date' => date('Y-m-d H:i:s')
        ];

        return $this->dataService->writeJson('comments.json', $allComments);
    }
}
