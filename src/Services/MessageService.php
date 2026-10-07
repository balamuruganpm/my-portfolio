<?php
namespace App\Services;

/**
 * MessageService — Handles contact form inquiries
 */
class MessageService
{
    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    /**
     * Submit contact form inquiry
     */
    public function submitMessage(string $name, string $email, string $subject, string $message): array
    {
        $name = trim($name);
        $email = trim($email);
        $subject = trim($subject);
        $message = trim($message);

        if (empty($name) || empty($email) || empty($message)) {
            return ['success' => false, 'message' => 'Please fill in all required fields.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Please provide a valid email address.'];
        }

        $messages = $this->dataService->readJson('messages.json');
        
        $newMessage = [
            'id' => time(),
            'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
            'subject' => htmlspecialchars($subject ?: 'General Inquiry', ENT_QUOTES, 'UTF-8'),
            'message' => htmlspecialchars($message, ENT_QUOTES, 'UTF-8'),
            'date' => date('Y-m-d H:i:s'),
            'read' => false
        ];

        array_unshift($messages, $newMessage);

        if ($this->dataService->writeJson('messages.json', $messages)) {
            return ['success' => true, 'message' => 'Your message has been sent successfully!'];
        }

        return ['success' => false, 'message' => 'Failed to save message. Please try again.'];
    }
}
