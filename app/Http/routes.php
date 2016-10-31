<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/member', 'MemberController@index');
    Route::resource('member', 'MemberController');
    // 手机注册
    Route::post('/registerPhone', 'MemberController@storePhone');
    // 邮箱注册
    Route::post('/registerEmail', 'MemberController@storeEmail');
});
// 发送手机验证码
Route::group(['namespace' => 'Service','prefix' => 'service'], function ($route) {
    $route->get('/sendSMS', 'SendValidateNews@sendSMS');
});

