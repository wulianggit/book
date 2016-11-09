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
    // 用户登录
    Route::get('/member', 'MemberController@index');
    Route::resource('member', 'MemberController');
    // 手机注册
    Route::post('/registerPhone', 'MemberController@storePhone');
    // 邮箱注册
    Route::post('/registerEmail', 'MemberController@storeEmail');
    // 邮箱验证
    Route::any('/Member/validation', 'MemberController@validatEmail');

    // 书籍类别
    Route::get('/category', 'CategoryController@index');
    Route::get('/category/pid/{pid}', 'CategoryController@getCategoryByPid');

    Route::get('/product/cid/{cid}', 'ProductController@index');
});
// 发送手机验证码
Route::group(['namespace' => 'Service','prefix' => 'service'], function ($route) {
    $route->get('/sendSMS', 'SendValidateNews@sendSMS');
});

