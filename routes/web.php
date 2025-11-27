<?php

use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PatientVisitController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


Route::middleware([AdminAuth::class])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.pages.dashboard.index');

    Route::prefix('admin/patients')->name('admin.patients.')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('index');
        Route::get('/create', [PatientController::class, 'create'])->name('create');
        Route::post('/store', [PatientController::class, 'store'])->name('store');
        Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('edit');
        Route::post('/{patient}', [PatientController::class, 'update'])->name('update');
        Route::get('/{patient}', [PatientController::class, 'show'])->name('show');
        Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('destroy');
        Route::post('/{patient}/visits', [PatientVisitController::class, 'store'])->name('visits.store');
    });

    Route::prefix('admin/appointments')->name('admin.appointments.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AppointmentController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\AppointmentController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\AppointmentController::class, 'store'])->name('store');
        Route::get('/{appointment}/edit', [App\Http\Controllers\Admin\AppointmentController::class, 'edit'])->name('edit');
        Route::post('/{appointment}', [App\Http\Controllers\Admin\AppointmentController::class, 'update'])->name('update');
        Route::delete('/{appointment}', [App\Http\Controllers\Admin\AppointmentController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/doctors')->name('admin.doctors.')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('index');
        Route::get('/create', [DoctorController::class, 'create'])->name('create');
        Route::post('/store', [DoctorController::class, 'store'])->name('store');
        Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('edit');
        Route::post('/{doctor}', [DoctorController::class, 'update'])->name('update');
        Route::post('/{doctor}/toggle-status', [DoctorController::class, 'toggleStatus'])->name('toggleStatus');
    });

    Route::prefix('admin/inventory')->name('admin.inventory.')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('index');
        Route::post('/store', [InventoryController::class, 'store'])->name('store');
        Route::post('/{inventory}', [InventoryController::class, 'update'])->name('update');
    });

    Route::prefix('admin/pharmacy')->middleware('auth:admin')->group(function() {
        Route::get('/', [PharmacyController::class, 'index'])->name('admin.pharmacy.index');
        Route::get('/pending', [PharmacyController::class, 'pending'])->name('admin.pharmacy.pending');
        Route::get('/{prescription}', [PharmacyController::class, 'show'])->name('admin.pharmacy.show');
        Route::post('/{prescription}/dispense', [PharmacyController::class, 'dispense'])->name('admin.pharmacy.dispense');
    });

    Route::prefix('admin/billing')->name('admin.billing.')->group(function () {
        Route::get('/', [BillingController::class, 'index'])->name('index');
        Route::get('/create', [BillingController::class, 'create'])->name('create');
        Route::post('/store', [BillingController::class, 'store'])->name('store');
        Route::get('/{billing}', [BillingController::class, 'show'])->name('show');
    });
});
