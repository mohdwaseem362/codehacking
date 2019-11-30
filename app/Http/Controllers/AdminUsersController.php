<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;

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

    //dd($request->file('file'));
       $validatedata=$this->validate($request, [
        'name' => 'required|max:25',
        'email' => 'required|email',
        'role' =>    'required',
        'status' => 'required',
        'file'  => 'required|mimes:jpeg,bmp,png|max:1000',
        'password'=>'required|max:20|min:5',
        'cpassword'=>'required|same:password|max:20|min:5'
         ]);
       /*uploading image file*/

        if($file=$request->file('file')){

            $filename = $file->getClientOriginalName();
            $file->move('images/codehacking/admin',$filename);
            $photo =Photo::create(['path'=>$filename]);
        }

       if($validatedata){
        $data =new User;
        $data->name =$request->name;
        $data->email =$request->email;
        $data->role_id= $request->role;
        $data->is_active= $request->status;
        $data->photo_id =$photo->id;
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
        $user=User::findOrFail($id);
        $role=Role::all(['name','id']);

        return view('admin/users/edit',compact('user','role'));
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
