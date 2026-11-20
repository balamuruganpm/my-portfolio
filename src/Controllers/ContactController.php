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

                // Dispatch Telegram notification if configured and submission succeeded
                if (!empty($result['success'])) {
                    $this->sendTelegramNotification($name, $email, $subject, $msg);
                }
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

    /**
     * Non-blocking Telegram notification dispatcher
     */
    private function sendTelegramNotification(string $name, string $email, string $subject, string $msg): void
    {
        $botToken = getenv('TELEGRAM_BOT_TOKEN') ?: (defined('TELEGRAM_BOT_TOKEN') ? TELEGRAM_BOT_TOKEN : '');
        $chatId = getenv('TELEGRAM_CHAT_ID') ?: (defined('TELEGRAM_CHAT_ID') ? TELEGRAM_CHAT_ID : '');

        if (empty($botToken) || empty($chatId)) {
            return;
        }

        $text = "🚀 *New Portfolio Transmission*\n\n"
              . "👤 *Name:* " . htmlspecialchars($name) . "\n"
              . "📧 *Email:* " . htmlspecialchars($email) . "\n"
              . "📌 *Subject:* " . htmlspecialchars($subject) . "\n"
              . "📝 *Message:*\n" . htmlspecialchars($msg) . "\n\n"
              . "⏱ *Time:* " . date('Y-m-d H:i:s') . " IST\n"
              . "🌐 *Client IP:* " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown');

        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'chat_id' => $chatId,
                'text' => $text,
                'parse_mode' => 'Markdown'
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_exec($ch);
            curl_close($ch);
        }
    }
}
