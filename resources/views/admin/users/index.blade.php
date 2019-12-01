@extends('layouts.master')

@section('content')


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <a  type="button" href="{{url('/admin/users/create')}}" class="btn btn-primary" > Create New User</a>
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

  			<div class="table-data">

              <table class="table">

                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($users)

                      @foreach($users as $key =>$data)
                      <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td><a href="{{route('users.edit',$data->id)}}">{{$data->name}}</a> </td>
                        <td><div class="image-container">
                        <img height="50" width="50" src="{{$data->photo ? $data->photo->path :'Add photo'}}" alt="" class="img-responsive img-circle">
                        </div></td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->role->name}}</td>
                        <td>
                          @if($data->is_active==1)
                          Active
                          @elseif($data->is_active==0)
                          InActive
                          @endif

                        </td>
                        <td>{{$data->created_at->diffForHumans()}}</td>
                        <td>{{$data->updated_at->diffForHumans()}}</td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>

              </table>
        </div>
      </div>
  </div>

@endsection