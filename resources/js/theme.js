const STORAGE_KEY = 'theme';

function getStoredTheme() {
    return localStorage.getItem(STORAGE_KEY);
}

function getSystemTheme() {
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
}

function applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    document.documentElement.style.colorScheme = theme;
}

function setTheme(theme) {
    localStorage.setItem(STORAGE_KEY, theme);
    applyTheme(theme);
    document.dispatchEvent(new CustomEvent('themechange', { detail: { theme } }));
}

function toggleTheme() {
    const current = document.documentElement.getAttribute('data-theme') || getSystemTheme();
    setTheme(current === 'dark' ? 'light' : 'dark');
}

function initThemeToggle() {
    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-theme-toggle]');

        if (!trigger) {
            return;
        }

        toggleTheme();
    });

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
        if (getStoredTheme()) {
            return;
        }

        applyTheme(event.matches ? 'dark' : 'light');
    });
}

initThemeToggle();

export { setTheme, toggleTheme, getSystemTheme, getStoredTheme };
