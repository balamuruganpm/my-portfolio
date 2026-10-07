<?php
/**
 * SEO: JSON-LD Structured Data Schemas
 * Dynamic Schema.org generator for Person, Organization, WebSite, Breadcrumbs, BlogPosting, JobPosting, and VideoObject
 */

$same_as = [];
if (!empty($socialsLinkedin)) $same_as[] = $socialsLinkedin;
if (!empty($socialsGithub)) $same_as[] = $socialsGithub;
if (!empty($socialsFigma)) $same_as[] = $socialsFigma;
if (!empty($socialsBehance)) $same_as[] = $socialsBehance;
if (!empty($socialsDribbble)) $same_as[] = $socialsDribbble;
if (!empty($socialsFacebook)) $same_as[] = $socialsFacebook;
if (!empty($socialsTwitter)) $same_as[] = $socialsTwitter;
if (!empty($socialsInstagram)) $same_as[] = $socialsInstagram;

// 1. Person & ProfilePage Schema
$person_schema = [
    "@context" => "https://schema.org",
    "@type" => "Person",
    "name" => $profileName,
    "jobTitle" => $profileTitle,
    "description" => $profileBio,
    "url" => SITE_URL,
    "email" => $profileEmail,
    "image" => SITE_URL . "assets/images/balamurugan-pm.webp",
    "address" => [
        "@type" => "PostalAddress",
        "addressLocality" => $profileLocation,
        "addressCountry" => "IN"
    ],
    "sameAs" => $same_as
];

if (!empty($educationList)) {
    $alumni = [];
    foreach ($educationList as $edu) {
        if (!empty($edu['institution'])) {
            $alumni[] = [
                "@type" => "EducationalOrganization",
                "name" => $edu['institution']
            ];
        }
    }
    $person_schema["alumniOf"] = $alumni;
}

if (!empty($skillsList)) {
    $skills = [];
    foreach ($skillsList as $sk) {
        $name = is_array($sk) ? (!empty($sk['name']) ? $sk['name'] : '') : $sk;
        if (!empty($name)) {
            $skills[] = $name;
        }
    }
    $person_schema["knowsAbout"] = $skills;
}

echo '<script type="application/ld+json">' . json_encode($person_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;

// 2. Organization Schema
$org_schema = [
    "@context" => "https://schema.org",
    "@type" => "Organization",
    "name" => $profileName . " Designs",
    "url" => SITE_URL,
    "logo" => SITE_URL . "assets/images/favicon.webp",
    "sameAs" => $same_as
];
echo '<script type="application/ld+json">' . json_encode($org_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;

// 3. WebSite Search Schema
$website_schema = [
    "@context" => "https://schema.org",
    "@type" => "WebSite",
    "name" => $profileName . " Portfolio",
    "url" => SITE_URL,
    "potentialAction" => [
        "@type" => "SearchAction",
        "target" => SITE_URL . "blogs?search={search_term_string}",
        "query-input" => "required name=search_term_string"
    ]
];
echo '<script type="application/ld+json">' . json_encode($website_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;

// 4. Professional Service (Local Business) Schema
$business_schema = [
    "@context" => "https://schema.org",
    "@type" => "ProfessionalService",
    "name" => $profileName . " - Frontend Developer",
    "image" => SITE_URL . "assets/images/balamurugan-pm.webp",
    "priceRange" => "$$",
    "telephone" => !empty($profilePhone[0]) ? $profilePhone[0] : "",
    "url" => SITE_URL,
    "address" => [
        "@type" => "PostalAddress",
        "addressLocality" => $profileLocation,
        "addressCountry" => "IN"
    ]
];
echo '<script type="application/ld+json">' . json_encode($business_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;

// 5. Breadcrumb Navigation Schema
$crumbs = [
    [
        "@type" => "ListItem",
        "position" => 1,
        "name" => "Home",
        "item" => SITE_URL
    ]
];
if (isset($thisPage) && $thisPage !== 'Home') {
    $pageSlug = strtolower(str_replace(' ', '-', $thisPage));
    $crumbs[] = [
        "@type" => "ListItem",
        "position" => 2,
        "name" => $thisPage,
        "item" => SITE_URL . $pageSlug
    ];
    if (isset($post) && !empty($post)) {
        $crumbs[] = [
            "@type" => "ListItem",
            "position" => 3,
            "name" => $post['title'],
            "item" => !empty($post['slug']) ? (SITE_URL . 'blogs/detail?slug=' . $post['slug']) : (SITE_URL . 'blogs/detail?id=' . $post['id'])
        ];
    }
}
$breadcrumb_schema = [
    "@context" => "https://schema.org",
    "@type" => "BreadcrumbList",
    "itemListElement" => $crumbs
];
echo '<script type="application/ld+json">' . json_encode($breadcrumb_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;

// 6. Contextual Schemas (Job, Blog, Video)
if (isset($post) && !empty($post)) {
    if (!empty($post['category']) && strtolower($post['category']) === 'job') {
        // Job Posting Schema
        $job_schema = [
            "@context" => "https://schema.org",
            "@type" => "JobPosting",
            "title" => $post['title'],
            "description" => htmlspecialchars($post['snippet'] . " - " . strip_tags($post['content'])),
            "datePosted" => date('c', strtotime($post['date'])),
            "validThrough" => date('c', strtotime($post['date'] . ' + 90 days')),
            "employmentType" => !empty($post['job_type']) ? strtoupper(str_replace('-', '_', $post['job_type'])) : "FULL_TIME",
            "hiringOrganization" => [
                "@type" => "Organization",
                "name" => !empty($post['company']) ? $post['company'] : $profileName,
                "sameAs" => SITE_URL
            ],
            "jobLocation" => [
                "@type" => "Place",
                "address" => [
                    "@type" => "PostalAddress",
                    "addressLocality" => !empty($post['job_location']) ? $post['job_location'] : $profileLocation,
                    "addressCountry" => "IN"
                ]
            ]
        ];
        
        if (!empty($post['salary'])) {
            $job_schema["baseSalary"] = [
                "@type" => "MonetaryAmount",
                "currency" => "INR",
                "value" => [
                    "@type" => "QuantitativeValue",
                    "value" => $post['salary'],
                    "unitText" => "MONTH"
                ]
            ];
        }
        echo '<script type="application/ld+json">' . json_encode($job_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;
    } else {
        // Blog Posting Schema
        $article_schema = [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $post['title'],
            "description" => $post['snippet'],
            "datePublished" => date('c', strtotime($post['date'])),
            "author" => [
                "@type" => "Person",
                "name" => $profileName,
                "url" => SITE_URL
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => $profileName,
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => SITE_URL . "assets/images/favicon.webp"
                ]
            ]
        ];
        
        if (!empty($post['image'])) {
            $article_schema["image"] = SITE_URL . $post['image'];
        }
        echo '<script type="application/ld+json">' . json_encode($article_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;
    }
    
    // Video Attachment Object Schema
    if (!empty($post['video'])) {
        $video_schema = [
            "@context" => "https://schema.org",
            "@type" => "VideoObject",
            "name" => $post['title'] . " Presentation Video",
            "description" => $post['snippet'],
            "thumbnailUrl" => !empty($post['image']) ? (SITE_URL . $post['image']) : (SITE_URL . "assets/images/placeholder.webp"),
            "uploadDate" => date('c', strtotime($post['date'])),
            "contentUrl" => SITE_URL . $post['video']
        ];
        echo '<script type="application/ld+json">' . json_encode($video_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;
    }
}
