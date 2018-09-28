@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1 class="h2 m-0">{{$title}}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @if(isset($active_class))
        <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#addstudent">
            Add Student
        </button>
        @else
        {{-- <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Import</button>
            <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div> --}}
        <button class="btn btn-primary" data-toggle="modal" data-target="#addclass">
            Add Class
        </button>
        @endif
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm display" data-sortable="true" style="text-align:center;">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                @if(isset($active_class))
                <th>Photo</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Username</th>
                <th>Age</th>
                @endif
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="searchable">
            @if(isset($active_class))
            @foreach($students as $student)
            <tr>
                <td class="align-middle">{{$student->id}}</td>
                <td class="align-middle">{{$student->firstname}} {{$student->lastname}}</td>
                <td class="align-middle">
                    <img src="{{ asset('storage/student_images/'.$student->photo) }}" width="50px" height="50px" />
                </td>
                <td class="align-middle">{{$student->gender}}</td>
                <td class="align-middle">{{$student->contactnumber}}</td>
                <td class="align-middle">{{$student->email}}</td>
                <td class="align-middle">{{$student->age}}</td>
                <td class="align-middle">
                    <button type="button" class="btn btn-sm btn-primary">
                        <a style="color:white;" href="../student/{{$student->id}}">Edit</a>
                    </button>
                    {!! Form::open(['action' => ['PagesController@deleteStudent'], 'method' => 'POST', 'style'=>'display:inline-block;']) !!}
                    {{Form::hidden('id', $student->id)}}
                    {{Form::hidden('classes_id', $active_class)}}
                    {!! Form::submit('Delete',['class'=> 'btn btn-sm btn-outline-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
            @else
            @foreach($classes as $class)
            <tr>
                <td class="align-middle">{{$class->id}}</td>
                <td class="align-middle">{{$class->classname}}</td>
                <td class="align-middle">
                    {{-- <button type="button" class="btn btn-sm btn-outline-success">Edit</button> --}}
                    {!! Form::open(['action' => ['PagesController@deleteClasses'], 'method' => 'POST', 'style'=>'display:inline-block;']) !!}
                    {{Form::hidden('id', $class->id)}}
                    {!! Form::submit('Delete',['class'=> 'btn btn-sm btn-outline-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@if(isset($active_class))
<div class="modal fade" id="addstudent" tabindex="-1" role="dialog" aria-labelledby="addstudentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="addstudentLabel">Add {{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['action' => 'PagesController@storeStudents', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('firstname', 'First Name')}}
                    {{Form::text('firstname', '', ['class' => 'form-control', 'placeholder' => 'First Name', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('lastname', 'Last Name')}}
                    {{Form::text('lastname', '', ['class' => 'form-control', 'placeholder' => 'Last Name', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('gender', 'Gender')}}
                    {{Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('contactnumber', 'Contact Number')}}
                    <span class="badge">Expected format: 09XX-XXXXXXX</span>
                    {{Form::text('contactnumber', '', ['class' => 'form-control', 'placeholder' => '09XX-XXXXXXX', 'pattern'=>'[0-9]{4}-[0-9]{7}', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('username', 'Username')}}
                    {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Username', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('age', 'Age')}}
                    {{Form::hidden('classes_id', $active_class)}}
                    {{Form::number('age', '', ['class' => 'form-control', 'placeholder' => 'Age', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('photo', 'Photo')}}
                    {{Form::file('photo', ['class' => 'form-control', 'placeholder' => 'Photo'])}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{Form::submit('Add Student', ['class'=>'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@else
<div class="modal fade" id="addclass" tabindex="-1" role="dialog" aria-labelledby="addclassLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addclassLabel">Add Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['action' => 'PagesController@storeClasses', 'method' => 'POST']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('title'), 'Class Name'}}
                    {{Form::text('classname', '', ['class' => 'form-control', 'placeholder' => 'Class Name'])}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{Form::submit('Add Class', ['class'=>'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif

<script>
    $(document).ready(function () {
        (function ($) {
            $('#filter').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.searchable tr').hide();
                $('.searchable tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
                $('.no-data').hide();
                if ($('.searchable tr:visible').length == 0) {
                    $('.no-data').show();
                }
            })
        }(jQuery));
    });

</script>
@endsection
