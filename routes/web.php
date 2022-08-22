<?php

use App\Events\LikeEvent;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\UploadController;
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

Auth::routes(['verify' => true]);
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('verified');
// Route::get('/', [NotifController::class, 'index'])->middleware('verified');
Route::post('/', [LikeController::class, 'store'])->middleware('verified');

// routers admin
Route::group(['middleware' => ['CekUserLogin:admin']], function () {
    Route::resource('postingan', PostinganController::class);
});

// routers user
Route::group(['middleware' => ['CekUserLogin:user']], function () {
    Route::resource('upload', UploadController::class);
});