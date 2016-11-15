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
    Route::post('/member/login', 'MemberController@login');

    // 手机注册
    Route::post('/registerPhone', 'MemberController@storePhone');
    // 邮箱注册
    Route::post('/registerEmail', 'MemberController@storeEmail');
    // 邮箱验证
    Route::any('/Member/validation', 'MemberController@validatEmail');

    // 书籍类别
    Route::get('/category', 'CategoryController@index');
    Route::get('/category/pid/{pid}', 'CategoryController@getCategoryByPid');
    // 书籍列表
    Route::get('/product/cid/{cid}', 'ProductController@index');
    // 书籍详情
    Route::get('/product/{id}', 'ProductController@show');
    
    // 购物车增 删 查
    Route::get('/cart/destory', 'CartController@destory');
    Route::resource('cart', 'CartController');

    // 结算订单
    Route::match(['get','post'],'/orderCommit', 'OrderController@commit')->middleware(['check.login']);
});
// 发送手机验证码
Route::group(['namespace' => 'Service','prefix' => 'service'], function ($route) {
    $route->get('/sendSMS', 'SendValidateNews@sendSMS');
});

