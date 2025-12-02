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
use App\Http\Controllers\Admin\PharmacistController; 
use App\Http\Controllers\Admin\ReceptionistController; 
use App\Http\Controllers\Auth\AdminLoginController;

use App\Http\Middleware\DoctorAuth;
use App\Http\Controllers\Doctor\DoctorDashboardController;
use App\Http\Controllers\Doctor\DoctorProfileController;
use App\Http\Controllers\Doctor\DoctorPatientController;

use App\Http\Middleware\PharmacistAuth;
use App\Http\Controllers\Pharmacist\PharmacistDashboardController;
use App\Http\Controllers\Pharmacist\PharmacistInventoryController;
use App\Http\Controllers\Pharmacist\PharmacistDispenseController;

use App\Http\Middleware\ReceptionistAuth;
use App\Http\Controllers\Receptionist\ReceptionistDashboardController;
use App\Http\Controllers\Receptionist\ReceptionistPatientController;


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
        Route::get('/{prescription}', [PharmacyController::class, 'show'])->name('show');
    });

    Route::prefix('admin/pharmacists')->name('admin.pharmacists.')->group(function () {
        Route::get('/', [PharmacistController::class, 'index'])->name('index');
        Route::get('/create', [PharmacistController::class, 'create'])->name('create');
        Route::post('/', [PharmacistController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PharmacistController::class, 'edit'])->name('edit');
        Route::post('/{id}', [PharmacistController::class, 'update'])->name('update');
    });
    
    Route::prefix('admin/receptionists')->name('admin.receptionists.')->group(function () {
        Route::get('/', [ReceptionistController::class, 'index'])->name('index');
        Route::post('/store', [ReceptionistController::class, 'store'])->name('store');
        Route::put('/{receptionist}', [ReceptionistController::class, 'update'])->name('update');
    });    

    Route::prefix('admin/billing')->name('admin.billing.')->group(function () {
        Route::get('/', [BillingController::class, 'index'])->name('index');
        Route::get('/create', [BillingController::class, 'create'])->name('create');
        Route::post('/store', [BillingController::class, 'store'])->name('store');
        Route::get('/{billing}', [BillingController::class, 'show'])->name('show');
    });
});

Route::middleware([DoctorAuth::class])->group(function () {

    Route::prefix('doctor/dashboard')->name('doctor.dashboard.')->group(function () {
        Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('index');
    });

    Route::prefix('doctor/profile')->name('doctor.profile.')->group(function () {
        Route::get('/', [DoctorProfileController::class, 'index'])->name('index');
        Route::post('/schedule/store', [DoctorProfileController::class, 'store'])->name('schedule.store');
    });   
    
    Route::prefix('doctor/patients')->name('doctor.patients.')->group(function () {
        Route::get('/', [DoctorPatientController::class, 'index'])->name('index');
        Route::get('/{patients}', [DoctorPatientController::class, 'show'])->name('show');
        Route::post('/{id}/visit/store', [DoctorPatientController::class, 'storeVisit'])->name('visits.store');
        Route::post('/patients/{id}/prescriptions/store', [DoctorPatientController::class, 'storePrescription'])->name('prescriptions.store');

    });
});


Route::middleware([PharmacistAuth::class])->group(function () {

    Route::prefix('pharmacist/dashboard')->name('pharmacist.dashboard.')->group(function () {
        Route::get('/dashboard', [PharmacistDashboardController::class, 'index'])->name('index');
    });

    Route::prefix('pharmacist/stock')->name('pharmacist.stock.')->group(function () {
        Route::get('/', [PharmacistInventoryController::class, 'index'])->name('index');
    });

    Route::prefix('pharmacist/dispense')->name('pharmacist.dispense.')->group(function () {
        Route::get('/', [PharmacistDispenseController::class, 'index'])->name('index');
        Route::post('/{prescription}/dispense', [PharmacistDispenseController::class, 'dispense'])->name('dispense');
    });

    Route::post('/logout', [PharmacistLoginController::class, 'logout'])->name('logout');
});

Route::middleware([ReceptionistAuth::class])->group(function () {

    Route::prefix('receptionist/dashboard')->name('receptionist.dashboard.')->group(function () {
        Route::get('/', [ReceptionistDashboardController::class, 'index'])->name('index');
    });

    Route::prefix('receptionist/patients')->name('receptionist.patients.')->group(function () {
        Route::get('/', [ReceptionistPatientController::class, 'index'])->name('index');
        Route::get('/create', [ReceptionistPatientController::class, 'create'])->name('create');
        Route::get('/{patient}', [ReceptionistPatientController::class, 'show'])->name('show');
    });    

    Route::post('/logout', [ReceptionistLoginController::class, 'logout'])->name('logout');
});