<?php
namespace App\Services;

/**
 * ProfileService — Manages bio, skills, tools, timeline, and accessibility speeches
 */
class ProfileService
{
    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function getProfile(): array
    {
        $data = $this->dataService->getMainData();
        return [
            'name'      => $data['profile']['name'] ?? 'Balamurugan P M',
            'title'     => $data['profile']['title'] ?? 'Frontend Developer | React.js | JavaScript | SPFx',
            'subtitle'  => $data['profile']['subtitle'] ?? 'Frontend Developer | React.js | JavaScript | SPFx | SharePoint Online',
            'email'     => $data['profile']['email'] ?? 'balamuruganpm.dev@gmail.com',
            'phone'     => $data['profile']['phone'] ?? ['+91 96778 04820'],
            'location'  => $data['profile']['location'] ?? 'Tamil Nadu, India',
            'biography' => $data['profile']['biography'] ?? 'Balamurugan P M is a Frontend Developer specializing in React.js, JavaScript, SPFx, web performance optimization, and responsive user interfaces.',
            'socials'   => $data['socials'] ?? [],
            'views'     => (int)($data['views'] ?? 0),
        ];
    }

    public function getSkills(): array
    {
        $data = $this->dataService->getMainData();
        return $data['skills'] ?? [];
    }

    public function getTools(): array
    {
        $data = $this->dataService->getMainData();
        return $data['tools'] ?? [];
    }

    public function getExperience(): array
    {
        $data = $this->dataService->getMainData();
        return $data['experience'] ?? [];
    }

    public function getEducation(): array
    {
        $data = $this->dataService->getMainData();
        return $data['education'] ?? [];
    }

    public function getAwards(): array
    {
        $data = $this->dataService->getMainData();
        return $data['awards'] ?? [];
    }

    public function getCertificates(): array
    {
        $data = $this->dataService->getMainData();
        return $data['certificates'] ?? [];
    }

    public function getAccessibility(): array
    {
        $data = $this->dataService->getMainData();
        return $data['accessibility'] ?? [];
    }

    public function getPageConfigs(): array
    {
        $data = $this->dataService->getMainData();
        return $data['pages'] ?? [];
    }

    public function isAdsEnabled(): bool
    {
        $data = $this->dataService->getMainData();
        return !isset($data['ads_enabled']) || (bool)$data['ads_enabled'];
    }
}
