<section id="about" class="section about">
    <div class="container">
        <div class="section-header" data-reveal>
            <span class="section-header__tag">02 · {{ __('about.section.eyebrow') }}</span>
            <h2 class="section-header__title">{{ __('about.section.heading') }}</h2>
        </div>

        <div class="about__grid">
            <div class="about__narrative" data-reveal>
                <p class="about__lead">{{ __('about.intro') }}</p>
                <div class="about__quote">
                    <div class="about__quote-line"></div>
                    <p class="about__quote-text">
                        "{{ __('about.quote') }}"
                    </p>
                </div>
            </div>

            <div class="about__pillars">
                <div class="about__card" data-reveal>
                    <div class="about__card-header">
                        <div class="about__card-icon">
                            <x-ui.icon name="layers" size="20" />
                        </div>
                        <h3 class="about__card-title">{{ __('about.approach.label') }}</h3>
                    </div>
                    <p class="about__card-text">{{ __('about.approach.text') }}</p>
                </div>

                <div class="about__card" data-reveal>
                    <div class="about__card-header">
                        <div class="about__card-icon about__card-icon--accent">
                            <x-ui.icon name="smartphone" size="20" />
                        </div>
                        <h3 class="about__card-title">{{ __('about.focus.label') }}</h3>
                    </div>
                    <p class="about__card-text">{{ __('about.focus.text') }}</p>
                </div>
            </div>
        </div>

        <div class="about__progression" data-reveal>
            <div class="progression-item">
                <span class="progression-step">01</span>
                <div class="progression-content">
                    <span class="progression-role">{{ __('about.progression.developer.role') }}</span>
                    <span class="progression-desc">{{ __('about.progression.developer.description') }}</span>
                </div>
            </div>
            <div class="progression-arrow" aria-hidden="true">→</div>

            <div class="progression-item">
                <span class="progression-step">02</span>
                <div class="progression-content">
                    <span class="progression-role">{{ __('about.progression.engineer.role') }}</span>
                    <span class="progression-desc">{{ __('about.progression.engineer.description') }}</span>
                </div>
            </div>
            <div class="progression-arrow" aria-hidden="true">→</div>

            <div class="progression-item">
                <span class="progression-step">03</span>
                <div class="progression-content">
                    <span class="progression-role">{{ __('about.progression.architect.role') }}</span>
                    <span class="progression-desc">{{ __('about.progression.architect.description') }}</span>
                </div>
            </div>
            <div class="progression-arrow" aria-hidden="true">→</div>

            <div class="progression-item progression-item--highlight">
                <span class="progression-step">04</span>
                <div class="progression-content">
                    <span class="progression-role">{{ __('about.progression.product_builder.role') }}</span>
                    <span class="progression-desc">{{ __('about.progression.product_builder.description') }}</span>
                </div>
            </div>
        </div>

        <div class="about__stack-wrapper" data-reveal>
            <div class="about__stack-header">
                <x-ui.icon name="cpu" size="16" />
                <span class="meta">{{ __('about.stack_label') }}</span>
            </div>
            <ul class="about__stack" aria-label="{{ __('about.stack_label') }}">
                @foreach(__('about.stack') as $tech)
                    <li>
                        <span class="about__stack-dot"></span>
                        <span>{{ $tech }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
