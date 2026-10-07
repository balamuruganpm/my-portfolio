<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * HomeController — Handles Home Page
 */
class HomeController extends Controller
{
    public function index(): void
    {
        $projects = $this->portfolioService->getAllProjects();
        $blogs = $this->blogService->getPublishedBlogs();

        $data = [
            'pageTitle'      => "Balamurugan P M | Frontend Developer | React.js | JavaScript | SPFx",
            'thisPage'       => "Home",
            'skills'         => $this->profileService->getSkills(),
            'skillsList'     => $this->profileService->getSkills(),
            'tools'          => $this->profileService->getTools(),
            'experience'     => $this->profileService->getExperience(),
            'experienceList' => $this->profileService->getExperience(),
            'education'      => $this->profileService->getEducation(),
            'educationList'  => $this->profileService->getEducation(),
            'projects'       => $projects,
            'projectsList'   => $projects,
            'publishedBlogs' => $blogs,
            'blogs'          => $blogs,
            'accessibility'  => $this->profileService->getAccessibility(),
        ];

        $this->render('views/home', $data);
    }

    public function notFound(): void
    {
        $data = [
            'pageTitle' => "404 Page Not Found | Balamurugan P M",
            'thisPage'  => "Home",
        ];

        $this->render('views/home', $data);
    }
}
