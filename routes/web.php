<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/cert', [UsersController::class, 'indexCert'])->name('cert')->middleware('can:auth-access-user');
Route::post('/cert/{id}', [UsersController::class, 'certificate']);

Route::get('/event', [EventController::class, 'index'])->name('event')->middleware('can:manage-users');
Route::post('/reg-event', [EventController::class, 'store'])->name('reg-event')->middleware('can:manage-users');
Route::put('/event', [EventController::class, 'update'])->name('edit-event')->middleware('can:manage-users');
Route::delete('/event/{id}', [EventController::class, 'destroy'])->name('del-event')->middleware('can:manage-users');
Route::get('/qr', [EventController::class, 'QR'])->name('qrscanner')->middleware('can:auth-access-user');
Route::post('/api/scan',[EventController::class, 'checkQrcode'])->name('scanqr.post')->middleware('can:auth-access-user');

Route::get('/attendance', [EventController::class, 'attendanceindex'])->name('attindex')->middleware('can:auth-access-user');
Route::post('/attendance/reg/{id}', [EventController::class, 'insertAtt'])->name('attindex-reg')->middleware('can:auth-access-user');
Route::delete('/attendance/del/{id}', [EventController::class, 'delAtt'])->name('attindex-del')->middleware('can:auth-access-user');

Route::get('/participants/{id}', [EventController::class, 'viewParticipants'])->name('vP')->middleware('can:auth-access-user');
Route::get('/transaction', [EventController::class, 'viewTransactions'])->name('vT')->middleware('can:auth-access-user');

Route::post('/appoint/reg', [EventController::class, 'appointAdd'])->name('reg-appoint')->middleware('can:auth-access-user');
Route::get('/report', [EventController::class, 'reportIndex'])->name('reporting')->middleware('can:auth-access-user');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});
