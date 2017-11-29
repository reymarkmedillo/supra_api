<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashCase extends Model {

    static function updateCaseStatusAndReference($request, $ref_id,$case_id,$connection='drafts') {
        $case_reference = \App\CaseDraft::where('id', $ref_id)->first();

        if(trim($request->input('status')) == 'reinstated') {
            // update reinstated table
            $reinstated = new \App\CaseReinstate;
            if($connection == 'drafts') {
                $reinstated->setConnection($connection);
            }
            
            $search = $reinstated->where('case_to', $case_id)->where('case_from', $ref_id)->first();

            if($search) {
                $search->case_from = $ref_id;
                $search->case_to = $case_id;
                $search->date = date('Y-m-d');
                $search->save();
            } else {
                $reinstated->case_from = $ref_id;
                $reinstated->case_to = $case_id;
                $reinstated->date = date('Y-m-d');
                $reinstated->save();
            }

        } elseif(trim($request->input('status')) == 'repealed') {
            // update repealed table
            $repelled = new \App\CaseRepel;
            if($connection == 'drafts') {
                $repelled->setConnection($connection);
            }

            $search = $repelled->where('case_to', $case_id)->where('case_from', $ref_id)->first();

            if($search) {
                $search->case_from = $ref_id;
                $search->case_to = $case_id;
                $search->date = date('Y-m-d');
                $search->save();
            } else {
                $repelled->case_from = $ref_id;
                $repelled->case_to = $case_id;
                $repelled->date = date('Y-m-d');
                $repelled->save();
            }
        }

        $case_reference->status = 'not_controlling';
        $case_reference->save();
    }
}

?>
