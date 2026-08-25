<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleRedirectController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $preferred = $request->getPreferredLanguage(SetLocale::SUPPORTED_LOCALES);

        return redirect('/'.($preferred ?: config('app.locale')));
    }
}
