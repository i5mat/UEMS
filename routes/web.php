<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UsersController;
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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cert', [UsersController::class, 'indexCert'])->name('cert');
Route::post('/cert/{id}', [UsersController::class, 'certificate']);

Route::get('/event', [EventController::class, 'index'])->name('event');
Route::post('/reg-event', [EventController::class, 'store'])->name('reg-event');
Route::put('/event/{id}', [EventController::class, 'update'])->name('edit-event');

Route::get('/calendar', [EventController::class, 'Calendar'])->name('calendar');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});
