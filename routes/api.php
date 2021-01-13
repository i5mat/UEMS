<?php

use App\Http\Controllers\Admin\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('logout', 'Api\AuthController@logout');

//Route::post('events/create', [EventController::class, 'createEvent'])->middleware('jwtAuth');
//Route::post('events/delete', [EventController::class, 'deleteEvent'])->middleware('jwtAuth');
//Route::post('events/update', [EventController::class, 'updateEvent'])->middleware('jwtAuth');

Route::get('events', [EventController::class, 'viewEvent']);

Route::post('attendance/create', [EventController::class, 'createAttendanceAndroid']);
