<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\DashboardController;

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

Route::redirect('/', '/admin');

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        /**
         * Auth Routes
         */
        Route::get('login', [AuthController::class, 'getLogin'])->name('auth.getLogin')->middleware('guest:admin');
        Route::post('login', [AuthController::class, 'postLogin'])->name('auth.postLogin');

        Route::middleware(['auth:admin', 'check_permission'])->group(function () {
            /**
             * Auth Routes
             */
            Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

            /**
             * Dashboard Routes
             */
            Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');

            /**
             * Admins Routes
             */
            Route::resource('admins', AdminsController::class);

            /**
             * Roles/Permissions Routes
             */
            Route::resource('roles', RolesController::class);
            Route::get('permissions/update', [RolesController::class, 'updatePermissions'])->name('permissions.update');
        });
    });
