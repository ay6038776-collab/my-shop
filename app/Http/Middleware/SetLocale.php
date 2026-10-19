<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // اولوية: Session → URL → Browser → Default
        $locale = Session::get('locale');

        if (!$locale) {
            $locale = $request->segment(1);

            if (!in_array($locale, ['ar', 'en'])) {
                $locale = $request->getPreferredLanguage(['en', 'ar']) ?? 'en';
            }
        }

        // RTL for Arabic
        if ($locale === 'ar') {
            App::setLocale('ar');
            Session::put('locale', 'ar');
        } else {
            App::setLocale('en');
            Session::put('locale', 'en');
        }

        return $next($request);
    }
}
