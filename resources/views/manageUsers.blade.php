<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>
@extends('layouts.app')
<?php
use Illuminate\Support\Facades\Storage;?>
@section('content')
<div class="container">
    <div class="row justify-content-left">
    <img src="{{route('Get_profile_pic')}}" style="width:100px; height:100px; float:left; border-radius:50%;">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Department</th>
                            <th scope="col">Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        

                    @foreach ($users as $user)
                            @php
                            $depname="";
                            foreach ($departments as $department) {
                                if($department->id==$user->user_has_department){
                                    $depname=$department->name;
                                }

                            }
                            @endphp
                            
    <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $depname }}</td>
       
        <td><button type="button" class="btn btn-secondary"  onclick="edit({{ $user->id }}, '{{ $user->name }}','{{ $user->email }}','{{ $depname }}')">Edit</button></td>
      </tr>
                    @endforeach
                </tbody>
            </table>

                </div>
            </div>
            <div class="card">
            <div id="create_edit" class="card-header">{{ __('Create User') }}</div>
            <div class="card-body">
            <form enctype="multipart/form-data"  method="POST" action="{{route('Create_user')}}">
                <div class="form-group">
                    <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <input id="name" type="text" name="name" class="form-controll">
                    </div>
                    <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                <input id="email" type="text" name="email" class="form-controll">
                    </div>
                    <div class="form-group row">
                        <div class="input-group d-flex justify-content-center">
                            <div class="input-group-prepend ">
                              <label class="input-group-text" for="department">Department</label>
                            </div>
                            <select class="custom-select col-4" id="department" name="department">
                              <option selected>Choose...</option>
                              @foreach ($departments as $department)
                              <option value="{{$department->name}}">{{$department->name}}</option>
                              @endforeach

                            </select>
                          </div>
                    </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                </div>
                <button id="edit_create_btn" class="btn btn-primary" type="submit">Create</button>
                <button id="cancel_btn" type="button" class="btn btn-secondary float-right"  onclick="create()">Cancel</button>
            </form>
        </div>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    $(document).ready(function() {
        create();
    });
    function edit(id,name,email,depname){
        $("#create_edit").html("Edit User");
        $("#name").prop("value", name);
        $("#email").prop("value", email);
        $("#department").prop("value", depname);
        $("#cancel_btn").show();
        $("#edit_create_btn").html("Update");
    }
    function create(){
        $("#create_edit").html("Create User");
        $("#name").prop("value", "");
        $("#email").prop("value", "");
        $("#department").prop("value", "");
        $("#cancel_btn").hide();
        $("#edit_create_btn").html("Create");
    }
</script>
