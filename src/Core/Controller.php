<?php
namespace App\Core;

use App\Services\ProfileService;
use App\Services\BlogService;
use App\Services\PortfolioService;
use App\Services\MessageService;

/**
 * Base Controller Class
 */
abstract class Controller
{
    protected View $view;
    protected ProfileService $profileService;
    protected BlogService $blogService;
    protected PortfolioService $portfolioService;
    protected MessageService $messageService;

    public function __construct(
        View $view,
        ProfileService $profileService,
        BlogService $blogService,
        PortfolioService $portfolioService,
        MessageService $messageService
    ) {
        $this->view = $view;
        $this->profileService = $profileService;
        $this->blogService = $blogService;
        $this->portfolioService = $portfolioService;
        $this->messageService = $messageService;
    }

    /**
     * Render template view
     */
    protected function render(string $viewPath, array $data = []): void
    {
        $profile = $this->profileService->getProfile();
        $accessibility = $this->profileService->getAccessibility();
        $pageConfigs = $this->profileService->getPageConfigs();
        $socials = $profile['socials'] ?? [];

        $extractedGlobals = [
            'profile'         => $profile,
            'profileName'     => $profile['name'] ?? 'Balamurugan P M',
            'profileAvatar'   => $profile['avatar'] ?? 'assets/images/balamurugan-pm.webp',
            'profileTitle'    => $profile['title'] ?? 'Frontend Developer | React.js | JavaScript | SPFx',
            'profileSubtitle' => $profile['subtitle'] ?? 'Frontend Developer | React.js | JavaScript | SPFx | SharePoint Online',
            'profileEmail'    => $profile['email'] ?? 'balamuruganpm.dev@gmail.com',
            'profilePhone'    => $profile['phone'] ?? ['+91 96778 04820'],
            'profileLocation' => $profile['location'] ?? 'Tamil Nadu, India',
            'profileBio'      => $profile['biography'] ?? '',
            'viewCount'       => $profile['views'] ?? 0,

            'socials'          => $socials,
            'socialsData'      => $socials,
            'socialsFigma'     => $socials['figma'] ?? '',
            'socialsLinkedin'  => $socials['linkedin'] ?? '',
            'socialsGithub'    => $socials['github'] ?? '',
            'socialsBehance'   => $socials['behance'] ?? '',
            'socialsDribbble'  => $socials['dribbble'] ?? '',
            'socialsFacebook'  => $socials['facebook'] ?? '',
            'socialsTwitter'   => $socials['twitter'] ?? '',
            'socialsInstagram' => $socials['instagram'] ?? '',
            'socialsCodepen'   => $socials['codepen'] ?? '',
            'socialsDiscord'   => $socials['discord'] ?? '',
            'socialsWhatsapp'  => $socials['whatsapp'] ?? '',
            'socialsContra'    => $socials['contra'] ?? '',

            'pageConfigs'      => $pageConfigs,
            'homeTitle'        => $pageConfigs['home']['title'] ?? 'Balamurugan P M | Portfolio',
            'homeDesc'         => $pageConfigs['home']['description'] ?? '',
            'aboutTitle'       => $pageConfigs['about']['title'] ?? 'About Me | Balamurugan P M',
            'aboutDesc'        => $pageConfigs['about']['description'] ?? '',
            'portfolioTitle'   => $pageConfigs['portfolio']['title'] ?? 'Portfolio Works | Balamurugan P M',
            'portfolioDesc'    => $pageConfigs['portfolio']['description'] ?? '',
            'contactTitle'     => $pageConfigs['contact']['title'] ?? 'Contact Us | Balamurugan P M',
            'contactDesc'      => $pageConfigs['contact']['description'] ?? '',

            'skills'           => $this->profileService->getSkills(),
            'skillsList'       => $this->profileService->getSkills(),
            'tools'            => $this->profileService->getTools(),
            'toolsList'        => $this->profileService->getTools(),
            'experience'       => $this->profileService->getExperience(),
            'experienceList'   => $this->profileService->getExperience(),
            'education'        => $this->profileService->getEducation(),
            'educationList'    => $this->profileService->getEducation(),
            'awards'           => $this->profileService->getAwards(),
            'awardsList'       => $this->profileService->getAwards(),
            'certificates'     => $this->profileService->getCertificates(),
            'certificatesList' => $this->profileService->getCertificates(),
            'projectsList'     => $this->portfolioService->getAllProjects(),
            'projects'         => $this->portfolioService->getAllProjects(),

            'accessibility'         => $accessibility,
            'expLabel'              => $accessibility['experience']['label'] ?? 'Career Ladder Timeline',
            'expSpeech'             => $accessibility['experience']['speech'] ?? '',
            'skillsLabel'           => $accessibility['skills']['label'] ?? 'Skills and Tools Competencies',
            'skillsSpeech'          => $accessibility['skills']['speech'] ?? '',
            'portfolioLabel'        => $accessibility['portfolio']['label'] ?? 'Portfolio Works Gallery',
            'portfolioSpeech'       => $accessibility['portfolio']['speech'] ?? '',
            'blogsLabel'            => $accessibility['blogs']['label'] ?? 'Blogs and Articles Feed',
            'blogsSpeech'           => $accessibility['blogs']['speech'] ?? '',
            'contactLabel'          => $accessibility['contact']['label'] ?? 'Contact Information and Form',
            'contactSpeech'         => $accessibility['contact']['speech'] ?? '',
            'eduLabel'              => $accessibility['education']['label'] ?? 'Education History Timeline',
            'eduSpeech'             => $accessibility['education']['speech'] ?? '',
            'defaultMascotSpeech'   => $accessibility['mascot']['default_speech'] ?? 'Want to talk? Hire me! 👋',
            'bentoMascotSpeech'     => $accessibility['mascot']['bento_speech'] ?? '',
            'mascotWhatsappMessage' => $accessibility['mascot']['whatsapp_message'] ?? 'Can you have a minutes to talk?',

            'adsEnabled'            => $this->profileService->isAdsEnabled(),
            'csrfToken'             => Security::csrfToken(),
        ];

        $globalData = array_merge($extractedGlobals, $data);
        $this->view->render($viewPath, $globalData);
    }

    /**
     * Return JSON response
     */
    protected function json(array $data, int $statusCode = 200): void
    {
        if (!headers_sent()) {
            http_response_code($statusCode);
            header('Content-Type: application/json; charset=utf-8');
        }
        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Redirect to URL
     */
    protected function redirect(string $url): void
    {
        if (!headers_sent()) {
            header('Location: ' . $url);
        } else {
            echo '<script>window.location.href="' . htmlspecialchars($url, ENT_QUOTES) . '";</script>';
        }
        exit;
    }
}
