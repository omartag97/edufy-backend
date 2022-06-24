<?php

use App\Http\Controllers\Apicontroller;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/register',          [Apicontroller::class ,'register']);
Route::post('/user/login',             [Apicontroller::class ,'login']);
Route::get('/user/meetings/all',             [Apicontroller::class ,'getAllMeetings']);
Route::post('/meeting/create',          [Apicontroller::class   ,'create']);
Route::post('/meeting/end',           [Apicontroller::class   ,'end']);
Route::post('/student/join-meeting',      [Apicontroller::class   ,'join']);
Route::post('/student/update-status',         [Apicontroller::class   ,'updateStatus']);




