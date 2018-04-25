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
use App\Event;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',function(){
	return view('register');
})->name('register');

Route::get('/login',function(){
	return view('login');
})->name('login');

Route::post('/register/save','UserController@save')->name('register/save');

Route::post('/login/authenticate','UserController@authenticate')->name('authenticate');

Route::post('/logout','UserController@logout')->name('logout');

Route::get('/dashboard','UserController@dashboard')->name('dashboard');

Route::get('/eventRegister',function(){
	return view('eventRegister');
})->name('eventRegister');

Route::post('event/Save','UserController@eventSave')->name('eventSave');
