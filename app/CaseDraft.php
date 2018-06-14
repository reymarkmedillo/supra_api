<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseDraft extends Model {
    protected $connection = 'drafts';
    protected $table = 'cases';
}

?>
