<section id="contact" class="section contact">
    <div class="container">
        <div class="section-header" data-reveal>
            <span class="section-header__tag">07 · {{ __('contact.section.eyebrow') }}</span>
            <h2 class="section-header__title">{{ __('contact.section.heading') }}</h2>
        </div>

        <div class="contact__grid">
            <div class="contact__intro" data-reveal>
                <p class="contact__lead">{{ __('contact.section.description') }}</p>

                <div class="contact__cards">
                    <!-- Live Availability Banner -->
                    <div class="contact__availability-bar">
                        <span class="contact__avail-pulse">
                            <span class="contact__avail-ping"></span>
                            <span class="contact__avail-dot"></span>
                        </span>
                        <span class="contact__avail-text">{{ __('contact.availability') }}</span>
                    </div>

                    <!-- Email Card with Copy Feature -->
                    <div class="contact__card" data-card-glow>
                        <div class="contact__card-icon">
                            <x-ui.icon name="mail" size="18" />
                        </div>
                        <div class="contact__card-body">
                            <span class="contact__card-label">{{ __('contact.form.email') }}</span>
                            <div class="contact__email-row">
                                <a href="mailto:{{ config('portfolio.contact.email') }}" class="contact__email-link">
                                    {{ config('portfolio.contact.email') }}
                                </a>
                                <button type="button" class="contact__copy-btn" data-copy-text="{{ config('portfolio.contact.email') }}" aria-label="{{ __('contact.email.copy') }}">
                                    <x-ui.icon name="copy" size="14" class="copy-icon" />
                                    <x-ui.icon name="check" size="14" class="check-icon" />
                                    <span class="contact__copy-tooltip">{{ __('contact.email.copied') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Card -->
                    @if(config('portfolio.contact.phone'))
                        <div class="contact__card" data-card-glow>
                            <div class="contact__card-icon">
                                <x-ui.icon name="smartphone" size="18" />
                            </div>
                            <div class="contact__card-body">
                                <span class="contact__card-label">{{ __('contact.phone.title') }}</span>
                                <div class="contact__email-row">
                                    <a href="tel:{{ str_replace(' ', '', config('portfolio.contact.phone')) }}" class="contact__email-link">
                                        {{ config('portfolio.contact.phone') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Location & Live Timezone Card -->
                    <div class="contact__card" data-card-glow>
                        <div class="contact__card-icon contact__card-icon--accent">
                            <x-ui.icon name="map-pin" size="18" />
                        </div>
                        <div class="contact__card-body">
                            <div class="contact__timezone-header">
                                <span class="contact__card-label">{{ __('contact.location.title') }}</span>
                                <span class="contact__live-clock-badge meta" id="live-jordan-time">17:00 UTC+3</span>
                            </div>
                            <span class="contact__card-val">{{ __('contact.location.value') }}</span>
                        </div>
                    </div>

                    <!-- Social Links Strip -->
                    <div class="contact__social-strip">
                        @if(config('portfolio.contact.social.github'))
                            <a href="{{ config('portfolio.contact.social.github') }}" target="_blank" rel="noopener noreferrer" class="contact__social-btn">
                                <x-ui.icon name="github" size="16" />
                                <span>GitHub</span>
                                <x-ui.icon name="external-link" size="12" class="contact__social-arrow" />
                            </a>
                        @endif
                        @if(config('portfolio.contact.social.linkedin'))
                            <a href="{{ config('portfolio.contact.social.linkedin') }}" target="_blank" rel="noopener noreferrer" class="contact__social-btn">
                                <x-ui.icon name="linkedin" size="16" />
                                <span>LinkedIn</span>
                                <x-ui.icon name="external-link" size="12" class="contact__social-arrow" />
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="contact__form-container" data-reveal>
                <form class="contact__form" method="POST" action="{{ route('contact.store', ['locale' => $locale]) }}" novalidate>
                    @csrf
                    <input type="hidden" name="rendered_at" value="{{ now()->timestamp }}">

                    <div class="form-field form-field--honeypot" aria-hidden="true">
                        <label for="company">Company</label>
                        <input type="text" id="company" name="company" tabindex="-1" autocomplete="off">
                    </div>

                    @if(session('contactStatus') === 'success')
                        <div class="form-status form-status--success" role="status">
                            <x-ui.icon name="check" size="18" />
                            <span>{{ __('contact.form.success') }}</span>
                        </div>
                    @endif

                    <div class="form-field">
                        <label for="name">{{ __('contact.form.name') }}</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="{{ __('contact.form.name_placeholder') }}"
                            autocomplete="name"
                            required
                            @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                        >
                        @error('name')
                            <span class="form-error" id="name-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="email">{{ __('contact.form.email') }}</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('contact.form.email_placeholder') }}"
                            autocomplete="email"
                            required
                            @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                        >
                        @error('email')
                            <span class="form-error" id="email-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="message">{{ __('contact.form.message') }}</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="5"
                            placeholder="{{ __('contact.form.message_placeholder') }}"
                            required
                            @error('message') aria-invalid="true" aria-describedby="message-error" @enderror
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <span class="form-error" id="message-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn--primary btn--lg contact__submit">
                        <span>{{ __('contact.form.submit') }}</span>
                        <x-ui.icon name="arrow-right" size="16" class="icon--directional" />
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
