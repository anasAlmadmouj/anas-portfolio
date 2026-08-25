@props([
    'project',
    'class' => '',
])

@php
    $screenshots = $project->screenshots;
    $primary = $project->primaryScreenshot();
    $secondary = $project->secondaryScreenshot();
    $tertiary = $project->tertiaryScreenshot();
@endphp

<div class="media-showcase {{ $class }}" data-media-showcase>
    @if(!empty($screenshots))
        <div class="media-showcase__stage">
            {{-- Background ambient reflection --}}
            <div class="media-showcase__glow" aria-hidden="true"></div>

            {{-- Layered Stack of Real Screenshots in Devices --}}
            <div class="media-showcase__devices">
                @if($tertiary)
                    <div class="media-showcase__device media-showcase__device--tertiary" aria-hidden="true">
                        <x-project.device-frame :image="$tertiary" :alt="$project->name() . ' Screen 3'" />
                    </div>
                @endif

                @if($secondary)
                    <div class="media-showcase__device media-showcase__device--secondary" aria-hidden="true">
                        <x-project.device-frame :image="$secondary" :alt="$project->name() . ' Screen 2'" />
                    </div>
                @endif

                <div class="media-showcase__device media-showcase__device--primary" data-showcase-primary>
                    <x-project.device-frame :image="$primary" :alt="$project->name() . ' Main Screen'" :priority="true" />
                </div>
            </div>
        </div>

        {{-- Interactive Screen Gallery Navigation Strip --}}
        @if(count($screenshots) > 1)
            <div class="media-showcase__gallery-strip" aria-label="Screenshots">
                @foreach($screenshots as $i => $shot)
                    <button 
                        type="button" 
                        class="media-showcase__thumb-btn {{ $i === 0 ? 'is-active' : '' }}" 
                        data-shot-src="{{ asset($shot) }}"
                        aria-label="View screenshot {{ $i + 1 }}"
                    >
                        <img src="{{ asset($shot) }}" alt="" class="media-showcase__thumb-img" loading="lazy" />
                        <span class="media-showcase__thumb-index">0{{ $i + 1 }}</span>
                    </button>
                @endforeach
            </div>
        @endif
    @else
        {{-- Elegant architectural fallback when no screenshots available --}}
        <div class="media-showcase__fallback">
            <div class="media-showcase__fallback-badge">
                <x-ui.icon name="lock" size="16" />
                <span>{{ __('projects.labels.private') }}</span>
            </div>
            <p class="media-showcase__fallback-text">Confidential Architecture Implementation</p>
        </div>
    @endif
</div>
