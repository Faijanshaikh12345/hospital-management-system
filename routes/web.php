<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// login routes
Route::get('/', [LoginController::class, 'showLogin'])
    ->name('login');

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

// logout routes
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// register routes
Route::get('/register', [RegisterController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');




Route::middleware('auth')->group(function () {
    // ======= dashboard ========
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    // ======= End dashboard ========

    // ======= users ========
    Route::resource('users', UserController::class)
        ->middleware('role:admin');
    // ======= End users ========

    // ======= departments ========
    Route::resource('departments', DepartmentController::class)
        ->only(['index'])
        ->middleware('role:admin,doctor,receptionist');

    Route::resource('departments', DepartmentController::class)
        ->except(['index', 'show'])
        ->middleware('role:admin');

    Route::resource('departments', DepartmentController::class)
        ->only(['show'])
        ->middleware('role:admin,doctor,receptionist');
    // ======= End departments ========

    // ======= doctors ========
    Route::resource('doctors', DoctorController::class)
        ->only(['index'])
        ->middleware('role:admin,doctor,receptionist');

    Route::resource('doctors', DoctorController::class)
        ->except(['index', 'show'])
        ->middleware('role:admin');

    Route::resource('doctors', DoctorController::class)
        ->only(['show'])
        ->middleware('role:admin,doctor,receptionist');
    // ======= End doctors ========

    // ======= Patients ========
    Route::resource('patients', PatientController::class)
        ->only(['index'])
        ->middleware('role:admin,doctor,receptionist,nurse');

    Route::resource('patients', PatientController::class)
        ->only(['create', 'store', 'edit', 'update'])
        ->middleware('role:admin,receptionist,doctor');

    Route::resource('patients', PatientController::class)
        ->only(['show'])
        ->middleware('role:admin,doctor,receptionist,nurse');

    Route::resource('patients', PatientController::class)
        ->only(['destroy'])
        ->middleware('role:admin');
    // ======= End Patients ========

    // ======= appointments ========
    Route::resource('appointments', AppointmentController::class)
        ->only(['index'])
        ->middleware('role:admin,doctor,receptionist,nurse,patient');

    Route::resource('appointments', AppointmentController::class)
        ->only(['create', 'store', 'edit', 'update'])
        ->middleware('role:admin,receptionist,doctor');

    Route::resource('appointments', AppointmentController::class)
        ->only(['show'])
        ->middleware('role:admin,doctor,receptionist,nurse,patient');

    Route::resource('appointments', AppointmentController::class)
        ->only(['destroy'])
        ->middleware('role:admin');
    // ======= End appointments ========

    // ======= prescriptions ========
    Route::resource('prescriptions', PrescriptionController::class)
        ->only(['index'])
        ->middleware('role:admin,doctor,nurse,patient');

    Route::resource('prescriptions', PrescriptionController::class)
        ->only(['create', 'store', 'edit', 'update'])
        ->middleware('role:admin,doctor');

    Route::resource('prescriptions', PrescriptionController::class)
        ->only(['show'])
        ->middleware('role:admin,doctor,nurse,patient');

    Route::resource('prescriptions', PrescriptionController::class)
        ->only(['destroy'])
        ->middleware('role:admin');
    // ======= End prescriptions ========


    // ======= prescriptions ========
    Route::resource('medicalRecord', MedicalRecordController::class)
        ->only(['index'])
        ->middleware('role:admin,doctor,nurse,patient');

    Route::resource('medicalRecord', MedicalRecordController::class)
        ->only(['create', 'store', 'edit', 'update'])
        ->middleware('role:admin,doctor');

    Route::resource('medicalRecord', MedicalRecordController::class)
        ->only(['show'])
        ->middleware('role:admin,doctor,nurse,patient');

    Route::resource('medicalRecord', MedicalRecordController::class)
        ->only(['destroy'])
        ->middleware('role:admin');
    // ======= End prescriptions ========


    // ======= medicines ========
    Route::resource('medicines', MedicineController::class)
        ->only(['index'])
        ->middleware('role:admin,doctor,nurse,patient');

    Route::resource('medicines', MedicineController::class)
        ->only(['create', 'store', 'edit', 'update'])
        ->middleware('role:admin,doctor');

    Route::resource('medicines', MedicineController::class)
        ->only(['show'])
        ->middleware('role:admin,doctor,nurse,patient');

    Route::resource('medicines', MedicineController::class)
        ->only(['destroy'])
        ->middleware('role:admin');
    // ======= End medicines ========

    // ======= admissions ========
    Route::resource('admissions', AdmissionController::class)
        ->only(['index'])
        ->middleware('role:admin,doctor,nurse,patient');

    Route::resource('admissions', AdmissionController::class)
        ->only(['create', 'store', 'edit', 'update'])
        ->middleware('role:admin,doctor,nurse');

    Route::resource('admissions', AdmissionController::class)
        ->only(['show'])
        ->middleware('role:admin,doctor,nurse,patient');

    Route::resource('admissions', AdmissionController::class)
        ->only(['destroy'])
        ->middleware('role:admin');
    // ======= End admissions ========

    // ======= billings ========
    Route::resource('billings', BillingController::class)
        ->only(['index'])
        ->middleware('role:admin,receptionist,doctor,patient');

    Route::resource('billings', BillingController::class)
        ->only(['create', 'store', 'edit', 'update'])
        ->middleware('role:admin,receptionist');

    Route::resource('billings', BillingController::class)
        ->only(['show'])
        ->middleware('role:admin,receptionist,doctor,patient');

    Route::resource('billings', BillingController::class)
        ->only(['destroy'])
        ->middleware('role:admin');
    // ======= End billings ========

    // ======= reports ========
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index')
        ->middleware('role:admin,receptionist');

    Route::get('/reports/export', [ReportController::class, 'export'])
        ->name('reports.export')
        ->middleware('role:admin,receptionist');
    // ======= End reports ========

    // ======= settings ========
    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index');

    Route::put('/settings/profile', [SettingController::class, 'updateProfile'])
        ->name('settings.profile.update');

    Route::put('/settings/password', [SettingController::class, 'updatePassword'])
        ->name('settings.password.update');
    // ======= End settings ========
});
