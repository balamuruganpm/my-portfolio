<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Security;

/**
 * BlogController — Handles Blog Articles, Detail Views, Category Filtering, and Comments
 */
class BlogController extends Controller
{
    /**
     * Blog Articles List Page
     */
    public function index(): void
    {
        $published = $this->blogService->getPublishedBlogs();
        $categories = $this->blogService->getCategories();

        $data = [
            'pageTitle'      => "Blog & Technical Articles | Balamurugan P M",
            'thisPage'       => "Blogs",
            'publishedBlogs' => $published,
            'categories'     => $categories,
            'selectedCat'    => 'all',
            'accessibility'  => $this->profileService->getAccessibility(),
        ];

        $this->render('views/blogs', $data);
    }

    /**
     * Category Filtered Articles Page
     */
    public function category(string $category = ''): void
    {
        if (empty($category) && isset($_GET['name'])) {
            $category = $_GET['name'];
        }

        $published = $this->blogService->getBlogsByCategory($category);
        $categories = $this->blogService->getCategories();

        $data = [
            'pageTitle'      => ucfirst($category) . " Articles | Balamurugan P M",
            'thisPage'       => "Blogs",
            'publishedBlogs' => $published,
            'categories'     => $categories,
            'selectedCat'    => strtolower($category),
            'accessibility'  => $this->profileService->getAccessibility(),
        ];

        $this->render('views/blogs', $data);
    }

    /**
     * Article Detail Page by Slug or Query Params
     */
    public function detail(string $slug = ''): void
    {
        if (empty($slug)) {
            $slug = $_GET['slug'] ?? '';
        }
        $id = (int)($_GET['id'] ?? 0);

        $post = $this->blogService->findBlog($slug, $id);

        if (!$post) {
            $this->redirect(BASE_URL . 'blogs');
            return;
        }

        // Increment view count for this post
        $this->blogService->incrementViews((int)$post['id']);

        // Handle comment submission via POST
        $commentMessage = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_comment') {
            if (Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                $name = $_POST['author_name'] ?? '';
                $commentText = $_POST['comment_text'] ?? '';
                
                if ($this->blogService->addComment((int)$post['id'], $name, $commentText)) {
                    $commentMessage = 'Thank you! Your comment has been posted.';
                } else {
                    $commentMessage = 'Error posting comment. Please try again.';
                }
            } else {
                $commentMessage = 'Invalid security token. Please refresh.';
            }
        }

        // Load existing comments
        $comments = $this->blogService->getComments((int)$post['id']);
        $relatedBlogs = $this->blogService->getRelatedBlogs((int)$post['id'], $post['category'] ?? 'General');

        $seoTitle = !empty($post['seo_title']) ? $post['seo_title'] : $post['title'];
        $seoDesc  = !empty($post['seo_description']) ? $post['seo_description'] : ($post['snippet'] ?? '');
        $seoKey   = !empty($post['seo_keywords']) ? $post['seo_keywords'] : (isset($post['tags']) ? implode(', ', $post['tags']) : '');

        $data = [
            'pageTitle'           => Security::e($seoTitle) . " | Balamurugan P M",
            'pageMetaDescription' => Security::e($seoDesc),
            'pageMetaKeywords'    => Security::e($seoKey),
            'thisPage'            => "Blogs",
            'post'                => $post,
            'comments'            => $comments,
            'relatedBlogs'        => $relatedBlogs,
            'commentMessage'      => $commentMessage,
            'accessibility'       => $this->profileService->getAccessibility(),
        ];

        $this->render('views/blog-detail', $data);
    }
}
