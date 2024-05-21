<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\User_role;
use App\Http\Middleware\Admin_role;
use App\Http\Middleware\Super_admin_role;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\ContinentController;

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


Route::middleware(['auth', User_role::class])->group(function() {
    Route::prefix('user')->name('user.')->group(function () {

    });
});

Route::middleware(['auth', Admin_role::class])->group(function() {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('/barangay', BarangayController::class);
        Route::resource('/city', CityController::class);
        Route::resource('/civil', CivilStatusController::class);
        Route::resource('/continent', ContinentController::class);
    });
});

Route::middleware(['auth', Super_admin_role::class])->group(function() {
    Route::prefix('superadmin')->name('superadmin.')->group(function () {

    });
});