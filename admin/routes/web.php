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

Route::get('/', 'HomeController@HomeIndex');
Route::get('/visitor', 'VisitorController@VisitorIndex');

//admin panel service management
Route::get('/service', 'ServiceController@ServiceIndex');
Route::get('/getServiceData', 'ServiceController@getServiceData');
Route::post('/ServiceDelete', 'ServiceController@ServiceDelete');
Route::post('/ServiceDetails', 'ServiceController@getServiceDetails');
Route::post('/ServiceUpdate', 'ServiceController@ServiceUpdate');
Route::post('/ServiceAdd', 'ServiceController@ServiceAdd');
