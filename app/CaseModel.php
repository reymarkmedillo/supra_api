<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model {
  public $incrementing = false;
  protected $table = 'cases';
}