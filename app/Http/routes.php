<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
#后端
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {

    Route::get('index', 'LoginController@index');
    Route::get('code', 'LoginController@code');
    Route::post('login', 'LoginController@login');
});

Route::group(['middleware'=>['admin.login'],'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::any('logout', 'LoginController@logout');
    Route::get('home', 'IndexController@index');
    Route::any('password','IndexController@password');
    #帖子管理
    Route::any('post','PostController@index');
    Route::any('post/edit/{post}','PostController@edit');
    Route::any('post/update/{post}','PostController@update');
    Route::post('post/delComment','PostController@delComment');

    #用户管理
    Route::any('user','UserController@index');
    Route::any('user/edit/{user}','UserController@edit');
    Route::post('user/update/{user}','UserController@update');
});

#前端

#注册
Route::any('login/signup','LoginController@signup');
#登录
Route::any('login/signin','LoginController@signin');

// Route::auth();
// Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
//     Route::get('/', 'HomeController@index');
//     Route::resource('article', 'ArticleController');
// });

// Route::get('article/{id}','ArticleController@show');

// Route::post('comment','CommentController@store');


//Route::get('admin', function () {
//        return view('admin_template');
//    });
//
//
//Route::group(['namespace' => 'Backend', 'middleware' => ['auth']], function () {
//    Route::get('/', 'IndexController@index');
//    Route::resource('user','UserController');
//});
//
//Route::group(['namespace' => 'Auth'], function () {
//    Route::get('auth/login', 'AuthController@getLogin');
//    Route::post('auth/login', 'AuthController@postLogin');
//    Route::get('auth/logout', 'AuthController@getLogout');
//});
