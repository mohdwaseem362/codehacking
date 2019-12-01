@extends('layouts.master')

@section('content')


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Users/Create</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <div class="container">
    <div class="body mr-5 ml-5">

          @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button> 
              <strong>{{ $message }}</strong>
            </div>
          @endif



          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="col-sm-3">

            <img height="200px" width="200px" src="{{$user->photo ? $user->photo->path :'Add photo'}}" alt="" class="img-responsive img-circle">
            
          </div>

          <div class="col-sm-9">

          <form action="{{route('users.update',$user->id)}}" method="post"  enctype="multipart/form-data" accept-charset="utf-8">
            @method('PUT')
              @csrf
                    
                    <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder="Enter title">
                    </div>

                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="{{$user->email}}" placeholder="Enter Email">
                    </div>

                    <div class="form-group">
                     <label for="SelectRole">Select Role</label>
                     <select name="role" class="form-control">
                      <option value="">Select Role</option>
                     @foreach($role as $role)
                     <option value="{{$role->id}}" {{( $user->role_id == $role->id ) ? ' selected' : '' }}>{{$role->name}}</option>
                     @endforeach
                     </select>
                    </div>

                    <div class="form-group">
                     <label for="SelectStatus">Select Status</label>
                     <select name="status"  class="form-control">
                     
                     <option value="{{$user->is_active}}" selected="selected" >
                       @if($user->is_active==1)
                          Active
                          @elseif($user->is_active==0)
                          InActive
                          @endif
                     </option>
                      
                     <option value="1">Active</option>
                     <option value="0" >Not Active</option>
                     </select>
                    </div>

                    <div class="form-group">
                    <label for="file">Select Image</label>
                    <input type="file" name="file" class="form-control" value="" placeholder="">
                    </div>



                    <div class="form-group">
                    <label for="email">Password</label>
                    <input type="text" name="password" class="form-control" value="" placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="text" name="cpassword" class="form-control" value="" placeholder="Enter Confirm Password">
                    </div>
                    

                    <input type="submit" name="Submit" value="Create User">
  
           </form>     
     </div>
      </div>
      </div>
  </div>

@endsection