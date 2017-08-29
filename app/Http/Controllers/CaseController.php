<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaseModel;

class CaseController extends Controller
{
    public function __construct()
    {
        //
    }

    public function searchCase(Request $request) {
        $result = array();
        if ($request->has('search')) {
            $search_GR = CaseModel::where('id','like', '%'. $request->input('search') .'%')->get();

            if(count($search_GR)) {
                $res_gr = $this->makeCaseArray($search_GR);
            }

            $search_title = CaseModel::where('title', 'like', '%'. $request->input('search') .'%')->get();
            if(count($search_title)) {
                $res_title = $this->makeCaseArray($search_title);
            }

            $result = array_merge($res_gr, $res_title);
        }

        return response()->json($result);
    }

    private function makeCaseArray($arr = array()) {
        $res = array();
        if(count($arr)) {
            foreach ($arr as $key => $value) {
                $res[$value->id]['id'] = $value->id;
                $res[$value->id]['title'] = $value->title;
                $res[$value->id]['scra'] = $value->scra;
                $res[$value->id]['date'] = $value->date;
                $res[$value->id]['topic'] = $value->topic;
                $res[$value->id]['syllabus'] = $value->syllabus;
                $res[$value->id]['body'] = $value->body;
                $res[$value->id]['status'] = $value->status;
            }
            return $res;
        }
        return array();
    }
}
