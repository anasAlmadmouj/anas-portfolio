<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * @var array<int, string>
     */
    public const SUPPORTED_LOCALES = ['en', 'ar'];

    public const RTL_LOCALES = ['ar'];

    public function handle(Request $request, Closure $next): Response
    {
        // The route's `where(['locale' => 'en|ar'])` constraint already
        // guarantees this, so no further validation is needed here.
        $locale = $request->route('locale');

        app()->setLocale($locale);

        view()->share('locale', $locale);
        view()->share('textDirection', in_array($locale, self::RTL_LOCALES, true) ? 'rtl' : 'ltr');

        return $next($request);
    }
}
