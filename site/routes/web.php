<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'HomeController@HomeIndex');

Route::post('/contactsend', 'HomeController@Contactsend');
