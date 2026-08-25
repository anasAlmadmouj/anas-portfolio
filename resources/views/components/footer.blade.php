<footer class="site-footer">
    <div class="container site-footer__inner">
        <div class="site-footer__top">
            <div class="site-footer__identity">
                <div class="site-footer__brand">
                    <span class="navbar__brand-mark" aria-hidden="true">
                        <span class="navbar__brand-glyph">~/</span>
                    </span>
                    <span class="site-footer__name">{{ __('general.site_name') }}</span>
                </div>
                <p class="site-footer__role meta">{{ __('general.site_role') }} · {{ __('hero.location') }}</p>
            </div>

            <ul class="site-footer__social">
                @if(config('portfolio.contact.social.github'))
                    <li>
                        <a href="{{ config('portfolio.contact.social.github') }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                            <x-ui.icon name="github" size="18" />
                        </a>
                    </li>
                @endif
                @if(config('portfolio.contact.social.linkedin'))
                    <li>
                        <a href="{{ config('portfolio.contact.social.linkedin') }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <x-ui.icon name="linkedin" size="18" />
                        </a>
                    </li>
                @endif
                <li>
                    <a href="mailto:{{ config('portfolio.contact.email') }}" aria-label="{{ __('contact.form.email') }}">
                        <x-ui.icon name="mail" size="18" />
                    </a>
                </li>
            </ul>
        </div>

        <div class="site-footer__meta">
            <p class="meta">&copy; {{ now()->year }} {{ __('general.site_name') }}. {{ __('general.rights_reserved') }}</p>
            <a href="{{ request()->routeIs('home') ? '#home' : '#main-content' }}" class="site-footer__back-to-top">
                {{ __('general.back_to_top') }}
                <x-ui.icon name="arrow-right" size="14" class="site-footer__back-icon" />
            </a>
        </div>
    </div>
</footer>
