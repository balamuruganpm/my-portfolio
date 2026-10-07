<?php
namespace App\Core;

use App\Services\DataService;
use App\Services\ProfileService;
use App\Services\BlogService;
use App\Services\PortfolioService;
use App\Services\MessageService;

/**
 * App — Application Front Controller & Dependency Container
 */
class App
{
    private static ?self $instance = null;
    private Router $router;
    private DataService $dataService;
    private ProfileService $profileService;
    private BlogService $blogService;
    private PortfolioService $portfolioService;
    private MessageService $messageService;
    private View $view;

    public function __construct()
    {
        self::$instance = $this;

        // Initialize Services
        $dataDirPath = defined('ADMIN_DATA_PATH') ? ADMIN_DATA_PATH : (BASE_PATH . 'admin/data/');
        $this->dataService = new DataService($dataDirPath);
        
        // Track visitor view once per session
        $this->dataService->trackVisitor();

        $this->profileService = new ProfileService($this->dataService);
        $this->blogService = new BlogService($this->dataService);
        $this->portfolioService = new PortfolioService($this->dataService);
        $this->messageService = new MessageService($this->dataService);

        // Initialize View Engine
        $this->view = new View(BASE_PATH);

        // Calculate web subfolder path if installed in a subdirectory
        $_scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
        if ($_scriptDir === '.' || $_scriptDir === '/') {
            $_scriptDir = '';
        }
        $this->router = new Router($_scriptDir);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * Boot up application and dispatch router
     */
    public function run(): void
    {
        // Inject security headers
        Security::injectSecurityHeaders();

        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';

        $this->router->dispatch($method, $uri, function ($handler, array $params) {
            [$controllerClass, $methodName] = $handler;

            // Instantiate controller with injected services
            $controller = new $controllerClass(
                $this->view,
                $this->profileService,
                $this->blogService,
                $this->portfolioService,
                $this->messageService
            );

            call_user_func_array([$controller, $methodName], $params);
        });
    }
}
