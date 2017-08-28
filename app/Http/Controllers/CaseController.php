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
        $search_GR = CaseModel::where('id','like', '%'.$request->input('search').'%')->get();

        return response()->json($search_GR);
    }
}
