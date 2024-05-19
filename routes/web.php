<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', Role::class])->group(function() {
    Route::prefix('user')->name('user.')->group(function () {

    });
});

Route::middleware(['auth', Role::class])->group(function() {
    Route::prefix('admin')->name('admin.')->group(function () {

    });
});

Route::middleware(['auth', Role::class])->group(function() {
    Route::prefix('superadmin')->name('superadmin.')->group(function () {

    });
});