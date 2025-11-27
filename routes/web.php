<?php

use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


Route::middleware([AdminAuth::class])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.pages.dashboard.index');

    // Patient Management
    Route::prefix('admin/patients')->name('admin.patients.')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('index');
        Route::get('/create', [PatientController::class, 'create'])->name('create');
        Route::post('/store', [PatientController::class, 'store'])->name('store');
        Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('edit');
        Route::put('/{patient}', [PatientController::class, 'update'])->name('update');
        Route::get('/{patient}', [PatientController::class, 'show'])->name('show');
        Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('destroy');
    });

});
