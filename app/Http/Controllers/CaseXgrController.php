<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


/** 
 * Main Case Controller
 * 
 * @category Case/Xgr
 * @package  None
 * @author   Rey <rmmedillo@gmail.com>
 * @link     /case/new
 */

class CaseXgrController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Save case xgr for fields (grno, body, topic, syllabus)
     *
     * @param array $request
     * 
     * @return array
     */
    public function createCaseXgr(Request $request) {

        if($request->has('grno')) {
            $xgr = \App\CaseXgr::where('grno', $request->input('grno'))->where('topic', $request->input('topic'))
            ->first();

            if($xgr) {
                $xgr->syllabus = $request->input('syllabus');
                $xgr->body = $request->input('body');

                $xgr->save();
            } else {
                $xgr = new \App\CaseXgr;

                $xgr->grno = $request->input('grno');
                $xgr->topic = $request->input('topic');
                $xgr->syllabus = $request->input('syllabus');
                $xgr->body = $request->input('body');

                $xgr->save();
            }
        }

        return response()->json(['message' => 'Saved Successfully.']);
    }

    /**
     * Search xgr table for fields (grno, body, topic, syllabus)
     *
     * @param array $request
     * 
     * @return array
     */
    public function viewCaseXgr(Request $request) {
        if($request->has('grno')) {
            $xgr = \App\CaseXgr::where('grno', $request->input('grno'))->where('topic', $request->input('topic'))
            ->first();

            if($xgr) {
                return response()->json(['message'=>'Successful.', 'xgr'=>$xgr]);
            }
        }

        return response()->json(['message'=>'No data found.', 'xgr'=>array() ]);
    }
}
