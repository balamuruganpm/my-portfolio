<?php
namespace App\Core;

/**
 * Security Helper & CSRF Token Engine
 */
class Security
{
    /**
     * Escape output for HTML context
     */
    public static function e(?string $value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize string input
     */
    public static function sanitize(?string $value): string
    {
        return trim(strip_tags((string)$value));
    }

    /**
     * Generate or retrieve existing CSRF token
     */
    public static function csrfToken(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Verify CSRF token against active session
     */
    public static function verifyCsrfToken(?string $token): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($token) || empty($_SESSION['csrf_token'])) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Inject modern security headers
     */
    public static function injectSecurityHeaders(): void
    {
        if (headers_sent()) return;
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
