<?php

namespace App\Providers;

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Sane defaults so views render correctly even outside the
        // {locale} route group (e.g. a 404 for a completely unmatched
        // URL). SetLocale::handle() overrides these with the definitive
        // per-request values for every route inside that group.
        $defaultLocale = app()->getLocale();

        View::share('locale', $defaultLocale);
        View::share('textDirection', in_array($defaultLocale, SetLocale::RTL_LOCALES, true) ? 'rtl' : 'ltr');

        View::composer('layouts.app', function ($view) {
            $view->with('hasOgImage', File::exists(public_path(config('portfolio.og_image_path'))));
            $view->with('personJsonLd', $this->buildPersonJsonLd());
        });
    }

    /**
     * Pre-encoded so the Blade template only echoes a variable — a raw
     * `@context`/`@type` key written directly in a .blade.php file gets
     * misparsed by Blade's directive compiler.
     */
    private function buildPersonJsonLd(): string
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => __('general.site_name'),
            'jobTitle' => __('general.site_role'),
            'url' => route('home', ['locale' => app()->getLocale()]),
            'email' => 'mailto:'.config('portfolio.contact.email'),
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'JO',
            ],
            'sameAs' => array_values(array_filter([
                config('portfolio.contact.social.github'),
                config('portfolio.contact.social.linkedin'),
            ])),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
