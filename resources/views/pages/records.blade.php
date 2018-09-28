@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1 class="h2 m-0">{{$title}}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        {{-- <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Import</button>
            <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div> --}}
        <button class="btn btn-primary" data-toggle="modal" data-target="#addteacher">
            Add Teacher
        </button>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm" style="text-align:center;">
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Age</th>
                <th>Access</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="searchable">
            @foreach($users as $user)
            <tr>
                <td class="align-middle">{{$user->id}}</td>
                <td class="align-middle">
                    <img src="storage/user_images/{{$user->photo}}" width="50px" height="50px" />
                </td>
                <td class="align-middle">{{$user->name}}</td>
                <td class="align-middle">{{$user->gender}}</td>
                <td class="align-middle">{{$user->contactnumber}}</td>
                <td class="align-middle">{{$user->email}}</td>
                <td class="align-middle">{{$user->age}}</td>
                <td class="align-middle">
                    <label class="switch">
                        <input type="checkbox" disabled @if(strtolower($user->isAdmin)=="true"){{"checked"}}@endif>
                        <span class="slider"></span>
                    </label>
                </td>
                <td class="align-middle">
                    <button type="button" class="btn btn-sm btn-success">
                        <a style="color:white;" href="records/{{$user->id}}">Edit</a>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger">
                        <a style="color:white;" href="user-action/delete/{{$user->id}}">Delete</a>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="addteacher" tabindex="-1" role="dialog" aria-labelledby="addteacherLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addteacherLabel">Add {{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['action' => 'PagesController@storeUser', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('name'), 'Full Name'}}
                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Full Name', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('gender'), 'Gender'}}
                    {{Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' =>'form-control', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('contactnumber'), 'Contact Number'}}
                    <span class="badge">Expected format: 09XX-XXXXXXX</span>
                    {{Form::tel('contactnumber', '', ['class' => 'form-control', 'placeholder' => '09XX-XXXXXXX', 'pattern'=>'[0-9]{4}-[0-9]{7}', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('email'), 'Email'}}
                    {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('age'), 'Age'}}
                    {{Form::number('age', '', ['class' => 'form-control', 'placeholder' => 'Age', 'required'=>true])}}
                </div>
                <div class="form-group">
                    {{Form::label('photo'), 'Picture'}}
                    {{Form::file('photo', ['class' => 'form-control', 'placeholder' => 'Picture'])}}
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
