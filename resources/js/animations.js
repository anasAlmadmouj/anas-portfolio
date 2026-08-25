function initRevealAnimations() {
    const targets = document.querySelectorAll('[data-reveal]');
    if (!targets.length) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        targets.forEach((target) => target.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12 }
    );

    targets.forEach((target) => observer.observe(target));
}

function initScrollProgress() {
    const progressBar = document.getElementById('scroll-progress');
    const timelineProgress = document.getElementById('experience-line-progress');
    const timelineWrapper = document.querySelector('.experience__timeline-wrapper');

    let ticking = false;

    function updateScroll() {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;

        if (progressBar && scrollHeight > 0) {
            const pct = Math.min(Math.max(scrollTop / scrollHeight, 0), 1);
            progressBar.style.setProperty('--scroll-pct', pct.toString());
        }

        if (timelineProgress && timelineWrapper) {
            const rect = timelineWrapper.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            
            // Calculate how far the timeline is through the viewport
            const start = windowHeight * 0.75;
            const current = start - rect.top;
            const total = rect.height;
            const fillPct = Math.min(Math.max((current / total) * 100, 0), 100);
            
            timelineProgress.style.height = `${fillPct}%`;
        }

        ticking = false;
    }

    window.addEventListener(
        'scroll',
        () => {
            if (!ticking) {
                window.requestAnimationFrame(updateScroll);
                ticking = true;
            }
        },
        { passive: true }
    );

    updateScroll();
}

document.addEventListener('DOMContentLoaded', () => {
    initRevealAnimations();
    initScrollProgress();
});

initRevealAnimations();
initScrollProgress();

