@props(['name', 'size' => 24])

<svg
    xmlns="http://www.w3.org/2000/svg"
    width="{{ $size }}"
    height="{{ $size }}"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="1.75"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
    focusable="false"
    {{ $attributes->merge(['class' => 'icon']) }}
>
    @switch($name)
        @case('arrow-right')
            <path d="M5 12h14" /><path d="M13 6l6 6-6 6" />
            @break
        @case('arrow-left')
            <path d="M19 12H5" /><path d="M11 18l-6-6 6-6" />
            @break
        @case('arrow-up-right')
            <path d="M7 17L17 7" /><path d="M7 7h10v10" />
            @break
        @case('menu')
            <path d="M4 7h16" /><path d="M4 12h16" /><path d="M4 17h16" />
            @break
        @case('close')
            <path d="M6 6l12 12" /><path d="M18 6L6 18" />
            @break
        @case('sun')
            <circle cx="12" cy="12" r="4" /><path d="M12 2v3" /><path d="M12 19v3" /><path d="M4.2 4.2l2.1 2.1" /><path d="M17.7 17.7l2.1 2.1" /><path d="M2 12h3" /><path d="M19 12h3" /><path d="M4.2 19.8l2.1-2.1" /><path d="M17.7 6.3l2.1-2.1" />
            @break
        @case('moon')
            <path d="M20 14.5A8 8 0 1 1 9.5 4 6.5 6.5 0 0 0 20 14.5z" />
            @break
        @case('globe')
            <circle cx="12" cy="12" r="9" /><path d="M3 12h18" /><path d="M12 3c2.5 2.5 3.8 5.7 3.8 9s-1.3 6.5-3.8 9c-2.5-2.5-3.8-5.7-3.8-9s1.3-6.5 3.8-9z" />
            @break
        @case('chevron-down')
            <path d="M6 9l6 6 6-6" />
            @break
        @case('map-pin')
            <path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12z" /><circle cx="12" cy="10" r="2.3" />
            @break
        @case('lock')
            <rect x="5" y="11" width="14" height="9" rx="1.5" /><path d="M8 11V7a4 4 0 0 1 8 0v4" />
            @break
        @case('download')
            <path d="M12 3v12" /><path d="M7 10l5 5 5-5" /><path d="M5 21h14" />
            @break
        @case('github')
            <path d="M12 2a10 10 0 0 0-3.16 19.49c.5.09.68-.22.68-.48v-1.7c-2.78.6-3.37-1.34-3.37-1.34-.46-1.16-1.11-1.47-1.11-1.47-.9-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.9 1.53 2.34 1.09 2.91.83.09-.65.35-1.09.63-1.34-2.22-.25-4.56-1.11-4.56-4.95 0-1.1.39-1.99 1.03-2.69-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02a9.53 9.53 0 0 1 5 0c1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.69 0 3.85-2.35 4.7-4.58 4.95.36.31.68.92.68 1.85v2.74c0 .26.18.58.69.48A10 10 0 0 0 12 2z" />
            @break
        @case('linkedin')
            <rect x="3" y="3" width="18" height="18" rx="2" /><path d="M7 10v7" /><circle cx="7" cy="7" r="1" /><path d="M11 17v-4a2 2 0 0 1 4 0v4" /><path d="M11 10v7" />
            @break
        @case('mail')
            <rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" />
            @break
        @case('smartphone')
            <rect x="7" y="2" width="10" height="20" rx="2" /><path d="M11 18h2" />
            @break
        @case('layers')
            <path d="M12 3l9 5-9 5-9-5 9-5z" /><path d="M3 13l9 5 9-5" />
            @break
        @case('plug')
            <path d="M9 2v6" /><path d="M15 2v6" /><path d="M6 8h12v4a6 6 0 0 1-12 0V8z" /><path d="M12 18v4" />
            @break
        @case('blueprint')
            <rect x="4" y="4" width="16" height="16" rx="1" /><path d="M4 9h16" /><path d="M9 4v16" />
            @break
        @case('refresh')
            <path d="M4 4v5h5" /><path d="M20 20v-5h-5" /><path d="M5.5 9A7 7 0 0 1 19 8" /><path d="M18.5 15A7 7 0 0 1 5 16" />
            @break
        @case('gauge')
            <path d="M12 12l4-3" /><circle cx="12" cy="12" r="9" /><path d="M7 15a6 6 0 0 1 10 0" />
            @break
        @case('check')
            <path d="M20 6L9 17l-5-5" />
            @break
        @case('copy')
            <rect x="9" y="9" width="13" height="13" rx="2" /><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
            @break
        @case('external-link')
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" /><polyline points="15 3 21 3 21 9" /><line x1="10" y1="14" x2="21" y2="3" />
            @break
        @case('sparkles')
            <path d="M12 3l1.9 4.9L19 10l-5.1 2.1L12 17l-1.9-4.9L5 10l5.1-2.1L12 3z" /><path d="M19 17l.9 2.1L22 20l-2.1.9L19 23l-.9-2.1L16 20l2.1-.9L19 17z" />
            @break
        @case('shield')
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            @break
        @case('cpu')
            <rect x="4" y="4" width="16" height="16" rx="2" /><rect x="9" y="9" width="6" height="6" /><line x1="9" y1="1" x2="9" y2="4" /><line x1="15" y1="1" x2="15" y2="4" /><line x1="9" y1="20" x2="9" y2="23" /><line x1="15" y1="20" x2="15" y2="23" /><line x1="20" y1="9" x2="23" y2="9" /><line x1="20" y1="14" x2="23" y2="14" /><line x1="1" y1="9" x2="4" y2="9" /><line x1="1" y1="14" x2="4" y2="14" />
            @break
        @case('git-branch')
            <line x1="6" y1="3" x2="6" y2="15" /><circle cx="18" cy="6" r="3" /><circle cx="6" cy="18" r="3" /><path d="M18 9a9 9 0 0 1-9 9" />
            @break
        @case('terminal')
            <polyline points="4 17 10 11 4 5" /><line x1="12" y1="19" x2="20" y2="19" />
            @break
        @case('trending-up')
            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" /><polyline points="17 6 23 6 23 12" />
            @break
        @case('activity')
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
            @break
        @case('credit-card')
            <rect x="2" y="5" width="20" height="14" rx="2" /><path d="M2 10h20" />
            @break
        @case('radio')
            <circle cx="12" cy="12" r="2" /><path d="M16.24 7.76a6 6 0 0 1 0 8.48" /><path d="M7.76 16.24a6 6 0 0 1 0-8.48" /><path d="M19.07 4.93a10 10 0 0 1 0 14.14" /><path d="M4.93 19.07a10 10 0 0 1 0-14.14" />
            @break
        @case('rocket')
            <path d="M12 2c3 2 5 6 5 10 0 2-1 4-2 5l-1-3-4 0-1 3c-1-1-2-3-2-5 0-4 2-8 5-10z" /><circle cx="12" cy="9" r="1.5" /><path d="M8 16l-2 5 4-2" /><path d="M16 16l2 5-4-2" />
            @break
    @endswitch
</svg>
