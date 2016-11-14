<?php

namespace App\Http\Controllers\Backend;
use App\Models\User;
use App\Http\Requests\Form\UserForm;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;



class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(25);
        return view('backend.user.index',compact('users'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(UserForm $request)
    {
        $data = [
            'name'      =>  $request['name'],
            'email'     =>  $request['email'],
            'password'  =>  bcrypt($request['password']),
        ];
        try{
            if(User::create($data)){
                return redirect()->back()->withSuccess('新增用户成功');
            }
        } catch(\Exception $e){
            return redirect()->back()->withInput()->withErrors(array('error' => $e->getMessage()));
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.user.edit',compact('user'));
    }

    public function update(UserForm $request, $id)
    {
        $data = [
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => bcrypt($request['password']),
        ];

        try {
            if (User::where('id', $id)->update($data)) {
                return redirect()->back()->withSuccess('编辑用户成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(array('error' => $e->getMessage()));
        }

    }

    public function destroy($id)
    {
        try {
            if (User::destroy($id)) {
                return redirect()->back()->withSuccess('删除用户成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }

}
