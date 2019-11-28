<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users =User::all();
      
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=Role::all(['name','id']);
       // print_r($role);exit();
        return view('admin.users.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedata=$this->validate($request, [
        'name' => 'required|max:25',
        'email' => 'required|email',
        'role' =>    'required',
        'status' => 'required',
        'password'=>'required|max:20|min:5',
        'cpassword'=>'required|same:password|max:20|min:5'
         ]);
       if($validatedata){
        $data =new User;
        $data->name =$request->name;
        $data->email =$request->email;
        $data->role_id= $request->role;
        $data->is_active= $request->status;
        $data->password=bcrypt($request->cpassword);
        $data->save();

        //return view('admin.users.index');
        return redirect('/admin/users')->with('success','Item created successfully!');
        
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
