<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['middleware' => ['before', 'auth:api'], 'namespace' => 'App\Http\Controllers'], function() use($app) {
    // SEARCH
    $app->post('v1/search-case', ['as' => 'searchCase', 'uses' => 'CaseController@searchCase']);
    // VIEW
    $app->get('v1/view-case/{case_id}', ['as' => 'viewCase', 'uses' => 'CaseController@viewCase']);
    // HIGHLIGHT
    $app->post('v1/highlight-case/{case_id}', ['as' => 'highlightCase', 'uses' => 'CaseController@highlightCase']);
    $app->get('v1/highlights/{user_id}', ['as' => 'getUserHighlights', 'uses' => 'CaseController@getUserHighlights']);
    // BOOKMARK
    $app->post('v1/bookmark-case', ['as' => 'bookmarkCase', 'uses' => 'CaseController@bookmarkCase']);
});
