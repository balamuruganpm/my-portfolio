<?php
namespace App\Core;

/**
 * View Templating Engine
 * Renders view templates inside layout wrappers with variable extraction.
 */
class View
{
    private string $viewsDir;
    private string $layout = 'layout/main';

    public function __construct(string $basePath)
    {
        $this->viewsDir = rtrim($basePath, '/\\') . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
    }

    /**
     * Set layout template (relative to templates/)
     */
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * Render a view within a layout wrapper
     */
    public function render(string $viewPath, array $data = []): void
    {
        $viewFile = $this->viewsDir . ltrim($viewPath, '/\\') . '.php';
        if (!file_exists($viewFile)) {
            throw new \RuntimeException("View file not found: {$viewPath}");
        }

        // Extract variables into view scope
        extract($data, EXTR_SKIP);

        // Capture view content output buffer
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        // Render layout wrapping content if layout exists
        $layoutFile = $this->viewsDir . ltrim($this->layout, '/\\') . '.php';
        if (!empty($this->layout) && file_exists($layoutFile)) {
            include $layoutFile;
        } else {
            echo $content;
        }
    }

    /**
     * Render a sub-template partial
     */
    public function partial(string $partialPath, array $data = []): void
    {
        $partialFile = $this->viewsDir . ltrim($partialPath, '/\\') . '.php';
        if (file_exists($partialFile)) {
            extract($data, EXTR_SKIP);
            include $partialFile;
        }
    }

    /**
     * Escape output helper
     */
    public function e(?string $val): string
    {
        return Security::e($val);
    }
}
