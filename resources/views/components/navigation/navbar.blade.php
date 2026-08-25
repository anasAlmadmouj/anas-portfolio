@php
    $isHome = request()->routeIs('home');
    $isProjectsArchive = request()->routeIs('projects.index');
    $isProjectDetails = request()->routeIs('projects.show');
    $isProjectsSection = $isProjectsArchive || $isProjectDetails;

    $homeUrl = route('home', ['locale' => $locale]);
    
    // Cross-route anchor destinations
    $brandLink = $isHome ? '#home' : $homeUrl;
    $homeLink = $isHome ? '#home' : $homeUrl . '#home';
    $aboutLink = $isHome ? '#about' : $homeUrl . '#about';
    $projectsLink = $isHome ? '#projects' : route('projects.index', ['locale' => $locale]);
    $experienceLink = $isHome ? '#experience' : $homeUrl . '#experience';
    $skillsLink = $isHome ? '#skills' : $homeUrl . '#skills';
    $servicesLink = $isHome ? '#services' : $homeUrl . '#services';
    $contactLink = $isHome ? '#contact' : $homeUrl . '#contact';
@endphp

<header class="navbar" data-navbar>
    <div class="container navbar__inner">
        {{-- Creative Developer Brand Mark --}}
        <a href="{{ $brandLink }}" class="navbar__brand" aria-label="{{ __('general.site_name') }}">
            <span class="navbar__brand-mark" aria-hidden="true">
                <span class="navbar__brand-glyph">~/</span>
            </span>
            <div class="navbar__brand-text">
                <span class="navbar__brand-name">{{ __('general.site_name') }}</span>
                <span class="navbar__brand-tag">flutter.dev</span>
            </div>
        </a>

        {{-- Center Floating Navigation Dock --}}
        <nav class="navbar__nav" aria-label="{{ __('navigation.primary') }}">
            <div class="navbar__dock">
                <ul class="navbar__links">
                    <li>
                        <a 
                            href="{{ $homeLink }}" 
                            class="navbar__link {{ $isHome ? 'is-active' : '' }}"
                            {!! $isHome ? 'aria-current="page"' : '' !!}
                        >
                            {{ __('navigation.home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ $aboutLink }}" class="navbar__link">
                            {{ __('navigation.about') }}
                        </a>
                    </li>
                    <li>
                        <a 
                            href="{{ $projectsLink }}" 
                            class="navbar__link {{ $isProjectsSection ? 'is-active' : '' }}"
                            {!! $isProjectsSection ? 'aria-current="page"' : '' !!}
                        >
                            {{ __('navigation.projects') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ $experienceLink }}" class="navbar__link">
                            {{ __('navigation.experience') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ $skillsLink }}" class="navbar__link">
                            {{ __('navigation.skills') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ $servicesLink }}" class="navbar__link">
                            {{ __('navigation.services') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ $contactLink }}" class="navbar__link">
                            {{ __('navigation.contact') }}
                        </a>
                    </li>
                </ul>
                <div class="navbar__indicator" data-nav-indicator aria-hidden="true"></div>
            </div>
        </nav>

        {{-- Controls & System Status Island --}}
        <div class="navbar__actions">
            <div class="navbar__status" title="{{ __('navigation.available_for_work') }}">
                <span class="navbar__status-ping" aria-hidden="true"></span>
                <span class="navbar__status-dot"></span>
                <span class="navbar__status-text">{{ __('navigation.available_for_work') }}</span>
            </div>

            <x-language-switcher />
            <x-theme-switcher />

            {{-- Animated Hamburger Trigger --}}
            <button
                type="button"
                class="navbar__menu-toggle"
                data-menu-toggle
                aria-expanded="false"
                aria-controls="mobile-nav-overlay"
                aria-label="{{ __('navigation.toggle_menu') }}"
            >
                <span class="navbar__hamburger" aria-hidden="true">
                    <span class="navbar__hamburger-line"></span>
                    <span class="navbar__hamburger-line"></span>
                    <span class="navbar__hamburger-line"></span>
                </span>
            </button>
        </div>
    </div>

    {{-- Full-Screen Mobile Navigation Overlay --}}
    <div 
        class="navbar__mobile-overlay" 
        id="mobile-nav-overlay" 
        data-mobile-menu 
        hidden 
        aria-modal="true" 
        role="dialog" 
        aria-label="{{ __('navigation.primary') }}"
    >
        <div class="navbar__mobile-backdrop" data-menu-backdrop></div>
        
        <div class="navbar__mobile-dialog">
            <div class="navbar__mobile-header container">
                <div class="navbar__mobile-brand">
                    <span class="navbar__brand-mark">~/</span>
                    <span class="navbar__brand-name">{{ __('general.site_name') }}</span>
                </div>
                
                <button type="button" class="navbar__mobile-close" data-menu-close aria-label="{{ __('navigation.close_menu') }}">
                    <x-ui.icon name="close" size="22" />
                </button>
            </div>

            <div class="navbar__mobile-body container">
                <nav class="navbar__mobile-nav">
                    <ul class="navbar__mobile-links">
                        <li class="navbar__mobile-item" style="--item-index: 1">
                            <a href="{{ $homeLink }}" class="navbar__mobile-link {{ $isHome ? 'is-active' : '' }}">
                                <span class="navbar__mobile-num">01</span>
                                <span class="navbar__mobile-label">{{ __('navigation.home') }}</span>
                                <x-ui.icon name="arrow-right" size="18" class="icon--directional navbar__mobile-arrow" />
                            </a>
                        </li>
                        <li class="navbar__mobile-item" style="--item-index: 2">
                            <a href="{{ $aboutLink }}" class="navbar__mobile-link">
                                <span class="navbar__mobile-num">02</span>
                                <span class="navbar__mobile-label">{{ __('navigation.about') }}</span>
                                <x-ui.icon name="arrow-right" size="18" class="icon--directional navbar__mobile-arrow" />
                            </a>
                        </li>
                        <li class="navbar__mobile-item" style="--item-index: 3">
                            <a href="{{ $projectsLink }}" class="navbar__mobile-link {{ $isProjectsSection ? 'is-active' : '' }}">
                                <span class="navbar__mobile-num">03</span>
                                <span class="navbar__mobile-label">{{ __('navigation.projects') }}</span>
                                <x-ui.icon name="arrow-right" size="18" class="icon--directional navbar__mobile-arrow" />
                            </a>
                        </li>
                        <li class="navbar__mobile-item" style="--item-index: 4">
                            <a href="{{ $experienceLink }}" class="navbar__mobile-link">
                                <span class="navbar__mobile-num">04</span>
                                <span class="navbar__mobile-label">{{ __('navigation.experience') }}</span>
                                <x-ui.icon name="arrow-right" size="18" class="icon--directional navbar__mobile-arrow" />
                            </a>
                        </li>
                        <li class="navbar__mobile-item" style="--item-index: 5">
                            <a href="{{ $skillsLink }}" class="navbar__mobile-link">
                                <span class="navbar__mobile-num">05</span>
                                <span class="navbar__mobile-label">{{ __('navigation.skills') }}</span>
                                <x-ui.icon name="arrow-right" size="18" class="icon--directional navbar__mobile-arrow" />
                            </a>
                        </li>
                        <li class="navbar__mobile-item" style="--item-index: 6">
                            <a href="{{ $servicesLink }}" class="navbar__mobile-link">
                                <span class="navbar__mobile-num">06</span>
                                <span class="navbar__mobile-label">{{ __('navigation.services') }}</span>
                                <x-ui.icon name="arrow-right" size="18" class="icon--directional navbar__mobile-arrow" />
                            </a>
                        </li>
                        <li class="navbar__mobile-item" style="--item-index: 7">
                            <a href="{{ $contactLink }}" class="navbar__mobile-link">
                                <span class="navbar__mobile-num">07</span>
                                <span class="navbar__mobile-label">{{ __('navigation.contact') }}</span>
                                <x-ui.icon name="arrow-right" size="18" class="icon--directional navbar__mobile-arrow" />
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="navbar__mobile-footer container">
                <div class="navbar__mobile-status">
                    <span class="navbar__status-ping" aria-hidden="true"></span>
                    <span class="navbar__status-dot"></span>
                    <span>{{ __('navigation.available_for_work') }}</span>
                </div>

                <div class="navbar__mobile-actions">
                    <x-language-switcher />
                    <x-theme-switcher />
                </div>

                <a href="{{ $contactLink }}" class="btn btn--primary navbar__mobile-cta">
                    <span>{{ __('navigation.contact_me') }}</span>
                    <x-ui.icon name="arrow-right" size="16" class="icon--directional" />
                </a>
            </div>
        </div>
    </div>
</header>

