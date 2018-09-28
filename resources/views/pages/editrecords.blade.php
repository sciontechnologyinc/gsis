@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
    <h1 class="h2 m-0">{{$title}}</h1>
</div>
<div  class="container-fluid p-0">
    {!! Form::open(['action' => 'PagesController@updateUser', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name'), 'Full Name'}}
        {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Full Name', 'required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('gender'), 'Gender'}}
        {{Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'], $user->gender, ['class' =>'form-control', 'required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('contactnumber'), 'Contact Number'}}
        <span class="badge">Expected format: 09XX-XXXXXXX</span>
        {{Form::text('contactnumber', $user->contactnumber, ['class' => 'form-control',  'placeholder' => '09XX-XXXXXXX', 'pattern'=>'[0-9]{4}-[0-9]{7}', 'required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('email'), 'Email'}}
        {{Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email', 'required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('age'), 'Age'}}
        {{Form::number('age', $user->age, ['class' => 'form-control', 'placeholder' => 'Age', 'required'=>true])}}
    </div>
    <div class="form-group">
        <img src="http://gsisadmin.com/storage/user_images/{{$user->photo}}" width="70px" height="70px" />
    </div>
    <div class="form-group">
        {{Form::hidden('current_photo', $user->photo)}}
        {{Form::hidden('my_id', $user->id)}}
        {{Form::label('photo', 'Picture')}}
        {{Form::file('photo', ['class' => 'form-control', 'placeholder' => 'Picture'])}}
    </div>
    @if(Auth::user()->isAdmin == "True")
        <div class="form-group">
            <h6>Admin Access</h6>
            <label class="switch">
            <input name="isAdmin" id="isAdmin" type="checkbox" value="{{$user->isAdmin}}" @if(strtolower($user->isAdmin)=="true"){{"checked"}}@endif onclick="$(this).val(this.checked ? 'True' : 'False')">
                <span class="slider"></span>
            </label>
        </div>
    @endif
    <div class="form-group">
        {{Form::submit('Update', ['class'=>'btn btn-primary ml-2', 'style'=>'float:right;'])}}
        <button type="button" class="btn btn-default" style='float:right;'>
            <a style="color:black;" href="/records">Cancel</a>
        </button>
    </div>
    {!! Form::close() !!}
</div>
@endsection