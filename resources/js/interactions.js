// Hero Console Tab Switcher
function initConsoleTabs() {
    const tabs = document.querySelectorAll('.hero__console-tab');
    if (!tabs.length) return;

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            const targetId = tab.getAttribute('data-tab-target');
            const targetContent = document.getElementById(targetId);
            if (!targetContent) return;

            tabs.forEach((t) => {
                t.classList.remove('is-active');
                t.setAttribute('aria-selected', 'false');
            });

            document.querySelectorAll('.hero__tab-content').forEach((content) => {
                content.classList.remove('is-active');
                content.setAttribute('hidden', '');
            });

            tab.classList.add('is-active');
            tab.setAttribute('aria-selected', 'true');
            targetContent.removeAttribute('hidden');
            void targetContent.offsetWidth;
            targetContent.classList.add('is-active');
        });
    });
}

// Interactive BLoC State Machine Simulator in Hero Console
function initBlocStateSimulator() {
    const statePills = document.querySelectorAll('.state-pill');
    const stateOutput = document.getElementById('state-output');
    if (!statePills.length || !stateOutput) return;

    const stateMap = {
        initial: 'AuthState.initial()',
        loading: 'AuthState.loading()',
        success: 'AuthState.authenticated(UserSession)',
    };

    statePills.forEach((pill) => {
        pill.addEventListener('click', () => {
            const state = pill.getAttribute('data-state');
            if (!state || !stateMap[state]) return;

            statePills.forEach((p) => p.classList.remove('is-active'));
            pill.classList.add('is-active');

            stateOutput.style.opacity = '0';
            setTimeout(() => {
                stateOutput.textContent = stateMap[state];
                stateOutput.style.opacity = '1';
            }, 120);
        });
    });
}

// Spotlight cursor-aware ambient glow on cards
function initCardSpotlight() {
    const cards = document.querySelectorAll('[data-card-glow]');
    if (!cards.length) return;

    cards.forEach((card) => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
}

// 3D Parallax Tilt for Hero Console
function initConsole3DTilt() {
    const consoleCard = document.querySelector('.hero__console[data-tilt-card]');
    if (!consoleCard) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion || window.innerWidth < 960) return;

    let bounds;

    function onMouseEnter() {
        bounds = consoleCard.getBoundingClientRect();
    }

    function onMouseMove(e) {
        if (!bounds) bounds = consoleCard.getBoundingClientRect();
        const mouseX = e.clientX;
        const mouseY = e.clientY;
        const leftX = mouseX - bounds.x;
        const topY = mouseY - bounds.y;
        const center = {
            x: leftX - bounds.width / 2,
            y: topY - bounds.height / 2,
        };

        const tiltX = (center.y / (bounds.height / 2)) * -4;
        const tiltY = (center.x / (bounds.width / 2)) * 4;

        consoleCard.style.transform = `perspective(1000px) rotateX(${tiltX.toFixed(2)}deg) rotateY(${tiltY.toFixed(2)}deg) scale3d(1.01, 1.01, 1.01)`;
    }

    function onMouseLeave() {
        consoleCard.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
    }

    consoleCard.addEventListener('mouseenter', onMouseEnter);
    consoleCard.addEventListener('mousemove', onMouseMove);
    consoleCard.addEventListener('mouseleave', onMouseLeave);
}

// Live Jordan Digital Clock Widget
function initLiveJordanClock() {
    const clockEl = document.getElementById('live-jordan-time');
    if (!clockEl) return;

    function updateClock() {
        try {
            const now = new Date();
            // Jordan is UTC+3
            const jordanTime = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Amman' }));
            const hours = String(jordanTime.getHours()).padStart(2, '0');
            const minutes = String(jordanTime.getMinutes()).padStart(2, '0');
            const seconds = String(jordanTime.getSeconds()).padStart(2, '0');
            clockEl.textContent = `${hours}:${minutes}:${seconds} UTC+3 (Amman)`;
        } catch (e) {
            clockEl.textContent = 'Amman · UTC+3';
        }
    }

    updateClock();
    setInterval(updateClock, 1000);
}

// 1-Click Copy-to-Clipboard
function initCopyButtons() {
    const buttons = document.querySelectorAll('[data-copy-text]');
    if (!buttons.length) return;

    buttons.forEach((btn) => {
        btn.addEventListener('click', async () => {
            const textToCopy = btn.getAttribute('data-copy-text');
            if (!textToCopy) return;

            try {
                await navigator.clipboard.writeText(textToCopy);
                btn.classList.add('is-copied');

                setTimeout(() => {
                    btn.classList.remove('is-copied');
                }, 2200);
            } catch (err) {
                const input = document.createElement('input');
                input.value = textToCopy;
                document.body.appendChild(input);
                input.select();
                document.execCommand('copy');
                document.body.removeChild(input);

                btn.classList.add('is-copied');
                setTimeout(() => {
                    btn.classList.remove('is-copied');
                }, 2200);
            }
        });
    });
}

// Interactive Media Showcase Screenshot Switcher
function initMediaShowcase() {
    const showcases = document.querySelectorAll('[data-media-showcase]');
    if (!showcases.length) return;

    showcases.forEach((showcase) => {
        const primaryImg = showcase.querySelector('[data-showcase-primary] .device-phone__img');
        const thumbBtns = showcase.querySelectorAll('.media-showcase__thumb-btn');
        if (!primaryImg || !thumbBtns.length) return;

        thumbBtns.forEach((btn) => {
            const handleSwitch = () => {
                const src = btn.getAttribute('data-shot-src');
                if (!src || primaryImg.src === src) return;

                thumbBtns.forEach((b) => b.classList.remove('is-active'));
                btn.classList.add('is-active');

                primaryImg.style.opacity = '0.35';
                setTimeout(() => {
                    primaryImg.src = src;
                    primaryImg.style.opacity = '1';
                }, 120);
            };

            btn.addEventListener('click', handleSwitch);
            btn.addEventListener('mouseenter', handleSwitch);
        });
    });
}

// Project Details Visual Case Study Gallery
function initProjectDetailsGallery() {
    const galleryViewers = document.querySelectorAll('[data-details-gallery]');
    if (!galleryViewers.length) return;

    galleryViewers.forEach((viewer) => {
        const mainImg = viewer.querySelector('.project-details__device-main .device-phone__img');
        const thumbs = viewer.querySelectorAll('.project-details__gallery-thumb');
        if (!mainImg || !thumbs.length) return;

        thumbs.forEach((thumb) => {
            thumb.addEventListener('click', () => {
                const src = thumb.getAttribute('data-gallery-src');
                if (!src || mainImg.src === src) return;

                thumbs.forEach((t) => t.classList.remove('is-active'));
                thumb.classList.add('is-active');

                mainImg.style.opacity = '0.3';
                setTimeout(() => {
                    mainImg.src = src;
                    mainImg.style.opacity = '1';
                }, 120);
            });
        });
    });
}

function initAllInteractions() {
    initConsoleTabs();
    initBlocStateSimulator();
    initCardSpotlight();
    initConsole3DTilt();
    initLiveJordanClock();
    initCopyButtons();
    initMediaShowcase();
    initProjectDetailsGallery();
}

document.addEventListener('DOMContentLoaded', initAllInteractions);
initAllInteractions();


