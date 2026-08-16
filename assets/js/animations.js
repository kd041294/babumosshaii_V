/**
 * Enhanced Animation & Interaction Effects
 * For BabuMosshaii Catering Application
 */

document.addEventListener('DOMContentLoaded', function() {
    // =====================================================
    // 1. SCROLL ANIMATIONS - Fade in elements on scroll
    // =====================================================
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.8s ease forwards';
                entry.target.style.opacity = '1';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all sections and cards
    document.querySelectorAll('.menu-item, #review .card, .gallery-img-wrap, .section-title').forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });

    // =====================================================
    // 2. SCROLL PROGRESS BAR
    // =====================================================
    const createProgressBar = () => {
        const progressBar = document.createElement('div');
        progressBar.id = 'scrollProgress';
        progressBar.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #b8183e 0%, #fafad2 50%, #b8183e 100%);
            width: 0%;
            z-index: 9999;
            transition: width 0.2s ease;
            box-shadow: 0 0 20px rgba(184, 24, 62, 0.6);
        `;
        document.body.appendChild(progressBar);

        window.addEventListener('scroll', () => {
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (scrollTop / docHeight) * 100;
            progressBar.style.width = scrolled + '%';
        });
    };
    createProgressBar();

    // =====================================================
    // 3. FLOATING EFFECT ON HOVER - Cards & Buttons
    // =====================================================
    document.querySelectorAll('.menu-item, #review .card, .btn-explore, .btn-secondary-cta').forEach(el => {
        el.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            this.style.transform = 'translateY(-8px) scale(1.02)';
            this.style.boxShadow = '0 20px 40px rgba(184, 24, 62, 0.3)';
        });

        el.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // =====================================================
    // 4. COUNTER ANIMATION - Animated numbers
    // =====================================================
    const animateCounter = (element, target, duration = 2000) => {
        let current = 0;
        const increment = target / (duration / 16);
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + '+';
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + '+';
            }
        }, 16);
    };

    // Animate client count if it exists
    const clientCount = document.getElementById('clientCount');
    if (clientCount) {
        const observer2 = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const text = entry.target.textContent;
                    const match = text.match(/\d+/);
                    if (match) {
                        animateCounter(entry.target, parseInt(match[0]));
                        observer2.unobserve(entry.target);
                    }
                }
            });
        });
        observer2.observe(clientCount);
    }

    // =====================================================
    // 5. PARALLAX EFFECT - Subtle depth on scroll
    // =====================================================
    const heroContent = document.querySelector('.hero-content-wrapper');
    if (heroContent) {
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            if (scrollY < window.innerHeight) {
                heroContent.style.transform = `translateY(${scrollY * 0.5}px)`;
            }
        });
    }

    // =====================================================
    // 6. BUTTON RIPPLE EFFECT
    // =====================================================
    document.querySelectorAll('.btn, .nav-link').forEach(button => {
        button.addEventListener('click', function(e) {
            if (e.button !== 0) return; // Only left click

            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            ripple.style.cssText = `
                position: absolute;
                width: 20px;
                height: 20px;
                background: rgba(255, 255, 255, 0.6);
                border-radius: 50%;
                left: ${x - 10}px;
                top: ${y - 10}px;
                pointer-events: none;
                animation: ripple-animation 0.6s ease-out;
            `;

            if (!this.style.position || this.style.position === 'static') {
                this.style.position = 'relative';
            }
            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });

    // Add ripple animation keyframes
    if (!document.getElementById('rippleStyles')) {
        const style = document.createElement('style');
        style.id = 'rippleStyles';
        style.textContent = `
            @keyframes ripple-animation {
                to {
                    width: 300px;
                    height: 300px;
                    opacity: 0;
                    left: -150px;
                    top: -150px;
                }
            }
        `;
        document.head.appendChild(style);
    }

    // =====================================================
    // 7. TYPING EFFECT - For hero section
    // =====================================================
    const typeText = (element, text, speed = 50) => {
        let index = 0;
        element.textContent = '';
        const type = () => {
            if (index < text.length) {
                element.textContent += text.charAt(index);
                index++;
                setTimeout(type, speed);
            }
        };
        type();
    };

    // =====================================================
    // 8. SMOOTH SCROLL BEHAVIOR - Enhanced
    // =====================================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                const target = document.querySelector(href);
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // =====================================================
    // 9. LAZY LOAD IMAGES
    // =====================================================
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    img.style.animation = 'fadeInUp 0.6s ease';
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // =====================================================
    // 10. QUICK CONNECT POPUP - Enhanced animations
    // =====================================================
    const quickConnectBtn = document.getElementById('quickConnectBtn');
    const quickConnectPopup = document.querySelector('.quick-connect-popup');

    if (quickConnectBtn && quickConnectPopup) {
        quickConnectBtn.addEventListener('click', function() {
            if (quickConnectPopup.style.display === 'none' || !quickConnectPopup.style.display) {
                quickConnectPopup.style.display = 'block';
                quickConnectPopup.style.animation = 'slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            } else {
                quickConnectPopup.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    quickConnectPopup.style.display = 'none';
                }, 300);
            }
        });

        // Close popup on outside click
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.quick-connect-btn') && !e.target.closest('.quick-connect-popup')) {
                quickConnectPopup.style.display = 'none';
            }
        });
    }

    // =====================================================
    // 11. FORM FIELD ANIMATIONS
    // =====================================================
    const formInputs = document.querySelectorAll('input, textarea, select');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#b8183e';
            this.style.boxShadow = '0 0 0 0.3rem rgba(184, 24, 62, 0.15)';
            this.style.transition = 'all 0.3s ease';
        });

        input.addEventListener('blur', function() {
            this.style.boxShadow = 'none';
        });
    });

    // =====================================================
    // 12. NAVBAR BRAND ANIMATION
    // =====================================================
    const navbarBrand = document.querySelector('.navbar-brand');
    if (navbarBrand) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                navbarBrand.style.transform = 'scale(0.9)';
            } else {
                navbarBrand.style.transform = 'scale(1)';
            }
        });
    }

    // =====================================================
    // 13. TOAST NOTIFICATIONS ENHANCEMENT
    // =====================================================
    window.showToast = function(message, type = 'info', duration = 4000) {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#17a2b8';
        const icon = type === 'success' ? 'check-circle-fill' : type === 'error' ? 'exclamation-circle-fill' : 'info-circle-fill';

        toast.innerHTML = `
            <div style="
                position: fixed;
                top: 100px;
                right: 20px;
                background: ${bgColor};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0,0,0,0.3);
                animation: slideInRight 0.4s ease;
                z-index: 10000;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 0.8rem;
            ">
                <i class="bi bi-${icon}"></i>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, duration);
    };

    // =====================================================
    // 14. CURSOR EFFECT - Custom cursor on hover
    // =====================================================
    document.querySelectorAll('a, button, .cursor-pointer').forEach(el => {
        el.addEventListener('mouseenter', function() {
            document.body.style.cursor = 'pointer';
        });
        el.addEventListener('mouseleave', function() {
            document.body.style.cursor = 'auto';
        });
    });

    // =====================================================
    // 15. ABOUT SECTION - CLIENT COUNTER ANIMATION
    // =====================================================
    const clientCounterElement = document.getElementById('clientCounter');
    if (clientCounterElement) {
        const observerAbout = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = 200;
                    let current = 0;
                    const increment = 20;
                    const interval = setInterval(() => {
                        current += increment;
                        clientCounterElement.textContent = current;
                        if (current >= target) {
                            clearInterval(interval);
                        }
                    }, 30);
                    observerAbout.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        observerAbout.observe(clientCounterElement);
    }

    // =====================================================
    // 16. ABOUT SECTION - VALUE CARDS ANIMATION
    // =====================================================
    const valueCards = document.querySelectorAll('.value-card');
    valueCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.animation = `fadeInUp 0.6s ease ${index * 0.1}s forwards`;
    });

    // =====================================================
    // 17. ABOUT SECTION - SERVICE ITEMS ANIMATION
    // =====================================================
    const serviceItems = document.querySelectorAll('.service-item');
    serviceItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.animation = `fadeInUp 0.6s ease ${index * 0.08}s forwards`;
    });

    console.log('✨ BabuMosshaii - Enhanced UI Animations Loaded!');
});

// Add slideOutRight animation
if (!document.getElementById('additionalAnimations')) {
    const style = document.createElement('style');
    style.id = 'additionalAnimations';
    style.textContent = `
        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(300px);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(300px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutLeft {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(-300px);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-300px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Smooth transitions */
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Focus states */
        *:focus-visible {
            outline: 2px solid #b8183e;
            outline-offset: 2px;
            border-radius: 4px;
        }
    `;
    document.head.appendChild(style);
}
