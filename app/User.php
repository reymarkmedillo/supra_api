<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

use Carbon\Carbon;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'auth_type', 'email', 'role', 'valid'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function generateToken($request,$mobile=false) {
        \Log::info(date_default_timezone_get());
        $exdate = Carbon::parse(date("Y-m-d H:i:s"))->setTimezone('Asia/Manila');
        foreach(config('define.token_time.access') as $k => $v){
            if($v == 0)continue;
            $exdate->{"add".ucfirst($k)}($v);
        }
        $rt_exdate = Carbon::parse(date("Y-m-d H:i:s"))->setTimezone('Asia/Manila');
        foreach(config('define.token_time.refresh') as $k => $v){
            if($v == 0)continue;
            $rt_exdate->{"add".ucfirst($k)}($v);
        }
        
        return array(
            'api_token'                  => $mobile?$request->input('token'):str_random(75),
            'expired_date'               => $exdate->format('Y-m-d H:i:s'),
            'refresh_token'              => str_random(75),
            'refresh_token_expired_date' => $rt_exdate->format('Y-m-d H:i:s')
        );
    }
}
