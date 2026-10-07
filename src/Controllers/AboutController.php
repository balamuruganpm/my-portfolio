<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * AboutController — Handles About Me Page
 */
class AboutController extends Controller
{
    public function index(): void
    {
        $configs = $this->profileService->getPageConfigs();
        
        $data = [
            'pageTitle'           => $configs['about']['title'] ?? "About Me | Balamurugan P M",
            'pageMetaDescription' => $configs['about']['description'] ?? "",
            'thisPage'            => "About",
            'skills'              => $this->profileService->getSkills(),
            'tools'               => $this->profileService->getTools(),
            'experience'          => $this->profileService->getExperience(),
            'education'           => $this->profileService->getEducation(),
            'awards'              => $this->profileService->getAwards(),
            'certificates'        => $this->profileService->getCertificates(),
            'accessibility'       => $this->profileService->getAccessibility(),
        ];

        $this->render('views/about', $data);
    }
}
