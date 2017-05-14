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


Route::group(['middleware' => 'jwt.refresh'], function () {
    Route::resource('quotes', 'QuoteController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
});

Route::post('/users/signup', 'UserController@signup');
Route::post('/users/signin', 'UserController@signin');