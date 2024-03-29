<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
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

Route::get('/report', [EventController::class, 'reportIndex'])->name('reporting')->middleware('can:manage-users');

Route::post('/files', 'DocumentController@store');
Route::get('/upload', 'DocumentController@index')->name('show_cert');
Route::get('/file/download/{file}','DocumentController@download');
Route::delete('/files/del/{id}', 'DocumentController@destroy');
Route::post('/upload/approve/{id}', 'DocumentController@approvalCert');

Route::get('/profile', 'DocumentController@userProfile')->name('user_profile');
Route::post('/profile/{id}', 'DocumentController@updateProfile')->name('update_profile');

Route::get('/calendar', [EventController::class, 'calendarIndex'])->name('show_calendar');
Route::get('/appoint', [EventController::class, 'appointIndex'])->name('appoint_view');
Route::delete('/appoint/del/{id}', [EventController::class, 'appointTerminate'])->name('appoint_del');

Route::get('/user/dashboard', [HomeController::class, 'userDash'])->name('usr-dash');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});
