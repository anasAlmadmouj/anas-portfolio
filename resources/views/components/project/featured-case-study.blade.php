@props([
    'project',
    'index' => 0,
    'reversed' => false,
])

<article class="featured-case-study {{ $reversed ? 'featured-case-study--reversed' : '' }}" data-reveal data-card-glow>
    <div class="featured-case-study__grid">
        {{-- Information & Editorial Column --}}
        <div class="featured-case-study__info">
            <div class="featured-case-study__meta-row">
                <span class="featured-case-study__index">
                    {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                </span>
                <span class="featured-case-study__category">{{ $project->categoryLabel() }}</span>
                <span class="featured-case-study__dot">·</span>
                <span class="featured-case-study__year">{{ $project->year }}</span>
                <span class="featured-case-study__dot">·</span>
                <span class="featured-case-study__status">{{ $project->statusLabel() }}</span>
            </div>

            <h3 class="featured-case-study__title">
                <a href="{{ route('projects.show', ['locale' => $locale, 'slug' => $project->slug]) }}" class="featured-case-study__title-link">
                    {{ $project->name() }}
                    <x-ui.icon name="arrow-up-right" size="20" class="icon--directional featured-case-study__title-icon" />
                </a>
            </h3>

            <p class="featured-case-study__description">
                {{ $project->shortDescription() }}
            </p>

            <div class="featured-case-study__role-badge">
                <span class="featured-case-study__role-label">{{ __('projects.labels.role') }}:</span>
                <span class="featured-case-study__role-val">{{ $project->role() }}</span>
            </div>

            <div class="featured-case-study__highlights">
                <ul class="featured-case-study__resp-list">
                    @foreach(array_slice($project->responsibilities(), 0, 3) as $resp)
                        <li>
                            <x-ui.icon name="check" size="14" class="featured-case-study__check-icon" />
                            <span>{{ $resp }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="featured-case-study__tech-wrap">
                <ul class="featured-case-study__tech-list">
                    @foreach($project->technologies as $tech)
                        <li>{{ $tech }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="featured-case-study__action">
                <a href="{{ route('projects.show', ['locale' => $locale, 'slug' => $project->slug]) }}" class="btn btn--primary">
                    <span>{{ __('projects.labels.overview') }} · Case Study</span>
                    <x-ui.icon name="arrow-right" size="16" class="icon--directional" />
                </a>
            </div>
        </div>

        {{-- Immersive Real Media Showcase Column --}}
        <div class="featured-case-study__media">
            <x-project.media-showcase :project="$project" />
        </div>
    </div>
</article>
