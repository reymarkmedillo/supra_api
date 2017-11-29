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
    return response()->json("Bad Request");
});
// MUST BE LOGGED IN ROUTES
$app->group(['middleware' => ['before', 'auth:api'], 'namespace' => 'App\Http\Controllers'], function() use($app) {
    // ** CASES **
    // SEARCH
    $app->post('v1/search-case', ['as' => 'searchCase', 'uses' => 'CaseController@searchCase']);
    // VIEW
    $app->get('v1/view-case/{case_id}', ['as' => 'viewCase', 'uses' => 'CaseController@viewCase']);
    // HIGHLIGHT
    $app->post('v1/highlight-case/{case_id}', ['as' => 'highlightCase', 'uses' => 'CaseController@highlightCase']);
    $app->get('v1/highlights/{user_id}', ['as' => 'getUserHighlights', 'uses' => 'CaseController@getUserHighlights']);
    $app->delete('v1/highlights/{hlight_id}', ['as' => 'deleteUserHighlight', 'uses' => 'CaseController@deleteUserHighlight']);
    // BOOKMARK
    $app->post('v1/bookmark-case/{case_id}', ['as' => 'bookmarkCase', 'uses' => 'CaseController@bookmarkCase']);
    $app->get('v1/bookmarks/{user_id}', ['as' => 'getBookmarks', 'uses' => 'CaseController@getBookmarks']);
    // CATEGORY
    $app->get('v1/categories/{parent}/{level}', ['as' => 'getCategory', 'uses' => 'CaseController@getCategory']);
    // DELETE
    $app->get('v1/remove/{case_id}', ['as' => 'deleteCase', 'uses' => 'CaseController@deleteCase']);
    // ** DRAFT CASES **
    //LIST
    $app->get('v1/drafts/list-case', ['as' => 'listDraftCase', 'uses' => 'CaseController@listDraftCase']);
    $app->get('v1/drafts/list-dropdown-case', ['as' => 'listDropdownDraftCase', 'uses' => 'CaseController@listDropdownDraftCase']);
    // CREATE
    $app->post('v1/drafts/create-case', ['as' => 'createDraftCase', 'uses' => 'CaseController@createDraftCase']);
    // UPDATE
    $app->post('v1/drafts/update-case/{case_id}', ['as' => 'updateDraftCase', 'uses' => 'CaseController@updateDraftCase']);
    // APPROVE/DISAPPROVE
    $app->post('v1/drafts/approval-case/{case_id}', ['as' => 'approvalDraftCase', 'uses' => 'CaseController@approvalDraftCase']);

    // ** USER **
    // PROFILE
    $app->post('v1/user/update/{user_id}', ['as' => 'updateProfile', 'uses' => 'UserController@updateProfile']);
    $app->get('v1/user/view/{user_id}', ['as' => 'viewProfile', 'uses' => 'UserController@viewProfile']);
    $app->get('v1/users', ['as' => 'getAllUsers', 'uses' => 'UserController@getAllUsers']);
    $app->post('v1/users/add', ['as' => 'addUser', 'uses' => 'UserController@addUser']);
});


// NOT LOGGED IN ROUTES
$app->group(['middleware' => ['before'], 'namespace' => 'App\Http\Controllers'], function() use($app) {
    // ** AUTH **
    // LOGIN
    $app->post('v1/auth/login', ['as' => 'postLogin', 'uses' => 'AuthController@postLogin']);
    // REGISTER
    $app->post('v1/auth/register', ['as' => 'postRegister', 'uses' => 'AuthController@postRegister']);
    // FORGOT PASSWORD
    $app->post('v1/auth/forgot', ['as' => 'postForgotPassword', 'uses' => 'AuthController@postForgotPassword']);
    $app->get('v1/auth/forgot-password/{token}', ['as' => 'getForgotPasswordToken', 'uses' => 'AuthController@getForgotPasswordToken']);
    $app->post('v1/auth/forgot-password/{token}', ['as' => 'postForgotPasswordToken', 'uses' => 'AuthController@postForgotPasswordToken']);
});
