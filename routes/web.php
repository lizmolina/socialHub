<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginTwitterController;
use App\Http\Controllers\PostTwitterController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\QueueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard-user', function () {
    return view('dashboard-user');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // routes/web.php

Route::get('/auth/linkedin', 'Auth\LoginController@redirectToLinkedIn');
Route::get('/auth/linkedin/callback', 'Auth\LoginController@handleLinkedInCallback');

});
Route::get('login/twitter', [LoginTwitterController::class, 'loginTwitter']);
//Route::middleware(['auth:sanctum', 'verified'])->get('login/twitter', [LoginTwitterController::class, 'loginTwitter']);
//Route::middleware(['auth:sanctum', 'verified'])->get('login/twitter/callback', [LoginTwitterController::class, 'getToken'])->name('k');

Route::get('login/twitter/callback', [LoginTwitterController::class, 'getToken'])->name('k');
Route::middleware(['auth:sanctum', 'verified'])->get('posts', [PostTwitterController::class, 'index'])->name('posts');
Route::middleware(['auth:sanctum', 'verified'])->post('store', [PostTwitterController::class, 'store']);

Route::middleware(['auth:sanctum', 'verified'])->post('twitter/post', [PostTwitterController::class, 'store'])->name('twitter-post');

Route::middleware(['auth:sanctum', 'verified'])->get('schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::middleware(['auth:sanctum', 'verified'])->get('schedule/{schedule:id}', [ScheduleController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->get('create', [ScheduleController::class, 'create'])->name('schedule-create');
Route::middleware(['auth:sanctum', 'verified'])->post('store', [ScheduleController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->put('update/{schedule:id}', [ScheduleController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->delete('delete/{schedule:id}', [ScheduleController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'verified'])->get('queue', [QueueController::class, 'index'])->name('queue');
