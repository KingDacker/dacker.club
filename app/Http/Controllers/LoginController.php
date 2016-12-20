<?php

namespace App\Http\Controllers;

use Illuminate\Mail\Message;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Passwords;
use Mail;
class LoginController extends Controller
{
    protected $email_view = 'emails.reset';
    protected $email_sub = 'Dacker.club重置密码邮件';
    protected $email_to = '';
    #登录
    public function signIn(Request $request)
    {
        if($data = Input::all()){
            $rules = [
                'email' => 'required',
                'password' => 'required'
            ];
            $messages = [
                'email.required' => '请输入正确的邮箱',
                'password.required' => '请输入密码',
            ];
            $validator = Validator::make($data,$rules,$messages);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput($request->all());
            }
            #邮箱,name_id 登录都可以
            $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
            if ( preg_match( $pattern, $data['email'] ) ) {
                $user = User::where('email',$data['email'])->first();
            }else{
                $user = User::where('name_id',$data['email'])->first();
            }
            if(!$user){
                return redirect()->back()->withInput($request->all())->withErrors(array('email' => '用户名不存在'));
            }
            if(Crypt::decrypt($user->password) != $data['password'] ){
                return redirect()->back()->withInput($request->all())->withErrors(array('email' => '用户名或密码不正确'));
            }
            session(['user'=>$user]);
            return redirect('/');
        }
        return view('login/signin');
    }

    #登出
    public function logout(){
        if(session('user')){
            session()->forget('user');
            return redirect('/');
        }
        return redirect('/');
    }
    #注册
    public function signUp(Request $request)
    {
        if($data = Input::all()){
            $rules = [
                'nick_name'=> 'required|between:2,8',
                'email' => 'required|email',
                'password' => 'required|between:6,20'
            ];
            $messages = [
                'nick_name.required' => '请输入昵称',
                'nick_name.between' => '昵称长度为2-8',
                'email.required' => '请输入正确的邮箱',
                'email.email' => '请输入正确的邮箱',
                'password.required' => '请输入密码',
                'password.between'=> '密码长度为6-20'
            ];
            $validator = Validator::make($data,$rules,$messages);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput($request->all());
            }
            #昵称唯一性
            $rs = User::where('nick_name',$data['nick_name'])->first();
            if($rs){
                return back()->with('errors','昵称已经被占用')->withInput($request->all());
            }
            #邮箱唯一性
            $rs = User::where('email',$data['email'])->first();
            if($rs){
                return back()->with('errors','邮箱已经被注册')->withInput($request->all());
            }
            #name_id唯一性
            $data['name_id'] = $this->getRollBack();
            #密码加密
            $data['password'] = Crypt::encrypt($data['password']);
            unset($data['_token']);
            $id = User::insertGetId($data);
            if(!$id){
                return back()->with('errors','注册失败,请联系站长')->withInput($request->all());
            }
            $user = User::find($id);
            session(['user'=>$user]);
            return redirect('/');

        }
        return view('login/signup');
    }

    #找回密码 发送邮件
    public function sendEmail(Request $request){

        if($data = Input::all()){
            #发送邮件
            $rules = [
                'email' => 'required|email',
            ];
            $messages = [
                'email.required' => '请输入正确的邮箱',
                'email.email' => '请输入正确的邮箱',
            ];
            $validator = Validator::make($data,$rules,$messages);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput($request->all());
            }
            #邮箱是否存在
            $rs = User::where('email',$data['email'])->where('status',1)->first();
            if(!$rs){
                return back()->with('errors','邮箱不存在')->withInput($request->all());
            }
            #生成token
            $this->email_to = $data['email'];
            $reset_arr['email'] = $data['email'];
            $reset_arr['token'] = md5($data['email'].time().env('APP_KEY'));
            PasswordReset::insertGetId($reset_arr);
            $flag = Mail::send($this->email_view, ['token'=>$reset_arr['token'],'email'=>$data['email']], function($message) {
                $to = $this->email_to;
                $message->to($to)->subject($this->email_sub);
            });
            if($flag){
                return redirect()->back()->with('success', '邮件发送成功,请去您的邮箱查看');
            }else{
                return redirect()->back()->withErrors(['errors' => '发送失败请联系管理员']);
            }
        }
        return view('login/email');
    }

    #找回密码 通过邮箱验证后,重新设置密码
    public function resetPassword(Request $request,$token){
        if($request->isMethod('post')){
            #失效时间判断
            $rs = PasswordReset::where('email',$request->get('email'))->where('token',$token)->first();
            if(!$rs){
                return back()->withErrors(['errors' => '链接不正确']);
            }
            $send_time = strtotime($rs->created_at);
            #60分钟内有效
            if(($send_time+60*60)<time()){
                return back()->withErrors(['errors'=>'链接失效']);
            }
            $rules = [
                'email' => 'required',
                'password' => 'required|between:6,20',
                'password_com' => 'same:password'
            ];
            $messages = [
                'email'=> '请填写邮箱',
                'password.required' => '旧密码不能为空',
                'password.between' => '新密码为6-20位',
                'password_com.same' => '新密码不一致',
            ];
            $validator = Validator::make($request->all(),$rules,$messages);
            if($validator->fails()){
                return back()->withErrors($validator);
            }
            #密码加密
            $data['password'] = Crypt::encrypt($request->get('password'));
            $rs = User::where('email',$request->get('email'))->update(['password'=>$data['password']]);
            if(!$rs){
                return view('login/reset')->with('errors','重新设置密码失败,请稍后再试');
            }
            #首页跳转
            return back()->with('success','重置密码成功,请去重新登录');
        }

        return view('login/reset')->with('email',$request->get('email'));
    }


    #回调生成name_id
    public function getRollBack(){
        #共同方法,生成9位数字符串
        $name_id = Controller::getNameId();
        $rs = User::where('name_id',$name_id)->first();
        if($rs){
            $this->getRollBack();
        }else{
            return $name_id;
        }
    }



}
