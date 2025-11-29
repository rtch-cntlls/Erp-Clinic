<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\PatientVisitController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Auth\AdminLoginController;

use App\Http\Middleware\DoctorAuth;
use App\Http\Controllers\Doctor\DoctorDashboardController;
use App\Http\Controllers\Doctor\DoctorProfileController;

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
        Route::get('/{patient}', [PatientController::class, 'show'])->name('show');
        Route::post('/{patient}/visits', [PatientVisitController::class, 'store'])->name('visits.store');
        Route::get('/patients/export/csv', [PatientController::class, 'exportCsv'])->name('export.csv');
        Route::get('/patients/export/pdf', [PatientController::class, 'exportPdf'])->name('export.pdf');
    });

    Route::prefix('admin/appointments')->name('admin.appointments.')->group(function () {
        Route::get('/', [AppointmentController::class, 'index'])->name('index');
        Route::get('/create', [AppointmentController::class, 'create'])->name('create');
        Route::post('/store', [AppointmentController::class, 'store'])->name('store');
        Route::get('/{appointment}/edit', [AppointmentController::class, 'edit'])->name('edit');
        Route::post('/{appointment}', [AppointmentController::class, 'update'])->name('update');
        Route::delete('/{appointment}', [AppointmentController::class, 'destroy'])->name('destroy');
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

    Route::prefix('admin/pharmacy')->name('admin.pharmacy.')->group(function() {
        Route::get('/', [PharmacyController::class, 'index'])->name('index');
        Route::get('/pending', [PharmacyController::class, 'pending'])->name('pending');
        Route::get('/{prescription}', [PharmacyController::class, 'show'])->name('show');
        Route::post('/{prescription}/dispense', [PharmacyController::class, 'dispense'])->name('dispense');
    });

    Route::prefix('admin/billing')->name('admin.billing.')->group(function () {
        Route::get('/', [BillingController::class, 'index'])->name('index');
        Route::get('/create', [BillingController::class, 'create'])->name('create');
        Route::post('/store', [BillingController::class, 'store'])->name('store');
        Route::get('/{billing}', [BillingController::class, 'show'])->name('show');
    });

    Route::middleware([DoctorAuth::class])->group(function () {

        Route::prefix('doctor/dashboard')->name('doctor.dashboard.')->group(function () {
            Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('index');
        });

        Route::prefix('doctor/profile')->name('doctor.profile.')->middleware([DoctorAuth::class])->group(function () {
            Route::get('/', [DoctorProfileController::class, 'index'])->name('index');
            Route::post('/schedule/store', [DoctorProfileController::class, 'store'])->name('schedule.store');
        });        
    });
});
