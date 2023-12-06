<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginTwitterController;

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
});
Route::get('login/twitter', [LoginTwitterController::class, 'loginTwitter']);
//Route::middleware(['auth:sanctum', 'verified'])->get('login/twitter', [LoginTwitterController::class, 'loginTwitter']);
//Route::middleware(['auth:sanctum', 'verified'])->get('login/twitter/callback', [LoginTwitterController::class, 'getToken'])->name('k');

Route::get('login/twitter/callback', [LoginTwitterController::class, 'getToken'])->name('k');
