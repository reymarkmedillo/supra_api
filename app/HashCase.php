<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashCase extends Model {

    static function updateCaseStatusAndReference($request, $ref_id,$case_id) {
        $case_reference = \App\CaseDraft::where('id', $ref_id)->first();

        if($request->input('status') == 'reinstated') {
            // update reinstated table
            $reinstated = new \App\CaseReinstate;
            $reinstated->setConnection('drafts');
            $reinstated->case_from = $ref_id;
            $reinstated->case_to = $case_id;
            $reinstated->date = date('Y-m-d');
            $reinstated->save();

        } elseif($request->input('status') == 'repealed') {
            // update repealed table
            $repelled = new \App\CaseRepel;
            $repelled->setConnection('drafts');
            $repelled->case_from = $ref_id;
            $repelled->case_to = $case_id;
            $repelled->date = date('Y-m-d');
            $repelled->save();
        }

        $case_reference->status = 'not_controlling';
        $case_reference->save();
    }
}

?>
