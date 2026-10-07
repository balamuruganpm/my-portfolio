// Clean anti-bot / hosting redirect parameters (?i=1, ?i=2) from the URL bar
(function() {
    if (window.location.search && /[?&]i=\d+/.test(window.location.search)) {
        var newSearch = window.location.search.replace(/([?&])i=\d+(&|$)/, function(match, p1, p2) {
            return p2 === '&' ? p1 : '';
        }).replace(/[?&]$/, '');
        var cleanUrl = window.location.pathname + (newSearch ? newSearch : '') + (window.location.hash || '');
        if (window.history && window.history.replaceState) {
            window.history.replaceState(null, document.title, cleanUrl);
        }
    }
})();

document.addEventListener('DOMContentLoaded', () => {

    // --- Experience & Awards Timeline Climbing Animation ---
    const climbers = document.querySelectorAll('.rope-climber');
    let lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;
    let scrollTimeout;

    if (climbers.length > 0) {
        window.addEventListener('scroll', () => {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            climbers.forEach(climberItem => {
                // Mark as climbing active
                climberItem.classList.add('is-climbing');
                
                // Alternate climber frames based on scroll pixel threshold (every 12px scrolled)
                climberItem.classList.toggle('frame-alt', Math.floor(scrollTop / 12) % 2 === 0);
                
                // Direction orientation
                if (scrollTop > lastScrollTop) {
                    // Scrolling Down
                    climberItem.classList.add('moving-down');
                    climberItem.classList.remove('moving-up');
                } else if (scrollTop < lastScrollTop) {
                    // Scrolling Up
                    climberItem.classList.add('moving-up');
                    climberItem.classList.remove('moving-down');
                }
            });
            
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            
            // Stop animation when scrolling ends
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                climbers.forEach(climberItem => {
                    climberItem.classList.remove('is-climbing', 'moving-up', 'moving-down');
                });
            }, 150);
        });
    }

    // --- Education Timeline Student Animation ---
    const studentMascot = document.getElementById('education-student');
    let studentScrollTimeout;

    if (studentMascot) {
        window.addEventListener('scroll', () => {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Mark as active/moving
            studentMascot.classList.add('is-active');
            
            // Alternate frames based on scroll pixel threshold (every 12px scrolled)
            studentMascot.classList.toggle('frame-alt', Math.floor(scrollTop / 12) % 2 === 0);
            
            // Stop animation when scrolling ends
            clearTimeout(studentScrollTimeout);
            studentScrollTimeout = setTimeout(() => {
                studentMascot.classList.remove('is-active');
            }, 150);
        });
    }

    // --- Timeline Cards Reveal Animation ---
    const revealCards = document.querySelectorAll('.reveal-card');
    if (revealCards.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target); // Reveal only once
                }
            });
        }, observerOptions);

        revealCards.forEach(card => observer.observe(card));
    }

    // --- Collapsible Timeline Details ---
    const toggleButtons = document.querySelectorAll('.view-more-btn');
    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('aria-controls');
            const targetWrapper = document.getElementById(targetId);
            const isExpanded = button.getAttribute('aria-expanded') === 'true';
            
            if (isExpanded) {
                targetWrapper.style.maxHeight = '0px';
                button.setAttribute('aria-expanded', 'false');
                button.querySelector('.toggle-text').textContent = 'View more';
                button.querySelector('.toggle-icon').style.transform = 'rotate(0deg)';
            } else {
                requestAnimationFrame(() => {
                    targetWrapper.style.maxHeight = targetWrapper.scrollHeight + 'px';
                });
                button.setAttribute('aria-expanded', 'true');
                button.querySelector('.toggle-text').textContent = 'View less';
                button.querySelector('.toggle-icon').style.transform = 'rotate(180deg)';
            }
        });
    });

    // --- Futuristic Scanner Preloader Sequence ---
    const preloader = document.getElementById('preloader');
    const preloaderPhrase = document.getElementById('preloader-phrase');
    const preloaderPhaseTag = document.getElementById('preloader-phase-tag');
    const preloaderProgressFill = document.getElementById('preloader-progress-fill');
    const preloaderPercentText = document.getElementById('preloader-percent-text');
    const percentNum = document.getElementById('svg-fuel-percent');
    const jetpackChar = document.getElementById('jetpack-character');

    if (jetpackChar) {
        jetpackChar.addEventListener('click', () => {
            // Get WhatsApp redirect link from data attributes
            const whatsappUrl = jetpackChar.getAttribute('data-whatsapp');
            const customMsg = jetpackChar.getAttribute('data-whatsapp-message') || "Hi, I saw your portfolio";
            if (whatsappUrl) {
                const defaultMsg = encodeURIComponent(customMsg);
                
                // If it is already a wa.me URL, append the text query param
                let targetUrl = whatsappUrl;
                if (targetUrl.includes('wa.me')) {
                    targetUrl += (targetUrl.includes('?') ? '&' : '?') + 'text=' + defaultMsg;
                }
                window.open(targetUrl, '_blank');
            } else {
                // Fallback to contact section scroll
                const contactSec = document.getElementById('contact-section') || document.querySelector('.contact-section') || document.getElementById('contact');
                if (contactSec) {
                    contactSec.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    }

    let lastScrollY = window.scrollY || window.pageYOffset;
    let jetpackTimeout;
    let jetpackRaf;

    // Scroll-based tilting, drift tracking, and dynamic flames/speech bubbles
    function initJetpackScrollAnimations() {
        if (jetpackChar) {
            const mascotTooltip = document.querySelector('#jetpack-character .jetpack-tooltip');
            const speechSections = document.querySelectorAll('[data-mascot-speech]');
            let bubbleTimeout;

            // 1. Dynamic Section Speech Bubble Observer
            if (mascotTooltip && speechSections.length > 0) {
                const mascotObserverOptions = {
                    root: null,
                    rootMargin: '-25% 0px -25% 0px', // Trigger when section is in viewport sweet-spot
                    threshold: 0.15
                };

                const mascotObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const speechText = entry.target.getAttribute('data-mascot-speech');
                            if (speechText && mascotTooltip.textContent !== speechText) {
                                // Change text contents
                                mascotTooltip.textContent = speechText;
                                
                                // Temporarily force show speech bubble
                                mascotTooltip.classList.add('show-bubble');
                                clearTimeout(bubbleTimeout);
                                bubbleTimeout = setTimeout(() => {
                                    mascotTooltip.classList.remove('show-bubble');
                                }, 4000);
                            }
                        }
                    });
                }, mascotObserverOptions);

                speechSections.forEach(section => mascotObserver.observe(section));
            }

            // 2. Scroll Physics & Thruster Flame Activation
            window.addEventListener('scroll', () => {
                // Ignore scroll anims if the character is not resting yet
                if (!jetpackChar.classList.contains('resting')) return;

                if (jetpackRaf) cancelAnimationFrame(jetpackRaf);
                jetpackRaf = requestAnimationFrame(() => {
                    const currentScrollY = window.scrollY || window.pageYOffset;
                    const diff = currentScrollY - lastScrollY;
                    
                    // Show flying flames when actively scrolling
                    if (Math.abs(diff) > 2) {
                        jetpackChar.classList.add('char-blastoff', 'blast-off');
                        jetpackChar.classList.remove('char-equipped');
                    }
                    
                    // Calculate dynamic flight tilt and drift proportional to scroll speed
                    const tilt = Math.min(Math.max(diff * 0.3, -25), 25);
                    const driftX = Math.min(Math.max(-diff * 0.7, -35), 35);
                    const driftY = Math.min(Math.max(-diff * 0.5, -25), 25);
                    
                    // Apply coordinates translation and rotation
                    const isMobile = window.innerWidth <= 768;
                    const scaleStr = isMobile ? ' scale(0.75)' : ' scale(1)';
                    jetpackChar.style.transform = `translate(${driftX}px, ${driftY}px) rotate(${tilt}deg)${scaleStr}`;
                    
                    // Reset tooltip to default when scrolling near top
                    if (currentScrollY < 150 && mascotTooltip) {
                        const defaultSpeech = jetpackChar.getAttribute('data-default-speech') || "Want to talk? Hire me! 👋";
                        if (mascotTooltip.textContent !== defaultSpeech) {
                            mascotTooltip.textContent = defaultSpeech;
                        }
                    }

                    lastScrollY = currentScrollY;
                });
                
                // Reset to default smooth floating state and extinguish thruster flames when scroll stops
                clearTimeout(jetpackTimeout);
                jetpackTimeout = setTimeout(() => {
                    const isMobileReset = window.innerWidth <= 768;
                    const scaleStrReset = isMobileReset ? ' scale(0.75)' : ' scale(1)';
                    jetpackChar.style.transform = `translate(0px, 0px) rotate(0deg)${scaleStrReset}`;
                    
                    // Exiting active flying state (turn off flames)
                    jetpackChar.classList.remove('char-blastoff', 'blast-off');
                    jetpackChar.classList.add('char-equipped');
                }, 180);
            }, { passive: true });
        }
    }

    let preloaderClosed = false;
    function closePreloader() {
        if (preloaderClosed) return;
        preloaderClosed = true;
        
        if (preloader) {
            preloader.classList.add('loading-done');
        }
        document.body.classList.remove('preloader-active');
        
        if (jetpackChar) {
            jetpackChar.className = "floating-jetpack-container resting char-equipped";
        }
        
        setTimeout(() => {
            if (preloader) preloader.style.display = 'none';
        }, 600);
        
        initJetpackScrollAnimations();
    }

    if (preloader) {
        let progress = 0;
        const startTime = performance.now();
        const duration = 1600; // 1.6s scanner animation experience
        
        function updateScannerSequence(now) {
            if (preloaderClosed) return;
            const elapsed = now - startTime;
            progress = Math.min(Math.round((elapsed / duration) * 100), 100);
            
            // Update progress bar fill & percentage displays
            if (preloaderProgressFill) preloaderProgressFill.style.width = progress + '%';
            if (preloaderPercentText) preloaderPercentText.textContent = progress + '%';
            if (percentNum) percentNum.textContent = progress + '%';
            
            // Phase triggers based on search & lock telemetry
            if (progress < 55) {
                if (preloaderPhaseTag && preloaderPhaseTag.textContent !== 'SEARCH_PROTOCOL_ACTIVE') {
                    preloaderPhaseTag.textContent = 'SEARCH_PROTOCOL_ACTIVE';
                    preloaderPhaseTag.className = 'text-cyan small fw-bold';
                }
                if (preloaderPhrase && preloaderPhrase.textContent !== 'Scanning for the best web developer...') {
                    preloaderPhrase.textContent = 'Scanning for the best web developer...';
                }
            } else if (progress < 85) {
                if (preloaderPhaseTag && preloaderPhaseTag.textContent !== 'TARGET_ACQUIRED') {
                    preloaderPhaseTag.textContent = 'TARGET_ACQUIRED';
                    preloaderPhaseTag.className = 'text-success small fw-bold';
                }
                if (preloaderPhrase && !preloaderPhrase.innerHTML.includes('100% Compatibility!')) {
                    preloaderPhrase.innerHTML = 'Match found: <span class="text-accent">100% Compatibility! 🎯</span>';
                }
            } else {
                if (preloaderPhaseTag && preloaderPhaseTag.textContent !== 'SYSTEM_UNLOCKED') {
                    preloaderPhaseTag.textContent = 'SYSTEM_UNLOCKED';
                    preloaderPhaseTag.className = 'text-cyan small fw-bold';
                }
                if (preloaderPhrase && !preloaderPhrase.innerHTML.includes("That's me!")) {
                    preloaderPhrase.innerHTML = 'Oh! You found it... <span class="text-accent">That\'s me! 👋</span>';
                }
            }
            
            if (progress < 100) {
                requestAnimationFrame(updateScannerSequence);
            } else {
                // Keep the final discovery phrase visible briefly before revealing the site
                setTimeout(() => {
                    closePreloader();
                }, 450);
            }
        }
        
        requestAnimationFrame(updateScannerSequence);
        
        // Safety fallback timeout to ensure preloader always closes
        setTimeout(() => {
            closePreloader();
        }, 2800);
    } else {
        initJetpackScrollAnimations();
    }

    // --- Mobile Menu Toggle ---
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileNavDrawer = document.getElementById('mobile-nav-drawer');
    if (mobileMenuBtn && mobileNavDrawer) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileNavDrawer.classList.toggle('open');
            const isOpen = mobileNavDrawer.classList.contains('open');
            mobileMenuBtn.setAttribute('aria-expanded', isOpen);
        });
    }

    // --- Project Modal Trigger ---
    const bentoCards = document.querySelectorAll('.project-bento-card, .cyber-project-card');
    const projectModal = document.getElementById('project-modal');
    const closeProjectModalBtn = document.getElementById('close-project-modal');

    if (bentoCards.length > 0 && projectModal && closeProjectModalBtn) {
        bentoCards.forEach(card => {
            card.addEventListener('click', () => {
                const title = card.getAttribute('data-project-title');
                const tagline = card.getAttribute('data-project-tagline');
                const img = card.getAttribute('data-project-image');
                const link = card.getAttribute('data-project-link');
                const bullets = JSON.parse(card.getAttribute('data-project-bullets') || '[]');
                const tags = JSON.parse(card.getAttribute('data-project-tags') || '[]');

                // Populate modal content
                const modalImg = document.getElementById('modal-project-img');
                if (modalImg) modalImg.src = img;
                const modalTitle = document.getElementById('modal-project-title');
                if (modalTitle) modalTitle.textContent = title;
                const modalTagline = document.getElementById('modal-project-tagline');
                if (modalTagline) modalTagline.textContent = tagline;
                const modalLink = document.getElementById('modal-project-link');
                if (modalLink) modalLink.href = link;

                // Populate highlights
                const bulletsList = document.getElementById('modal-project-bullets');
                if (bulletsList) {
                    bulletsList.innerHTML = '';
                    bullets.forEach(b => {
                        const li = document.createElement('li');
                        li.className = 'mb-2';
                        li.textContent = b;
                        bulletsList.appendChild(li);
                    });
                }

                // Populate tags
                const tagsWrapper = document.getElementById('modal-project-tags');
                if (tagsWrapper) {
                    tagsWrapper.innerHTML = '';
                    tags.forEach(t => {
                        const span = document.createElement('span');
                        span.className = 'cyber-mini-badge';
                        span.textContent = t;
                        tagsWrapper.appendChild(span);
                    });
                }

                // Open modal
                projectModal.classList.add('active');
                projectModal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden'; // Disable page scrolling
            });
        });

        // Close modal helper
        const closeModal = () => {
            projectModal.classList.remove('active');
            projectModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = ''; // Restore page scrolling
        };

        closeProjectModalBtn.addEventListener('click', closeModal);
        projectModal.addEventListener('click', (e) => {
            if (e.target === projectModal) {
                closeModal();
            }
        });
        
        // Escape key close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && projectModal.classList.contains('active')) {
                closeModal();
            }
        });
    }

    // --- Blog Category Filter ---
    const filterBtns = document.querySelectorAll('.blog-filter-btn, .cyber-filter-pill');
    const blogCardCols = document.querySelectorAll('.blog-card-col');

    if (filterBtns.length > 0 && blogCardCols.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('active');
                    b.setAttribute('aria-pressed', 'false');
                });
                btn.classList.add('active');
                btn.setAttribute('aria-pressed', 'true');

                const filterVal = btn.getAttribute('data-filter');
                blogCardCols.forEach(col => {
                    const cardCategory = col.getAttribute('data-category');
                    if (filterVal === 'all' || cardCategory === filterVal) {
                        col.classList.remove('hidden');
                        col.style.display = '';
                    } else {
                        col.classList.add('hidden');
                        col.style.display = 'none';
                    }
                });
            });
        });
    }

    // --- High-Tech Dynamic Text Typing Animation ---
    const typingEls = document.querySelectorAll('#hero-typewriter-text, #typing-text');
    typingEls.forEach(el => {
        let phrases = [];
        try {
            const attr = el.getAttribute('data-roles');
            if (attr) phrases = JSON.parse(attr);
        } catch(e) {}

        if (!phrases || !phrases.length) {
            phrases = [
                "Frontend Developer",
                "React.js Specialist",
                "SPFx & SharePoint Engineer",
                "UI/UX & Design Systems Architect",
                "High-Performance Web Engineer"
            ];
        }

        let phraseIndex = 0;
        let charIndex = el.textContent ? el.textContent.trim().length : 0;
        let isDeleting = charIndex > 0;
        let typeSpeed = 70;

        function runTypeLoop() {
            const currentPhrase = phrases[phraseIndex];
            
            if (isDeleting) {
                charIndex--;
                typeSpeed = 35;
            } else {
                charIndex++;
                typeSpeed = 75;
            }
            
            el.textContent = currentPhrase.substring(0, charIndex);

            if (!isDeleting && charIndex === currentPhrase.length) {
                isDeleting = true;
                typeSpeed = 2200; // Pause at end of phrase
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                phraseIndex = (phraseIndex + 1) % phrases.length;
                typeSpeed = 350; // Pause before typing next phrase
            }

            setTimeout(runTypeLoop, typeSpeed);
        }
        
        setTimeout(runTypeLoop, isDeleting ? 1800 : 400);
    });

    // --- Code Block Copy to Clipboard ---
    const codeCopyBtns = document.querySelectorAll('.code-copy-btn');
    codeCopyBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const wrapper = btn.closest('.code-block-wrapper');
            const codeEl = wrapper ? wrapper.querySelector('code') : null;
            if (codeEl) {
                navigator.clipboard.writeText(codeEl.innerText || codeEl.textContent).then(() => {
                    const origHtml = btn.innerHTML;
                    btn.innerHTML = '<i class="bi bi-check2 text-success me-1"></i>Copied!';
                    setTimeout(() => {
                        btn.innerHTML = origHtml;
                    }, 2000);
                }).catch(err => {
                    console.error('Copy failed:', err);
                });
            }
        });
    });
});