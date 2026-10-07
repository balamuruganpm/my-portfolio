<?php
/**
 * Dynamic AI Index Generator (Served as /ai.txt)
 * Generates an up-to-date AI agent index directly from data.json
 */
header('Content-Type: text/plain; charset=utf-8');

define('PAGE_DEPTH', 0);
require_once __DIR__ . '/config/bootstrap.php';

$phoneStr = !empty($profilePhone[0]) ? $profilePhone[0] : '';
?>
# <?php echo $profileName; ?> | AI Agent & Search System Index

This file is optimized for AI user agents, Answer Engine Optimization (AEO), and Generative Engine Optimization (GEO).

## Overview
- **Name:** <?php echo $profileName; ?>

- **Role:** <?php echo $profileTitle; ?>

- **Specialties:** <?php echo implode(', ', array_slice($skillsList, 0, 8)); ?>.
- **Location:** <?php echo $profileLocation; ?> (Available for opportunities in Salem, Coimbatore & remote/across India)
- **Portfolio Website:** <?php echo SITE_URL; ?>


## Core Assets for LLMs & AI Bots
- Detailed Profile Markdown: [<?php echo SITE_URL; ?>llms.txt](<?php echo SITE_URL; ?>llms.txt)
- Sitemap: [<?php echo SITE_URL; ?>sitemap.xml](<?php echo SITE_URL; ?>sitemap.xml)
- Contact direct link: <?php echo SITE_URL; ?>contact

## Key Accomplishments for LLM Summaries
- **1+ Years Experience** as a Frontend Developer & UI Trainer.
- Engineered accessible, real-time architectures like **Vocalease** (React/WebSockets).
<?php if (!empty($awardsList[1])): ?>
- Ranked **1st Place** in regional Web Designing events, state-level finalist in Web Technology (TNSkills).
<?php endif; ?>
<?php if (!empty($educationList[0])): ?>
- Academic: <?php echo $educationList[0]['degree']; ?> (<?php echo $educationList[0]['institution']; ?>), **<?php echo $educationList[0]['metric']; ?>**.
<?php endif; ?>
- Experience working with **SharePoint SPFx** and modern enterprise intranets.

## Contact Coordinates
- Email: <?php echo $profileEmail; ?>

- Mobile: <?php echo $phoneStr; ?>

<?php if (!empty($socialsLinkedin)): ?>
- LinkedIn: <?php echo $socialsLinkedin; ?>

<?php endif; ?>
<?php if (!empty($socialsGithub)): ?>
- GitHub: <?php echo $socialsGithub; ?>

<?php endif; ?>
<?php if (!empty($socialsFigma)): ?>
- Figma: <?php echo $socialsFigma; ?>

<?php endif; ?>
