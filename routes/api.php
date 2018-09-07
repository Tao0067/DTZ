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

//Route::post('login','Api\IndexController@login');
//Route::post('register','Api\IndexController@register');
Route::get('index','Api\IndexController@index');
//
//Route::group(['middleware' => 'auth:api'], function () {
//    Route::get('getDetails','Api\IndexController@gitDetails');
//});



Route::prefix('auth')->group(function($router) {
    $router->post('login', 'Api\AuthController@login');
    $router->post('logout', 'Api\AuthController@logout');


});


Route::group(['middleware' => ['jwt.api.auth']], function () { //
    Route::get('info', 'Api\AuthController@getUserInfo');
});


Route::get('/inter/index','Api\InteractiveController@index');


