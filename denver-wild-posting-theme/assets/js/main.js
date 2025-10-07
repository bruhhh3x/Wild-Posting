/**
 * Denver Wild Posting Theme JavaScript
 */

(function() {
    'use strict';

    // Smooth scrolling for anchor links
    function initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Image fallback functionality
    function initImageFallback() {
        const fallbackImages = [
            'https://images.unsplash.com/photo-1520975832261-87cd0b7c1b5f?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1200&auto=format&fit=crop'
        ];

        const images = document.querySelectorAll('img[data-fallback]');
        
        images.forEach(img => {
            img.addEventListener('error', function() {
                if (!this.dataset.fallbackUsed) {
                    const randomFallback = fallbackImages[Math.floor(Math.random() * fallbackImages.length)];
                    this.src = randomFallback;
                    this.dataset.fallbackUsed = 'true';
                }
            });
        });
    }

    // Mobile menu toggle (if needed)
    function initMobileMenu() {
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-links');
        
        if (navToggle && navMenu) {
            navToggle.addEventListener('click', function() {
                navMenu.classList.toggle('nav-open');
                this.classList.toggle('nav-toggle-open');
            });
        }
    }

    // Lazy loading for images
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            const lazyImages = document.querySelectorAll('img[data-src]');
            lazyImages.forEach(img => imageObserver.observe(img));
        }
    }

    // Video autoplay handling
    function initVideoHandling() {
        const videos = document.querySelectorAll('video[autoplay]');
        
        videos.forEach(video => {
            // Ensure video is muted for autoplay
            video.muted = true;
            
            // Handle autoplay failure
            video.addEventListener('error', function() {
                console.log('Video autoplay failed, showing fallback');
                // Could show fallback image here
            });
        });
    }

    // Initialize all functionality
    function init() {
        initSmoothScrolling();
        initImageFallback();
        initMobileMenu();
        initLazyLoading();
        initVideoHandling();
    }

    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
