<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AccessToken;
use App\ApiClient;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'type' => 'required',
            'email' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if(!$user) {
            return response()->json(['msg'=> 'email not found']);
        }

        if(!in_array($request->input('type'), config('define.auth_types') )) {
            return response()->json(['msg'=>'error']);
        } else {
            if($request->input('type') == 'normal') { // NORMAL LOGIN
                $this->validate($request, [
                    'password' => 'required'
                ]);

                $check_password = app('hash')->check($request->input('password'), $user->password);
                if(!$check_password) {
                    return response()->json(['msg'=> 'incorrect password']);
                }
                // check if user has already running unexpired token
                $tokens = $this->saveTokens($user->id, $request);
                return response()->json($tokens);

            } else { // THIRD-PARTY LOGIN 
                $this->validate($request, [
                    'token' => 'required'
                ]);
                // check if user has already running unexpired token
                $tokens = $this->saveTokens($user->id, $request);
                return response()->json($tokens);

            }
        }
    }

    private function saveTokens($user_id, $request) {
        $user = array();
        $tokens     = $this->user->generateToken();
        $client    = ApiClient::where('name', $request->input('client_name'))->where('secret', $request->input('client_secret'))->firstOrFail();


        AccessToken::create([
            'user_id' => $user_id,
            'api_client_id' => $client->id,
            'api_token' => ($request->has('token') && $request->input('type')!='normal'?$request->input('token'):$tokens['api_token']),
            'expires_at' => $tokens['expired_date'],
            'refresh_token' => $tokens['refresh_token'],
            'refresh_expires_at' => $tokens['refresh_token_expired_date']
        ]);

        $user['api_token'] = ($request->has('token') && $request->input('type')!='normal'?$request->input('token'):$tokens['api_token']);
        $user['expired_date'] = $tokens['expired_date'];
        $user['refresh_token'] = $tokens['refresh_token'];
        $user['refresh_token_expired_date'] = $tokens['refresh_token_expired_date'];
        return $user;
    }

}
