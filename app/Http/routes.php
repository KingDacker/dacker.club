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
#写真导航
Route::any('/list/{type}', 'HomeController@lists');
#获取省市区
Route::any('address/option', 'AddressController@addressOption');

#固定链接:常见问题,赞助中心,网站公告
Route::any('help', 'HelpController@lists');
Route::any('sponsor', 'PayController@sponsor');
Route::any('announcement', 'NewsController@systemList');

#投稿详情
Route::any('post/detail/{id}', 'PostController@detail');

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

    #用户申请投稿,稿列表,投稿详情,回复留言
    Route::any('post/create', 'PostController@create');
    Route::any('post/list', 'PostController@lists');
    Route::any('post/detail/{id}', 'PostController@detail');
    Route::post('post/reply/comment', 'PostController@replyComment');

    #点赞 关注
    Route::any('post/likes', 'PostController@likes');
    Route::any('follow', 'UserController@follow');

    #用户个人资料
    Route::any('info', 'UserController@info');
    Route::any('info/id/{id}', 'UserController@info');
    Route::any('info/update','UserController@infoUpdate');

    #用户修改密码
    Route::any('password','UserController@password');

    #用户生成订单,订单详情,支付订单,支出记录,收入记录,提现记录
    Route::any('order/create/{post_id}', 'OrderController@create');
    Route::any('order/detail/{id}', 'OrderController@detail');
    Route::any('order/pay', 'OrderController@pay');
    Route::any('order/out', 'OrderController@out');
    Route::any('order/in', 'OrderController@in');
    Route::any('order/cash', 'OrderController@cash');

    #收货地址列表,地址省市区选项,新增用户地址,编辑地址,删除地址
    Route::any('address/list', 'AddressController@addressList');
    //Route::any('address/option', 'AddressController@addressOption');
    Route::any('address/create', 'AddressController@addressCreate');
    Route::any('address/edit', 'AddressController@addressEdit');
    Route::any('address/edit/id/{address_id}', 'AddressController@addressEdit');
    Route::any('address/del', 'AddressController@addressDel');

    #系统,私密消息,私密消息详情,回复私密消息
    //Route::any('news/system/list', 'NewsController@systemList');
    Route::any('news/chat/list', 'NewsController@chatList');
    Route::any('news/chat/detail/{user_id}', 'NewsController@chatDetail');
    Route::post('news/chat/reply', 'NewsController@chatReply');

    #充值
    #Route::any('pay', 'PayController@pay');

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

    #帖子管理 列表,编辑,更新,置顶;删除评论,新增评论
    Route::any('post', 'PostController@index');
    Route::any('post/edit/{post}', 'PostController@edit');
    Route::any('post/update/{post}', 'PostController@update');
    Route::post('post/top', 'PostController@top');
    Route::post('post/del/comment', 'PostController@delComment');
    Route::post('post/add/comment', 'PostController@addComment');

    #用户管理 列表,编辑,更新,增加鸡鸡币 收货地址的修改,删除,新增
    Route::any('user', 'UserController@index');
    Route::any('user/edit/{user}', 'UserController@edit');
    Route::post('user/update/{user}', 'UserController@update');
    Route::post('user/add/point', 'UserController@addPoint');
    Route::get('address/edit/{address_id}/user/{user_id}', 'AddressController@edit');
    Route::post('address/del', 'AddressController@del');
    Route::post('address/create', 'AddressController@create');

    #公告消息列表,发布,删除
    Route::any('news/lists', 'NewsController@lists');
    Route::post('news/add/system', 'NewsController@addSystem');
    Route::post('news/del/system', 'NewsController@delSystem');

    #订单管理
    Route::any('order/lists', 'OrderController@lists');
    Route::any('order/detail/{order_id}', 'OrderController@detail');


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
//
//Route::auth();
//
//Route::get('/home', 'HomeController@index');
