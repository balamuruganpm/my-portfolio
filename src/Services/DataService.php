<?php
namespace App\Services;

/**
 * DataService — Flat-file JSON Database Repository Engine
 * Provides thread-safe reading, writing, and session-based visitor tracking.
 */
class DataService
{
    private string $dataDirPath;
    private static ?array $cachedData = null;
    private static ?array $cachedBlogs = null;

    public function __construct(string $dataDirPath)
    {
        $this->dataDirPath = rtrim($dataDirPath, '/\\') . DIRECTORY_SEPARATOR;
    }

    /**
     * Read JSON file safely
     */
    public function readJson(string $filename): array
    {
        $filePath = $this->dataDirPath . $filename;
        if (!file_exists($filePath)) {
            return [];
        }

        $content = @file_get_contents($filePath);
        if ($content === false) {
            return [];
        }

        $decoded = json_decode($content, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Write JSON file atomically with file locking
     */
    public function writeJson(string $filename, array $data): bool
    {
        $filePath = $this->dataDirPath . $filename;
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        
        return @file_put_contents($filePath, $json, LOCK_EX) !== false;
    }

    /**
     * Get main data.json database
     */
    public function getMainData(): array
    {
        if (self::$cachedData === null) {
            self::$cachedData = $this->readJson('data.json');
        }
        return self::$cachedData;
    }

    /**
     * Save main data.json database
     */
    public function saveMainData(array $data): bool
    {
        self::$cachedData = $data;
        return $this->writeJson('data.json', $data);
    }

    /**
     * Get blogs.json database
     */
    public function getBlogs(): array
    {
        if (self::$cachedBlogs === null) {
            self::$cachedBlogs = $this->readJson('blogs.json');
        }
        return self::$cachedBlogs;
    }

    /**
     * Save blogs.json database
     */
    public function saveBlogs(array $blogs): bool
    {
        self::$cachedBlogs = $blogs;
        return $this->writeJson('blogs.json', $blogs);
    }

    /**
     * Track unique session visitor views
     */
    public function trackVisitor(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['has_visited'])) {
            $_SESSION['has_visited'] = true;
            $data = $this->getMainData();
            $data['views'] = isset($data['views']) ? (int)$data['views'] + 1 : 1;
            $this->saveMainData($data);
        }
    }
}
