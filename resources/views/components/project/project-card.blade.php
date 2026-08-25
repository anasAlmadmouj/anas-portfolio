@props(['project', 'index' => 0])

<article class="project-card" data-reveal data-card-glow>
    <a href="{{ route('projects.show', ['locale' => $locale, 'slug' => $project->slug]) }}" class="project-card__link">
        <div class="project-card__media project-card__media--{{ $project->category }}">
            <div class="project-card__badges">
                <span class="project-card__index">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                @if($project->isConfidential)
                    <span class="project-card__badge project-card__badge--confidential">
                        <x-ui.icon name="lock" size="12" />
                        <span>{{ __('projects.labels.private') }}</span>
                    </span>
                @elseif($project->isFeatured)
                    <span class="project-card__badge project-card__badge--featured">
                        <x-ui.icon name="sparkles" size="12" />
                        <span>{{ __('projects.labels.featured') }}</span>
                    </span>
                @endif
            </div>

            <!-- Visual Media or Animated Visual Mockup -->
            <div class="project-card__mockup" aria-hidden="true">
                @if($project->hasScreenshots())
                    <div class="project-card__screenshot-preview">
                        <x-project.device-frame :image="$project->primaryScreenshot()" :alt="$project->name()" />
                    </div>
                @elseif($project->slug === 'mobile-banking-app')
                    <div class="mockup-banking">
                        <div class="mockup-banking__card">
                            <div class="mockup-banking__top">
                                <div class="mockup-banking__chip"></div>
                                <span class="mockup-banking__contactless">)))</span>
                            </div>
                            <span class="mockup-banking__num">•••• 8924</span>
                            <div class="mockup-banking__bottom">
                                <span class="mockup-banking__holder">AUTHENTICATED</span>
                                <span class="mockup-banking__brand">AES-256</span>
                            </div>
                        </div>
                        <div class="mockup-banking__stats">
                            <span class="mockup-banking__live-dot"></span>
                            <span class="mockup-banking__val">BLoC State · 60 FPS</span>
                        </div>
                    </div>
                @elseif($project->slug === 'field-service-platform')
                    <div class="mockup-dispatch">
                        <div class="mockup-dispatch__header">
                            <span class="mockup-dispatch__dot"></span>
                            <span>Offline-First Sync Engine</span>
                        </div>
                        <div class="mockup-dispatch__route">
                            <div class="mockup-dispatch__node is-active">
                                <span class="dispatch-pulse"></span>
                            </div>
                            <div class="mockup-dispatch__line">
                                <span class="dispatch-packet"></span>
                            </div>
                            <div class="mockup-dispatch__node"></div>
                            <div class="mockup-dispatch__line"></div>
                            <div class="mockup-dispatch__node is-destination"></div>
                        </div>
                    </div>
                @elseif($project->slug === 'health-tracking-app')
                    <div class="mockup-health">
                        <div class="mockup-health__vitals">
                            <x-ui.icon name="activity" size="16" class="mockup-health__icon" />
                            <span>Riverpod · Reactive SQLite Vitals</span>
                        </div>
                        <div class="mockup-health__graph">
                            <svg viewBox="0 0 200 40" class="mockup-health__svg" preserveAspectRatio="none">
                                <path class="mockup-health__wave" d="M0 20 L50 20 L60 5 L70 35 L80 10 L90 25 L100 20 L200 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="mockup-health__beacon"></span>
                        </div>
                    </div>
                @else
                    <div class="mockup-generic">
                        <div class="mockup-generic__terminal">
                            <div class="mockup-generic__dots">
                                <span></span><span></span><span></span>
                            </div>
                            <div class="mockup-generic__body">
                                <span class="mockup-generic__prompt">$</span>
                                <span class="mockup-generic__code">dart run build_runner build</span>
                                <span class="mockup-generic__cursor"></span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="project-card__body">
            <div class="project-card__meta">
                <span class="project-card__category">{{ $project->categoryLabel() }}</span>
                <span class="project-card__dot">·</span>
                <span class="project-card__year">{{ $project->year }}</span>
                <span class="project-card__dot">·</span>
                <span class="project-card__status">{{ $project->statusLabel() }}</span>
            </div>

            <div class="project-card__header-row">
                <h3 class="project-card__title">{{ $project->name() }}</h3>
                <div class="project-card__arrow-circle">
                    <x-ui.icon name="arrow-up-right" size="16" class="icon--directional project-card__arrow" />
                </div>
            </div>

            <p class="project-card__description">{{ $project->shortDescription() }}</p>

            <div class="project-card__footer">
                <ul class="project-card__tech">
                    @foreach($project->technologies as $tech)
                        <li>{{ $tech }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </a>
</article>
