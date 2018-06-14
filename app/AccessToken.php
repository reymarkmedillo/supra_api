<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model {
  protected $table = 'access_tokens';
  protected $fillable = ['user_id','api_client_id','api_token','expires_at','refresh_token','refresh_expires_at'];
}

?>