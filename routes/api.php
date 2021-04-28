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
Route::post('login', 'Api\UserController@login')->middleware('cors');
Route::post('register', 'Api\UserController@register');
Route::post('chart', 'Api\UserController@chart');
Route::post('memberselect', 'Api\UserController@memberselect');
Route::post('paymentselect', 'Api\UserController@paymentselect');
Route::get('mutasi_sandbox', 'Api\UserController@mutasi_sandbox');
Route::get('mutasi_dev', 'Api\UserController@mutasi_dev');
Route::get('mutasi_prod', 'Api\UserController@mutasi_prod');
Route::get('check_balance_dev', 'Api\UserController@check_balance_dev');
Route::post('confirmregister', 'Api\UserController@confirmregister');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('details', 'Api\UserController@details');
    Route::get('logout', 'Api\UserController@logout');

}); 
Route::get('/city/{id}', 'ApiController@city');
Route::get('/getalbum', 'ApiController@getalbum'); 
Route::post('/checkemail', 'ApiController@checkemail');   
