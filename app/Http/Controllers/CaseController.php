<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaseModel;
use App\CaseGroup;
use App\UserHighlight;
use App\CaseReference;

class CaseController extends Controller
{
    public function __construct()
    {
        //
    }

    public function searchCase(Request $request) {
        $result = array();
        $res_gr = array();
        $res_title = array();
        $res_topic = array();
        $res_syllabus = array();
        $res_case_refs = array();
        $this->validate($request, [
            'search' => 'required'
        ]);
        if ($request->has('search')) {
            // *GR
            $search_GR = CaseModel::where('grno','like', '%'. $request->input('search') .'%')->get(['id','grno','title','topic','scra','syllabus','body','full_txt','status','short_title','date']);
            if(count($search_GR)) {
                $res_gr = $this->makeCaseArray($search_GR);
            }
            // FILTER ONLY GR
            if($request->has('filter') && strtolower($request->input('filter')) == strtolower('grno')) {
                $result['grno'] = $res_gr;
                return $result;
            }

            // *TITLE
            $search_title = CaseModel::where('title', 'like', '%'. $request->input('search') .'%')->get(['id','grno','title','topic','scra','syllabus','body','full_txt','status','short_title','date']);
            if(count($search_title)) {
                $res_title = $this->makeCaseArray($search_title);
            }
            // FILTER ONLY TITLE
            if($request->has('filter') && strtolower($request->input('filter')) == strtolower('title')) {
                $result['title'] = $res_title;
                return $result;
            }

            // *TOPIC
            $search_topic = CaseModel::where('topic', 'like', '%'. $request->input('search') . '%')->get(['id','grno','title','topic','scra','syllabus','body','full_txt','status','short_title','date']);
            if(count($search_topic)) {
                $res_topic = $this->makeCaseArray($search_topic);
            }
            // FILTER ONLY TITLE
            if($request->has('filter') && strtolower($request->input('filter')) == strtolower('topic')) {
                $result['topic'] = $res_topic;
                return $result;
            }

            // *SYLLABUS
            $search_syllabus = CaseModel::where('syllabus', 'like', '%'. $request->input('search') . '%')->get(['id','grno','title','topic','scra','syllabus','body','full_txt','status','short_title','date']);
            if(count($search_syllabus)) {
                $res_syllabus = $this->makeCaseArray($search_syllabus);
            }
            // FILTER ONLY SYLLABUS
            if($request->has('filter') && strtolower($request->input('filter')) == strtolower('syllabus')) {
                $result['syllabus'] = $res_syllabus;
                return $result;
            }

            // *MULTIPLE GR NUMBERS
            // $search_case_refs = CaseReference::where('sub_case_id', $request->input('search'))
            // ->leftJoin('cases as a', 'a.id','=','case_references.case_id')
            // ->get(['case_references.sub_case_id as id','grno','title','topic','scra','syllabus']);

            $search_case_refs = \App\CaseGroup::where('refno', 'like', '%'.$request->input('search').'%')
            ->leftJoin('cases as a', 'a.id','=','case_group.case_id')
            ->get(['a.id', 'a.grno','a.title', 'a.topic','a.scra','a.syllabus','a.body','a.full_txt','a.status','a.short_title','a.date']);
            if(count($search_case_refs)) {
                $res_case_refs = $this->makeCaseArray($search_case_refs);
            }

            $merge_arr = array_merge($res_gr, $res_title, $res_topic, $res_syllabus, $res_case_refs);
            $result = $this->makeUniqueIdArray($merge_arr);
        }

        return response()->json($result,200);
    }

    private function makeCaseArray($arr = array(), $draft = false) {
        $final = array();
        $res = array();
        $related_grs = array();
        if(count($arr)) {
            foreach ($arr as $key => $value) {
                $res = $this->hashCase($value,$draft);
                array_push($final, $res);
                $res = array();
            }
            return $final;
        }
        return array();
    }

    public function hashCase($value,$draft = false) {
        $res = array();
        $related_grs = array();
        $reference_child = array();
        $reference_parent = array();

        $res['id'] = $value->id;
        $res['grno'] = $value->grno;
        $res['title'] = $value->title;
        $res['scra'] = $value->scra;
        $res['topic'] = $value->topic;
        $res['syllabus'] = $value->syllabus;
        $res['body'] = $value->body;
        $res['full_txt'] = $value->full_txt;
        $res['status'] = $value->status;
        $res['short_title'] = $value->short_title;
        $res['date'] = $value->date;
        $res['deleted_at'] = $value->deleted_at;

        if(isset($value->approved)) {
            $res['approved'] = $value->approved;
        }
        if($draft == true) {
            $related_grs = \App\CaseGroupDraft::where('case_id', $value->id)->get(['refno','title','short_title','date','scra']);
        } else {
            $related_grs = \App\CaseGroup::where('case_id', $value->id)->get(['refno','title','short_title','date','scra']);
            $reference_child = \App\CaseReference::where('case_id', $value->id)
            ->leftJoin('cases as c','c.id', '=', 'case_references.child_case_id')
            ->select('c.*')->first();
            $reference_parent = \App\CaseReference::where('case_id', $value->id)
            ->leftJoin('cases as c','c.id', '=', 'case_references.parent_case_id')
            ->select('c.*')->first();
        }

        if(count($related_grs)) {
            $res['related_grno'] = $related_grs;
        }
        if(count($reference_child)) {
            $res['child'] = $reference_child;
        }
        if(count($reference_parent)) {
            $res['parent'] = $reference_parent;
        }
        return $res;
    }

    public function viewCase($id) {
        $case = CaseModel::where('id', $id)->first();
        $make_case = $this->hashCase($case);
        return response()->json(['case' => $make_case]);
    }

    public function highlightCase(Request $request, $id) {
        $find_case = CaseModel::find($id);
        if($find_case) {
            $this->validate($request, [
                'user_id' => 'required',
                'text' => 'required'
            ]);
            UserHighlight::create([
                'user_id' => $request->input('user_id'),
                'case_id' => $id,
                'text' => $request->input('text')
            ]);
            return response()->json(['msg' => 'success']);
        }

        return response()->json(['msg' => 'error'], 500);
    }

    public function deleteUserHighlight($hlight_id) {
        $user_highlight = UserHighlight::find($hlight_id);
        if(!$user_highlight) {
            return response()->json(['errors' => [
                'not_found' => 'Record not found.'
            ]], 404);
        }
        $user_highlight->delete();
        return response()->json(['message' => 'success']);
    }

    public function getUserHighlights(Request $request, $id) {
        $user_highlight = UserHighlight::where('user_id', $id)
        ->leftJoin('cases as c', 'c.id','=','user_highlights.case_id')
        ->whereNotNull('text')
        ->where('text', '!=', '')
        ->get([
            'user_highlights.id',
            'user_id',
            'case_id',
            'text',
            'user_highlights.created_at',
            'user_highlights.updated_at',
            'c.grno',
            'c.short_title',
            'c.title'
        ]);
        if($user_highlight) {
            return response()->json(['highlights' => $user_highlight]);
        }

        return response()->json(['msg' => 'error'], 500);
    }

    public function bookmarkCase(Request $request, $id) {
        $find_case = CaseModel::find($id);
        if($find_case) {
            $this->validate($request, [
                'user_id' => 'required'
            ]);
            UserHighlight::create([
                'user_id' => $request->input('user_id'),
                'case_id' => $id,
                'text' => ''
            ]);

            return response()->json(['msg' => 'success']);
        }
        return response()->json(['msg'=>'error'], 500);
    }

    public function getBookmarks(Request $request, $id) {
        $bookmarks = UserHighlight::where('user_id', $id)->where('text', '')->get();
        if($bookmarks) {
            return response()->json(['bookmarks' => $bookmarks]);
        }

        return response()->json(['msg' => 'error'], 500);
    }

    public function makeUniqueIdArray($arr) {
        $hash = array();
        $ret = array();
        foreach ($arr as $cases) {
            if(!isset($hash[$cases['id']])) {
                array_push($ret, $cases);
            }
            $hash[$cases['id']] = $cases;
        }
        return $ret;
    }

    public function getCategory($parent, $level) {
        $categories = \App\Category::where('parent_id', $parent)->where('level', $level)->get();
        return response()->json(['categories' => $categories]);
    }

    public function createDraftCase(Request $request) {
        $case = new \App\CaseDraft;
        $case_reference_draft = new \App\CaseReferenceDraft;

        if($request->has('case_related_to')) {
            $case_group = new \App\CaseGroupDraft;
            $case_group->case_id = $request->input('case_related_to');
            $case_group->title = $request->input('title');
            $case_group->short_title = $request->input('short_title');
            $case_group->refno = $request->input('gr');
            $case_group->scra = $request->input('scra');
            $case_group->date = date('Y-m-d', strtotime($request->input('date')));
            $case_group->status = 'controlling';
            
            $case_group->save();

            if($request->has('case_parent') || $request->has('case_child') ) {
                $case_reference_draft->parent_case_id = $request->has('case_parent')?$request->input('case_parent'):$request->input('case_related_to');
                $case_reference_draft->case_id = $request->input('case_related_to');
                $case_reference_draft->child_case_id = $request->has('case_child')?$request->input('case_child'):$request->input('case_related_to');

                $case_reference_draft->save();
            }
            // "update case status if there is parent/child"
            if($request->has('case_parent')) {
                \App\HashCase::updateCaseStatusAndReference($request, $request->input('case_parent'),$request->input('case_related_to'));
            }
            if($request->has('case_child')) {
                \App\HashCase::updateCaseStatusAndReference($request, $request->input('case_child'),$request->input('case_related_to'));
            }
            // "update the related case status to controlling"
            $case_reference_draft = \App\CaseDraft::where('id', $request->input('case_related_to'))->first();
            $case_reference_draft->status = 'controlling';
            $case_reference_draft->save();

        } else {
            $case->title = $request->input('title');
            $case->short_title = $request->input('short_title');
            $case->grno = $request->input('gr');
            $case->scra = $request->input('scra');
            $case->date = date('Y-m-d', strtotime($request->input('date')));
            $case->topic = $request->input('topic');
            $case->syllabus = $request->input('syllabus');
            $case->body = $request->input('body');
            $case->full_txt = $request->input('fulltxt');
            $case->createdBy = \Auth::user()->user_id;
            $case->status = 'controlling';

            $case->save();

            if($request->has('case_parent') || $request->has('case_child') ) {
                $case_reference_draft->parent_case_id = $request->has('case_parent')?$request->input('case_parent'):$case->id;
                $case_reference_draft->case_id = $case->id;
                $case_reference_draft->child_case_id = $request->has('case_child')?$request->input('case_child'):$case->id;

                $case_reference_draft->save();
            }

            // "update case status if there is parent/child"
            if($request->has('case_parent')) {
                \App\HashCase::updateCaseStatusAndReference($request, $request->input('case_parent'),$case->id);
            }
            if($request->has('case_child')) {
                \App\HashCase::updateCaseStatusAndReference($request, $request->input('case_child'),$case->id);
            }   
        }

        return response()->json(['message' => 'Saved Successfully.']);
    }

    public function updateDraftCase(Request $request, $case_id) {
        if($request->has('db') && $request->input('db') == 'live') {
            $case = \App\CaseModel::find($case_id);
            $case_reference = new \App\CaseReference;
        } else {
            $case = \App\CaseDraft::find($case_id);
            $case_reference = new \App\CaseReferenceDraft;
        }

        if(!$case) {
            return response()->json(['message' => 'Record not found.']);
        }
        if($request->has('title')) {
            $case->title = $request->input('title');
        }
        if($request->has('short_title')) {
            $case->short_title = $request->input('short_title');
        }
        if($request->has('gr')) {
            $case->grno = $request->input('gr');
        }
        if($request->has('scra')) {
            $case->scra = $request->input('scra');
        }
        if($request->has('date')) {
            $case->date = date('Y-m-d', strtotime($request->input('date')));
        }
        if($request->has('topic')) {
            $case->topic = $request->input('topic');
        }
        if($request->has('syllabus')) {
            $case->syllabus = $request->input('syllabus');
        }
        if($request->has('body')) {
            $case->body = $request->input('body');
        }
        if($request->has('fulltxt')) {
            $case->full_txt = $request->input('fulltxt');
        }
        if($request->has('status')) {
            $case->status = $request->input('status');
        }

        $case->save();

        if($request->has('case_parent') || $request->has('case_child') ) {
            $check_case_reference = $case_reference->where('case_id', $case_id)->first();
            if($check_case_reference) {
                $check_case_reference->parent_case_id = $request->has('case_parent')?$request->input('case_parent'):$case_id;
                $check_case_reference->case_id = $case_id;
                $check_case_reference->child_case_id = $request->has('case_child')?$request->input('case_child'):$case_id;
                $check_case_reference->save();
            } else {
                $case_reference->parent_case_id = $request->has('case_parent')?$request->input('case_parent'):$case_id;
                $case_reference->case_id = $case_id;
                $case_reference->child_case_id = $request->has('case_child')?$request->input('case_child'):$case_id;
                $case_reference->save();
            }
        }
        // "update case status if there is parent/child"
        if($request->has('case_parent')) {
            \App\HashCase::updateCaseStatusAndReference($request, $request->input('case_parent'),$case_id);
        }
        if($request->has('case_child')) {
            \App\HashCase::updateCaseStatusAndReference($request, $request->input('case_child'),$case_id);
        }
        return response()->json(['message' => 'Updated Successfully.']);
    }

    public function approvalDraftCase(Request $request, $case_id) {
        $case = \App\CaseDraft::find($case_id);
        $case_transfer = new CaseModel;
        if(!$case) {
            return response()->json(['message' => 'Record not found.'],422);
        }

        if($request->has('approval')) {
            if($request->input('approval') == 1) {
                $case_transfer->title = $case->title;
                $case_transfer->grno = $case->grno;
                $case_transfer->scra = $case->scra;
                $case_transfer->date = $case->date;
                $case_transfer->topic = $case->topic;
                $case_transfer->syllabus = $case->syllabus;
                $case_transfer->body = $case->body;
                $case_transfer->full_txt = $case->full_txt;
                $case_transfer->status = $case->status;

                $case_transfer->save();
                $case->approved = 1;
                $case->save();

                // FIND IF CASE HAS RELATED CASES
                $case_related = \App\CaseGroupDraft::where('case_id', $case->id)->get();
                if(count($case_related)) {
                    foreach($case_related as $case_r) {
                        $case_transfer_group = new CaseGroup;
                        $case_transfer_group->case_id = $case_transfer->id;
                        $case_transfer_group->refno = $case_r->refno;
                        $case_transfer_group->title = $case_r->title;
                        $case_transfer_group->short_title = $case_r->short_title;
                        $case_transfer_group->date = $case_r->date;
                        $case_transfer_group->scra = $case_r->scra;
                        $case_transfer_group->status = $case_r->status;
                        $case_transfer_group->save();
                    }
                }

                return response()->json(['message' => 'Case Approved Successfully.']);
            } elseif($request->input('approval') == 0) {
                $case->deleted_at = \Carbon\Carbon::now();
                $case->save();
                return response()->json(['message' => 'Case Disapproved Successfully.']);
            }
        }

        return response()->json(['message' => 'There is some problem with your request.']);
    }

    public function listDraftCase(Request $request) {
        $cases = array();
        $user = \App\User::find(\Auth::user()->user_id);
        $draft = true;

        if($user->role == 'admin') {
            if($request->has('db') && $request->input('db') == 'live') {
                $cases = CaseModel::all();
                $draft = false;
            } else {
                $cases = \App\CaseDraft::where('approved', 0)->get();
            }
        } else {
            if($request->has('db') && $request->input('db') == 'live') {
                $cases = CaseModel::where('createdBy', $user->id)->get();
                $draft = false;
            } else {
                $cases = \App\CaseDraft::where('createdBy', $user->id)->where('approved', 0)->get();
            }
        }
        

        return response()->json(['cases' => $this->makeCaseArray($cases,$draft)]);
    }

    public function listDropdownDraftCase() {
        $cases = \App\CaseDraft::select('id',\DB::raw("CONCAT(grno,' ', IFNULL(short_title,'')) as text"))->where('approved', 0)->get();
        return response()->json(['cases' => $cases]);
    }

    public function deleteCase($case_id) {
        \Log::info('here=>'.$case_id);
        $case = CaseModel::find($case_id);
        if(!$case) {
            return response()->json(['message' => 'Record not found.'],422);
        }

        $case->delete();
        return response()->json(['message' => "Successfully Deleted case id {$case_id}."]);
    }
}
