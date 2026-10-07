/**
 * Balamurugan P M — Admin Console Client Engine (2026 Edition)
 * Includes count-up animations, toast notifications, WYSIWYG editor, and drag-and-drop uploader.
 */

document.addEventListener('DOMContentLoaded', function () {
    initCounterAnimations();
    initCategoryFieldToggle();
    initSeoAutoFill();
    initWysiwygEditor();
    initCopyShortlinks();
    initPasswordToggles();
});

/**
 * Animated Number Count-Up for Stat Cards
 */
function initCounterAnimations() {
    const counters = document.querySelectorAll('.stat-count-animated');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target') || counter.innerText, 10);
        if (isNaN(target)) return;

        let current = 0;
        const duration = 1000;
        const increment = target / (duration / 16);

        function updateCounter() {
            current += increment;
            if (current < target) {
                counter.innerText = Math.ceil(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.innerText = target;
            }
        }
        updateCounter();
    });
}

/**
 * Toast Notification System
 */
window.showToast = function (message, type = 'success') {
    let container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `admin-toast toast-${type}`;
    const icon = type === 'success' ? 'bi-check-circle-fill text-success' : 'bi-exclamation-triangle-fill text-danger';
    toast.innerHTML = `<i class="bi ${icon} fs-5"></i><span class="flex-grow-1 small fw-semibold">${message}</span>`;

    container.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(10px)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 4000);
};

/**
 * Password Visibility Toggle
 */
function initPasswordToggles() {
    const toggles = document.querySelectorAll('.password-toggle-btn');
    toggles.forEach(btn => {
        btn.addEventListener('click', function () {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        });
    });
}

/**
 * Conditional fields for Blog, Article, and Job categories
 */
function initCategoryFieldToggle() {
    const categorySelect = document.querySelector('select[name="category"]');
    if (!categorySelect) return;

    function toggleFields() {
        const selectedValue = categorySelect.value.toLowerCase();

        document.querySelectorAll('.conditional-section').forEach(section => {
            section.classList.remove('show');
        });

        const targetSection = document.getElementById(`fields-for-${selectedValue}`);
        if (targetSection) {
            targetSection.classList.add('show');
        }
    }

    categorySelect.addEventListener('change', toggleFields);
    toggleFields();
}

/**
 * Auto-fill custom slugs from title inputs
 */
function initSeoAutoFill() {
    const titleInput = document.querySelector('input[name="title"]');
    const slugInput = document.getElementById('slug-input');
    const slugPreview = document.getElementById('slug-preview');
    const seoTitleInput = document.getElementById('seo-title');

    if (!titleInput || !slugInput) return;

    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }

    titleInput.addEventListener('input', function () {
        const calculatedSlug = slugify(this.value);

        if (!slugInput.dataset.userEdited) {
            slugInput.value = calculatedSlug;
            if (slugPreview) {
                slugPreview.innerText = '/blogs/detail?slug=' + (calculatedSlug || '...');
            }
        }

        if (seoTitleInput && !seoTitleInput.dataset.userEdited) {
            seoTitleInput.placeholder = this.value;
        }
    });

    slugInput.addEventListener('input', function () {
        this.dataset.userEdited = "true";
        const cleaned = slugify(this.value);
        if (slugPreview) {
            slugPreview.innerText = '/blogs/detail?slug=' + (cleaned || '...');
        }
    });

    if (seoTitleInput) {
        seoTitleInput.addEventListener('input', function () {
            this.dataset.userEdited = "true";
        });
    }
}

/**
 * Rich Visual / HTML WYSIWYG Editor
 */
function initWysiwygEditor() {
    const visualEditor = document.getElementById('visual-editor');
    const htmlEditor = document.getElementById('html-editor');
    const btnVisual = document.getElementById('btn-visual-tab');
    const btnHtml = document.getElementById('btn-html-tab');
    const editorToolbar = document.getElementById('editor-toolbar');
    const modeIndicator = document.getElementById('editor-mode-indicator');
    const form = document.querySelector('form');

    if (!visualEditor || !htmlEditor) return;

    window.formatDoc = function (cmd, value = null) {
        visualEditor.focus();
        document.execCommand(cmd, false, value);
        updateHtmlSource();
    };

    window.insertLink = function () {
        const url = prompt("Enter target URL:");
        if (url) {
            window.formatDoc("createLink", url);
        }
    };

    window.insertImage = function () {
        const url = prompt("Enter image URL:");
        if (url) {
            window.formatDoc("insertImage", url);
        }
    };

    function updateHtmlSource() {
        htmlEditor.value = visualEditor.innerHTML;
    }

    visualEditor.addEventListener('input', updateHtmlSource);
    htmlEditor.addEventListener('input', function () {
        visualEditor.innerHTML = htmlEditor.value;
    });

    if (form) {
        form.addEventListener('submit', function () {
            if (visualEditor.style.display !== 'none') {
                htmlEditor.value = visualEditor.innerHTML;
            }
        });
    }

    if (btnVisual && btnHtml) {
        btnVisual.addEventListener('click', function () {
            btnVisual.classList.add('active', 'btn-admin-primary');
            btnVisual.classList.remove('btn-admin-secondary');
            btnHtml.classList.remove('active', 'btn-admin-primary');
            btnHtml.classList.add('btn-admin-secondary');
            
            if (modeIndicator) {
                modeIndicator.innerText = 'Visual Mode';
                modeIndicator.className = 'badge bg-light text-secondary border px-2.5 py-1';
            }

            if (editorToolbar) editorToolbar.style.display = 'flex';
            visualEditor.innerHTML = htmlEditor.value;
            visualEditor.style.display = 'block';
            htmlEditor.style.display = 'none';
        });

        btnHtml.addEventListener('click', function () {
            btnHtml.classList.add('active', 'btn-admin-primary');
            btnHtml.classList.remove('btn-admin-secondary');
            btnVisual.classList.remove('active', 'btn-admin-primary');
            btnVisual.classList.add('btn-admin-secondary');
            
            if (modeIndicator) {
                modeIndicator.innerText = 'HTML Source Mode';
                modeIndicator.className = 'badge bg-dark text-info border border-info px-2.5 py-1';
            }

            if (editorToolbar) editorToolbar.style.display = 'none';
            htmlEditor.value = visualEditor.innerHTML;
            htmlEditor.style.display = 'block';
            visualEditor.style.display = 'none';
        });
    }
}

/**
 * Copy to clipboard helper
 */
function initCopyShortlinks() {
    window.copyShortlink = function (text, btn) {
        navigator.clipboard.writeText(text).then(function () {
            window.showToast('Copied to clipboard!', 'success');
            const icon = btn.querySelector('i');
            if (icon) {
                const original = icon.className;
                icon.className = 'bi bi-check-lg text-success';
                setTimeout(() => { icon.className = original; }, 1500);
            }
        });
    };
}
