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
        Route::post('/', [Admin\UserController::class, 'save'])->name('_save');
        Route::get('/add', [Admin\UserController::class, 'addOrUpdate'])->name('_add');
        Route::get('/delete/{id}', [Admin\UserController::class, 'delete'])->name('_delete');
        Route::get('/update/{id}', [Admin\UserController::class, 'addOrUpdate'])->name('_update');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/profile',
    'as' => 'profile',
    ], function () {
        Route::get('/', [Admin\ProfileController::class, 'index']);
        Route::post('/save', [Admin\ProfileController::class, 'save'])->name('_save');
        Route::post('/change-password', [Admin\ProfileController::class, 'changePassword'])->name('_change_password');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/roles',
    'as' => 'roles',
    ], function () {
        Route::get('/', [Admin\RoleController::class, 'index']);
        Route::post('/', [Admin\RoleController::class, 'save'])->name('_save');
        Route::get('/add', [Admin\RoleController::class, 'addOrUpdate'])->name('_add');
        Route::get('/delete/{id}', [Admin\RoleController::class, 'delete'])->name('_delete');
        Route::get('/update/{id}', [Admin\RoleController::class, 'addOrUpdate'])->name('_update');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/menus',
    'as' => 'menus',
    ], function () {
        Route::get('/', [Admin\MenuController::class, 'index']);
        Route::post('/', [Admin\MenuController::class, 'save'])->name('_save');
        Route::get('/add', [Admin\MenuController::class, 'addOrUpdate'])->name('_add');
        Route::get('/delete/{id}', [Admin\MenuController::class, 'delete'])->name('_delete');
        Route::get('/update/{id}', [Admin\MenuController::class, 'addOrUpdate'])->name('_update');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/settings',
    'as' => 'settings',
    ], function () {
        Route::get('/', [Admin\SettingController::class, 'index']);
        Route::get('/configuration', [Admin\SettingController::class, 'configuration'])->name('_configuration');
        Route::post('/configuration', [Admin\SettingController::class, 'configurationSave'])->name('_configuration_save');
        Route::get('/integration', [Admin\SettingController::class, 'integration'])->name('_integration');
        Route::get('/integration/add', [Admin\SettingController::class, 'integrationAddOrUpdate'])->name('_integration_add');
        Route::get('/integration/{id}', [Admin\SettingController::class, 'integrationAddOrUpdate'])->name('_integration_update');
        Route::post('/integration', [Admin\SettingController::class, 'integrationSave'])->name('_integration_save');
});