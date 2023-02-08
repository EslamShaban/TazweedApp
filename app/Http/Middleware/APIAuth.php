<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class APIAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        return $request->header('app-api-key') == env('APP_API_KEY','gOqrQaQ468DMzRU0x!%^&*wqrzIJIu5MhzfYWSMqXu0@~5PnPK0NpskrQJjsD5P') ? $next( $request ) : response()->withError(__('api.unauthorize'), 5000);
    }
}
