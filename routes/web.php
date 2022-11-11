<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientPaymentController;
use App\Http\Controllers\SupplierPaymentController;

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
             * Colors Routes
             */
            Route::resource('colors', ColorController::class);

            /**
             * Clients Routes
             */
            Route::resource('clients', ClientController::class);

            /**
             * Orders Routes
             */
            Route::resource('orders', OrderController::class);

            /**
             * ClientPayments Routes
             */
            Route::resource('clientPayments', ClientPaymentController::class);

            /**
             * Suppliers Routes
             */
            Route::resource('suppliers', SupplierController::class);

            /**
             * Supplies Routes
             */
            Route::resource('supplies', SupplyController::class);

            /**
             * SupplierPayments Routes
             */
            Route::resource('supplierPayments', SupplierPaymentController::class);

            /**
             * Expenses Routes
             */
            Route::resource('expenses', ExpenseController::class);

            /**
             * Roles/Permissions Routes
             */
            Route::resource('roles', RolesController::class);
            Route::get('permissions/update', [RolesController::class, 'updatePermissions'])->name('permissions.update');
        });
    });
