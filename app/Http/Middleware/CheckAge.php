<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('age') && $request->age >= 18) {
            # code...
            return $next($request);
        } else {
            abort(401, "Your Age Must Getter than 18");
        }
        // Log::info('this message before Request');
        // return $next($request);

    }
    public function terminate(Request $request, Response $response): void
    {
        Log::info('this message after Request');
    }
}
