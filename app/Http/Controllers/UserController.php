<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;
use App\User;
use Illuminate\Support\Facades\Mail;

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

        // if($request->has('password')) {
        //     $auth_user->password = app('hash')->make($request->input('password'));
        //     $auth_user->save();
        // }
        if($request->has('email')) {
            $auth_user->email = $request->input('email');
            $auth_user->save();
        }

        $user->save();

        $profile = array();
        $profile['id'] = $user->id;
        $profile['user_id'] = $user->user_id;
        $profile['first_name'] = $user->first_name;
        $profile['last_name'] = $user->last_name;
        $profile['address'] = $user->address;
        $profile['email'] = $auth_user->email;
        $profile['payment_method'] = $user->payment_method;
        $profile['premium'] = $user->premium;
        $profile['role'] = $auth_user->role;
        return response()->json(['msg'=>'success', 'user_profile' => $profile]);
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

    public function getAllUsers() {
        $hash_allusers = array();
        $user = \App\User::find(\Auth::user()->user_id);

        if($user->role != 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $all_users = \App\User::all();
        foreach ($all_users as $user) {
            $approve = \App\CaseDraft::where('createdBy', $user->id)->where('approved', 1)->count();
            $pending = \App\CaseDraft::where('createdBy', $user->id)->whereNull('deleted_at')->where('approved', 0)->count();
            $disapprove = \App\CaseDraft::where('createdBy', $user->id)->whereNotNull('deleted_at')->where('approved',0)->count();

            $temp_user = $user->toArray();
            $temp_user['approve'] = $approve;
            $temp_user['pending'] = $pending;
            $temp_user['disapprove'] = $disapprove;

            $hash_allusers[] = $temp_user;
        }

        return response()->json(['users'=> $hash_allusers]);
    }

    public function addUser(Request $request) {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
        ]);
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $user = new \App\User;
        $user_profile = new \App\UserProfile;

        $random_password = str_random(8);
        $password = app('hash')->make($random_password);


        $user->email = $request->input('email');
        $user->password = $password;
        $user->role = $request->input('role');
        $user->auth_type = $request->input('auth_type');

        if($request->has('user_role_function')) {
            $user->user_role_function = strtolower($request->input('user_role_function'));
        }
        if($request->has('role')) {
            $user->role = $request->input('role');
        }

        if(!$user->save()) {
            return response()->json(['error'=> 'There is some problem with your request.'],401);
        }

        $user_profile->user_id = $user->id;
        $user_profile->first_name = $request->input('first_name');
        $user_profile->last_name = $request->input('last_name');
        $user_profile->address = $request->input('address');

        if($request->has('premium')) {
            $user_profile->premium = $request->input('premium');
        }
        if($request->has('payment_method')) {
            $user_profile->payment_method= $request->input('payment_method');
        }
        if(!$user_profile->save()) {
            return response()->json(['error'=> 'There is some problem with your request.'],401);
        }

        $mail_param = array(
            'email' => $request->input('email'),
            'password' => $random_password,
            'name' => $request->input('first_name').' '.$request->input('last_name'),
            'subj' => 'Welcome To TierApp'
        );
        Mail::send('email.welcome', $mail_param, function($message) use($mail_param) {
            $message->to($mail_param['email']);
            $message->subject($mail_param['subj']);
        });

        return response()->json(['message'=> 'User created successfully.']);
        
    }
}
