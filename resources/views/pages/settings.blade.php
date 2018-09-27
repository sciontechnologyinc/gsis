@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
    <h1 class="h2 m-0">{{$title}}</h1>
</div>
<div  class="container-fluid p-0">
    {!! Form::open(['action' => 'PagesController@updateUser', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name'), 'Full Name'}}
        {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Full Name'])}}
    </div>
    <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                            
                        </div>
 
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="new-password">New Password</label>
 
                           
                                <input id="new-password" type="password" class="form-control" name="new-password" required>
 
                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                           
                        </div>
 
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>


    <div class="form-group">
        {{Form::label('gender'), 'Gender'}}
        {{Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'], $user->gender, ['class' =>
        'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('contactnumber'), 'Contact Number'}}
        {{Form::text('contactnumber', $user->contactnumber, ['class' => 'form-control', 'placeholder' => 'Contact Number'])}}
    </div>
    <div class="form-group">
        {{Form::label('email'), 'Email'}}
        {{Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
    </div>
    <div class="form-group">
        {{Form::label('age'), 'Age'}}
        {{Form::number('age', $user->age, ['class' => 'form-control', 'placeholder' => 'Age'])}}
    </div>
    <div class="form-group">
        <img src="http://gsisadmin.com/storage/user_images/{{Auth::user()->photo}}" width="70px" height="70px" />
    </div>
    <div class="form-group">
        {{Form::hidden('current_photo', Auth::user()->photo)}}
        {{Form::hidden('my_id', Auth::user()->id)}}
        {{Form::hidden('my_self', "True")}}
        {{Form::label('photo', 'Picture')}}
        {{Form::file('photo', ['class' => 'form-control', 'placeholder' => 'Picture'])}}
    </div>
    @if(Auth::user()->isAdmin == "True")
        <div class="form-group">
            <h6>Admin Access</h6>
            <label class="switch">
            <input name="isAdmin" id="isAdmin" type="checkbox" value={{$user->isAdmin}} @if(strtolower($user->isAdmin)=="true"){{"checked"}}@endif onclick="$(this).val(this.checked ? 'True' : 'False')">
                <span class="slider"></span>
            </label>
        </div>
    @endif
    <div class="form-group">
        {{Form::submit('Update', ['class'=>'btn btn-primary', 'style'=>'float:right;'])}}
    </div>
    {!! Form::close() !!}
</div>
@endsection
