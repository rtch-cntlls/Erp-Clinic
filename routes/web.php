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
use App\Http\Controllers\Admin\CashierController; 
use App\Http\Controllers\Auth\AdminLoginController;

use App\Http\Middleware\DoctorAuth;
use App\Http\Controllers\Doctor\DoctorDashboardController;
use App\Http\Controllers\Doctor\DoctorProfileController;
use App\Http\Controllers\Doctor\DoctorPatientController;

use App\Http\Middleware\PharmacistAuth;
use App\Http\Controllers\Pharmacist\PharmacistDashboardController;
use App\Http\Controllers\Pharmacist\PharmacistInventoryController;
use App\Http\Controllers\Pharmacist\PharmacistDispenseController;
use App\Http\Controllers\Pharmacist\PharmacistProfileController;

use App\Http\Middleware\ReceptionistAuth;
use App\Http\Controllers\Receptionist\ReceptionistDashboardController;
use App\Http\Controllers\Receptionist\ReceptionistPatientController;
use App\Http\Controllers\Receptionist\ReceptionistAppointmentController;

use App\Http\Middleware\CashierAuth;
use App\Http\Controllers\Cashier\CashierDashboardController;
use App\Http\Controllers\Cashier\CashierInvoiceController;
use App\Http\Controllers\Cashier\CashierProfileController;
use App\Http\Controllers\Auth\CashierLoginController;


use App\Http\Middleware\PatientAuth;
use App\Http\Controllers\Auth\PatientLoginController;
use App\Http\Controllers\Patient\LandingController;
use App\Http\Controllers\Patient\PatientAppointmentController;
use App\Http\Controllers\Patient\PatientPrescriptionsController;

Route::get('patient/login', [PatientLoginController::class, 'showLoginForm'])->name('patient.login.form');
Route::post('patient/login', [PatientLoginController::class, 'login'])->name('patient.login');
Route::post('patient/register', [PatientLoginController::class, 'register'])->name('patient.register');
Route::post('patient/logout', [PatientLoginController::class, 'logout'])->name('patient.logout');

Route::get('auth/google/redirect', [PatientLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [PatientLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/', [LandingController::class, 'index'])->name('patient.landing');
Route::middleware([PatientAuth::class])->group(function () {

    Route::post('/appointment/store', [LandingController::class, 'store'])
        ->name('patient.appointment.store');

    Route::get('/patient/appointments', [PatientAppointmentController::class, 'index'])->name('patient.appointments.index');

    Route::post('/patient/appointments/{appointment}/cancel', [PatientAppointmentController::class, 'cancel'])
        ->name('patient.appointments.cancel');

    Route::get('/patient/prescriptions', [PatientPrescriptionsController::class, 'index'])
        ->name('patient.prescriptions.index');
});



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
        Route::get('/{doctor}/show', [DoctorController::class, 'show'])->name('show');
        Route::post('/{doctor}', [DoctorController::class, 'update'])->name('update');
        Route::post('/{doctor}/toggle-status', [DoctorController::class, 'toggleStatus'])->name('toggleStatus');

        Route::get('/export/csv', [DoctorController::class, 'exportCsv'])->name('export.csv');
        Route::get('/export/pdf', [DoctorController::class, 'exportPdf'])->name('export.pdf');
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
        Route::post('/{id}/toggle-status', [PharmacistController::class, 'toggleStatus'])->name('toggleStatus');

        Route::get('/export/csv', [PharmacistController::class, 'exportCsv'])->name('exportCsv');
        Route::get('/export/pdf', [PharmacistController::class, 'exportPdf'])->name('exportPdf');
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

    Route::prefix('admin/cashiers')->name('admin.cashiers.')->group(function () {
        Route::get('/', [CashierController::class, 'index'])->name('index');
        Route::get('/create', [CashierController::class, 'create'])->name('create');
        Route::get('/{cashier}', [CashierController::class, 'show'])->name('show');
        Route::post('/store', [CashierController::class, 'store'])->name('store');
        Route::post('/{cashier}', [CashierController::class, 'update'])->name('update');
        Route::post('/{cashier}/toggle-status', [CashierController::class, 'toggleStatus'])->name('toggleStatus');
        Route::get('/export/csv', [CashierController::class, 'exportCsv'])->name('export.csv');
        Route::get('/export/pdf', [CashierController::class, 'exportPdf'])->name('export.pdf');
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

    Route::prefix('pharmacist/profile')->name('pharmacist.profile.')->group(function () {
        Route::get('profile', [PharmacistProfileController::class, 'index'])->name('index');
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
        Route::post('/patients/{patient}', [ReceptionistPatientController::class, 'update'])->name('update');
    });    

    Route::prefix('receptionist/appointments')->name('receptionist.appointments.')->group(function () {
        Route::get('/', [ReceptionistAppointmentController::class, 'index'])->name('index');
        Route::post('/approve/{appointment}', [ReceptionistAppointmentController::class, 'approve'])->name('approve');
    });

    Route::post('/logout', [ReceptionistLoginController::class, 'logout'])->name('logout');
});


Route::middleware([CashierAuth::class])->group(function () {

    Route::prefix('cashier/dashboard')->name('cashier.dashboard.')->group(function () {
        Route::get('/', [CashierDashboardController::class, 'index'])->name('index');
    });

    Route::prefix('cashier/invoices')->name('cashier.invoices.')->group(function () {
        Route::get('/', [CashierInvoiceController::class, 'index'])->name('index');
        Route::get('/create', [CashierInvoiceController::class, 'create'])->name('create');
        Route::post('/store', [CashierInvoiceController::class, 'store'])->name('store');
        Route::get('/{invoice}/edit', [CashierInvoiceController::class, 'edit'])->name('edit');
        Route::post('/{invoice}', [CashierInvoiceController::class, 'update'])->name('update');
        Route::post('/{invoice}/paid', [CashierInvoiceController::class, 'markPaid'])->name('paid');
    });

    Route::prefix('cashier/profile')->name('cashier.profile.')->group(function () {
        Route::get('/', [CashierProfileController::class, 'index'])->name('index');
        Route::post('/update', [CashierProfileController::class, 'update'])->name('update');
    });
});