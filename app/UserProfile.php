<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {

  protected $table = 'user_profile';
  protected $fillable = ['user_id','first_name','last_name', 'address', 'premium', 'payment_method'];
}

?>
