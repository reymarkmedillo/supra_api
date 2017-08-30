<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Route;
use App\User;
use App\Http\Middleware\BeforeMiddleware;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            return response('Unauthorized.', 401);
        } else {
            if ($this->auth->check()) {
                $access_token = $this->auth->guard($guard)->user();
                if($request->route()[1]['uses'] != 'auth.refresh' && strtotime($access_token->expires_at) < time()) {
                    return response()->json(['message' => 'Unauthorized'], 401);
                }

                $before_midware = new BeforeMiddleware();
                if ($before_midware->api_client($request)->id != $access_token->api_client_id) {
                    return response()->json(['message' => 'Unauthorized1.'], 401);
                }

                $user = User::find($access_token->user_id);
                if ($guard == 'admin' && $user->role != 'admin') {
                    return response()->json(['message' => 'Unauthorized3.'], 401);
                }
                return $next($request);
            }
        }

        return response()->json(['message'  => "Unauthorized."],401);
    }
}
