<?php
namespace App\Services;

/**
 * PortfolioService — Manages portfolio projects and categories
 */
class PortfolioService
{
    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function getAllProjects(): array
    {
        $data = $this->dataService->getMainData();
        return $data['projects'] ?? [];
    }

    public function getFeaturedProjects(): array
    {
        $projects = $this->getAllProjects();
        return array_filter($projects, function ($p) {
            return !empty($p['featured']);
        });
    }

    public function getProjectById(int $id): ?array
    {
        $projects = $this->getAllProjects();
        foreach ($projects as $p) {
            if (isset($p['id']) && (int)$p['id'] === $id) {
                return $p;
            }
        }
        return null;
    }
}
