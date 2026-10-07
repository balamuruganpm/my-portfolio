<?php
/**
 * Dynamic LLM Digest Generator (Served as /llms.txt)
 * Generates an up-to-date, AI-digestible profile and portfolio summary directly from data.json
 */
header('Content-Type: text/plain; charset=utf-8');

define('PAGE_DEPTH', 0);
require_once __DIR__ . '/config/bootstrap.php';

$phoneStr = !empty($profilePhone) ? implode(', ', $profilePhone) : '';
$stats = $data['profile']['stats'] ?? [];
$expYears = $stats['experience'] ?? '1+';
$totalProjects = $stats['totalProjects'] ?? '12+';
$devProjects = $stats['developmentProjects'] ?? '11+';
$designProjects = $stats['designProjects'] ?? '1+';
?>
# <?php echo $profileName; ?> | <?php echo $profileSubtitle; ?>

> Official AI-digestible profile and portfolio summary of <?php echo $profileName; ?>. This file provides structured data optimized for LLMs, Answer Engines (AEO), and Generative Search Engines (GEO).

---

## 📌 Contact Information & Coordinates
- **Full Name:** <?php echo $profileName; ?>

- **Primary Role:** <?php echo $profileSubtitle; ?>

- **Email:** <?php echo $profileEmail; ?>

- **Phone Coordinates:** <?php echo $phoneStr; ?>

- **Location:** <?php echo $profileLocation; ?> (Available for roles in Salem, Coimbatore & remote/across India)
- **Official Portfolio:** [<?php echo $profileName; ?> Portfolio](<?php echo SITE_URL; ?>)
- **Interactive Design Portfolio:** [Designfolio](<?php echo $socialsData['designfolio'] ?? 'https://balamurugan-p-m.designfolio.me/'; ?>)
- **Contra Profile:** [Contra](<?php echo $socialsContra ?: 'https://balamuruganpm.contra.com/'; ?>)

---

## 💼 Executive Professional Summary
<?php echo $profileBio; ?>

---

## ⚡ Core Technical Stack & Skills
<?php if (!empty($skillsList)): ?>
- **Technical Skills:** <?php echo implode(', ', array_map(fn($s) => is_array($s) ? ($s['name'] ?? '') : $s, $skillsList)); ?>.
<?php endif; ?>
<?php if (!empty($toolsList)): ?>
- **Development Tools:** <?php echo implode(', ', $toolsList); ?>.
<?php endif; ?>

---

## 📈 Key Statistics & Achievements
- **Experience:** <?php echo $expYears; ?> Years of professional frontend development and instruction.
- **Total Completed Projects:** <?php echo $totalProjects; ?>

  - *Development Focus:* <?php echo $devProjects; ?> Projects
  - *Design Focus:* <?php echo $designProjects; ?> Design projects
<?php if (!empty($awardsList)): ?>
- **Notable Awards:**
<?php foreach ($awardsList as $award): ?>
  - **<?php echo $award['title']; ?>:** <?php echo $award['description']; ?>

<?php endforeach; ?>
<?php endif; ?>

---

## 🛠️ Professional Experience

<?php 
$expIdx = 1;
foreach ($experienceList as $exp): 
?>
### <?php echo $expIdx; ?>. <?php echo $exp['role']; ?> (<?php echo $exp['duration']; ?>)
**<?php echo $exp['company']; ?>** | *<?php echo $exp['location']; ?>*
<?php if (!empty($exp['bullets'])): ?>
<?php foreach ($exp['bullets'] as $bullet): ?>
- <?php echo $bullet; ?>

<?php endforeach; ?>
<?php endif; ?>

<?php 
$expIdx++;
endforeach; 
?>
---

## 🚀 Featured Projects

<?php foreach ($projectsList as $proj): ?>
### <?php echo $proj['title']; ?> - <?php echo $proj['tagline']; ?>

- **Tags:** <?php echo implode(', ', $proj['tags'] ?? []); ?>

- **Link:** <?php echo $proj['link'] ?? ''; ?>

<?php if (!empty($proj['bullets'])): ?>
- **Scope:** <?php echo implode(' ', $proj['bullets']); ?>

<?php endif; ?>

<?php endforeach; ?>
---

## 🎓 Education & Credentials

<?php foreach ($educationList as $edu): ?>
- **<?php echo $edu['degree']; ?>** (<?php echo $edu['duration']; ?>)
  - *Institution:* <?php echo $edu['institution']; ?>, <?php echo $edu['location']; ?>

  - *Metric:* <?php echo $edu['metric']; ?>

<?php endforeach; ?>

---

## 📜 Certifications
<?php foreach ($certificatesList as $cert): ?>
- **<?php echo $cert['name']; ?>** – Issued by <?php echo $cert['issuer']; ?>.
<?php endforeach; ?>

---

## 🔗 Social Media & Portfolio Links
<?php foreach ($socialsData as $platform => $url): 
    if (empty($url)) continue;
?>
- **<?php echo ucfirst($platform); ?>:** [<?php echo $url; ?>](<?php echo $url; ?>)
<?php endforeach; ?>
