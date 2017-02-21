<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserController extends CommonController
{
    #用户列表
    public function index(Request $request)
    {
        view()->share('page_title','用户资料管理');
        $data =User::where(function ($query) use ($request){
            $field_arr = $request->only(['name_id','email','nick_name','user_type','status','pay_status']);
            $query->where('user_type','<',99);
            foreach($field_arr as $key=>$value){
                if($value){
                    if($key == 'nick_name'){
                        $query->where($key,'like','%'.$value.'%');
                    }elseif($key == 'pay_status' ){
                        #是否付费 1已付费 2未付费
                        if($value == 1){
                            $query->where('closed_at','>=',date('Y-m-d H:i:s'));
                        }elseif($value == 2){
                            $query->where('closed_at','<',date('Y-m-d H:i:s'));
                        }
                    }else{
                        $query->where($key,$value);
                    }
                }
            }
        })->paginate(10);
        foreach($data as $key=>$value){
            $data[$key]['user_type_str'] = $this->userType($value['user_type']);
            $data[$key]['status_str'] = $this->userStatus($value['status']);
            if($value['closed_at']>=date('Y-m-d H:i:s')){
                $data[$key]['pay_status_str'] = '已付费';
            }else{
                $data[$key]['pay_status_str'] = '未付费';
            }
        }
        $condition = [
            'name_id'=>$request->get('name_id'),
            'email'=>$request->get('email'),
            'nick_name'=>$request->get('nick_name'),
            'user_type'=>$request->get('user_type'),
            'status'=>$request->get('status'),
            'pay_status'=>$request->get('pay_status'),
        ];
        return view('admin/user/index',['data'=>$data,'condition'=>$condition]);
    }

    #编辑页面
    public function edit(Request $request,$id)
    {
        $user = User::where('user_type','<',99)->where('id',$id)->first();
        if(!$user){
            return view('errors.404');
        }
        if($user['closed_at']>=date('Y-m-d H:i:s')){
            $user['pay_status_str'] = '已付费';
        }else{
            $user['pay_status_str'] = '未付费';
        }
        $data = [
            'page_title'    =>  '修改个人资料',
            'checked_menu'  =>  ['level1'=>'用户管理','level2'=>'个人资料'],
            'user'  =>  $user,
            'user_info' =>  $user->userInfo
            #'user_info' =>  $user_info,
        ];
        return  view('admin.user.edit')->with('data',$data);
    }

    #更新
    public function update(Request $request,$id)
    {
        $rules = [
            'name_id'   =>  'required',
            'password' => 'between:6,20',
            'nick_name' =>  'required',
            'email'     =>  'required|email',
            'user_type' =>  'required',
            'status'    =>  'required',
            'created_at'=>  'required',
            'closed_at'=>  'required',
            'last_login_at'=>  'required|date_format:Y-m-d H:i:s',
        ];
        $data = Input::all();
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        if($data['password']){
            $user['password'] = Crypt::encrypt($data['password']);
        }
        $user['name_id']    = $data['name_id'];
        $user['nick_name']  = $data['nick_name'];
        $user['user_type']  = $data['user_type'];
        $user['email']      = $data['email'];
        $user['status']     = $data['status'];
        $user['created_at'] = $data['created_at'];
        $user['closed_at']  = $data['closed_at'];
        $user['last_login_at'] = $data['last_login_at'];
        $result = User::where('id',$id)->whereIn('status',[1,2])->update($user);
        if(!$result){
            return back()->with('errors','更新用户资料失败');
        }
        $user_info['point_scale'] = $data['point_scale'];
        $user_info['followers_num'] = $data['followers_num'];
        $user_info['identity'] = $data['identity'];
        $user_info['mobile'] = $data['mobile'];
        $user_info['we_chat'] = $data['we_chat'];
        $user_info['ali_account'] = $data['ali_account'];
        $user_info['ali_name'] = $data['ali_name'];
        $user_info['height'] = $data['height'];
        $user_info['weight'] = $data['weight'];
        $user_info['gender'] = $data['gender'];
        $user_info['introduce'] = $data['introduce'];
        $result = UserInfo::where('user_id',$id)->update($user_info);
        if(!$result){
            return back()->with('errors','更新用户资料失败');
        }
        return back()->with('success','更新用户资料成功');

    }

    #增加鸡鸡币
    public function addPoint(Request $request){
        $user_id = (int)$request->get('user_id');
        $add_point = (int)$request->get('add_point');
        $user = User::find($user_id);
        if(!$user){
            return Controller::echoJson(400,'用户不存在');
        }
        $rs = UserInfo::where('user_id',$user_id)->increment('point',$add_point);
        if(!$rs){
            return Controller::echoJson(401,'增加失败');
        }
        return Controller::echoJson(200,'成功');
    }

//    public function destroy($id)
//    {
//        try {
//            if (User::destroy($id)) {
//                return redirect()->back()->withSuccess('删除用户成功');
//            }
//        } catch (\Exception $e) {
//            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
//        }
//    }
//$user = User::find($id);
//return view('backend.user.edit',compact('user'));

}
