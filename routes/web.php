<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/main', [MainController::class, 'index'])->middleware('auth');
Route::post('/main', [MainController::class, 'compressVideo'])->middleware('auth');

// Route::get('/download-file/{filename}', function ($filename) {
//     $flask_url = "http://127.0.0.1:5000/download_video/{$filename}";
//     return redirect($flask_url);
// })->name('download.file');



Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/history', VideoController::class);
    Route::resource('/user', UserController::class);
    Route::post('/user/reset-password', [UserController::class, 'resetPasswordAdmin'])->name('user.password');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::resource('/register', RegisterController::class)->middleware('guest');
