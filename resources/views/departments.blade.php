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
                
                <div class="card-header">{{ __('Departments') }}</div>

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
                            <th scope="col">Owner</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=0;
                            @endphp
                    @foreach ($departments as $department)
                            @php
                            $i++;
                            $name;
                            $email;
                            foreach ($users as $user) {
                                if($user->id==$department->Owner){
                                    $name=$user->name;
                                    $email=$user->email;
                                }

                            }
                            @endphp
    <tr>
        <th scope="row">{{ $department->id }}</th>
        <td>{{ $department->name }}</td>
        <td>{{ $name }}</td>
        <td>{{ $email }}</td>
        <td><button type="button" class="btn btn-secondary"  onclick="edit({{ $department->id }}, '{{ $department->name }}','{{ $email }}')">Edit</button></td>
      </tr>
                    @endforeach
                </tbody>
            </table>

                </div>
            </div>
            <div class="card">
            <div id="create_edit" class="card-header">{{ __('Create Department') }}</div>
            <div class="card-body">
            <form enctype="multipart/form-data"  method="POST" action="{{route('Create_department')}}">
                <div class="form-group">
                    <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <input id="name" type="text" name="name" class="form-controll">
                    </div>
                    <div class="form-group row">
                        <div class="input-group d-flex justify-content-center">
                            <div class="input-group-prepend ">
                              <label class="input-group-text" for="owner">Owner</label>
                            </div>
                            <select class="custom-select col-4" id="owner" name="owner">
                              <option selected>Choose...</option>
                              @foreach ($users as $user)
                              <option value="{{$user->email}}">{{$user->email}}</option>
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
    function edit(id,d_name,o_name){
        $("#create_edit").html("Edit Department");
        $("#name").prop("value", d_name);
        $("#owner").prop("value", o_name);
        $("#cancel_btn").show();
        $("#edit_create_btn").html("Update");
    }
    function create(){
        $("#create_edit").html("Create Department");
        $("#name").prop("value", "");
        $("#owner").prop("value", "");
        $("#cancel_btn").hide();
        $("#edit_create_btn").html("Create");
    }
</script>
