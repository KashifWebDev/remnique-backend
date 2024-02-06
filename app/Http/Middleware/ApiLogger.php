<?php

namespace App\Http\Middleware;

use App\Models\ApiLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ApiLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request,Response $response): void{
        if(!Str::contains($request->fullUrl(),"/storage/"))
            ApiLog::create(array(
                'request' => $request->fullUrl(),
                'method' => $request->method(),
                'request_params' => json_encode($request->all()),
                'response' => $response->getContent(),
                'response_status' => $response->getStatusCode(),
                'user_id' => auth()->user()->id ?? null,
                'route' => $request->getUri(),
                'ip' => $request->ip(),
            ));
    }
}
