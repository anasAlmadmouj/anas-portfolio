@extends('layouts.app')

@section('title', __('errors.500.title').' — '.__('general.site_name'))

@section('content')
    <section class="section error-page">
        <div class="container error-page__inner">
            <p class="eyebrow">{{ __('errors.500.eyebrow') }}</p>
            <h1>{{ __('errors.500.heading') }}</h1>
            <p class="error-page__description">{{ __('errors.500.description') }}</p>

            <div class="hero__actions">
                <a href="{{ route('home', ['locale' => $locale]) }}" class="btn btn--primary">
                    {{ __('errors.back_home') }}
                </a>
            </div>
        </div>
    </section>
@endsection
