@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
    <h1 class="h2 m-0">{{$title}}</h1>
</div>
<div class="container-fluid p-0">
    {!! Form::open(['action' => 'PagesController@updateActivity', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('category'), 'Answer'}}
        {{Form::select('category', ['shapes' => 'Shapes', 'colors' => 'Colors', 'letters' => 'Letters', 'numbers'
        => 'Numbers'], $activity->category, ['class' =>
        'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('question'), 'Question'}}
        {{Form::text('question', $activity->question, ['class' => 'form-control', 'placeholder' => 'Question'])}}
    </div>
    <div class="form-group">
        {{Form::label('answer'), 'Answer'}}
        {{Form::select('answer', ['choice1' => 'Choice 1', 'choice2' => 'Choice 2'], $activity->answer, ['class' =>
        'form-control'])}}
    </div>
    <div class="row">
        <div class="col col-md-6 form-group">
            {{Form::label('choice1'), 'Choice 1'}}
            <img class="mb-2" style="display:block;" src="http://gsisadmin.com/storage/activity_images/{{$activity->choice1}}" width="150px" height="250px" />
            {{Form::hidden('current_choice1', $activity->choice1)}}
            {{Form::file('choice1', ['class' => 'form-control', 'placeholder' => 'Choice 1'])}}
        </div>
        <div class="col col-md-6 form-group">
            {{Form::label('choice1'), 'Choice 2'}}
            <img class="mb-2" style="display:block;" src="http://gsisadmin.com/storage/activity_images/{{$activity->choice2}}" width="150px" height="250px"/>
            {{Form::hidden('current_choice2', $activity->choice2)}}
            {{Form::file('choice2', ['class' => 'form-control', 'placeholder' => 'Choice 2'])}}
        </div>
    </div>
    <div class="form-group">
            {{Form::hidden('cid', $activity->id)}}
            {{Form::hidden('classes_id', $activity->classes_id)}}
            {{Form::submit('Update', ['class'=>'btn btn-primary ml-2', 'style'=>'float:right;'])}}
            <button type="button" class="btn btn-default" style='float:right;'>
                <a style="color:black;" href="/activities/{{$activity->category}}/{{$activity->classes_id}}">Cancel</a>
            </button>
    </div>
    {!! Form::close() !!}
</div>
@endsection