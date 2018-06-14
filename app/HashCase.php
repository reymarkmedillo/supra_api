<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashCase extends Model {

    static function updateCaseStatusAndReference($request, $ref_id,$case_id,$connection='drafts') {
        $case_reference = \App\CaseModel::where('id', $ref_id)->first();
        $main_case = \App\CaseModel::find($case_id);

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

        if($case_reference && $main_case) {
            if($request->has('case_parent') && $request->has('case_child')) {
                $case_reference->status = 'not_controlling';
                $main_case->status = 'controlling';
            } else if($request->has('case_parent') && !$request->has('case_child')) {
                $case_reference->status = 'not_controlling';
                $main_case->status = 'controlling';
            } else if(!$request->has('case_parent') && $request->has('case_child')) {
                $case_reference->status = 'not_controlling';
                $main_case->status = 'controlling';
            }
            // $case_reference->status = $status;
            $case_reference->save();
            $main_case->save();
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
                } else {
                    array_push($new_topics_container, $ex_topic);
                }
            }
        }
        $new_topics_container_joined = implode(",", $new_topics_container);
        return $new_topics_container_joined;
    }

    static function makeDropdown($values = array(), $text = "Please choose") {
        $hash_values = array();
        $temp = (object)array();
        $temp->id = null;
        $temp->text = $text;
        array_push($hash_values, $temp);

        foreach($values as $val) {
            $temp = (object)array();
            $temp->id = $val->id;
            $temp->text = $val->text;
            array_push($hash_values, $temp);
        }

        return $hash_values;
    }

    static function validateDate($request) {
        if($request->has('date')) {
            if($request->has('case_parent')) {
                $case_parent = \App\CaseModel::find($request->input('case_parent'));
                if( $case_parent && (\Carbon\Carbon::parse($request->input('date')) <  \Carbon\Carbon::parse($case_parent->date)) ) {
                    return 'Date field must not be less than referenced Parent field.';
                } else {
                    return null;
                }
            }

            if($request->has('case_child')) {
                $case_child = \App\CaseModel::find($request->input('case_child'));
                if( $case_child && (\Carbon\Carbon::parse($request->input('date')) <  \Carbon\Carbon::parse($case_child->date)) ) {
                    return 'Date field must not be less than referenced Child field.';
                } else {
                    return null;
                }
            }
        }
    }
}

?>
