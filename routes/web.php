<?php

use Illuminate\Http\Request;
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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/{id}', 'UserController@profile')->name('user.profile');

Route::get('/edit/user/', 'UserController@edit')->name('user.edit');
Route::post('/edit/user/', 'UserController@update')->name('user.update');

Route::get('/edit/password/user/', 'UserController@passwordEdit')->name('password.edit');
Route::post('/edit/password/user/', 'UserController@passwordUpdate')->name('password.update');

Route::post('/upload', 'UserController@uploadAvatar');

Route::get('/files/create', 'DocumentController@create');
Route::post('/files', 'DocumentController@store');

Route::get('/homes', 'DocumentController@index');
Route::get('/files/{id}','DocumentController@show');

Route::get('/file/download/{file}','DocumentController@download');

Route::match(['get', 'post'], '/botman', 'BotManController@handle');