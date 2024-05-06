<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Locale
{
    public function handle($request, Closure $next)
    {
        if ($request->method() === 'GET') {
            $segment = $request->segment(1);

            if (!in_array($segment, config('app.locales'))) {
                $segments = $request->segments();
                $fallback = session('locale') ?: config('app.fallback_locale');

                // Pluralize each segment of the URL individually
                foreach ($segments as &$segment) {
                    $segment = Str::plural($segment, $fallback);
                }

                // Redirect to the updated URL
                return redirect()->to(implode('/', $segments));
            }

            // Set the locale and update the session
            Session::put('locale', $segment);
            App::setLocale($segment);
        }

        return $next($request);
    }
}