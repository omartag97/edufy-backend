<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//user
Route::post('/users/register',          [UserController::class ,'register']);
Route::post('/users/login',             [UserController::class ,'login']);
Route::get('/meetingNumber',           [UserController::class , 'getAllMeetings']);
//meeting
Route::post('/meeting/create',         [MeetingController::class   ,'store']);
Route::post('/meeting/update',         [MeetingController::class   ,'update']);
Route::post('/meeting/ShowStudents',   [MeetingController::class   , 'ShowStudents']);
//student
Route::post('/students/create',        [StudentController::class   ,'store']);
Route::post('/students/add',           [StudentController::class   ,'add']);
