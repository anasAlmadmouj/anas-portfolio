@extends('layouts.app')

@section('title', __('projects.archive.title').' — '.__('general.site_name'))

@section('content')
    <section class="section projects-archive">
        <div class="container">
            <div class="projects-archive__header" data-reveal>
                <a href="{{ route('home', ['locale' => $locale]) }}" class="projects-archive__back btn btn--ghost btn--sm">
                    <x-ui.icon name="arrow-left" size="14" class="icon--directional" />
                    <span>{{ __('navigation.home') }}</span>
                </a>

                <div class="section-header">
                    <span class="section-header__tag">{{ __('projects.archive.eyebrow') }}</span>
                    <h1 class="section-header__title">{{ __('projects.archive.heading') }}</h1>
                    <p class="section-header__desc">Curated Flutter mobile applications, architecture frameworks, and enterprise software case studies.</p>
                </div>
            </div>

            @if($projects->isEmpty())
                <div class="projects__empty-state" data-reveal>
                    <x-ui.icon name="layers" size="32" />
                    <p class="projects__empty">{{ __('projects.section.empty') }}</p>
                </div>
            @else
                <div class="projects__grid projects__grid--archive">
                    @foreach($projects as $index => $project)
                        <x-project.project-card :project="$project" :index="$index" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
