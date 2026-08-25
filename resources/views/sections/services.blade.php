<section id="services" class="section services">
    <div class="container">
        <div class="section-header" data-reveal>
            <span class="section-header__tag">06 · {{ __('services.section.eyebrow') }}</span>
            <h2 class="section-header__title">{{ __('services.section.heading') }}</h2>
        </div>

        <div class="services__grid">
            @foreach($services as $index => $service)
                <div class="services__item" data-reveal data-card-glow>
                    <div class="services__top">
                        <div class="services__icon-wrapper">
                            <x-ui.icon :name="$service->icon" size="20" class="services__icon" />
                        </div>
                        <span class="services__index meta">0{{ $index + 1 }}</span>
                    </div>
                    <h3 class="services__title">{{ $service->title() }}</h3>
                    <p class="services__desc">{{ $service->description() }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
