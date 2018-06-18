<?php

namespace App\Http\Controllers;
/** 
 * Category Controller
 * 
 * @category Case/Category
 * @package  None
 * @author   Rei <rmmedillo@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     api.tier-app.com/category
 */
use Illuminate\Http\Request;
class CategoryController extends Controller
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
     * Generate an array with parent/child relationships even how deep is the level
     *
     * @param $request $request ..
     * 
     * @return array
     */
    public function generateTreeView(Request $request)
    {
        $parent_id = $request->input('cat_search'); //
        $parent_name = '';
        $hash = array();
        $categories = \App\Category::all();
        foreach ($categories as $category) {
            $temp_hash = array();
            if ($category->parent_id == $parent_id) {
                $category['children'] = 'test';
                $category['children'] = $this->_setChildrenFirst($category->id, $categories);
                array_push($hash, $category);
            }
        }
        foreach ($categories as $category) {
            if ($category->id == $parent_id) {
                $parent_name = $category->name;
                break;
            }
        }
        return response()->json(
            ['category' => $hash, 
            'main_category' => $parent_name
            ]
        );
    }

    /**
     * Ugly hack for setting DEEP LEVELS IN CHILDREN
     *
     * @param int $parent_id 
     * @param int $lists 
     * 
     * @return array
     */
    private function _setChildrenFirst($parent_id, $lists) 
    {
        $temp = array();
        foreach ($lists as $category) {
            if ($category->parent_id == $parent_id) {
                $category['children'] = $this->_setChildrenSecond(
                    $category->id, $lists
                );
                array_push($temp, $category);
            }
        }
        return $temp;
    }
    private function _setChildrenSecond($parent_id, $lists) 
    {
        $temp = array();
        foreach ($lists as $category) {
            if ($category->parent_id == $parent_id) {
                $category['children'] = $this->_setChildrenThird(
                    $category->id, $lists
                );
                array_push($temp, $category);
            }
        }
        return $temp;
    }
    private function _setChildrenThird($parent_id, $lists) 
    {
        $temp = array();
        foreach ($lists as $category) {
            if ($category->parent_id == $parent_id) {
                array_push($temp, $category);
            }
        }
        return $temp;
    }
    /**
     * Get all cases based on their category
     *
     * @param $request $request ..
     * 
     * @return array
     */
    public function getCasesByCategory(Request $request) {
        \Log::info($request->input('category_name'));
        $cases = \App\CaseModel::select('id',\DB::raw("CONCAT(grno,' ', IFNULL(short_title,'')) as text"))
        ->where('topic', 'LIKE', '%'.$request->input('category_name').'%')
        ->get();
        return response()->json(['cases' => $cases]);
    }

    //
}
