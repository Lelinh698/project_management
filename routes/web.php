<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@getLogout');

Route::group(['prefix' => 'admin', 'middleware' => 'menu.admin'],function(){
	Route::get('/', 'ProjectController@index');

	Route::group(['prefix' => 'file'], function(){
	});

	Route::group(['prefix'=>'assess'], function(){
	});

	Route::group(['prefix'=>'plan'], function(){	
		Route::get('/', 'PlanController@index');
		Route::post('department/store', 'PlanController@dstore');
	});

	Route::group(['prefix'=>'project'], function(){
		Route::get('/', 'ProjectController@index');
		Route::get('create', 'ProjectController@create');
		Route::post('store', 'ProjectController@store');
		Route::get('edit/{id}', 'ProjectController@edit');
		Route::post('update', 'ProjectController@update');
		Route::get('delete/{id}', 'ProjectController@destroy');
		Route::get('{id}', 'ProjectController@getProjectInfo');
	});
	
	Route::group(['prefix'=>'student'], function(){
		Route::get('/', 'StudentController@index');
		Route::get('create', 'StudentController@create');
		Route::post('store', 'StudentController@store');
		Route::get('edit/{id}', 'StudentController@edit');
		Route::post('update', 'StudentController@update');
		Route::get('delete/{id}', 'StudentController@destroy');
	});

	Route::group(['prefix'=>'teacher'], function(){
		Route::get('/','TeacherController@index');
		// Route::get('create', 'TeacherController@create');
		Route::post('store', 'TeacherController@store');
		Route::get('edit/{id}', 'TeacherController@edit');
		Route::post('update', 'TeacherController@update');
		Route::get('delete/{id}', 'TeacherController@destroy');
	});

	Route::get('department_criteria', function() {
		return view('admin.criteria');
	});

	Route::post('addstudent', 'AdminController@addstudent');

	Route::get('filelist/{id}', 'AdminController@filelist');
	Route::get('planlist/{id}', 'AdminController@planlist');
	Route::get('plancreate/{id}', 'AdminController@plancreate');
	Route::post('planstore', 'AdminController@planstore');
	Route::get('assesslist/{id}', 'AdminController@assesslist');
	Route::post('assesscreate{id}', 'AdminController@assesscreate');
});

Route::group(['prefix' => 'teacher', 'middleware' => 'menu.teacher'],function(){
	Route::get('/', 'ProjectController@index');
	Route::get('project/{id}', 'ProjectController@getProjectInfo');
	Route::post('plan', 'PlanController@index');
	Route::get('plancreate/{id}', 'PlanController@create');
	Route::post('planstore', 'PlanController@store');
	
	Route::group(['prefix'=>'file'], function() {
		Route::get('document', 'FileController@document');
		Route::post('document/upload', 'FileController@documentUpload');
	});
});

Route::group(['prefix' => 'student'],function(){
	Route::get('/', 'ProjectController@index');
	Route::get('project/{id}', 'ProjectController@getProjectInfo');
	Route::group(['prefix'=>'plan'], function(){	
		Route::get('/', 'PlanController@getDepartmentPlan');
	});

	Route::group(['prefix'=>'file'], function() {
		Route::get('report', 'FileController@report');
		Route::post('report/upload', 'FileController@reportUpload');
		Route::get('progress_result', 'FileController@progress_result');
		Route::post('progress_result/upload', 'FileController@progress_resultUpload');
	});
});
Route::get('file/getfile/{filename}', 'FileController@getfile')->name('getfile');
Route::post('ajax_criteria', 'AjaxController@ajaxCriteria');
Route::post('end_criteria', 'AjaxController@endCriteria');
Route::get('ajax_student', 'AjaxController@ajaxStudent');
Route::get('ajax_teacher', 'AjaxController@ajaxTeacher');
Route::post('ajax_get_student', 'AjaxController@getStudent');