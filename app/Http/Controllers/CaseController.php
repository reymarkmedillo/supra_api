<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaseModel;
use App\UserHighlight;

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
        if ($request->has('search')) {
            // GR
            $search_GR = CaseModel::where('id','like', '%'. $request->input('search') .'%')->get(['id','title','topic','scra']);
            if(count($search_GR)) {
                $res_gr = $this->makeCaseArray($search_GR);
            }
            // FILTER ONLY ID/GR
            if($request->has('filter') && strtolower($request->input('filter')) == strtolower('id')) {
                $result['id'] = $res_gr;
                return $result;
            }

            // TITLE
            $search_title = CaseModel::where('title', 'like', '%'. $request->input('search') .'%')->get(['id','title','topic','scra']);
            if(count($search_title)) {
                $res_title = $this->makeCaseArray($search_title);
            }
            // FILTER ONLY TITLE
            if($request->has('filter') && strtolower($request->input('filter')) == strtolower('title')) {
                $result['title'] = $res_title;
                return $result;
            }

            // TOPIC
            $search_topic = CaseModel::where('topic', 'like', '%'. $request->input('search') . '%')->get(['id','title','topic','scra']);
            if(count($search_topic)) {
                $res_topic = $this->makeCaseArray($search_topic);
            }
            // FILTER ONLY TITLE
            if($request->has('filter') && strtolower($request->input('filter')) == strtolower('topic')) {
                $result['topic'] = $res_topic;
                return $result;
            }

            $result['id'] = $res_gr;
            $result['title'] = $res_title;
            $result['topic'] = $res_topic;
        }

        return response()->json($result);
    }

    private function makeCaseArray($arr = array()) {
        $final = array();
        $res = array();
        if(count($arr)) {
            foreach ($arr as $key => $value) {
                $res['id'] = $value->id;
                $res['title'] = $value->title;
                $res['scra'] = $value->scra;
                $res['topic'] = $value->topic;
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
}
