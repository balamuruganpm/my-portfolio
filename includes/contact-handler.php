<?php
/**
 * Contact Form Handler — Processes POST submissions
 * Extracted from the old Components/contact.php
 */

$contactMsg = '';
$contactMsgType = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    $msgs_file = ADMIN_DATA_PATH . 'messages.json';
    $messages = [];
    if (file_exists($msgs_file)) {
        $messages = json_decode(file_get_contents($msgs_file), true);
        if (!is_array($messages)) {
            $messages = [];
        }
    }

    $new_msg = [
        'id'      => time(),
        'name'    => trim($_POST['name']),
        'email'   => trim($_POST['email']),
        'subject' => trim($_POST['subject']),
        'message' => trim($_POST['message']),
        'date'    => date('Y-m-d H:i:s'),
        'read'    => false
    ];

    $messages[] = $new_msg;

    if (file_put_contents($msgs_file, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) !== false) {
        $contactMsg = 'Your message has been sent successfully! I\'ll get back to you soon.';
        $contactMsgType = 'success';
    } else {
        $contactMsg = 'Something went wrong. Please try again later.';
        $contactMsgType = 'danger';
    }
}
