<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserManagement\Permissioncontroller;
use App\Http\Controllers\Admin\UserManagement\RoleController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // user management routes
        Route::prefix('user-management')->group(function () {
            // permission group
            Route::prefix('permission')->name('permission.')->controller(PermissionController::class)->group(function () {
                Route::get('/', 'getLists')->name('list');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::get('/delete/{id}', 'destroy')->name('destroy');
            });
            // role group
            Route::prefix('role')->name('role.')->controller(RoleController::class)->group(function () {
                Route::get('/', 'lists')->name('list');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::get('/delete/{id}', 'destroy')->name('destroy');
            });
        });
    });
});

require __DIR__ . '/auth.php';
