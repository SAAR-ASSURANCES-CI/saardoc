document.addEventListener('DOMContentLoaded', function() {
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-fade-in-up, .animate-scale-in').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        observer.observe(el);
    });

    document.querySelectorAll('.stat-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)';
        });
    });

    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('ring-4', 'ring-blue-500/30');
        });
        
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('ring-4', 'ring-blue-500/30');
        });
    }

    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1.05)';
            }, 150);
        });
    });

    document.querySelectorAll('.btn-primary, .btn-secondary, .btn-consult').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    const tableRows = document.querySelectorAll('.table-row');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.05}s`;
    });

    document.querySelectorAll('.badge').forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(2deg)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    function updateGlassmorphism() {
        const cards = document.querySelectorAll('.card-hover, .stat-card');
        cards.forEach(card => {
            const rect = card.getBoundingClientRect();
            const isInViewport = rect.top < window.innerHeight && rect.bottom > 0;
            
            if (isInViewport) {
                card.style.backdropFilter = 'blur(20px)';
                card.style.backgroundColor = 'rgba(255, 255, 255, 0.8)';
            }
        });
    }

    window.addEventListener('scroll', updateGlassmorphism);
    updateGlassmorphism();

    document.querySelectorAll('svg').forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });
        
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });

    function createFloatingParticle() {
        const particle = document.createElement('div');
        particle.className = 'floating-particle';
        particle.style.cssText = `
            position: fixed;
            width: 4px;
            height: 4px;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            border-radius: 50%;
            pointer-events: none;
            z-index: -1;
            opacity: 0.6;
            animation: float 6s ease-in-out infinite;
        `;
        
        particle.style.left = Math.random() * window.innerWidth + 'px';
        particle.style.top = Math.random() * window.innerHeight + 'px';
        particle.style.animationDelay = Math.random() * 6 + 's';
        
        document.body.appendChild(particle);
        
        setTimeout(() => {
            particle.remove();
        }, 6000);
    }

    setInterval(createFloatingParticle, 2000);

    function simulateLoading() {
        const loadingElements = document.querySelectorAll('.loading-skeleton');
        loadingElements.forEach((el, index) => {
            setTimeout(() => {
                el.style.opacity = '0';
                el.style.transform = 'scale(0.8)';
            }, index * 200);
        });
    }

    if (document.querySelector('.loading-skeleton')) {
        setTimeout(simulateLoading, 1000);
    }

    document.querySelectorAll('button, a, input').forEach(element => {
        element.addEventListener('focus', function() {
            this.style.outline = 'none';
            this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.3)';
        });
        
        element.addEventListener('blur', function() {
            this.style.boxShadow = 'none';
        });
    });

    document.querySelectorAll('.pagination-link').forEach(link => {
        link.addEventListener('click', function() {
            document.body.style.opacity = '0.8';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 300);
        });
    });

    document.querySelectorAll('th').forEach(th => {
        th.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(59, 130, 246, 0.1)';
            this.style.transform = 'translateY(-2px)';
        });
        
        th.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
            this.style.transform = 'translateY(0)';
        });
    });

    document.querySelectorAll('.export-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});

const style = document.createElement('style');
style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .floating-particle {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .table-row {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .table-row:hover {
        transform: translateX(5px) scale(1.01);
    }

    .stat-card {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .search-input:focus {
        transform: scale(1.02);
    }

    .filter-tab {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-primary:hover {
        transform: translateY(-2px) scale(1.02);
    }

    .badge:hover {
        transform: scale(1.1) rotate(2deg);
    }

    .export-btn:hover {
        transform: scale(1.05);
    }

    .export-btn:active {
        transform: scale(0.95);
    }
`;

document.head.appendChild(style);
