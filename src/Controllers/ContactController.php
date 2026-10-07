<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Security;

/**
 * ContactController — Handles Contact Page & Inquiry Form Submissions
 */
class ContactController extends Controller
{
    public function index(): void
    {
        $configs = $this->profileService->getPageConfigs();
        $messageResult = null;

        // Process POST submission if non-AJAX
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                $result = ['success' => false, 'message' => 'Invalid CSRF token. Please refresh the page and try again.'];
            } else {
                $name    = $_POST['name'] ?? '';
                $email   = $_POST['email'] ?? '';
                $subject = $_POST['subject'] ?? '';
                $msg     = $_POST['message'] ?? '';

                $result = $this->messageService->submitMessage($name, $email, $subject, $msg);
            }

            if ($isAjax) {
                $this->json($result);
                return;
            }

            $messageResult = $result;
        }

        $data = [
            'pageTitle'           => $configs['contact']['title'] ?? "Contact Me | Balamurugan P M",
            'pageMetaDescription' => $configs['contact']['description'] ?? "",
            'thisPage'            => "Contact",
            'messageResult'       => $messageResult,
            'accessibility'       => $this->profileService->getAccessibility(),
        ];

        $this->render('views/contact', $data);
    }
}
