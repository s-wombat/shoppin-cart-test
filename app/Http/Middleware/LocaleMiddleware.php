<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);
        if (!empty($locale) && in_array($locale, ['en', 'ru', 'ua'])) {
            App::setLocale($locale);
        } else {
            $locale = config('app.locale');
            return redirect('/' . $locale . '/' . $request->path());
        }

        return $next($request);;
    }
}
