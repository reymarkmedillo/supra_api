<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaseModel;
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
            $search_GR = CaseModel::where('grno','like', '%'. $request->input('search') .'%')->get(['id','grno','title','topic','scra','syllabus','full_txt']);
            if(count($search_GR)) {
                $res_gr = $this->makeCaseArray($search_GR);
            }
            // FILTER ONLY GR
            if($request->has('filter') && strtolower($request->input('filter')) == strtolower('grno')) {
                $result['grno'] = $res_gr;
                return $result;
            }

            // *TITLE
            $search_title = CaseModel::where('title', 'like', '%'. $request->input('search') .'%')->get(['id','grno','title','topic','scra','syllabus','full_txt']);
            if(count($search_title)) {
                $res_title = $this->makeCaseArray($search_title);
            }
            // FILTER ONLY TITLE
            if($request->has('filter') && strtolower($request->input('filter')) == strtolower('title')) {
                $result['title'] = $res_title;
                return $result;
            }

            // *TOPIC
            $search_topic = CaseModel::where('topic', 'like', '%'. $request->input('search') . '%')->get(['id','grno','title','topic','scra','syllabus','full_txt']);
            if(count($search_topic)) {
                $res_topic = $this->makeCaseArray($search_topic);
            }
            // FILTER ONLY TITLE
            if($request->has('filter') && strtolower($request->input('filter')) == strtolower('topic')) {
                $result['topic'] = $res_topic;
                return $result;
            }

            // *SYLLABUS
            $search_syllabus = CaseModel::where('syllabus', 'like', '%'. $request->input('search') . '%')->get(['id','grno','title','topic','scra','syllabus','full_txt']);
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
            ->get(['a.id', 'a.grno','a.title', 'a.topic','a.scra','a.syllabus','a.full_txt']);
            if(count($search_case_refs)) {
                $res_case_refs = $this->makeCaseArray($search_case_refs);
            }

            $merge_arr = array_merge($res_gr, $res_title, $res_topic, $res_syllabus, $res_case_refs);
            $result = $this->makeUniqueIdArray($merge_arr);
        }

        return response()->json($result,200);
    }

    private function makeCaseArray($arr = array()) {
        $final = array();
        $res = array();
        if(count($arr)) {
            foreach ($arr as $key => $value) {
                $res['id'] = $value->id;
                $res['grno'] = $value->grno;
                $res['title'] = $value->title;
                $res['scra'] = $value->scra;
                $res['topic'] = $value->topic;
                $res['syllabus'] = $value->syllabus;
                $res['full_txt'] = $value->full_txt;
                $child_grs = \App\CaseGroup::where('case_id', $value->id)->get(['refno','title']);

                if(count($child_grs)) {
                    $res['child_grno'] = $child_grs;
                }
                array_push($final, $res);
                $res = array();
            }
            return $final;
        }
        return array();
    }

    public function viewCase($id) {
        $case = CaseModel::where('id', $id)->get();
        return response()->json($case);
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
        $case_group = new \App\CaseGroupDraft;

        if($request->has('case_related_to')) {
            $case_group->case_id = $request->input('case_related_to');
            $case_group->title = $request->input('title');
            $case_group->short_title = $request->input('short_title');
            $case_group->refno = $request->input('gr');
            $case_group->scra = $request->input('scra');
            $case_group->date = date('Y-m-d', strtotime($request->input('date')));
            $case_group->status = $request->input('status');

            $case_group->save();
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
            $case->status = $request->input('status');

            $case->save();
        }
        return response()->json(['message' => 'Saved Successfully.']);
    }

    public function updateDraftCase(Request $request, $case_id) {
        $case = \App\CaseDraft::find($case_id);
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
        if($request->has('full_txt')) {
            $case->body = $request->input('fulltxt');
        }
        $case->status = "reinstated";

        $case->save();
        return response()->json(['message' => 'Updated Successfully.']);
    }

    public function approvalDraftCase(Request $request, $case_id) {
        $case = \App\CaseDraft::find($case_id);
        $case_tranfer = new CaseModel;
        if(!$case) {
            return response()->json(['message' => 'Record not found.']);
        }

        if($request->has('approval')) {
            if($request->input('approval') == 1) {
                $case_tranfer->title = $case->title;
                $case_tranfer->grno = $case->grno;
                $case_tranfer->scra = $case->scra;
                $case_tranfer->date = $case->date;
                $case_tranfer->topic = $case->topic;
                $case_tranfer->syllabus = $case->syllabus;
                $case_tranfer->body = $case->body;
                $case_tranfer->full_txt = $case->full_txt;
                $case_tranfer->status = $case->status;

                $case_tranfer->save();
                
                $case->approved = 1;
                $case->save();
                return response()->json(['message' => 'Case Approved Successfully.']);
            } elseif($request->input('approval') == 0) {
                $case->deleted_at = \Carbon\Carbon::now();
                $case->save();
                return response()->json(['message' => 'Case Disapproved Successfully.']);
            }
        }

        return response()->json(['message' => 'There is some problem with your request.']);
    }

    public function listDraftCase() {
        $cases = array();
        $user = \App\User::find(\Auth::user()->user_id);

        if($user->role == 'admin') {
            $cases = \App\CaseDraft::where('approved', 0)->get();
        } else {
            $cases = \App\CaseDraft::where('createdBy', $user->id)->where('approved', 0)->get();
        }
        

        return response()->json(['cases' => $cases]);
    }

    public function listDropdownDraftCase() {
        $cases = \App\CaseDraft::select('id',\DB::raw("CONCAT(grno,' ', IFNULL(short_title,'')) as text"))->get();
        return response()->json(['cases' => $cases]);
    }
}
