<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseGroupDraft extends Model {
    protected $connection = 'drafts';
    protected $table = 'case_group';
}