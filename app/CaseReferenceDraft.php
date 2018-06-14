<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseReferenceDraft extends Model {
  protected $connection = 'drafts';
  protected $table = 'case_references';
}