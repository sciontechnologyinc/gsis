@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1 class="h2 m-0">{{$title}}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button class="btn btn-outline-secondary mr-3" data-toggle="modal" data-target="#addactivity">
            Add Activity
        </button>
        @if(isset($categories))
        <div class="btn-group">
            @foreach($categories as $category)
            <a class="btn btn-outline-secondary @if(isset($active_category) && $category[0] == $active_category){{"active"}}@endif"
                href="../{{$category[0]}}/{{$active_class}}">
                <span>{{$category[1]}}</span>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>
<div class="col-md-12 row px-0">
    <div class="col-md-3 container mb-4">
        @if(isset($ac_classes))
        <ul class="list-group">
            @foreach($ac_classes as $class)
            <a class="list-group-item list-group-item-action @if(isset($active_class) && $class->id == $active_class){{"active"}}@endif"
                href="/activities/@if(isset($active_category)){{$active_category}}@else{{"letters"}}@endif/{{$class->id}}">
                <span>
                    {{$class->classname}}
                </span>
            </a>
            @endforeach
        </ul>
        @endif
    </div>
    <div class="col-md-9 lister">
        <div class="row">
            @if(isset($activities))
            @foreach($activities as $activity)
            <div class="col col-md-4 col-sm-6 col-xs-12 activities mb-4">
                <div class="card shadow-sm">
                    <div class="row container mx-0 px-0 {{$activity->answer}}">
                        <img class="card-img-top col col-md-6 col-xs-12 px-0 c1" style="height:250px;" src="../../storage/activity_images/{{$activity->choice1}}"
                            alt="Choice 1">
                        <img class="card-img-top col col-md-6 sol-xs-12 px-0 c2" style="height:250px;" src="../../storage/activity_images/{{$activity->choice2}}"
                            alt="Choice 2">
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{$activity->question}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary">
                                    <a style="color:white;" href="../../activity/{{$activity->id}}">Edit</a>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger">
                                    <a style="color:white;" href="../../activities-action/delete/{{$activity->id}}">Delete</a>
                                </button>
                            </div>
                            <small class="text-muted">{{$activity->category}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="alert alert-info center">
                Select a class first
            </div>
            @endif
        </div>
    </div>
</div>
@if(isset($active_class))
<div class="modal fade" id="addactivity" tabindex="-1" role="dialog" aria-labelledby="addactivityLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addactivityLabel">Add {{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['action' => 'PagesController@storeActivity', 'method' => 'POST', 'enctype' =>
            'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('category'), 'Answer'}}
                    {{Form::select('category', ['shapes' => 'Shapes', 'colors' => 'Colors', 'letters' => 'Letters',
                    'numbers' => 'Numbers'], $active_category, ['class' =>
                    'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('question'), 'Question'}}
                    {{Form::text('question', '', ['class' => 'form-control', 'placeholder' => 'Question'])}}
                </div>
                <div class="form-group">
                    {{Form::label('answer'), 'Answer'}}
                    {{Form::select('answer', ['choice1' => 'Choice 1', 'choice2' => 'Choice 2'], null, ['class' =>
                    'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('choice1'), 'Choice 1'}}
                    {{Form::file('choice1', ['class' => 'form-control', 'placeholder' => 'Choice 1'])}}
                </div>
                <div class="form-group">
                    {{Form::label('choice2'), 'Choice 2'}}
                    {{Form::file('choice2', ['class' => 'form-control', 'placeholder' => 'Choice 2'])}}
                </div>
                <div class="form-group">
                    {{Form::hidden('classes_id', $active_class)}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{Form::submit('Add Activity', ['class'=>'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@else
@endif
@endsection
