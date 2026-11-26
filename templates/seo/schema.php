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
    "logo" => SITE_URL . "web-app-manifest-512x512.png",
    "sameAs" => $same_as
];
echo '<script type="application/ld+json">' . json_encode($org_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;

// 2B. ProfilePage Schema (Google Official Creator/Portfolio Rich Result)
if (!isset($thisPage) || in_array(strtolower($thisPage), ['home', 'about'], true)) {
    $profile_page_schema = [
        "@context" => "https://schema.org",
        "@type" => "ProfilePage",
        "dateCreated" => "2024-01-01T00:00:00+05:30",
        "dateModified" => date('c'),
        "mainEntity" => [
            "@type" => "Person",
            "name" => $profileName,
            "alternateName" => "Bala",
            "description" => $profileBio,
            "image" => SITE_URL . "assets/images/balamurugan-pm.webp",
            "sameAs" => $same_as
        ]
    ];
    echo '<script type="application/ld+json">' . json_encode($profile_page_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;
}

// 2C. Blog CollectionPage + ItemList Schema on /blogs
if (isset($thisPage) && strtolower($thisPage) === 'blogs' && empty($post) && !empty($publishedBlogs)) {
    $itemList = [];
    foreach (array_slice($publishedBlogs, 0, 20) as $idx => $b) {
        if (empty($b['slug'])) continue;
        $itemList[] = [
            "@type" => "ListItem",
            "position" => $idx + 1,
            "url" => SITE_URL . "blogs/" . $b['slug'],
            "name" => $b['title'] ?? ''
        ];
    }
    if (!empty($itemList)) {
        $collection_schema = [
            "@context" => "https://schema.org",
            "@type" => "CollectionPage",
            "name" => "Technical Articles & Engineering Publications | " . $profileName,
            "url" => SITE_URL . "blogs",
            "mainEntity" => [
                "@type" => "ItemList",
                "itemListElement" => $itemList
            ]
        ];
        echo '<script type="application/ld+json">' . json_encode($collection_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;
    }
}

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

// 4. Professional Service (Local Business / Regional GEO Schema)
$business_schema = [
    "@context" => "https://schema.org",
    "@type" => "ProfessionalService",
    "name" => $profileName . " - Website Developer & Frontend Architect",
    "description" => "Website development, React.js, TypeScript, SharePoint SPFx, and SEO-optimized web applications serving Salem, Coimbatore, Chennai, and Tamil Nadu, India.",
    "image" => SITE_URL . "assets/images/balamurugan-pm.webp",
    "priceRange" => "$$",
    "telephone" => !empty($profilePhone[0]) ? $profilePhone[0] : "",
    "url" => SITE_URL,
    "serviceType" => [
        "Website Development",
        "Frontend Web Application Development",
        "React.js & Next.js Development",
        "SharePoint SPFx Solutions",
        "UI/UX Design & Performance Optimization"
    ],
    "areaServed" => [
        ["@type" => "City", "name" => "Salem", "containedInPlace" => ["@type" => "State", "name" => "Tamil Nadu"]],
        ["@type" => "City", "name" => "Coimbatore", "containedInPlace" => ["@type" => "State", "name" => "Tamil Nadu"]],
        ["@type" => "City", "name" => "Chennai", "containedInPlace" => ["@type" => "State", "name" => "Tamil Nadu"]],
        ["@type" => "State", "name" => "Tamil Nadu"],
        ["@type" => "Country", "name" => "India"]
    ],
    "address" => [
        "@type" => "PostalAddress",
        "addressLocality" => $profileLocation,
        "addressRegion" => "Tamil Nadu",
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
            "item" => !empty($post['slug']) ? (SITE_URL . 'blogs/' . $post['slug']) : (SITE_URL . 'blogs/detail?id=' . $post['id'])
        ];
    }
}
$breadcrumb_schema = [
    "@context" => "https://schema.org",
    "@type" => "BreadcrumbList",
    "itemListElement" => $crumbs
];
echo '<script type="application/ld+json">' . json_encode($breadcrumb_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;

// 6. FAQPage Schema (Top AEO & GEO for ChatGPT, Claude, Perplexity, and Google AI Overviews)
$faq_schema = [
    "@context" => "https://schema.org",
    "@type" => "FAQPage",
    "mainEntity" => [
        [
            "@type" => "Question",
            "name" => "Who is Balamurugan P M?",
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => "Balamurugan P M is a Frontend Developer and Enterprise SharePoint Framework (SPFx) specialist based in Tamil Nadu, India. He builds responsive, ultra-high-performance web applications using React.js, TypeScript, Next.js, and SharePoint Online."
            ]
        ],
        [
            "@type" => "Question",
            "name" => "What technologies and frameworks does Balamurugan specialize in?",
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => "His core technical expertise includes React.js, TypeScript, JavaScript (ES6+), SharePoint Framework (SPFx), Microsoft Graph APIs, PnP JS, PHP, Tailwind CSS, Bootstrap 5, Figma Design Systems, and Core Web Vitals optimization."
            ]
        ],
        [
            "@type" => "Question",
            "name" => "How can I hire Balamurugan P M or initiate a project?",
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => "You can reach Balamurugan via email at balamuruganedsty@gmail.com, via telephone/WhatsApp at +91 9677804820, or via the interactive Contact Portal on his official portfolio website."
            ]
        ],
        [
            "@type" => "Question",
            "name" => "Is Balamurugan available for website development in Salem, Coimbatore, Chennai, and Tamil Nadu?",
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => "Yes. Balamurugan P M provides full-cycle website development, React.js web apps, e-commerce sites, and enterprise SharePoint SPFx solutions for businesses in Salem, Coimbatore, Chennai, and across Tamil Nadu, as well as 100% remote contracts worldwide."
            ]
        ],
        [
            "@type" => "Question",
            "name" => "What makes Balamurugan P M a top website developer in Tamil Nadu?",
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => "He combines modern React.js/TypeScript engineering with Core Web Vitals speed optimization, Schema.org SEO/GEO/AEO implementation, and Figma UI/UX design systems to deliver fast, high-ranking websites."
            ]
        ]
    ]
];
echo '<script type="application/ld+json">' . json_encode($faq_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . PHP_EOL;

// 7. Contextual Schemas (Job, Blog, Video)
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
        // Blog Posting Schema (Rich Google Search Result + AEO Speakable)
        $canonicalArticleUrl = !empty($post['slug']) ? (SITE_URL . 'blogs/' . $post['slug']) : (SITE_URL . 'blogs/detail?id=' . ($post['id'] ?? ''));
        $shortArticleUrl = !empty($post['id']) ? (SITE_URL . 'b/' . $post['id']) : $canonicalArticleUrl;
        $wordCount = str_word_count(strip_tags($post['content'] ?? ''));
        $readMinutes = max(1, (int)ceil($wordCount / 200));

        $article_schema = [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => $canonicalArticleUrl
            ],
            "headline" => $post['title'],
            "description" => !empty($post['seo_description']) ? $post['seo_description'] : ($post['snippet'] ?? ''),
            "url" => $canonicalArticleUrl,
            "sameAs" => $shortArticleUrl,
            "datePublished" => date('c', strtotime($post['date'] ?? 'now')),
            "dateModified" => date('c', strtotime($post['updated_at'] ?? ($post['date'] ?? 'now'))),
            "articleSection" => $post['category'] ?? 'Technology',
            "keywords" => !empty($post['seo_keywords']) ? $post['seo_keywords'] : (isset($post['tags']) && is_array($post['tags']) ? implode(', ', $post['tags']) : ''),
            "wordCount" => $wordCount,
            "timeRequired" => "PT{$readMinutes}M",
            "inLanguage" => "en-US",
            "speakable" => [
                "@type" => "SpeakableSpecification",
                "cssSelector" => ["#detail-title", "#detail-snippet", "#detail-body"]
            ],
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
                    "url" => SITE_URL . "web-app-manifest-512x512.png"
                ]
            ]
        ];
        
        if (!empty($post['image'])) {
            $article_schema["image"] = [
                "@type" => "ImageObject",
                "url" => SITE_URL . ltrim($post['image'], '/')
            ];
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
