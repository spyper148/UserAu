<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $secret_token = $request->bearerToken();
        $user = User::query()->where('api_token','=',$secret_token);
        if(isset($user))
        {
            return $next($request);
        }
        return response((['code'=>401,'message'=>'authorization not successful']));

    }
}
