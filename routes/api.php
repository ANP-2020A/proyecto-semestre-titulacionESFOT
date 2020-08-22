<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('projects/{project}/cronogram', 'ProjectController@cronogram');

Route::group(['middleware' => ['jwt.verify']], function () {
    //users
    Route::get('user', 'UserController@getAuthenticatedUser');
    //teachers plans
    Route::get('teachers-plans', 'TeacherPlanController@index');
    Route::get('teachers-plans/{teacherplan}', 'TeacherPlanController@show');
    Route::post('teachers-plans', 'TeacherPlanController@store');
    Route::put('teachers-plans/{teacherplan}', 'TeacherPlanController@update');
    Route::delete('teachers-plans/{teacherplan}', 'TeacherPlanController@delete');

//project
    Route::get('projects', 'ProjectController@index');
    Route::get('projects/{project}', 'ProjectController@show');
    Route::post('students/{students}/projects', 'ProjectController@store');
    Route::put('projects/{project}', 'ProjectController@update');
    Route::delete('projects/{project}', 'ProjectController@delete');


//student
    Route::get('students', 'StudentController@index');
    Route::get('students/{student}', 'StudentController@show');
    Route::put('students/{student}', 'StudentController@update');
    Route::delete('students/{student}', 'StudentController@delete');

    Route::get('students/{student}/projects/{project}', 'StudentController@project');

//project cronogram

//teacher
    Route::get('teachers', 'TeacherController@index');
    Route::get('teachers/{teacher}', 'TeacherController@show');
    Route::put('teachers/{teacher}', 'TeacherController@update');
    Route::delete('teachers/{teacher}', 'TeacherController@delete');
    Route::get('teachers/{teacher}/projects', 'TeacherController@projects');
    Route::get('teachers/{teacher}/projects/{project}', 'TeacherController@project');
    Route::get('teachers/{teacher}/ideas', 'TeacherController@ideas');
    Route::get('teachers/{teacher}/ideas/{idea}', 'TeacherController@idea');

});
