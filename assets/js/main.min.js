/**
 * Master Antigravity Web OS Controller (v2.8)
 * Single-Viewport 100vw x 100vh Responsive System Architecture
 * Author: Balamurugan P M
 */

(function () {
    'use strict';

    // Core DOM Elements
    const osViewport = document.getElementById('os-viewport');
    const homeVideoEl = document.getElementById('os-home-video');
    const sectionBgEl = document.getElementById('os-section-bg');
    const dossierModal = document.getElementById('os-dossier-modal');
    const desktopGrid = document.getElementById('os-desktop-grid');
    const superheroesLayer = document.getElementById('os-superheroes');
    const hudBar = document.getElementById('os-hud-bar');
    const bottomTag = document.getElementById('bottom-tag') || document.getElementById('dossier-bottom-tag');
    const bottomTitle = document.getElementById('bottom-title') || document.getElementById('dossier-bottom-title');
    const bottomScrollBody = document.getElementById('dossier-scroll-body') || document.getElementById('dossier-bottom-scroll');
    const centralHero = document.getElementById('os-central-hero');
    const bottomDock = document.getElementById('os-dock');
    const activityCorner = document.getElementById('os-activity-corner');
    const activityTrigger = document.getElementById('os-activity-trigger');
    const activityPanel = document.getElementById('os-activity-panel');
    const activityCloseBtn = document.getElementById('activity-panel-close-btn');
    const home3dDeck = document.getElementById('os-home-3d-deck');
    const baseUrl = osViewport ? (osViewport.getAttribute('data-base-url') || '/') : '/';

    // Section Background Mapping (Loads custom wallpapers when present; keeps ambient background otherwise)
    const SECTION_BG_MAP = {
        about: ['assets/images/os/about-bg.webp'],
        portfolio: ['assets/images/os/projects-bg.webp', 'assets/images/os/portfolio-bg.webp'],
        blogs: ['assets/images/os/blog-bg.webp', 'assets/images/os/blogs-bg.webp'],
        game: ['assets/images/os/games-bg.webp'],
        contact: ['assets/images/os/contact-bg.webp']
    };

    // Application Configuration Registry
    const APPS = {
        home: {
            title: 'Bala @2027 – Portfolio',
            route: baseUrl,
            tag: '// HOME_DESKTOP',
            heading: 'Desktop Home',
            panelId: null
        },
        about: {
            title: 'About Me | Balamurugan P M',
            route: baseUrl + 'about',
            tag: '// TECHNICAL_CAPABILITIES',
            heading: 'Skills & Technology Stack',
            panelId: 'panel-about'
        },
        portfolio: {
            title: 'Portfolio Works | Balamurugan P M',
            route: baseUrl + 'portfolio',
            tag: '// PORTFOLIO_SHOWCASE',
            heading: 'Featured Engineering Works & Projects',
            panelId: 'panel-portfolio'
        },
        blogs: {
            title: 'Blog & Articles | Balamurugan P M',
            route: baseUrl + 'blogs',
            tag: '// KNOWLEDGE_DISPATCH',
            heading: 'Technical Articles & Engineering Publications',
            panelId: 'panel-blogs'
        },
        game: {
            title: 'Arcade & Retro Games | Balamurugan P M',
            route: baseUrl + 'game',
            tag: '// ARCADE_MATRIX',
            heading: 'MiniCraft & Interactive Simulations',
            panelId: 'panel-game'
        },
        contact: {
            title: 'Contact Us | Balamurugan P M',
            route: baseUrl + 'contact',
            tag: '// TRANSMISSION_PORTAL',
            heading: 'Direct Communications & Inquiries',
            panelId: 'panel-contact'
        }
    };

    let currentApp = osViewport ? (osViewport.getAttribute('data-active-app') || 'home') : 'home';

    // Strictly ensure bottom dock is hidden on home page load
    if (bottomDock && currentApp === 'home') {
        bottomDock.classList.add('d-none');
        bottomDock.style.display = 'none';
    }

    // Pre-cached Blogs Data
    let cachedBlogs = [];
    const blogsDataEl = document.getElementById('blogs-data');
    if (blogsDataEl) {
        try {
            cachedBlogs = JSON.parse(blogsDataEl.textContent.trim());
        } catch (e) {
            cachedBlogs = [];
        }
    }

    // Pre-cached Projects Data & Modal Controller
    let cachedProjects = [];
    const projectsDataEl = document.getElementById('projects-data');
    if (projectsDataEl) {
        try {
            cachedProjects = JSON.parse(projectsDataEl.textContent.trim());
        } catch (e) {
            cachedProjects = [];
        }
    }

    const imageLightbox = document.getElementById('os-image-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxImgCanvas = document.getElementById('lightbox-img-canvas');
    const lightboxScrollViewport = document.getElementById('lightbox-scroll-viewport');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxZoomVal = document.getElementById('lightbox-zoom-val');
    const zoomInBtn = document.getElementById('lightbox-zoom-in');
    const zoomOutBtn = document.getElementById('lightbox-zoom-out');
    const zoomFitBtn = document.getElementById('lightbox-zoom-fit');
    const zoomWidthBtn = document.getElementById('lightbox-zoom-width');
    const zoomResetBtn = document.getElementById('lightbox-zoom-reset');

    let currentZoom = 1.0;
    let currentMode = 'width'; // 'width' = full readable width for websites, 'fit' = fit screen

    function updateZoom(newZoom) {
        currentZoom = Math.min(3.0, Math.max(0.25, Math.round(newZoom * 100) / 100));
        if (lightboxZoomVal) {
            lightboxZoomVal.textContent = Math.round(currentZoom * 100) + '%';
        }
        if (lightboxImgCanvas) {
            lightboxImgCanvas.style.transform = `scale(${currentZoom})`;
        }
    }

    function setLightboxMode(mode) {
        currentMode = mode;
        if (!lightboxImg) return;
        if (mode === 'fit') {
            lightboxImg.classList.add('mode-fit');
            lightboxImg.classList.remove('mode-full');
            if (zoomFitBtn) zoomFitBtn.classList.add('active');
            if (zoomWidthBtn) zoomWidthBtn.classList.remove('active');
        } else {
            lightboxImg.classList.remove('mode-fit');
            lightboxImg.classList.add('mode-full');
            if (zoomFitBtn) zoomFitBtn.classList.remove('active');
            if (zoomWidthBtn) zoomWidthBtn.classList.add('active');
        }
    }

    function openImageLightbox(imgSrc, title) {
        if (!imageLightbox || !lightboxImg) return;
        lightboxImg.src = imgSrc;
        lightboxImg.alt = title || 'Full Portfolio View';
        if (lightboxCaption) {
            lightboxCaption.textContent = title || '';
        }
        setLightboxMode('width');
        updateZoom(1.0);
        if (lightboxScrollViewport) {
            lightboxScrollViewport.scrollTop = 0;
            lightboxScrollViewport.scrollLeft = 0;
        }
        imageLightbox.classList.add('show');
    }

    function closeImageLightbox() {
        if (imageLightbox) {
            imageLightbox.classList.remove('show');
            setTimeout(() => {
                if (!imageLightbox.classList.contains('show') && lightboxImg) {
                    lightboxImg.src = '';
                    updateZoom(1.0);
                }
            }, 300);
        }
    }

    // Attach Lightbox Zoom & Mode Controls
    if (zoomInBtn) {
        zoomInBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            updateZoom(currentZoom + 0.25);
        });
    }
    if (zoomOutBtn) {
        zoomOutBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            updateZoom(currentZoom - 0.25);
        });
    }
    if (zoomFitBtn) {
        zoomFitBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            setLightboxMode('fit');
            updateZoom(1.0);
        });
    }
    if (zoomWidthBtn) {
        zoomWidthBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            setLightboxMode('width');
            updateZoom(1.0);
        });
    }
    if (zoomResetBtn) {
        zoomResetBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            setLightboxMode('width');
            updateZoom(1.0);
            if (lightboxScrollViewport) {
                lightboxScrollViewport.scrollTop = 0;
            }
        });
    }
    if (lightboxImg) {
        lightboxImg.addEventListener('click', (e) => {
            e.stopPropagation();
            if (currentMode === 'fit') {
                setLightboxMode('width');
                updateZoom(1.0);
            } else {
                setLightboxMode('fit');
                updateZoom(1.0);
            }
        });
    }
    if (lightboxScrollViewport) {
        lightboxScrollViewport.addEventListener('wheel', (e) => {
            if (e.ctrlKey) {
                e.preventDefault();
                const delta = e.deltaY < 0 ? 0.15 : -0.15;
                updateZoom(currentZoom + delta);
            }
        }, { passive: false });
        lightboxScrollViewport.addEventListener('click', (e) => {
            if (e.target === lightboxScrollViewport || e.target === lightboxImgCanvas) {
                closeImageLightbox();
            }
        });
    }

    const projectModal = document.getElementById('os-project-modal');
    const pModalImg = document.getElementById('project-modal-img');
    const pModalTitle = document.getElementById('project-modal-title');
    const pModalTagline = document.getElementById('project-modal-tagline');
    const pModalBullets = document.getElementById('project-modal-bullets');
    const pModalTags = document.getElementById('project-modal-tags');
    const pModalLink = document.getElementById('project-modal-link');
    const pModalBadge = document.getElementById('project-modal-badge');

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function openProjectModal(proj) {
        if (!proj) return;
        if (!projectModal) {
            const imgSrc = proj.image ? (baseUrl + proj.image.replace(/^\//, '')) : '';
            openImageLightbox(imgSrc, proj.title);
            return;
        }
        if (pModalTitle) pModalTitle.textContent = proj.title || 'Project';
        if (pModalTagline) pModalTagline.textContent = proj.tagline || '';
        if (pModalImg && proj.image) {
            pModalImg.src = baseUrl + proj.image.replace(/^\//, '');
            pModalImg.alt = proj.title || 'Project Preview';
        }
        if (pModalBadge) {
            pModalBadge.textContent = (proj.tags && proj.tags[0]) ? proj.tags[0] : 'Featured';
        }
        if (pModalBullets) {
            if (proj.bullets && Array.isArray(proj.bullets)) {
                pModalBullets.innerHTML = proj.bullets.map(b => `<li>${escapeHtml(b)}</li>`).join('');
            } else {
                pModalBullets.innerHTML = '';
            }
        }
        if (pModalTags) {
            if (proj.tags && Array.isArray(proj.tags)) {
                pModalTags.innerHTML = proj.tags.map(t => `<span class="dossier-badge">${escapeHtml(t)}</span>`).join('');
            } else {
                pModalTags.innerHTML = '';
            }
        }
        if (pModalLink) {
            if (proj.link) {
                pModalLink.href = proj.link;
                pModalLink.style.display = 'inline-flex';
            } else {
                pModalLink.style.display = 'none';
            }
        }
        projectModal.classList.add('show');
    }

    function closeProjectModal() {
        if (projectModal) {
            projectModal.classList.remove('show');
        }
    }

    // ============================================================
    // BACKGROUND MANAGER (Persistent Video on Home, Smooth Fallback)
    // ============================================================

    function updatePageBackground(appName) {
        if (!homeVideoEl) return;

        if (appName === 'home') {
            if (sectionBgEl) {
                sectionBgEl.style.opacity = '0';
                setTimeout(() => {
                    if (currentApp === 'home' && sectionBgEl) {
                        sectionBgEl.style.display = 'none';
                        sectionBgEl.style.backgroundImage = 'none';
                    }
                }, 300);
            }
            homeVideoEl.style.display = 'block';
            homeVideoEl.style.opacity = '1';
            homeVideoEl.muted = true;
            homeVideoEl.loop = true;
            const playPromise = homeVideoEl.play();
            if (playPromise !== undefined) {
                playPromise.catch(() => {});
            }
            return;
        }

        const candidates = SECTION_BG_MAP[appName] || [];
        if (candidates.length === 0) {
            if (sectionBgEl) sectionBgEl.style.display = 'none';
            homeVideoEl.style.display = 'block';
            homeVideoEl.style.opacity = '1';
            return;
        }

        function tryCandidate(index) {
            if (index >= candidates.length) {
                // If candidate images not found, keep video background visible with glass blur
                if (sectionBgEl) sectionBgEl.style.display = 'none';
                homeVideoEl.style.display = 'block';
                homeVideoEl.style.opacity = '1';
                return;
            }

            const candidateUrl = baseUrl + candidates[index];
            const testImg = new Image();
            testImg.onload = function () {
                if (currentApp !== appName) return; // Prevent out-of-order race
                if (sectionBgEl) {
                    sectionBgEl.style.backgroundImage = 'url("' + candidateUrl + '")';
                    sectionBgEl.style.display = 'block';
                    sectionBgEl.style.opacity = '1';
                }
                homeVideoEl.style.opacity = '0';
            };
            testImg.onerror = function () {
                tryCandidate(index + 1);
            };
            testImg.src = candidateUrl;
        }

        tryCandidate(0);
    }

    // Video Autoplay Resilience & Seamless Infinite Looping
    if (homeVideoEl) {
        homeVideoEl.muted = true;
        homeVideoEl.defaultMuted = true;
        homeVideoEl.loop = true;
        homeVideoEl.playsInline = true;

        const loopAndPlay = function () {
            if (currentApp === 'home') {
                homeVideoEl.currentTime = 0;
                const p = homeVideoEl.play();
                if (p && typeof p.catch === 'function') {
                    p.catch(() => {});
                }
            }
        };

        // Standard ended event listener for looping
        homeVideoEl.addEventListener('ended', loopAndPlay);

        // Sub-second near-end detection to ensure smooth seamless looping without pauses
        homeVideoEl.addEventListener('timeupdate', function () {
            if (homeVideoEl.duration && homeVideoEl.currentTime >= (homeVideoEl.duration - 0.25)) {
                loopAndPlay();
            }
        });

        // Resume if unexpectedly paused while on home desktop
        homeVideoEl.addEventListener('pause', function () {
            if (currentApp === 'home' && !document.hidden && homeVideoEl.paused) {
                homeVideoEl.play().catch(() => {});
            }
        });

        // Tab switch / visibility restore
        document.addEventListener('visibilitychange', function () {
            if (document.visibilityState === 'visible' && currentApp === 'home' && homeVideoEl.paused) {
                homeVideoEl.play().catch(() => {});
            }
        });

        // Autoplay policy unlocker on user interaction
        const unlockAndPlay = function () {
            if (currentApp === 'home') {
                homeVideoEl.muted = true;
                homeVideoEl.loop = true;
                homeVideoEl.play().catch(() => {});
            }
        };

        unlockAndPlay();
        window.addEventListener('load', unlockAndPlay);
        document.addEventListener('click', unlockAndPlay, { once: true });
        document.addEventListener('touchstart', unlockAndPlay, { once: true, passive: true });
        document.addEventListener('keydown', unlockAndPlay, { once: true });
    }

    // ============================================================
    // APP SWITCHER & WINDOW MANAGER
    // ============================================================

    function launchApp(appName, updateHistory = true) {
        if (!APPS[appName]) return;
        currentApp = appName;

        // If Home is clicked, minimize dossier
        if (appName === 'home') {
            closeDossier(updateHistory);
            return;
        }

        // Open dossier window
        if (osViewport) {
            osViewport.classList.remove('desktop-active');
            osViewport.classList.add('dossier-active');
            osViewport.setAttribute('data-active-app', appName);
        }
        if (desktopGrid) desktopGrid.classList.add('fade-out');
        if (superheroesLayer) superheroesLayer.classList.add('fade-out');
        if (hudBar) hudBar.classList.add('fade-out');
        if (centralHero) centralHero.classList.add('fade-out');
        if (activityCorner) activityCorner.classList.add('fade-out');
        if (home3dDeck) home3dDeck.classList.add('fade-out');
        if (activityPanel) activityPanel.classList.remove('show');
        if (dossierModal) {
            dossierModal.classList.add('visible');
            dossierModal.scrollTop = 0;
        }
        if (bottomDock) {
            bottomDock.classList.remove('d-none');
            bottomDock.style.display = 'flex';
        }

        // Update background
        updatePageBackground(appName);

        // Update dossier bottom card header
        const appConfig = APPS[appName];
        if (bottomTag) bottomTag.textContent = appConfig.tag;
        if (bottomTitle) bottomTitle.textContent = appConfig.heading;

        // Update active panels
        const panels = document.querySelectorAll('.dossier-panel');
        panels.forEach(p => p.classList.remove('active'));
        if (appConfig.panelId) {
            const activePanel = document.getElementById(appConfig.panelId);
            if (activePanel) {
                activePanel.classList.add('active');
                if (bottomScrollBody) bottomScrollBody.scrollTop = 0;
            }
        }

        // Update mini pill tabs in bottom card
        const miniPills = document.querySelectorAll('.dossier-mini-pill-btn');
        miniPills.forEach(pill => {
            pill.classList.toggle('active', pill.getAttribute('data-app') === appName);
        });

        // Update dock halos
        updateDockState(appName);

        // Update URL & title
        if (updateHistory) {
            window.history.pushState({ app: appName }, appConfig.title, appConfig.route);
            document.title = appConfig.title;
        }
    }

    function closeDossier(updateHistory = true) {
        currentApp = 'home';
        if (osViewport) {
            osViewport.classList.remove('dossier-active');
            osViewport.classList.add('desktop-active');
            osViewport.setAttribute('data-active-app', 'home');
        }
        if (dossierModal) dossierModal.classList.remove('visible');
        if (desktopGrid) desktopGrid.classList.remove('fade-out');
        if (superheroesLayer) superheroesLayer.classList.remove('fade-out');
        if (hudBar) hudBar.classList.remove('fade-out');
        if (centralHero) centralHero.classList.remove('fade-out');
        if (activityCorner) activityCorner.classList.remove('fade-out');
        if (home3dDeck) home3dDeck.classList.remove('fade-out');
        if (bottomDock) {
            bottomDock.classList.add('d-none');
            bottomDock.style.display = 'none';
        }

        // Restore video background
        updatePageBackground('home');

        updateDockState('home');

        if (updateHistory) {
            window.history.pushState({ app: 'home' }, APPS.home.title, APPS.home.route);
            document.title = APPS.home.title;
        }
    }

    function updateDockState(activeName) {
        const dockItems = document.querySelectorAll('.dock-item');
        dockItems.forEach(item => {
            const app = item.getAttribute('data-app');
            item.classList.toggle('active', app === activeName);
        });

        const desktopBtns = document.querySelectorAll('.os-desktop-icon-btn');
        desktopBtns.forEach(sc => {
            const app = sc.getAttribute('data-app');
            sc.classList.toggle('active', app === activeName);
        });
    }

    // ============================================================
    // IN-APP BLOG DETAIL ROUTER
    // ============================================================

    function displayBlogPost(slug, updateHistory = true) {
        const post = cachedBlogs.find(b => b.slug === slug);
        const detailPanel = document.getElementById('panel-blog-detail');
        const blogsPanel = document.getElementById('panel-blogs');
        if (!detailPanel || !blogsPanel) return;

        if (post) {
            const dTitle = document.getElementById('detail-title');
            const dCat = document.getElementById('detail-category');
            const dDate = document.getElementById('detail-date');
            const dViews = document.getElementById('detail-views');
            const dSnippet = document.getElementById('detail-snippet');
            const dBody = document.getElementById('detail-body');
            const dImg = document.getElementById('detail-img');
            const dTags = document.getElementById('detail-tags');

            if (dTitle) dTitle.textContent = post.title || 'Technical Article';
            if (dCat) dCat.textContent = post.category || 'Tech';
            if (dDate) dDate.innerHTML = `<i class="bi bi-calendar3 me-1 text-cyan"></i>${post.date || 'Recent'}`;
            if (dViews) dViews.innerHTML = `<i class="bi bi-eye text-cyan me-1"></i>${Number(post.views || 0).toLocaleString()} views`;
            if (dSnippet) dSnippet.textContent = post.snippet || '';
            if (dBody) dBody.innerHTML = post.content || '<p class="text-secondary">Full article content.</p>';
            if (dImg && post.image) {
                dImg.src = baseUrl + post.image.replace(/^\//, '');
                dImg.alt = post.title || 'Article';
            }
            if (dTags && post.tags && Array.isArray(post.tags)) {
                dTags.innerHTML = post.tags.map(t => `<span class="badge-mini-tag">#${t}</span>`).join('');
            }
            const dShortBtn = document.getElementById('blog-copy-shortlink-btn');
            if (dShortBtn && post.id) {
                const shortUrl = baseUrl + 'b/' + encodeURIComponent(post.id);
                dShortBtn.setAttribute('data-shortlink', shortUrl);
                dShortBtn.setAttribute('title', 'Copy Shortlink (' + shortUrl + ')');
            }

            blogsPanel.classList.remove('active');
            detailPanel.classList.add('active');
            if (bottomScrollBody) bottomScrollBody.scrollTop = 0;
            if (dossierModal) {
                dossierModal.scrollTop = 0;
            }
            const detailContainer = document.getElementById('panel-blog-detail');
            if (detailContainer && typeof detailContainer.scrollIntoView === 'function') {
                detailContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            if (updateHistory) {
                window.history.pushState({ app: 'blogs', slug: slug }, post.title, baseUrl + 'blogs/' + encodeURIComponent(slug));
                document.title = `${post.title} | Balamurugan P M`;
            }
        } else {
            // Fetch via AJAX if not in pre-cached dataset
            fetch(baseUrl + 'blogs/' + encodeURIComponent(slug) + '?ajax=1')
                .then(r => r.json())
                .then(res => {
                    if (res.activePost) {
                        cachedBlogs.push(res.activePost);
                        displayBlogPost(slug, updateHistory);
                    }
                })
                .catch(() => {});
        }
    }

    // ============================================================
    // EVENT LISTENERS: SHORTCUTS, DOCK & ROUTING
    // ============================================================

    document.addEventListener('click', function (e) {
        // Desktop Shortcut / Hotspot / 3D Icon / Central CTA / 3D Home Deck Click
        const shortcut = e.target.closest('.os-desktop-icon-btn, .os-hotspot-btn, .os-app-shortcut, .central-cta-btn[data-app], .activity-shortcut-btn[data-app], .home-3d-card[data-app], .home-3d-center-btn[data-app]');
        if (shortcut) {
            e.preventDefault();
            const app = shortcut.getAttribute('data-app');
            launchApp(app);
            return;
        }

        // Dock Item Click
        const dockBtn = e.target.closest('.dock-item');
        if (dockBtn) {
            e.preventDefault();
            const app = dockBtn.getAttribute('data-app');
            launchApp(app);
            return;
        }

        // Mini Pill Button in Dossier Bottom Card
        const miniPill = e.target.closest('.dossier-mini-pill-btn[data-app]');
        if (miniPill) {
            e.preventDefault();
            const app = miniPill.getAttribute('data-app');
            launchApp(app);
            return;
        }

        // Blog Category / View All Filter Click
        const catBtn = e.target.closest('.blog-cat-filter');
        if (catBtn) {
            e.preventDefault();
            const cat = catBtn.getAttribute('data-cat') || 'all';
            document.querySelectorAll('.blog-cat-filter').forEach(b => b.classList.remove('active'));
            catBtn.classList.add('active');
            document.querySelectorAll('#blog-cards-grid .blog-grid-card').forEach(card => {
                const cardCat = (card.getAttribute('data-category') || '').toLowerCase();
                card.style.display = (cat === 'all' || cardCat === cat) ? 'flex' : 'none';
            });
            return;
        }

        // Copy Article Shortlink (from card or detail view)
        const shortlinkBtn = e.target.closest('.copy-shortlink-btn');
        if (shortlinkBtn) {
            e.preventDefault();
            e.stopPropagation();
            const shortUrl = shortlinkBtn.getAttribute('data-shortlink');
            if (shortUrl && navigator.clipboard) {
                navigator.clipboard.writeText(shortUrl).then(() => {
                    const label = shortlinkBtn.querySelector('#shortlink-btn-label');
                    if (label) {
                        label.textContent = 'Copied!';
                        setTimeout(() => { label.textContent = 'Copy Shortlink'; }, 2000);
                    } else {
                        const origHtml = shortlinkBtn.innerHTML;
                        shortlinkBtn.innerHTML = '<i class="bi bi-check2 text-success"></i>';
                        setTimeout(() => { shortlinkBtn.innerHTML = origHtml; }, 1800);
                    }
                });
            }
            return;
        }

        // Blog Article Item Click
        const blogCard = e.target.closest('.read-blog-btn, .blog-link-btn, .blog-entry-card, .blog-grid-card');
        if (blogCard) {
            e.preventDefault();
            const slug = blogCard.getAttribute('data-slug');
            if (slug) {
                if (currentApp !== 'blogs') {
                    launchApp('blogs', false);
                }
                displayBlogPost(slug, true);
                if (dossierModal) {
                    dossierModal.scrollTop = 0;
                }
            }
            return;
        }

        // Back from detail to blog list
        if (e.target.closest('#blog-back-btn')) {
            e.preventDefault();
            const detailPanel = document.getElementById('panel-blog-detail');
            const blogsPanel = document.getElementById('panel-blogs');
            if (detailPanel && blogsPanel) {
                detailPanel.classList.remove('active');
                blogsPanel.classList.add('active');
                if (dossierModal) {
                    dossierModal.scrollTop = 0;
                }
                window.history.pushState({ app: 'blogs' }, APPS.blogs.title, APPS.blogs.route);
                document.title = APPS.blogs.title;
            }
            return;
        }

        // Copy Article Link
        if (e.target.closest('#blog-copy-link-btn')) {
            e.preventDefault();
            if (navigator.clipboard) {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    const label = document.getElementById('copy-btn-label');
                    if (label) {
                        label.textContent = 'Copied!';
                        setTimeout(() => { label.textContent = 'Copy Link'; }, 2000);
                    }
                });
            }
            return;
        }

        // Portfolio Pure Image Card Click -> Open Lightbox
        const portfolioCard = e.target.closest('.portfolio-image-card');
        if (portfolioCard) {
            e.preventDefault();
            const imgSrc = portfolioCard.getAttribute('data-img');
            const title = portfolioCard.getAttribute('data-title');
            if (imgSrc) {
                openImageLightbox(imgSrc, title);
            }
            return;
        }

        // Lightbox Close triggers
        if (e.target.closest('#lightbox-close-btn')) {
            e.preventDefault();
            closeImageLightbox();
            return;
        }
        if (e.target.id === 'os-image-lightbox') {
            closeImageLightbox();
            return;
        }

        // Project Showcase Card & Inspect Button Click
        const projTrigger = e.target.closest('.open-project-btn, .project-showcase-card');
        if (projTrigger) {
            if (e.target.closest('a')) return; // Allow direct repository anchor clicks
            e.preventDefault();
            const pIdx = parseInt(projTrigger.getAttribute('data-project-idx'), 10);
            if (!isNaN(pIdx) && cachedProjects[pIdx]) {
                openProjectModal(cachedProjects[pIdx]);
            }
            return;
        }

        // Project Modal Close triggers
        if (e.target.closest('#project-modal-close-btn, #project-modal-close-action')) {
            e.preventDefault();
            closeProjectModal();
            return;
        }
        if (e.target.id === 'os-project-modal') {
            closeProjectModal();
            return;
        }

        // Dossier Close Button
        const closeBtn = e.target.closest('#dossier-close-trigger, #dossier-bottom-close-btn');
        if (closeBtn) {
            e.preventDefault();
            closeDossier();
            return;
        }

        // Close when clicking outside dossier dialog on backdrop
        if (e.target.id === 'os-dossier-modal') {
            closeDossier();
            return;
        }
    });

    // Handle Browser Back / Forward buttons
    window.addEventListener('popstate', function (e) {
        if (e.state && e.state.app) {
            if (e.state.app === 'home') {
                closeDossier(false);
            } else {
                launchApp(e.state.app, false);
                if (e.state.app === 'blogs' && e.state.slug) {
                    displayBlogPost(e.state.slug, false);
                }
            }
        } else {
            // Determine by URL pathname
            const path = window.location.pathname.replace(baseUrl, '').replace(/^\//, '').split('/')[0];
            const matchingApp = Object.keys(APPS).find(k => k === path) || 'home';
            if (matchingApp === 'home') {
                closeDossier(false);
            } else {
                launchApp(matchingApp, false);
            }
        }
    });

    // Keyboard Shortcuts (Esc to close modals / window)
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            if (imageLightbox && imageLightbox.classList.contains('show')) {
                closeImageLightbox();
                return;
            }
            if (projectModal && projectModal.classList.contains('show')) {
                closeProjectModal();
                return;
            }
            if (currentApp !== 'home') {
                closeDossier();
            }
        }
    });

    // ============================================================
    // AJAX CONTACT FORM HANDLER
    // ============================================================

    const contactForm = document.getElementById('dossier-contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const alertBox = document.getElementById('contact-alert-box');
            const submitBtn = document.getElementById('c-submit-btn');
            const originalText = submitBtn ? submitBtn.innerHTML : 'Send';

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Transmitting...';
            }

            const formData = new FormData(contactForm);

            fetch(contactForm.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (alertBox) {
                    alertBox.classList.remove('d-none', 'alert-danger', 'alert-success');
                    if (data.success) {
                        alertBox.classList.add('alert', 'alert-success');
                        alertBox.textContent = data.message || 'Transmission dispatched successfully! Bala has been notified.';
                        contactForm.reset();
                    } else {
                        alertBox.classList.add('alert', 'alert-danger');
                        alertBox.textContent = data.message || 'Failed to dispatch transmission. Please check inputs.';
                    }
                }
            })
            .catch(() => {
                if (alertBox) {
                    alertBox.classList.remove('d-none', 'alert-success');
                    alertBox.classList.add('alert', 'alert-danger');
                    alertBox.textContent = 'Network or transmission error. Please try again.';
                }
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
        });
    }

    // ============================================================
    // LIVE CLOCK & DATE WIDGET (HUD Bar)
    // ============================================================
    const hudTimeEl = document.getElementById('hud-time');
    const hudDateEl = document.getElementById('hud-date');

    function updateLiveClock() {
        const now = new Date();
        if (hudTimeEl) {
            hudTimeEl.textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
        }
        if (hudDateEl) {
            hudDateEl.textContent = now.toLocaleDateString([], { weekday: 'short', month: 'short', day: 'numeric' });
        }
    }
    updateLiveClock();
    setInterval(updateLiveClock, 1000);

    // ============================================================
    // SKILLS TYPEWRITER ROTATION (Home Hero Center)
    // ============================================================
    const typingSkillsEl = document.getElementById('hero-typing-skills');
    if (typingSkillsEl) {
        const skillsList = [
            "Frontend Architecture & Modern Web",
            "React.js & Next.js SPAs",
            "Enterprise SharePoint SPFx Intranets",
            "Microsoft Graph API & PnP JS",
            "Pixel-Perfect Figma Design Systems",
            "Sub-Second LCP & Web Optimization"
        ];
        let skillIdx = 0;
        let charIdx = 0;
        let isDeleting = false;
        let speed = 75;

        function runTypewriter() {
            const currentSkill = skillsList[skillIdx];

            if (isDeleting) {
                charIdx--;
                typingSkillsEl.textContent = currentSkill.substring(0, charIdx);
                speed = 35;
            } else {
                charIdx++;
                typingSkillsEl.textContent = currentSkill.substring(0, charIdx);
                speed = 75;
            }

            if (!isDeleting && charIdx === currentSkill.length) {
                speed = 2200; // Pause at end of completed skill
                isDeleting = true;
            } else if (isDeleting && charIdx === 0) {
                isDeleting = false;
                skillIdx = (skillIdx + 1) % skillsList.length;
                speed = 400; // Pause before next skill
            }

            setTimeout(runTypewriter, speed);
        }

        setTimeout(runTypewriter, 600);
    }

    // ============================================================
    // LIVE GITHUB ACTIVITY INTEGRATION (Recent Activity Corner)
    // ============================================================
    function fetchLiveGithubActivity() {
        fetch('https://api.github.com/users/Balamuruganpm/events/public', {
            headers: { 'Accept': 'application/vnd.github.v3+json' }
        })
        .then(r => {
            if (!r.ok) throw new Error('Status: ' + r.status);
            return r.json();
        })
        .then(events => {
            if (!Array.isArray(events) || events.length === 0) return;
            const pushEvent = events.find(e => e.type === 'PushEvent') || events[0];
            if (!pushEvent) return;

            const repoName = pushEvent.repo ? pushEvent.repo.name : 'portfolio';
            const cleanRepo = repoName.replace(/^[^/]+\//, '');
            const commitMsg = pushEvent.payload && pushEvent.payload.commits && pushEvent.payload.commits[0]
                ? pushEvent.payload.commits[0].message.slice(0, 48)
                : 'Committed updates';

            const eventDate = new Date(pushEvent.created_at);
            const diffHours = Math.max(1, Math.round((Date.now() - eventDate.getTime()) / (1000 * 60 * 60)));
            const timeText = diffHours < 24 ? `${diffHours}h ago` : `${Math.round(diffHours / 24)}d ago`;

            const ghTiles = document.querySelectorAll('.activity-tile');
            ghTiles.forEach(tile => {
                if (tile.querySelector('.bi-github')) {
                    const titleEl = tile.querySelector('.activity-tile-title');
                    const linkEl = tile.querySelector('.activity-tile-link');
                    if (titleEl) {
                        titleEl.textContent = `Pushed to ${cleanRepo} (${timeText})`;
                    }
                    if (linkEl) {
                        linkEl.innerHTML = `<span>"${commitMsg}"</span> <i class="bi bi-arrow-up-right ms-1"></i>`;
                        linkEl.href = `https://github.com/${repoName}`;
                    }
                }
            });
        })
        .catch(() => {
            // Graceful fallback to static template content
        });
    }

    fetchLiveGithubActivity();

    // ============================================================
    // RECENT ACTIVITY CORNER PANEL
    // ============================================================
    if (activityTrigger && activityPanel) {
        activityTrigger.addEventListener('click', function (e) {
            e.stopPropagation();
            activityPanel.classList.toggle('show');
        });

        if (activityCloseBtn) {
            activityCloseBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                activityPanel.classList.remove('show');
            });
        }

        document.addEventListener('click', function (e) {
            if (activityPanel.classList.contains('show') && !activityPanel.contains(e.target) && !activityTrigger.contains(e.target)) {
                activityPanel.classList.remove('show');
            }
        });
    }

    // ============================================================
    // SUBTLE MOUSE-FOLLOWING 3D TILT EFFECT
    // ============================================================
    const heroTiltEl = document.getElementById('central-hero-tilt');
    if (heroTiltEl && window.matchMedia && window.matchMedia('(pointer: fine)').matches) {
        let mouseX = 0, mouseY = 0;
        let currentTiltX = 0, currentTiltY = 0;
        let isHoveringHero = false;
        let animFrameId = null;

        function updateTilt() {
            if (!isHoveringHero) {
                currentTiltX += (0 - currentTiltX) * 0.1;
                currentTiltY += (0 - currentTiltY) * 0.1;
            } else {
                currentTiltX += (mouseY - currentTiltX) * 0.12;
                currentTiltY += (mouseX - currentTiltY) * 0.12;
            }

            heroTiltEl.style.transform = `perspective(800px) rotateX(${currentTiltX.toFixed(2)}deg) rotateY(${currentTiltY.toFixed(2)}deg)`;

            if (isHoveringHero || Math.abs(currentTiltX) > 0.05 || Math.abs(currentTiltY) > 0.05) {
                animFrameId = requestAnimationFrame(updateTilt);
            } else {
                heroTiltEl.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg)';
                animFrameId = null;
            }
        }

        const heroContainer = centralHero || heroTiltEl;

        heroContainer.addEventListener('mousemove', function (e) {
            const rect = heroTiltEl.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            const x = (e.clientX - centerX) / (rect.width / 2);
            const y = (e.clientY - centerY) / (rect.height / 2);

            // Clamp max tilt to 6 degrees
            mouseX = Math.max(-1, Math.min(1, x)) * 6;
            mouseY = Math.max(-1, Math.min(1, y)) * -6;
            isHoveringHero = true;

            if (!animFrameId) {
                animFrameId = requestAnimationFrame(updateTilt);
            }
        });

        heroContainer.addEventListener('mouseleave', function () {
            isHoveringHero = false;
            mouseX = 0;
            mouseY = 0;
            if (!animFrameId) {
                animFrameId = requestAnimationFrame(updateTilt);
            }
        });
    }

    // Initial check on load
    document.addEventListener('DOMContentLoaded', function () {
        if (currentApp && currentApp !== 'home') {
            launchApp(currentApp, false);
            // Check if URL has a blog slug
            const parts = window.location.pathname.replace(baseUrl, '').replace(/^\//, '').split('/');
            if (parts[0] === 'blogs' && parts[1]) {
                displayBlogPost(parts[1], false);
            }
        }
    });

})();
