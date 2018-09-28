@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
    <h1 class="h2 m-0">{{$title}}</h1>
</div>
<div class="container-fluid p-0">
    {!! Form::open(['action' => 'PagesController@updateStudent', 'method' => 'POST', 'enctype' =>
    'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('firstname', 'First Name')}}
        {{Form::text('firstname', $student->firstname, ['class' => 'form-control', 'placeholder' => 'First Name','required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('lastname', 'Last Name')}}
        {{Form::text('lastname', $student->lastname, ['class' => 'form-control', 'placeholder' => 'Last Name','required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('gender', 'Gender')}}
        {{Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'], $student->gender, ['class' => 'form-control','required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('contactnumber', 'Contact Number')}}
        <span class="badge">Expected format: 09XX-XXXXXXX</span>
        {{Form::text('contactnumber', $student->contactnumber, ['class' => 'form-control', 'placeholder' => '09XX-XXXXXXX', 'pattern'=>'[0-9]{4}-[0-9]{7}', 'required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('username', 'Username')}}
        {{Form::text('email', $student->email, ['class' => 'form-control', 'placeholder' => 'Username','required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('age', 'Age')}}
        {{Form::number('age', $student->age, ['class' => 'form-control', 'placeholder' => 'Age','required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::hidden('my_id', $student->id)}}
        {{Form::hidden('classes_id', $student->classes_id)}}
        {{Form::hidden('current_photo', $student->photo)}}
        {{Form::label('photo', 'Photo')}}
        <div class="form-group">
            <img src="http://gsisadmin.com/storage/student_images/{{$student->photo}}" width="70px" height="70px" />
        </div>
        {{Form::file('photo', ['class' => 'form-control', 'placeholder' => 'Photo'])}}
    </div>
    <div class="form-group">
            {{Form::submit('Update', ['class'=>'btn btn-primary ml-2', 'style'=>'float:right;'])}}
            <button type="button" class="btn btn-default" style='float:right;'>
                <a style="color:black;" href="../classes/{{$student->classes_id}}">Back</a>
            </button>
    </div>
    {!! Form::close() !!}
</div>
@endsection