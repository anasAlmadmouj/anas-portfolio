@php
    $otherLocale = $locale === 'en' ? 'ar' : 'en';

    if (request()->route()) {
        $routeName = request()->route()->getName();
        $parameters = request()->route()->parameters();
        $parameters['locale'] = $otherLocale;

        try {
            $targetUrl = route($routeName, $parameters);
        } catch (\Throwable $e) {
            $targetUrl = url('/' . $otherLocale);
        }
    } else {
        $targetUrl = url('/' . $otherLocale);
    }

    $label = $otherLocale === 'ar' ? __('navigation.switch_to_arabic') : __('navigation.switch_to_english');
    $displayText = $otherLocale === 'ar' ? 'عربي' : 'EN';
@endphp

<a
    href="{{ $targetUrl }}"
    class="lang-switch"
    aria-label="{{ $label }}"
    hreflang="{{ $otherLocale }}"
>
    <x-ui.icon name="globe" size="14" class="lang-switch__icon" />
    <span class="lang-switch__text">{{ $displayText }}</span>
</a>

