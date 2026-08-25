@extends('layouts.app')

@section('title', __('errors.404.title').' — '.__('general.site_name'))

@section('content')
    <section class="section error-page">
        <div class="container error-page__inner">
            <p class="eyebrow">{{ __('errors.404.eyebrow') }}</p>
            <h1>{{ __('errors.404.heading') }}</h1>
            <p class="error-page__description">{{ __('errors.404.description') }}</p>

            <div class="hero__actions">
                <a href="{{ route('home', ['locale' => $locale]) }}" class="btn btn--primary">
                    {{ __('errors.back_home') }}
                </a>
                <a href="{{ route('projects.index', ['locale' => $locale]) }}" class="btn btn--ghost">
                    {{ __('errors.view_projects') }}
                </a>
            </div>
        </div>
    </section>
@endsection
