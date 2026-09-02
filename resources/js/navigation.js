// Mobile Fullscreen Navigation Overlay
function initMobileMenu() {
    const toggle = document.querySelector('[data-menu-toggle]');
    const menu = document.querySelector('[data-mobile-menu]');
    const closeBtn = document.querySelector('[data-menu-close]');
    const backdrop = document.querySelector('[data-menu-backdrop]');

    if (!toggle || !menu) return;

    // The navbar has a backdrop-filter, which makes it the containing block
    // for this fixed-position overlay — confining it to the navbar's own
    // height instead of the full viewport. Move it to <body> so `position:
    // fixed; inset: 0` resolves against the viewport as intended.
    if (menu.parentElement !== document.body) {
        document.body.appendChild(menu);
    }

    const isOpen = () => !menu.hasAttribute('hidden');

    const openMenu = () => {
        menu.removeAttribute('hidden');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
    };

    const closeMenu = ({ returnFocus = false } = {}) => {
        if (!isOpen()) return;

        menu.setAttribute('hidden', '');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';

        if (returnFocus) {
            toggle.focus();
        }
    };

    toggle.addEventListener('click', () => {
        if (isOpen()) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', () => closeMenu({ returnFocus: true }));
    }

    if (backdrop) {
        backdrop.addEventListener('click', () => closeMenu());
    }

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => closeMenu());
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && isOpen()) {
            closeMenu({ returnFocus: true });
        }
    });
}

// Intelligent Scroll Behavior
function initNavbarScrollState() {
    const navbar = document.querySelector('[data-navbar]');
    if (!navbar) return;

    let ticking = false;

    const updateState = () => {
        const currentScrollY = window.scrollY;
        navbar.classList.toggle('navbar--scrolled', currentScrollY > 20);
        ticking = false;
    };

    window.addEventListener(
        'scroll',
        () => {
            if (!ticking) {
                window.requestAnimationFrame(updateState);
                ticking = true;
            }
        },
        { passive: true }
    );

    updateState();
}

// Sliding Active Section & Page Indicator
function initNavIndicator() {
    const indicator = document.querySelector('[data-nav-indicator]');
    const dock = document.querySelector('.navbar__dock');
    const links = document.querySelectorAll('.navbar__link');
    if (!indicator || !dock || !links.length) return;

    function positionIndicator(activeLink) {
        if (!activeLink) {
            indicator.classList.remove('is-visible');
            return;
        }

        const dockRect = dock.getBoundingClientRect();
        const linkRect = activeLink.getBoundingClientRect();

        const left = linkRect.left - dockRect.left;
        const width = linkRect.width;

        indicator.style.left = `${left}px`;
        indicator.style.width = `${width}px`;
        indicator.classList.add('is-visible');
    }

    // Check initial active link
    const currentActive = document.querySelector('.navbar__link.is-active') || links[0];
    if (currentActive) {
        requestAnimationFrame(() => positionIndicator(currentActive));
    }

    // If on homepage, observe sections
    const hashLinks = Array.from(document.querySelectorAll('.navbar__link[href^="#"]'));
    if (hashLinks.length && 'IntersectionObserver' in window) {
        const sections = hashLinks
            .map((link) => {
                const target = document.querySelector(link.getAttribute('href'));
                return target;
            })
            .filter(Boolean);

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const targetId = entry.target.id;
                        hashLinks.forEach((link) => {
                            const isMatch = link.getAttribute('href') === `#${targetId}`;
                            if (isMatch) {
                                links.forEach((l) => l.classList.remove('is-active'));
                                link.classList.add('is-active');
                                link.setAttribute('aria-current', 'page');
                                positionIndicator(link);
                            }
                        });
                    }
                });
            },
            { rootMargin: '-20% 0px -60% 0px', threshold: 0 }
        );

        sections.forEach((s) => observer.observe(s));
    }

    window.addEventListener(
        'resize',
        () => {
            const active = document.querySelector('.navbar__link.is-active');
            if (active) positionIndicator(active);
        },
        { passive: true }
    );
}

// Smooth Page Entrance
function initPageTransitions() {
    const main = document.getElementById('main-content') || document.querySelector('main');
    if (main) {
        main.classList.add('page-transition-enter');
    }
}

function initAll() {
    initMobileMenu();
    initNavbarScrollState();
    initNavIndicator();
    initPageTransitions();
}

// Module scripts run after the document has been parsed, so DOMContentLoaded
// may fire either before or after this point. Run once, whichever comes first,
// to avoid double-registering listeners (which broke the mobile menu toggle).
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAll);
} else {
    initAll();
}
