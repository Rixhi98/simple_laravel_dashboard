<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/up_profile_pic', function () {
    return view('upload_profile_pic');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/update_password', 'UserController@update_password')->name('update_password');
Route::post('/change_password', 'UserController@change_password')->name('Change_password');

Route::post('/change_profile_pic', 'UserController@change_profile_pic')->name('Change_profile_pic');
Route::get('/get_profile_pic', 'UserController@get_profile_pic')->name('Get_profile_pic');
Route::get('/user_manager', 'UserController@user_manager')->name('user_manager');
Route::post('/create_user', 'UserController@create_user')->name('Create_user');

Route::get('/show_department', 'DepartmentController@show_departments');
Route::post('/create_department', 'DepartmentController@create_department')->name('Create_department');
Route::get('/departments', 'DepartmentController@show_departments_view')->name('Departments');
Route::post('/send_text', 'ChatController@submit_text')->name('Send_text');
Route::get('/get_text', 'ChatController@get_text')->name('get_text');