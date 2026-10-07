<?php
/**
 * Data Extractor — Converts $data array into named variables
 * Replaces the repetitive isset() checks in the old configuration.php
 * Uses null coalescing operator for cleaner syntax
 */

// Profile details
$profileName     = !empty($data['profile']['name']) ? $data['profile']['name'] : 'Balamurugan P M';
$profileTitle    = !empty($data['profile']['title']) ? $data['profile']['title'] : 'Frontend Developer | React.js | JavaScript | SPFx';
$profileSubtitle = !empty($data['profile']['subtitle']) ? $data['profile']['subtitle'] : 'Frontend Developer | React.js | JavaScript | SPFx | SharePoint Online';
$profileEmail    = !empty($data['profile']['email']) ? $data['profile']['email'] : 'balamuruganpm.dev@gmail.com';
$profilePhone    = !empty($data['profile']['phone']) ? $data['profile']['phone'] : ['+91 96778 04820'];
$profileLocation = !empty($data['profile']['location']) ? $data['profile']['location'] : 'Tamil Nadu, India';
$profileBio      = !empty($data['profile']['biography']) ? $data['profile']['biography'] : 'Balamurugan P M is a Frontend Developer specializing in React.js, JavaScript, SPFx, web performance optimization, and responsive user interfaces.';

// Social links (full array for renderSocialLinks helper)
$socialsData     = $data['socials'] ?? [];

// Individual social links (for backward compatibility in templates)
$socialsFigma     = $socialsData['figma'] ?? '';
$socialsLinkedin  = $socialsData['linkedin'] ?? '';
$socialsGithub    = $socialsData['github'] ?? '';
$socialsBehance   = $socialsData['behance'] ?? '';
$socialsDribbble  = $socialsData['dribbble'] ?? '';
$socialsFacebook  = $socialsData['facebook'] ?? '';
$socialsTwitter   = $socialsData['twitter'] ?? '';
$socialsInstagram = $socialsData['instagram'] ?? '';
$socialsCodepen   = $socialsData['codepen'] ?? '';
$socialsDiscord   = $socialsData['discord'] ?? '';
$socialsWhatsapp  = $socialsData['whatsapp'] ?? '';
$socialsContra    = $socialsData['contra'] ?? '';

// Collections
$skillsList       = $data['skills'] ?? [];
$toolsList        = $data['tools'] ?? [];
$experienceList   = $data['experience'] ?? [];
$educationList    = $data['education'] ?? [];
$projectsList     = $data['projects'] ?? [];
$awardsList       = $data['awards'] ?? [];
$certificatesList = $data['certificates'] ?? [];

// Page Configurations
$homeTitle     = $data['pages']['home']['title'] ?? 'Balamurugan P M | Portfolio';
$homeDesc      = $data['pages']['home']['description'] ?? '';
$aboutTitle    = $data['pages']['about']['title'] ?? 'About Me | Balamurugan P M';
$aboutDesc     = $data['pages']['about']['description'] ?? '';
$portfolioTitle = $data['pages']['portfolio']['title'] ?? 'Portfolio Works | Balamurugan P M';
$portfolioDesc  = $data['pages']['portfolio']['description'] ?? '';
$contactTitle  = $data['pages']['contact']['title'] ?? 'Contact Us | Balamurugan P M';
$contactDesc   = $data['pages']['contact']['description'] ?? '';

// Accessibility Configs (Labels & Mascot Speeches)
$accessibilityData = $data['accessibility'] ?? [];

$expLabel   = $accessibilityData['experience']['label'] ?? 'Career Ladder Timeline';
$expSpeech  = $accessibilityData['experience']['speech'] ?? '';

$skillsLabel  = $accessibilityData['skills']['label'] ?? 'Skills and Tools Competencies';
$skillsSpeech = $accessibilityData['skills']['speech'] ?? '';

$portfolioLabel  = $accessibilityData['portfolio']['label'] ?? 'Portfolio Works Gallery';
$portfolioSpeech = $accessibilityData['portfolio']['speech'] ?? '';

$blogsLabel  = $accessibilityData['blogs']['label'] ?? 'Blogs and Articles Feed';
$blogsSpeech = $accessibilityData['blogs']['speech'] ?? '';

$contactLabel  = $accessibilityData['contact']['label'] ?? 'Contact Information and Form';
$contactSpeech = $accessibilityData['contact']['speech'] ?? '';

$eduLabel  = $accessibilityData['education']['label'] ?? 'Education History Timeline';
$eduSpeech = $accessibilityData['education']['speech'] ?? '';

$defaultMascotSpeech  = $accessibilityData['mascot']['default_speech'] ?? 'Want to talk? Hire me! 👋';
$bentoMascotSpeech    = $accessibilityData['mascot']['bento_speech'] ?? '';
$mascotWhatsappMessage = $accessibilityData['mascot']['whatsapp_message'] ?? 'Can you have a minutes to talk?';

// Global ads switcher configuration
$adsEnabled = !isset($data['ads_enabled']) || (bool)$data['ads_enabled'];
