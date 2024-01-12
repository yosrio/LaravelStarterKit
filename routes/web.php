<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;

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

Route::group([
    'prefix' => '/',
    'as' => '',
    ], function () {
        Route::get('/', [AuthController::class, 'index']);
        Route::get('login', [AuthController::class, 'index']);
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/dashboard',
    'as' => 'dashboard',
    ], function () {
        Route::get('/', [DashboardController::class, 'index']);
});