<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

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
        Route::get('/', [Admin\AuthController::class, 'index']);
        Route::get('login', [Admin\AuthController::class, 'index']);
        Route::post('login', [Admin\AuthController::class, 'login'])->name('login');
        Route::get('logout', [Admin\AuthController::class, 'logout'])->name('logout');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/dashboard',
    'as' => 'dashboard',
    ], function () {
        Route::get('/', [Admin\DashboardController::class, 'index']);
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/users',
    'as' => 'users',
    ], function () {
        Route::get('/', [Admin\UserController::class, 'index']);
        Route::get('/add', [Admin\UserController::class, 'addOrUpdate'])->name('_add');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/roles',
    'as' => 'roles',
    ], function () {
        Route::get('/', [Admin\RoleController::class, 'index']);
        Route::get('/add', [Admin\RoleController::class, 'addOrUpdate'])->name('_add');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/settings',
    'as' => 'settings',
    ], function () {
        Route::get('/', [Admin\SettingController::class, 'index']);
        Route::get('/configuration', [Admin\SettingController::class, 'configuration'])->name('_configuration');
        Route::get('/integration', [Admin\SettingController::class, 'integration'])->name('_integration');
});