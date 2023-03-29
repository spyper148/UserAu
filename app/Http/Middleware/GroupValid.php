<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupValid
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $group): Response
    {
        $secret_token = $request->bearerToken();
        if (isset($secret_token))
        {
            $user = User::query()->where('api_token', $secret_token)->first();
            if ($user->group->name == $group)
            {
                return $next($request);

            }

            return response(['error' => ['code' => 403, 'message' => 'not enough rights']], 403);

        }

        return response(['error' => ['code' => 401, 'message' => 'authorization not successful']],401);

    }
}
