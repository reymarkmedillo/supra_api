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
        $app->post('v1/search-case', ['as' => 'searchCase', 'uses' => 'CaseController@searchCase']);
        $app->get('v1/view-case/{case_id}', ['as' => 'viewCase', 'uses' => 'CaseController@viewCase']);
});
