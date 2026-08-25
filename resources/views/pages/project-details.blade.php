@extends('layouts.app')

@section('title', $project->name().' — '.__('general.site_name'))
@section('meta_description', $project->shortDescription())

@section('content')
    <article class="section project-details">
        <div class="container project-details__header" data-reveal>
            <a href="{{ route('projects.index', ['locale' => $locale]) }}" class="project-details__back btn btn--ghost btn--sm">
                <x-ui.icon name="arrow-left" size="14" class="icon--directional" />
                <span>{{ __('projects.section.view_all') }}</span>
            </a>

            <div class="project-details__meta-tags">
                <span class="project-details__tag">{{ $project->categoryLabel() }}</span>
                <span class="project-details__tag-dot">·</span>
                <span class="project-details__tag">{{ $project->year }}</span>
                <span class="project-details__tag-dot">·</span>
                <span class="project-details__tag project-details__tag--status">{{ $project->statusLabel() }}</span>
            </div>

            <h1 class="project-details__title">{{ $project->name() }}</h1>
            <p class="project-details__lead">{{ $project->shortDescription() }}</p>

            @if($project->isConfidential)
                <div class="project-details__confidential-notice">
                    <x-ui.icon name="lock" size="16" />
                    <span>{{ __('projects.labels.private') }}</span>
                </div>
            @endif

            <ul class="project-details__tech">
                @foreach($project->technologies as $tech)
                    <li>{{ $tech }}</li>
                @endforeach
            </ul>

            @if($project->hasScreenshots())
                {{-- Interactive Visual Case Study Gallery --}}
                <div class="project-details__gallery-showcase" data-reveal>
                    <div class="project-details__gallery-header">
                        <div class="project-details__gallery-title-wrap">
                            <x-ui.icon name="smartphone" size="18" class="project-details__gallery-icon" />
                            <h2 class="project-details__gallery-title">Visual Showcase & Screen Architecture</h2>
                        </div>
                        <span class="project-details__gallery-count">{{ count($project->screenshots) }} Production Screens</span>
                    </div>

                    <div class="project-details__gallery-viewer" data-details-gallery>
                        <div class="project-details__gallery-main">
                            <x-project.device-frame 
                                :image="$project->primaryScreenshot()" 
                                :alt="$project->name() . ' Screen Preview'" 
                                :priority="true"
                                class="project-details__device-main"
                            />
                        </div>

                        <div class="project-details__gallery-grid">
                            @foreach($project->screenshots as $idx => $screenshot)
                                <button 
                                    type="button" 
                                    class="project-details__gallery-thumb {{ $idx === 0 ? 'is-active' : '' }}" 
                                    data-gallery-src="{{ asset($screenshot) }}"
                                    aria-label="View screen {{ $idx + 1 }}"
                                >
                                    <div class="project-details__thumb-wrapper">
                                        <img src="{{ asset($screenshot) }}" alt="" loading="lazy" class="project-details__thumb-img" />
                                        <span class="project-details__thumb-badge">Screen 0{{ $idx + 1 }}</span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="container project-details__body">
            <div class="project-details__main">
                <section class="project-details__section" data-reveal>
                    <div class="project-details__section-header">
                        <x-ui.icon name="sparkles" size="18" class="project-details__section-icon" />
                        <h2>{{ __('projects.labels.overview') }}</h2>
                    </div>
                    <p>{{ $project->overview() }}</p>
                </section>

                <section class="project-details__section" data-reveal>
                    <div class="project-details__section-header">
                        <x-ui.icon name="layers" size="18" class="project-details__section-icon" />
                        <h2>{{ __('projects.labels.architecture') }}</h2>
                    </div>
                    <p>{{ $project->architecture() }}</p>
                </section>

                <section class="project-details__section" data-reveal>
                    <div class="project-details__section-header">
                        <x-ui.icon name="gauge" size="18" class="project-details__section-icon" />
                        <h2>{{ __('projects.labels.challenges') }}</h2>
                    </div>
                    <p>{{ $project->challenges() }}</p>
                </section>

                <section class="project-details__section" data-reveal>
                    <div class="project-details__section-header">
                        <x-ui.icon name="check" size="18" class="project-details__section-icon" />
                        <h2>{{ __('projects.labels.solutions') }}</h2>
                    </div>
                    <p>{{ $project->solutions() }}</p>
                </section>

                @unless($project->isConfidential)
                    <section class="project-details__section project-details__section--results" data-reveal>
                        <div class="project-details__section-header">
                            <x-ui.icon name="trending-up" size="18" class="project-details__section-icon" />
                            <h2>{{ __('projects.labels.results') }}</h2>
                        </div>
                        <p>{{ $project->results() }}</p>
                    </section>
                @endunless
            </div>

            <aside class="project-details__aside" data-reveal>
                <div class="project-details__sidebar-card">
                    <div class="project-details__fact">
                        <span class="project-details__fact-label">{{ __('projects.labels.role') }}</span>
                        <p class="project-details__fact-val">{{ $project->role() }}</p>
                    </div>

                    <div class="project-details__fact">
                        <span class="project-details__fact-label">{{ __('projects.labels.responsibilities') }}</span>
                        <ul class="project-details__resp-list">
                            @foreach($project->responsibilities() as $item)
                                <li>
                                    <x-ui.icon name="check" size="14" class="project-details__check-icon" />
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="project-details__cta-box">
                        <p class="project-details__cta-title">Need a similar Flutter architecture?</p>
                        <a href="{{ route('home', ['locale' => $locale]) }}#contact" class="btn btn--primary btn--sm">
                            <span>Get in Touch</span>
                            <x-ui.icon name="arrow-right" size="14" class="icon--directional" />
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </article>
@endsection
