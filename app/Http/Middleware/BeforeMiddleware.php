<?php

namespace App\Http\Middleware;

use Closure;

class BeforeMiddleware
{
    public $client=array();
    public function handle($request, Closure $next)
    {
        \Log::info(json_encode($request->all()));
        if( !$this->api_client($request)) {
            return response()->json(['message'  => "Unauthorized."],401);
        }
        return $next($request);
    }
    public function api_client($request) {
        $api_client = \App\ApiClient::select(['id','name'])
            ->where('secret',$request->input('client_secret'))
            ->where('name',$request->input('client_name'))
            ->get();
        return $this->client = $api_client->first();
    }
}