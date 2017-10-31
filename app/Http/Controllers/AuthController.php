<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AccessToken;
use App\ApiClient;
use App\UserProfile;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function postLogin(Request $request) {
        $validator = $this->validate($request, [
            'type' => 'required',
            'email' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if(!$user) {
            return response()->json(['msg'=> array('Record not found.')],422);
        } else {
            if($user->auth_type != $request->input('type')) {
                return response()->json(['msg'=> array('Invalid login.')],422);
            }
        }

        if(!in_array($request->input('type'), config('define.auth_types') )) {
            return response()->json(['msg'=>array('There is a problem with your request.')],422);
        } else {
            if($request->input('type') == 'normal') { // NORMAL LOGIN
                $this->validate($request, [
                    'password' => 'required'
                ]);

                $check_password = app('hash')->check($request->input('password'), $user->password);
                if(!$check_password) {
                    return response()->json(['msg'=> array('Wrong Password.')],422);
                }

                $tokens = $this->saveTokens($user, $request);
                // clear expired tokens
                AccessToken::where('expires_at','<', \Carbon\Carbon::now())->delete();
                return response()->json($tokens);

            } else { // THIRD-PARTY LOGIN 
                $this->validate($request, [
                    'token' => 'required'
                ]);

                $tokens = $this->saveTokens($user, $request);
                return response()->json($tokens);

            }
        }
    }

    public function postRegister(Request $request) {
        $this->validate($request, [
            'type' => 'required',
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required'
        ]);
        if(!in_array($request->input('type'), config('define.auth_types') )) {
            return response()->json(['msg'=>'error']);
        } else {
            if($request->input('type') == 'normal') { // NORMAL LOGIN
                $this->validate($request, [
                    'password' => 'required'
                ]);
            }

            $user = new User;
            $user_profile = new UserProfile;

            $user->auth_type = $request->input('type');
            $user->email = $request->input('email');
            if($request->has('password')) {
                $user->password = app('hash')->make($request->input('password'));
            }
            // <-- add saving of role here
            $user->save();

            if(isset($user->id)) {
                $user_profile->user_id = $user->id;
                $user_profile->first_name = $request->input('first_name');
                $user_profile->last_name = $request->input('last_name');
                $user_profile->address = $request->input('address');
                if($request->has('premium')) {
                    $user_profile->premium = $request->input('premium');
                }
                if($request->has('payment_method')) {
                    $user_profile->payment_method = $request->input('payment_method');
                }
                $user_profile->save();
            }

            return response()->json(['msg'=>'success']);
        }
    }

    private function saveTokens($user, $request) {
        $res = array();
        $tokens     = $this->user->generateToken();
        $client    = ApiClient::where('name', $request->input('client_name'))->where('secret', $request->input('client_secret'))->firstOrFail();
        $profile = UserProfile::where('user_id', $user->id)->leftJoin('users as a', 'a.id', '=', 'user_profile.user_id')->first([
            'user_profile.id',
            'user_profile.user_id',
            'user_profile.first_name',
            'user_profile.last_name',
            'user_profile.address',
            'a.email',
            'a.role',
            'user_profile.payment_method',
            'user_profile.premium'
        ]);

        AccessToken::create([
            'user_id' => $user->id,
            'api_client_id' => $client->id,
            'api_token' => ($request->has('token') && $request->input('type')!='normal'?$request->input('token'):$tokens['api_token']),
            'expires_at' => $tokens['expired_date'],
            'refresh_token' => $tokens['refresh_token'],
            'refresh_expires_at' => $tokens['refresh_token_expired_date']
        ]);

        $res['result'] = 'success';
        $res['access_token'] = ($request->has('token') && $request->input('type')!='normal'?$request->input('token'):$tokens['api_token']);
        $res['expired_date'] = $tokens['expired_date'];
        $res['refresh_token'] = $tokens['refresh_token'];
        $res['refresh_token_expired_date'] = $tokens['refresh_token_expired_date'];
        $res['user_profile']['id'] = $profile->id;
        $res['user_profile']['user_id'] = $profile->user_id;
        $res['user_profile']['first_name'] = $profile->first_name;
        $res['user_profile']['last_name'] = $profile->last_name;
        $res['user_profile']['address'] = $profile->address;
        $res['user_profile']['email'] = $profile->email;
        $res['user_profile']['payment_method'] = $profile->payment_method;
        $res['user_profile']['premium'] = $profile->premium;
        $res['user_profile']['role'] = $profile->role;
        return $res;
    }

    public function postForgotPassword(Request $request) {
        $user = User::where('email', $request->input('email'))->first();
        if(!$user) {
            return response()->json(['errors' => [
                'not_found' => 'Record not found.'
            ]], 404);
        }
        $token = str_random(32);
        \DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at'=> \Carbon\Carbon::now()
        ]);
        $mail_param = array(
            'email' => $user->email,
            'token' => $token,
            'subj' => 'test subject'
        );
        Mail::send('email.forgot', $mail_param, function($message) use($mail_param) {
            $message->to($mail_param['email']);
            $message->subject($mail_param['subj']);
        });
        return response()->json(['message' => 'An email has been sent to your account.']);
    }

}
