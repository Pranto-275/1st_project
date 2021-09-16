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

Route::get('/', 'HomeController@HomeIndex')->middleware('logincheck');
Route::get('/visitor', 'VisitorController@VisitorIndex')->middleware('logincheck');

//admin panel service management
Route::get('/service', 'ServiceController@ServiceIndex')->middleware('logincheck');
Route::get('/getServiceData', 'ServiceController@getServiceData')->middleware('logincheck');
Route::post('/ServiceDelete', 'ServiceController@ServiceDelete')->middleware('logincheck');
Route::post('/ServiceDetails', 'ServiceController@getServiceDetails')->middleware('logincheck');
Route::post('/ServiceUpdate', 'ServiceController@ServiceUpdate')->middleware('logincheck');
Route::post('/ServiceAdd', 'ServiceController@ServiceAdd')->middleware('logincheck');



//admin panel Courses management
Route::get('/courses', 'CoursesController@CoursesIndex')->middleware('logincheck');
Route::get('/getCoursesData', 'CoursesController@getCourseData')->middleware('logincheck');
Route::post('/CoursesDelete', 'CoursesController@CoursesDelete')->middleware('logincheck');
Route::post('/CoursesDetails', 'CoursesController@getCoursesDetails')->middleware('logincheck');
Route::post('/CoursesUpdate', 'CoursesController@CoursesUpdate')->middleware('logincheck');
Route::post('/CoursesAdd', 'CoursesController@CoursesAdd')->middleware('logincheck');


//login

Route::get('/Login', 'loginController@loginFunction');
Route::post('/onLogin', 'loginController@onLogin');


//logout

Route::get('/Logout', 'loginController@onLogout');
