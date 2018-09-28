@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1 class="h2 m-0">{{$title}}</h1>
</div>
<div class="col-md-12 row px-0">
    <div class="col-md-2 container mb-4">
        @if(isset($ac_classes))
        <ul class="list-group">
            @foreach($ac_classes as $class)
            <a class="list-group-item list-group-item-action @if(isset($active_class) && $class->id == $active_class){{"active"}}@endif"
                href="/reports/{{$class->id}}">
                <span>
                    {{$class->classname}}
                </span>
            </a>
            @endforeach
        </ul>
        @endif
    </div>
    <div class="col-md-10 lister">
        <h1 class="h2 m-0">List of Students</h1>
        <br />
        {{ $examsclass->render() }}
    </div>
</div>
@endsection