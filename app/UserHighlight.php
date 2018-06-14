<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHighlight extends Model {

  protected $table = 'user_highlights';
  protected $fillable = ['user_id','case_id','text'];
}

?>
