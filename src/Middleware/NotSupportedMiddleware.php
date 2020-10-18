<?php

namespace NotSupported\Laravel\Middleware;

use Closure;
use NotSupported\Laravel\NotSupported;

class NotSupportedMiddleware
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
        $notSupported = new NotSupported;

        if (! $notSupported->isSupported()) {
            return redirect()->away($notSupported->url());
        }

        return $next($request);
    }
}
