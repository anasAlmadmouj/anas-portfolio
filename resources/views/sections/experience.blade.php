<section id="experience" class="section experience">
    <div class="container">
        <div class="section-header" data-reveal>
            <span class="section-header__tag">04 · {{ __('experience.section.eyebrow') }}</span>
            <h2 class="section-header__title">{{ __('experience.section.heading') }}</h2>
        </div>

        <div class="experience__timeline-wrapper">
            <div class="experience__line" aria-hidden="true">
                <div class="experience__line-progress" id="experience-line-progress"></div>
            </div>

            <ol class="experience__timeline">
                @foreach($experience as $index => $item)
                    <li class="experience__item" data-reveal>
                        <div class="experience__node-wrapper" aria-hidden="true">
                            <div class="experience__node {{ $item->periodEnd === null ? 'is-current' : '' }}">
                                @if($item->periodEnd === null)
                                    <span class="experience__node-pulse"></span>
                                @endif
                            </div>
                        </div>

                        <div class="experience__card" data-card-glow>
                            <div class="experience__header">
                                <div>
                                    <h3 class="experience__position">{{ $item->position() }}</h3>
                                    <div class="experience__company-row">
                                        <span class="experience__company">{{ $item->company() }}</span>
                                    </div>
                                </div>
                                <div class="experience__period-badge">
                                    <x-ui.icon name="sparkles" size="12" />
                                    <span>{{ $item->periodStart }} — {{ $item->periodEnd ?? __('experience.section.present') }}</span>
                                </div>
                            </div>

                            <p class="experience__description">{{ $item->description() }}</p>

                            <ul class="experience__responsibilities">
                                @foreach($item->responsibilities() as $responsibility)
                                    <li>
                                        <x-ui.icon name="check" size="14" class="experience__resp-icon" />
                                        <span>{{ $responsibility }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="experience__tech">
                                @foreach($item->technologies as $tech)
                                    <li>{{ $tech }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
