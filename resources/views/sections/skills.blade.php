<section id="skills" class="section skills">
    <div class="container">
        <div class="section-header" data-reveal>
            <span class="section-header__tag">05 · {{ __('skills.section.eyebrow') }}</span>
            <h2 class="section-header__title">{{ __('skills.section.heading') }}</h2>
        </div>

        <div class="skills__grid">
            @foreach($skillGroups as $group)
                <div class="skills__card skills__card--{{ $group->key }}" data-reveal data-card-glow>
                    <div class="skills__card-header">
                        <div class="skills__icon-box">
                            @if($group->key === 'mobile')
                                <x-ui.icon name="smartphone" size="20" />
                            @elseif($group->key === 'backend')
                                <x-ui.icon name="plug" size="20" />
                            @elseif($group->key === 'architecture')
                                <x-ui.icon name="layers" size="20" />
                            @else
                                <x-ui.icon name="terminal" size="20" />
                            @endif
                        </div>
                        <h3 class="skills__group-title">{{ $group->label() }}</h3>
                    </div>

                    <ul class="skills__list">
                        @foreach($group->skills as $skill)
                            <li class="skills__pill">
                                <span class="skills__pill-dot"></span>
                                <span>{{ $skill }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
