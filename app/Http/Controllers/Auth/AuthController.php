<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use App\Http\Requests\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    #dacker
    #设置成功登录后转向的页面：
    protected $redirectPath = '/';

    #设置登录失败后转向的页面：
    protected $loginPath = '/auth/login';

    #设置退出登录后转向的页面：
    protected $redirectAfterLogout = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    #dacker 登录页面
    public function getLogin(){
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        $builder = new CaptchaBuilder();
        $builder->build();
        Session::put('phrase', $builder->getPhrase());

        return view('auth.login')->with('captcha', $builder->inline());       
    }

    #dacker 登录
    public function postLogin(Request $request){
        $this->validate($request, [
            $this->loginUsername() => 'required',
            'password'             => 'required',
            'captcha'              => 'required'
        ], [
            $this->loginUsername() . '.required' => '请输入邮箱或用户名称',
            'password.required'                  => '请输入用户密码',
            'captcha.required'                   => '请输入验证码'
        ]);

        if (Session::get('phrase') !== $request->get('captcha')) {
            return redirect()->back()->withErrors(array('captcha' => '验证码不正确'))->withInput();
        }
    }
    

}
