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
// MUST BE LOGGED IN ROUTES
$app->group(['middleware' => ['before', 'auth:api'], 'namespace' => 'App\Http\Controllers'], function() use($app) {
    // ** CASES **
    // SEARCH
    $app->post('v1/search-case', ['as' => 'searchCase', 'uses' => 'CaseController@searchCase']);
    // CREATE
    $app->post('v1/create-case', ['as' => 'createCase', 'uses' => 'CaseController@createCase']);
    // VIEW
    $app->get('v1/view-case/{case_id}', ['as' => 'viewCase', 'uses' => 'CaseController@viewCase']);
    // HIGHLIGHT
    $app->post('v1/highlight-case/{case_id}', ['as' => 'highlightCase', 'uses' => 'CaseController@highlightCase']);
    $app->get('v1/highlights/{user_id}', ['as' => 'getUserHighlights', 'uses' => 'CaseController@getUserHighlights']);
    // BOOKMARK
    $app->post('v1/bookmark-case/{case_id}', ['as' => 'bookmarkCase', 'uses' => 'CaseController@bookmarkCase']);
    $app->get('v1/bookmarks/{user_id}', ['as' => 'getBookmarks', 'uses' => 'CaseController@getBookmarks']);
    // CATEGORY
    $app->get('v1/categories/{parent}/{level}', ['as' => 'getCategory', 'uses' => 'CaseController@getCategory']);

    // ** USER **
    // PROFILE
    $app->post('v1/user/update/{user_id}', ['as' => 'updateProfile', 'uses' => 'UserController@updateProfile']);
    $app->get('v1/user/view/{user_id}', ['as' => 'viewProfile', 'uses' => 'UserController@viewProfile']);
});


// NOT LOGGED IN ROUTES
$app->group(['middleware' => ['before'], 'namespace' => 'App\Http\Controllers'], function() use($app) {
    // ** AUTH **
    // LOGIN
    $app->post('v1/auth/login', ['as' => 'postLogin', 'uses' => 'AuthController@postLogin']);
    // REGISTER
    $app->post('v1/auth/register', ['as' => 'postRegister', 'uses' => 'AuthController@postRegister']);
});
