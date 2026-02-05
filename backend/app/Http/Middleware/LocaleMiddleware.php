<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $acceptLanguage = $request->header('Accept-Language', config('locale.default'));
        
        // Parse Accept-Language header to extract primary locale
        $locale = $this->parseAcceptLanguage($acceptLanguage);

        // Validate that locale is supported
        if (!in_array($locale, config('locale.supported', []))) {
            $locale = config('locale.default', 'en');
        }

        // Set the application locale
        app()->setLocale($locale);

        // Store in request for use in controllers
        $request->attributes->set('locale', $locale);

        return $next($request);
    }
    
    /**
     * Parse Accept-Language header to extract primary language code
     */
    private function parseAcceptLanguage($acceptLanguage)
    {
        if (empty($acceptLanguage)) {
            return config('locale.default', 'en');
        }
        
        // Split by comma and get first locale
        $locales = explode(',', $acceptLanguage);
        $primaryLocale = trim(explode(';', $locales[0])[0]);
        
        // Extract language code from locale like "id-ID" -> "id"
        $languageCode = explode('-', $primaryLocale)[0];
        
        return $languageCode;
    }
}
