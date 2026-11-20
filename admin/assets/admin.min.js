/**
 * Balamurugan P M — Admin Console Client Engine (Glassmorphic Dark Edition)
 * Controls ApexCharts analytics, AJAX SPA-like actions, toast alerts, WYSIWYG editor, and table filters.
 */

document.addEventListener('DOMContentLoaded', function () {
    initCounterAnimations();
    initCategoryFieldToggle();
    initSeoAutoFill();
    initWysiwygEditor();
    initCopyShortlinks();
    initPasswordToggles();
    initTableLiveFilters();
    initApexAnalyticsCharts();
    initAjaxForms();
    initCommandBar();
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
        const duration = 800;
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
        container.className = 'admin-toast-container';
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
 * ApexCharts Analytics Engine Initialization
 */
function initApexAnalyticsCharts() {
    const trafficChartEl = document.getElementById('apex-traffic-chart');
    if (trafficChartEl && typeof ApexCharts !== 'undefined') {
        const trafficOptions = {
            series: [{
                name: 'Profile Visits',
                data: [42, 78, 110, 160, 240, 310, 480, 590, 720, 890, 1050, 1280]
            }, {
                name: 'Project Views',
                data: [20, 45, 60, 95, 140, 190, 310, 400, 510, 640, 780, 950]
            }],
            chart: {
                type: 'area',
                height: 300,
                toolbar: { show: false },
                background: 'transparent',
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            colors: ['#ff5722', '#6366f1'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: '#9ca3af' } }
            },
            yaxis: {
                labels: { style: { colors: '#9ca3af' } }
            },
            grid: {
                borderColor: 'rgba(255, 255, 255, 0.06)',
                strokeDashArray: 4
            },
            tooltip: { theme: 'dark' },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                labels: { colors: '#d1d5db' }
            }
        };
        const trafficChart = new ApexCharts(trafficChartEl, trafficOptions);
        trafficChart.render();
    }

    const distributionChartEl = document.getElementById('apex-content-distribution');
    if (distributionChartEl && typeof ApexCharts !== 'undefined') {
        const distributionOptions = {
            series: [12, 18, 8, 5],
            chart: {
                type: 'donut',
                height: 280,
                background: 'transparent',
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            labels: ['Portfolio Projects', 'Blog Articles', 'Technical Skills', 'Certificates'],
            colors: ['#ff5722', '#6366f1', '#10b981', '#f59e0b'],
            stroke: { width: 0 },
            legend: {
                position: 'bottom',
                labels: { colors: '#d1d5db' }
            },
            dataLabels: { enabled: false },
            tooltip: { theme: 'dark' }
        };
        const distributionChart = new ApexCharts(distributionChartEl, distributionOptions);
        distributionChart.render();
    }
}

/**
 * Table Search / Live Filtering
 */
function initTableLiveFilters() {
    const searchInputs = document.querySelectorAll('[data-table-search]');
    searchInputs.forEach(input => {
        const targetSelector = input.getAttribute('data-table-search');
        const table = document.querySelector(targetSelector);
        if (!table) return;

        input.addEventListener('input', function () {
            const term = this.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(term)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
}

/**
 * AJAX Form Handling Helper
 */
function initAjaxForms() {
    document.querySelectorAll('form[data-ajax="true"]').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn ? submitBtn.innerHTML : '';

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Saving...';
            }

            const formData = new FormData(form);

            fetch(form.action || window.location.href, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    window.showToast(data.message || 'Changes saved successfully!', 'success');
                } else {
                    window.showToast(data.message || 'Error occurred while saving.', 'danger');
                }
            })
            .catch(() => {
                // Fallback submit if endpoint does not return JSON
                form.submit();
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            });
        });
    });
}

/**
 * Global Keyboard Command Shortcut (Ctrl+K)
 */
function initCommandBar() {
    document.addEventListener('keydown', function (e) {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            const searchInput = document.querySelector('.search-command-bar input');
            if (searchInput) searchInput.focus();
        }
    });
}

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
 * Conditional fields toggle
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
    });

    slugInput.addEventListener('input', function () {
        this.dataset.userEdited = "true";
        const cleaned = slugify(this.value);
        if (slugPreview) {
            slugPreview.innerText = '/blogs/detail?slug=' + (cleaned || '...');
        }
    });
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
                modeIndicator.className = 'badge bg-dark text-warning border border-warning px-2.5 py-1';
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
