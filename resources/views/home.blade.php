@extends('layouts.app')
<?php
use Illuminate\Support\Facades\Storage;?>
@section('content')
<x-package-chatview/>
<div class="container">
    <div class="row justify-content-left">
    <img src="{{route('Get_profile_pic')}}" style="width:100px; height:100px; float:left; border-radius:50%;">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($user->id==1)
                    <a href="{{ route('Departments') }}">Manage Departments</a>
                    <p></p>
                    <a href="{{ route('user_manager') }}">Manage Users</a>
                    <p></p>
                    @endif

                    {{ __('') }}
                    <a href="{{ route('update_password') }}">Change Password</a>
                    <p></p>
                    <a href="{{ url('/up_profile_pic') }}">Upload Photo</a>
                    
                </div>
            </div>
        </div>
    </div>
   
</div>

@endsection
