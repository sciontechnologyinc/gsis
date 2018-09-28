@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1 class="h2 m-0">{{$title}}</h1>
</div>
<div class="col-md-12 row px-0">
    <div class="col-md-3">
        <div class="footer-side" style="text-align:center;">
            <img class="center-block my-4" src="http://gsisadmin.com/storage/student_images/{{$info->photo}}" width="120px" height="120px"  />
            <div class="col-xs-12 col-sm-12">
                    <h4 class="blue">
                        <span class="middle">{{$info->firstname}} {{$info->lastname}}</span>
                    </h4>

                    <div class="profile-user-info">
                        <div class="profile-info-row">
                            <div class="badge badge-pill badge-secondary">{{$xclasses->classname}}</div>
                        </div>
                        <br />
                        <div class="profile-info-row">
                            <div class="badge col-12">Teacher:</div>
                            <div class="profile-info-value">
                                <span>{{$teacher->name}}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="badge">Username:</div>
                            <div class="profile-info-value">
                                <span>{{$info->email}}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="badge">Gender:</div>
                            <div class="profile-info-value">
                                <span>{{$info->gender}}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="badge">Age:</div>
                            <div class="profile-info-value">
                                <span>{{$info->age}}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="badge">Local Contact:</div>
                            <div class="profile-info-value">
                                <span>{{$info->contactnumber}}</span>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-md-9 lister">
        <h1 class="h2 m-0">List of Tests</h1>
        <br />
        {{ $report->render() }}
    </div>
</div>
@endsection