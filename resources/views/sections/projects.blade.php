<section id="projects" class="section projects">
    <div class="container">
        <div class="projects__header" data-reveal>
            <div class="section-header">
                <span class="section-header__tag">03 · {{ __('projects.section.eyebrow') }}</span>
                <h2 class="section-header__title">{{ __('projects.section.heading') }}</h2>
            </div>
            <a href="{{ route('projects.index', ['locale' => $locale]) }}" class="projects__view-all btn btn--secondary">
                <span>{{ __('projects.section.view_all') }}</span>
                <x-ui.icon name="arrow-right" size="16" class="icon--directional" />
            </a>
        </div>

        @if($featuredProjects->isEmpty())
            <div class="projects__empty-state" data-reveal>
                <x-ui.icon name="layers" size="32" />
                <p class="projects__empty">{{ __('projects.section.empty') }}</p>
            </div>
        @else
            <div class="projects__showcase-list">
                @foreach($featuredProjects as $index => $project)
                    <x-project.featured-case-study 
                        :project="$project" 
                        :index="$index" 
                        :reversed="$index % 2 === 1" 
                    />
                @endforeach
            </div>
        @endif
    </div>
</section>
