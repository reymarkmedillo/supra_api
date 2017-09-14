<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    public function updateProfile(Request $request, $user_id) {
        $user = UserProfile::where('user_id', $user_id)->first();
        $auth_user = User::find($user_id);

        if(!$user || !$auth_user) {
            return response()->json(['msg' => 'error']);
        }

        if($request->has('first_name')) {
            $user->first_name = $request->input('first_name');
        }
        if($request->has('last_name')) {
            $user->last_name = $request->input('last_name');
        }
        if($request->has('premium')) {
            $user->premium = $request->input('premium');
        }
        if($request->has('payment_method')) {
            $user->payment_method = $request->input('payment_method');
        }
        if($request->has('address')) {
            $user->address = $request->input('address');
        }

        if($request->has('password')) {
            $auth_user->password = app('hash')->make($request->input('password'));
            $auth_user->save();
        }

        $user->save();
        return response()->json(['msg'=>'success']);
    }

    public function viewProfile($user_id) {
        $res = array();
        $user = UserProfile::where('user_id', $user_id)->leftJoin('users as a', 'a.id', '=', 'user_profile.user_id')->first([
            'user_profile.id',
            'user_profile.user_id',
            'user_profile.first_name',
            'user_profile.last_name',
            'user_profile.address',
            'a.email',
            'user_profile.payment_method',
            'user_profile.premium'
        ]);

        if(count($user) == 0) {
            return response()->json(['msg'=>'error']);
        }

        return response()->json($user);
    }
}
