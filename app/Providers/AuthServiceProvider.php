<?php

namespace App\Providers;

// use App\User;
use App\AccessToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        Auth::viaRequest('api', function ($request) {
            if ($request->headers->get('Authorization')) {
                $header = $request->headers->get('Authorization');
                $access_token = str_replace('Bearer ','',$header);
                $token = AccessToken::where('api_token', $access_token)->first();
                \Log::info($token->api_token);
                return $token;
            }
        });
    }
}
