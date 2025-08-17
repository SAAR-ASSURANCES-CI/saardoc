import './bootstrap';

class ToastManager {
    constructor() {
        this.container = null;
        this.init();
    }

    init() {
        this.container = document.createElement('div');
        this.container.id = 'toast-container';
        this.container.className = 'fixed top-4 right-4 z-50 space-y-2';
        document.body.appendChild(this.container);
    }

    show(message, type = 'info', duration = 5000) {
        const toast = this.createToast(message, type);
        this.container.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('animate-in', 'slide-in-from-right', 'duration-300');
        }, 100);

        if (duration > 0) {
            setTimeout(() => {
                this.hide(toast);
            }, duration);
        }

        return toast;
    }

    createToast(message, type) {
        const toast = document.createElement('div');
        const typeClasses = {
            success: 'toast-success',
            error: 'toast-error',
            info: 'toast-info',
            warning: 'toast-warning'
        };

        const icons = {
            success: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            error: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            info: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            warning: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>'
        };

        toast.className = `toast-notification ${typeClasses[type] || typeClasses.info}`;
        toast.innerHTML = `
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="text-${type === 'success' ? 'green' : (type === 'error' ? 'red' : (type === 'warning' ? 'yellow' : 'blue'))}-400">
                        ${icons[type] || icons.info}
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">${message}</p>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <button class="inline-flex text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 focus:outline-none focus:text-zinc-600 dark:focus:text-zinc-300 transition-colors duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mt-2 h-1 bg-zinc-200 dark:bg-zinc-700 rounded-full overflow-hidden">
                <div class="h-full bg-${type === 'success' ? 'green' : (type === 'error' ? 'red' : (type === 'warning' ? 'yellow' : 'blue'))}-500 transition-all duration-5000 ease-linear" style="width: 100%"></div>
            </div>
        `;

        const closeBtn = toast.querySelector('button');
        closeBtn.addEventListener('click', () => this.hide(toast));

        return toast;
    }

    hide(toast) {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 200);
    }
}

class FormManager {
    constructor() {
        this.init();
    }

    init() {
        document.addEventListener('submit', (e) => {
            const form = e.target;
            const submitBtn = form.querySelector('button[type="submit"]');
            
            if (submitBtn) {
                this.showLoadingState(submitBtn);
            }
        });

        this.initRealTimeValidation();
    }

    showLoadingState(button) {
        const originalText = button.innerHTML;
        button.innerHTML = `
            <div class="flex items-center">
                <div class="loading-spinner mr-2"></div>
                ${button.dataset.loadingText || 'Chargement...'}
            </div>
        `;
        button.disabled = true;

        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        }, 3000);
    }

    initRealTimeValidation() {
        const inputs = document.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                this.validateField(input);
            });

            input.addEventListener('input', () => {
                this.clearFieldError(input);
            });
        });
    }

    validateField(field) {
        const value = field.value.trim();
        const isRequired = field.hasAttribute('required');
        
        if (isRequired && !value) {
            this.showFieldError(field, 'Ce champ est requis');
        } else if (field.type === 'email' && value && !this.isValidEmail(value)) {
            this.showFieldError(field, 'Email invalide');
        }
    }

    showFieldError(field, message) {
        this.clearFieldError(field);
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'form-error mt-1';
        errorDiv.textContent = message;
        
        field.parentNode.appendChild(errorDiv);
        field.classList.add('border-red-500');
    }

    clearFieldError(field) {
        const errorDiv = field.parentNode.querySelector('.form-error');
        if (errorDiv) {
            errorDiv.remove();
        }
        field.classList.remove('border-red-500');
    }

    isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
}

class AnimationManager {
    constructor() {
        this.init();
    }

    init() {
        this.initIntersectionObserver();
        
        this.initScrollAnimations();
    }

    initIntersectionObserver() {
        const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in', 'fade-in', 'duration-500');
                observer.unobserve(entry.target);
            }
        });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    }

    initScrollAnimations() {
        let ticking = false;
        
        function updateAnimations() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('[data-parallax]');
            
            parallaxElements.forEach(el => {
                const speed = el.dataset.parallax || 0.5;
                const yPos = -(scrolled * speed);
                el.style.transform = `translateY(${yPos}px)`;
            });
            
            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateAnimations);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick);
    }
}

class SearchManager {
    constructor() {
        this.init();
    }

    init() {
        const searchInputs = document.querySelectorAll('input[type="search"], input[placeholder*="recherche"], input[placeholder*="search"]');
        
        searchInputs.forEach(input => {
            this.enhanceSearchInput(input);
        });
    }

    enhanceSearchInput(input) {
        const loadingIndicator = document.createElement('div');
        loadingIndicator.className = 'absolute inset-y-0 right-0 pr-3 flex items-center hidden';
        loadingIndicator.innerHTML = '<div class="loading-spinner"></div>';
        
        input.parentNode.style.position = 'relative';
        input.parentNode.appendChild(loadingIndicator);

        let searchTimeout;
        input.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            
            if (e.target.value.length > 2) {
                loadingIndicator.classList.remove('hidden');
                
                searchTimeout = setTimeout(() => {
                    loadingIndicator.classList.add('hidden');
                }, 500);
            } else {
                loadingIndicator.classList.add('hidden');
            }
        });
    }
}

class ModalManager {
    constructor() {
        this.init();
    }

    init() {
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal-overlay')) {
                this.closeModal(e.target);
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeAllModals();
            }
        });
    }

    openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
            
            const focusableElement = modal.querySelector('input, button, select, textarea, [tabindex]:not([tabindex="-1"])');
            if (focusableElement) {
                focusableElement.focus();
            }
        }
    }

    closeModal(modal) {
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
    }

    closeAllModals() {
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            this.closeModal(modal);
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    window.toastManager = new ToastManager();
    window.formManager = new FormManager();
    window.animationManager = new AnimationManager();
    window.searchManager = new SearchManager();
    window.modalManager = new ModalManager();

    window.showToast = (message, type, duration) => {
        return window.toastManager.show(message, type, duration);
    };

    window.openModal = (modalId) => {
        return window.modalManager.openModal(modalId);
    };

    document.querySelectorAll('.card-hover').forEach(card => {
        card.classList.add('animate-on-scroll');
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Tab' && e.target.closest('.modal-content')) {
            const focusableElements = e.target.closest('.modal-content').querySelectorAll(
                'input, button, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            if (e.shiftKey && e.target === firstElement) {
                e.preventDefault();
                lastElement.focus();
            } else if (!e.shiftKey && e.target === lastElement) {
                e.preventDefault();
                firstElement.focus();
            }
        }
    });
});

window.uxUtils = {
    copyToClipboard: async (text) => {
        try {
            await navigator.clipboard.writeText(text);
            window.showToast('Copié dans le presse-papiers', 'success');
        } catch (err) {
            window.showToast('Erreur lors de la copie', 'error');
        }
    },

    formatDate: (date, locale = 'fr-FR') => {
        return new Date(date).toLocaleDateString(locale, {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    },

    formatFileSize: (bytes) => {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    },

    debounce: (func, wait) => {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
};

import './dashboard.js';
