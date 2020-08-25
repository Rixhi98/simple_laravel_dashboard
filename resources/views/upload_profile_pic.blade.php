@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile Photo') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            
                        </div>
                    @endif
                    
                    <form enctype="multipart/form-data"  method="POST" action="{{route('Change_profile_pic')}}">
                        <div class="form-group">
                        <input type="file" name="profile_pic" class="form-controll">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </div>
                        <button class="btn btn-primary" type="submit">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
