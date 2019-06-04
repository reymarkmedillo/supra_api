<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseXgr extends Model {
  protected $table = 'xgr';
  protected $fillable = ['grno','topic','syllabus','case_digest'];
}

?>