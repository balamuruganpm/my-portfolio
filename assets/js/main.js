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

    // --- Preloader Progress & Jetpack Fly Animation ---
    const preloader = document.getElementById('preloader');
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

    function closePreloader() {
        if (preloader && preloader.classList.contains('loading-done')) return;
        
        if (preloader) {
            preloader.classList.add('loading-done');
        }
        document.body.classList.remove('preloader-active');
        
        if (jetpackChar) {
            jetpackChar.className = "floating-jetpack-container resting char-equipped";
        }
        
        setTimeout(() => {
            if (preloader) preloader.style.display = 'none';
        }, 500);
        
        initJetpackScrollAnimations();
    }

    if (preloader && percentNum && jetpackChar) {
        // Monitor window load event to close immediately
        window.addEventListener('load', () => {
            closePreloader();
        });

        // Fallback: if load event already fired
        if (document.readyState === 'complete') {
            closePreloader();
        }

        // Fallback timeout to ensure page is accessible even if resources hang
        setTimeout(() => {
            closePreloader();
        }, 1200);
    } else {
        // Fallback if elements aren't present (e.g. admin panel)
        initJetpackScrollAnimations();
    }

    // --- Bento Project Modal Trigger ---
    const bentoCards = document.querySelectorAll('.project-bento-card');
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
                document.getElementById('modal-project-img').src = img;
                document.getElementById('modal-project-title').textContent = title;
                document.getElementById('modal-project-tagline').textContent = tagline;
                document.getElementById('modal-project-link').href = link;

                // Populate highlights
                const bulletsList = document.getElementById('modal-project-bullets');
                bulletsList.innerHTML = '';
                bullets.forEach(b => {
                    const li = document.createElement('li');
                    li.className = 'mb-2';
                    li.textContent = b;
                    bulletsList.appendChild(li);
                });

                // Populate tags
                const tagsWrapper = document.getElementById('modal-project-tags');
                tagsWrapper.innerHTML = '';
                tags.forEach(t => {
                    const span = document.createElement('span');
                    span.className = 'badge bg-secondary-subtle text-secondary small px-2 py-1';
                    span.textContent = t;
                    tagsWrapper.appendChild(span);
                });

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
    const filterBtns = document.querySelectorAll('.blog-filter-btn');
    const blogCardCols = document.querySelectorAll('.blog-card-col');

    if (filterBtns.length > 0 && blogCardCols.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-filter');

                // Update active state
                filterBtns.forEach(b => {
                    b.classList.remove('active');
                    b.setAttribute('aria-pressed', 'false');
                });
                btn.classList.add('active');
                btn.setAttribute('aria-pressed', 'true');

                // Show/hide cards
                blogCardCols.forEach(col => {
                    const category = col.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        col.classList.remove('hidden');
                    } else {
                        col.classList.add('hidden');
                    }
                });
            });
        });
    }
});