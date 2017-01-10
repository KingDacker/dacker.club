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

##################################[前端]##################################
#首页
Route::any('/', 'HomeController@index');

#用户注册,登录,找回密码
Route::group(['prefix' => 'login'], function () {
    #注册
    Route::any('signup', 'LoginController@signUp');
    #登录
    Route::any('signin', 'LoginController@signIn');
    #登出
    Route::any('logout', 'LoginController@logout');
    #忘记密码(发送邮件,重设密码)
    Route::any('email', 'LoginController@sendEmail');
    Route::any('reset/{token}', 'LoginController@resetPassword');
});

#用户投稿,个人资料
Route::group(['middleware' => ['user.login'], 'prefix' => 'user'], function () {
    #用户上传图片
    Route::post('upload/image', 'Controller@uploadImg');

    #用户申请投稿,稿列表,投稿详情
    Route::any('post/create', 'PostController@create');
    Route::any('post/list', 'PostController@lists');
    Route::any('post/detail/{id}', 'PostController@detail');

    #用户个人资料
    Route::any('info', 'UserController@info');
    Route::any('info/id/{id}', 'UserController@info');
    Route::any('info/update','UserController@infoUpdate');

    #用户修改密码
    Route::any('password','UserController@password');

});

##################################[后端]##################################

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    #登录
    Route::any('index', 'LoginController@index');
    Route::get('code', 'LoginController@code');
    Route::post('login', 'LoginController@login');
});

Route::group(['middleware' => ['admin.login'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    #首页,注销,密码
    Route::get('home', 'IndexController@index');
    Route::any('logout', 'LoginController@logout');
    Route::any('password', 'IndexController@password');
    #帖子管理
    Route::any('post', 'PostController@index');
    Route::any('post/edit/{post}', 'PostController@edit');
    Route::any('post/update/{post}', 'PostController@update');
    Route::post('post/delComment', 'PostController@delComment');
    #用户管理
    Route::any('user', 'UserController@index');
    Route::any('user/edit/{user}', 'UserController@edit');
    Route::post('user/update/{user}', 'UserController@update');
    #菜单管理
    Route::any('menu', 'MenuController@index');
});


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

Route::auth();

Route::get('/home', 'HomeController@index');
