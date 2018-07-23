<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'articles'], function(){
    Route::get('/', 'API\\ArticleController@getPaginate');
    Route::get('one/{article}', 'API\\ArticleController@getById');
    Route::get('full', 'API\\ArticleController@getFullData');
});


Route::group(['prefix' => 'categories'], function(){
    Route::get('/', 'API\\CategoryController@getPaginate');
    Route::get('one/{category}', 'API\\CategoryController@getById');
    Route::get('full', 'API\\CategoryController@getFullData');
});


Route::group(
    ['prefix' => 'authors'], function (){
    Route::get('/', 'API\\AuthorController@getPaginate');
    // full reiktu pasidaryti
    Route::get('one/{author}', 'API\\AuthorController@getById');
    Route::get('full', 'API\\AuthorController@getFullData');
});