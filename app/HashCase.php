<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashCase extends Model {

    static function updateCaseStatusAndReference($request, $id) {
        $case_reference_draft = new \App\CaseDraft;
        $case_reference_draft->where('id', $id);
        if($request->input('status') == 'reinstated') {
            // update reinstated table
            $case_reference_draft->update(['status'=>'not_controlling']);
        } elseif($request->input('status') == 'repealed') {
            // update repealed table
            $case_reference_draft->update(['status'=>'not_controlling']);
        } else {
            $case_reference_draft->update(['status'=>$request->input('status')]);
        }
    }
}

?>
