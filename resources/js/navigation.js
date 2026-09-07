// Temporary on-screen diagnostic for the mobile-nav-doesn't-navigate report.
// Always on for now (no query param — too easy to lose "?navdebug" to
// mobile address-bar autocomplete/cache) so it's visible on any page load.
// Remove once the real-device repro is understood.
function initNavDebugOverlay() {
    const badge = document.createElement('div');
    badge.textContent = 'navdebug active';
    badge.style.cssText =
        'position:fixed;top:0;right:0;background:#f0f;color:#000;font:10px monospace;' +
        'padding:2px 6px;z-index:2147483647;pointer-events:none;';
    document.body.appendChild(badge);

    const panel = document.createElement('div');
    panel.style.cssText =
        'position:fixed;bottom:0;left:0;right:0;max-height:45vh;overflow:auto;' +
        'background:rgba(0,0,0,0.92);color:#0f0;font:11px/1.4 monospace;' +
        'padding:8px;z-index:2147483647;white-space:pre-wrap;pointer-events:none;';
    panel.textContent = 'navdebug ready — tap a mobile nav link';
    document.body.appendChild(panel);

    window.__navDebugLog = (msg) => {
        panel.textContent = `[log] ${msg}\n` + panel.textContent;
    };

    const describe = (el) =>
        el ? `<${el.tagName.toLowerCase()} class="${el.className}">` : 'null';

    // Capture phase: fires first, before any click handler can mutate the DOM.
    document.addEventListener(
        'click',
        (event) => {
            const anchor = event.target.closest('a');
            panel.textContent =
                `[capture] target=${describe(event.target)}\n` +
                `anchor=${anchor ? anchor.href : 'none'}\n` +
                `defaultPrevented=${event.defaultPrevented}\n` +
                panel.textContent;
        },
        true
    );

    // Bubble phase on document fires last (after the target's own handlers),
    // so this shows the final defaultPrevented state before the browser
    // decides whether to navigate.
    document.addEventListener('click', (event) => {
        const anchor = event.target.closest('a');
        panel.textContent =
            `[bubble] target=${describe(event.target)}\n` +
            `anchor=${anchor ? anchor.href : 'none'}\n` +
            `defaultPrevented=${event.defaultPrevented}\n` +
            `---\n` +
            panel.textContent;
    });

    ['touchstart', 'touchend'].forEach((type) => {
        document.addEventListener(
            type,
            (event) => {
                const t = event.touches[0] || event.changedTouches[0];
                panel.textContent =
                    `[${type}] target=${describe(event.target)} at (${t?.clientX},${t?.clientY})\n` +
                    panel.textContent;
            },
            { passive: true }
        );
    });
}

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
        link.addEventListener('click', (event) => {
            const url = new URL(link.href, location.href);
            const isSamePage = url.pathname === location.pathname && url.search === location.search;

            if (isSamePage && url.hash) {
                // Same-page section links (#projects, #about, ...): don't rely
                // on the browser's built-in "scroll to anchor" default action.
                // At the moment that action would run, <html>/<body> still have
                // overflow: hidden from the open menu, so the page isn't
                // scrollable yet — the browser silently drops the scroll, and
                // by the time closeMenu() restores overflow the opportunity has
                // passed. Confirmed on a real Android device via an on-screen
                // event log: the click itself was never prevented and had the
                // correct href, it's the scroll that quietly failed. Take
                // manual control instead: unlock scroll first, then scroll.
                const target = document.querySelector(url.hash);
                if (target) {
                    event.preventDefault();

                    const log = window.__navDebugLog || (() => {});
                    log(
                        `pre-close: scrollY=${window.scrollY} html.overflow="${document.documentElement.style.overflow}" ` +
                        `body.overflow="${document.body.style.overflow}" targetTop=${Math.round(target.getBoundingClientRect().top)}`
                    );

                    closeMenu();

                    log(
                        `post-close: scrollY=${window.scrollY} html.overflow="${document.documentElement.style.overflow}" ` +
                        `body.overflow="${document.body.style.overflow}" targetTop=${Math.round(target.getBoundingClientRect().top)}`
                    );

                    try {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        log('scrollIntoView() called, no error thrown');
                    } catch (err) {
                        log(`scrollIntoView() THREW: ${err.message}`);
                    }

                    setTimeout(() => log(`+50ms: scrollY=${window.scrollY}`), 50);
                    setTimeout(() => log(`+400ms: scrollY=${window.scrollY}`), 400);

                    history.pushState(null, '', url.hash);
                    return;
                }
            }

            // Cross-page links: let the browser navigate normally. Defer the
            // close so it doesn't race the click's own default action, though
            // it's moot in practice since this page is about to unload anyway.
            setTimeout(() => closeMenu(), 0);
        });
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
    initNavDebugOverlay();
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
