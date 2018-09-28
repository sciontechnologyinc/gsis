<?php

Auth::routes();
Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//classes
Route::get('/classes', 'PagesController@classes');
Route::get('/classes/{id}', 'PagesController@students');
Route::post('/classes-create', 'PagesController@storeClasses');
Route::post('/classes-delete', 'PagesController@deleteClasses');
Route::post('/student-create', 'PagesController@storeStudents');
Route::post('/student-delete', 'PagesController@deleteStudent');
Route::get('/student/{id}', 'PagesController@editStudent');
Route::post('/student-update', 'PagesController@updateStudent');

//records
Route::get('/records', 'PagesController@records');
Route::get('/records/{id}', 'PagesController@editUser');
Route::get('/user-action/delete/{id}', 'PagesController@deleteUser');
Route::get('/settings', 'PagesController@settings');
Route::post('/user-create', 'PagesController@storeUser');
Route::post('/user-update', 'PagesController@updateUser');

//reports
Route::get('/report', "PagesController@checkReports");
Route::get('/reports/{id}', "PagesController@reports");
Route::get('/reports/report/{id}', "PagesController@report");

//activitites
Route::get('/activities', 'PagesController@activities');
Route::get('/activities/{category}/{id}', 'PagesController@questions');
Route::get('/activity/{id}', 'PagesController@editActivity');
Route::get('/activities-action/delete/{id}', 'PagesController@deleteActivity');
Route::post('/activity-create', 'PagesController@storeActivity');
Route::post('/activity-update', 'PagesController@updateActivity');

//mobileapi
Route::get('/student/get/{email}', 'PagesController@getUserUsingEmail');
Route::get('/class/get', "PagesController@getClasses");
Route::get('/submit/testpaper/{student_id}/{score}/{asnwer_sheet}', "PagesController@submitPaper");
Route::get('/submit/student/{fname}/{lname}/{gender}/{contact}/{username}/{age}/{class_id}', "PagesController@submitStudent");
