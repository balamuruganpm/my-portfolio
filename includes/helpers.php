<?php
/**
 * Helper Functions — Reusable utilities
 * Extracted from about.php and other files
 */

/**
 * Get Bootstrap Icon class for a given technology name
 * @param string $name Technology/tool name
 * @return string Bootstrap icon class string
 */
function getTechIconClass(string $name): string
{
    $nameLower = strtolower(trim($name));
    $map = [
        'html'         => 'bi-filetype-html icon-html',
        'html5'        => 'bi-filetype-html icon-html',
        'css'          => 'bi-filetype-css icon-css',
        'css3'         => 'bi-filetype-css icon-css',
        'javascript'   => 'bi-filetype-js icon-js',
        'bootstrap'    => 'bi-bootstrap-fill icon-bootstrap',
        'tailwind css' => 'bi-wind icon-tailwind',
        'figma'        => 'bi-figma icon-figma',
        'react'        => 'bi-code-slash icon-react',
        'react.js'     => 'bi-code-slash icon-react',
        'wordpress'    => 'bi-wordpress icon-wordpress',
        'shopify'      => 'bi-shop icon-shopify',
        'github'       => 'bi-github icon-github',
        'git'          => 'bi-git icon-git',
        'vscode'       => 'bi-terminal icon-vscode',
        'vs code'      => 'bi-terminal icon-vscode',
        'visual studio code' => 'bi-terminal icon-vscode',
        'canva'        => 'bi-palette-fill icon-canva',
        'php'          => 'bi-filetype-php icon-php',
        'json'         => 'bi-filetype-json icon-json',
        'sharepoint'   => 'bi-microsoft icon-sharepoint',
    ];

    return $map[$nameLower] ?? 'bi-patch-check-fill icon-default';
}

/**
 * Get CSS pill class for a technology name
 * @param string $name Technology name
 * @return string CSS class name
 */
function getTechPillClass(string $name): string
{
    $nameClean = preg_replace('/[^a-z0-9]/', '', strtolower(trim($name)));
    return 'pill-' . $nameClean;
}

/**
 * Safely output an HTML-escaped string
 * @param string $value The value to escape
 * @return string Escaped string
 */
function e(?string $value): string
{
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

/**
 * Render a list of social link icons
 * @param array $socials Associative array of platform => URL
 * @param string $linkClass CSS class for links
 * @param string $iconSize Bootstrap font-size class
 */
function renderSocialLinks(array $socials, string $linkClass = 'text-secondary hover-accent', string $iconSize = 'fs-5'): void
{
    $platformIcons = [
        'github'    => 'bi-github',
        'linkedin'  => 'bi-linkedin',
        'behance'   => 'bi-behance',
        'dribbble'  => 'bi-dribbble',
        'instagram' => 'bi-instagram',
        'twitter'   => 'bi-twitter-x',
        'facebook'  => 'bi-facebook',
        'discord'   => 'bi-discord',
        'whatsapp'  => 'bi-whatsapp',
        'codepen'   => null, // Custom SVG
        'figma'     => null, // Custom SVG
        'contra'    => 'bi-briefcase',
    ];

    foreach ($platformIcons as $platform => $iconClass) {
        if (empty($socials[$platform])) continue;

        $url = e($socials[$platform]);
        $label = ucfirst($platform) . ' Profile';

        if ($platform === 'whatsapp') $label = 'WhatsApp Chat';
        if ($platform === 'twitter') $label = 'Twitter X Profile';

        echo '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" class="' . $linkClass . '" aria-label="' . $label . '">';

        if ($platform === 'figma') {
            echo '<svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 346 512.36" width="16" height="16" style="display:inline-block;vertical-align:-0.15em;" aria-hidden="true"><g fill-rule="nonzero"><path fill="#6d6961" d="M172.53 246.9c0-42.04 34.09-76.11 76.12-76.11h11.01c.3.01.63-.01.94-.01 47.16 0 85.4 38.25 85.4 85.4 0 47.15-38.24 85.39-85.4 85.39-.31 0-.64-.01-.95-.01l-11 .01c-42.03 0-76.12-34.09-76.12-76.12V246.9z"/><path fill="#6d6961" d="M0 426.98c0-47.16 38.24-85.41 85.4-85.41l87.13.01v84.52c0 47.65-39.06 86.26-86.71 86.26C38.67 512.36 0 474.13 0 426.98z"/><path fill="#6d6961" d="M172.53.01v170.78h87.13c.3-.01.63.01.94.01 47.16 0 85.4-38.25 85.4-85.4C346 38.24 307.76 0 260.6 0c-.31 0-.64.01-.95.01h-87.12z"/><path fill="#6d6961" d="M0 85.39c0 47.16 38.24 85.4 85.4 85.4h87.13V.01H85.39C38.24.01 0 38.24 0 85.39z"/><path fill="#6d6961" d="M0 256.18c0 47.16 38.24 85.4 85.4 85.4h87.13V170.8H85.39C38.24 170.8 0 209.03 0 256.18z"/></g></svg>';
        } elseif ($platform === 'codepen') {
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="currentColor" style="display:inline-block;vertical-align:-0.15em;" aria-hidden="true"><path d="M502.285 159.703l-234.568-156.345c-7.232-4.821-16.747-4.821-23.978 0L9.171 159.703C3.502 163.482 0 169.873 0 176.711v158.578c0 6.837 3.502 13.228 9.171 17.008l234.568 156.345c3.615 2.41 7.828 3.615 12.04 3.615s8.425-1.205 12.04-3.615l234.568-156.345c5.669-3.779 9.171-10.17 9.171-17.008V176.711c.001-6.838-3.499-13.229-9.168-17.008zM277.333 46.101v112.593l101.442 67.628-101.442-67.628L391.821 235.1l-114.488-76.326v77.066l58.919 39.279L277.333 313.43v152.469l194.667-129.778V175.879L277.333 46.101zm-42.666 0L40 175.879v159.943l194.667 129.778V313.43l-58.919-38.311 58.919-39.279v-77.066L120.179 235.1l114.488-76.326V46.101zM256 195.956l68.966 45.977L256 287.91l-68.966-45.977L256 195.956z"/></svg>';
        } else {
            echo '<i class="bi ' . $iconClass . ' ' . $iconSize . '" aria-hidden="true"></i>';
        }

        echo '</a>' . "\n";
    }
}
