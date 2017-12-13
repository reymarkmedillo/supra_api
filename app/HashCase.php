<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashCase extends Model {

    static function updateCaseStatusAndReference($request, $ref_id,$case_id,$connection='drafts', $status='not_controlling') {
        $case_reference = \App\CaseModel::where('id', $ref_id)->first();

        if(trim($request->input('status')) == 'reinstated') {
            // update reinstated table
            $reinstated = new \App\CaseReinstate;
            
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

        if($case_reference) {
            $case_reference->status = $status;
            $case_reference->save();
        }
    }

    static function getTopicNames($topics = '') {
        $ex_topics = explode(',', $topics);
        $new_topics_container = array();
        $new_topics_container_joined = '';
        if($ex_topics) {
            foreach($ex_topics as $ex_topic) {
                $topic = \App\Category::find($ex_topic);
                if($topic) {
                    array_push($new_topics_container, $topic->name);
                }
            }
        }
        $new_topics_container_joined = implode(",", $new_topics_container);
        return $new_topics_container_joined;
    }
}

?>
