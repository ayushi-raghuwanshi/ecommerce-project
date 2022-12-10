<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserManagement\Permissioncontroller;
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


// Route::prefix()
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // permission routes
    Route::controller(PermissionController::class)->group(function () {
        Route::get('/getPermissionList', 'getPermissionList')->name('getPermissionList');
        Route::get('/addPermission', 'addPermission')->name('add-permission');
        Route::post('/storePermission', 'storePermission')->name('store-permission');
        Route::get('/editPermission/{id}', 'editPermission')->name('edit-permission');
        Route::get('/deletePermission/{id}', 'deletePermission')->name('delete-permission');
    });
});

require __DIR__.'/auth.php';
