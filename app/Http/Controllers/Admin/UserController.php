<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
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
                            $query->where('closing_data','>=',date('Y-m-d H:i:s'));
                        }elseif($value == 2){
                            $query->where('closing_data','<',date('Y-m-d H:i:s'));
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
            if($value['closing_data']>=date('Y-m-d H:i:s')){
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
        view()->share('page_title','用户管理');
        $user = User::where('user_type','<',99)->where('id',$id)->first();
        if($user['closing_data']>=date('Y-m-d H:i:s')){
            $user['pay_status_str'] = '已付费';
        }else{
            $user['pay_status_str'] = '未付费';
        }
        return  view('admin.user.edit')->with('data',$user);
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
            'closing_data'=>  'required',
            'last_login_data'=>  'required|date_format:Y-m-d H:i:s',
        ];
        $data = Input::all();
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        if($data['password']){
            $data['password'] = Crypt::encrypt($data['password']);
        }else{
            unset($data['password']);
        }
        unset($data['_token']);
        $result = User::where('id',$id)->where('user_type','<',99)->update($data);
        if(!$result){
            return back()->with('errors','更新用户资料失败');
        }
        return back()->with('success','更新用户资料成功');

    }





}
