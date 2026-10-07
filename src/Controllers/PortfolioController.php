<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * PortfolioController — Handles Portfolio Projects Page
 */
class PortfolioController extends Controller
{
    public function index(): void
    {
        $configs = $this->profileService->getPageConfigs();

        $data = [
            'pageTitle'           => $configs['portfolio']['title'] ?? "Portfolio Works | Balamurugan P M",
            'pageMetaDescription' => $configs['portfolio']['description'] ?? "",
            'thisPage'            => "Portfolio",
            'projects'            => $this->portfolioService->getAllProjects(),
            'accessibility'       => $this->profileService->getAccessibility(),
        ];

        $this->render('views/portfolio', $data);
    }
}
