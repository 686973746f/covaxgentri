<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VaccineListController;
use App\Http\Controllers\PatientLoginController;
use App\Http\Controllers\VaccinatorNameController;
use App\Http\Controllers\VaccinationCenterController;
use App\Http\Controllers\PatientRegistrationController;
use App\Http\Controllers\VaccinationScheduleController;

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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['isPatient']], function() {
    Route::get('/patient/home', [PatientController::class, 'patient_home'])->name('patient_home');
    Route::get('/patient/find_schedule', [PatientController::class, 'findschedule_index'])->name('findschedule_index');

    Route::post('/patient/home/sched_cancel', [PatientController::class, 'currentsched_cancel'])->name('currentsched_cancel');

    Route::get('/patient/profile', [PatientController::class, 'profile_index'])->name('profile_index');
});

Route::group(['middleware' => ['isPatient', 'ifNextDoseReady']], function() {
    Route::get('/patient/find_schedule/verify/{vaccination_schedule_id}', [PatientController::class, 'findschedule_verify'])->name('findschedule_verify');
    Route::post('/patient/find_schedule/verify/{vaccination_schedule_id}', [PatientController::class, 'findschedule_accept'])->name('findschedule_accept');
});

Route::group(['middleware' => ['guest']], function() {
    Route::get('/patient_login', [PatientLoginController::class, 'patient_login'])->name('patient_login');
    Route::post('/patient_login', [PatientLoginController::class, 'authenticate'])->name('patient_authenticate');
    Route::get('/vaccination/register', [PatientRegistrationController::class, 'register'])->name('vaccination.register');
    Route::post('/vaccination/register', [PatientRegistrationController::class, 'register_store'])->name('vaccination_register_store');
});

//Admin and Encoder
Route::group(['middleware' => ['isAdmin', 'isEncoder']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/patient_list', [AdminController::class, 'pending_list'])->name('patient_view_index');
    Route::get('/patient_records', [AdminController::class, 'existing_list'])->name('patient_existing_index');
    Route::get('/patient_list/view/{id}', [AdminController::class, 'patient_view'])->name('patient_view');
    Route::post('/patient_list/view/{id}', [AdminController::class, 'patient_action'])->name('patient_action');

    Route::get('/encode_vaccination', [HomeController::class, 'encodevaccination_index'])->name('encodevaccination_index');
    Route::get('/encode_vaccination/view/{patient_id}/{get_date}', [HomeController::class, 'encodevaccination_viewpatient'])->name('encodevaccination_viewpatient');
    Route::post('/encode_vaccination/view/{patient_id}/{vaccinationschedule_id}', [HomeController::class, 'encodevaccination_actions'])->name('encodevaccination_actions');

    Route::get('/walkin_create', [AdminController::class, 'walkin_create'])->name('walkin_create');
    Route::post('/walkin_create', [AdminController::class, 'walkin_store'])->name('walkin_store');
});

Route::group(['middleware' => ['isAdmin']], function() {
    Route::get('/admin/vaccinators', [VaccinatorNameController::class, 'index'])->name('vaccinators_index');
    Route::post('/admin/vaccinators', [VaccinatorNameController::class, 'store'])->name('vaccinators_store');

    Route::get('/admin/vaccination_centers', [VaccinationCenterController::class, 'index'])->name('vaccinationcenters_index');
    Route::post('/admin/vaccination_centers', [VaccinationCenterController::class, 'store'])->name('vaccinationcenters_store');

    Route::get('/admin/vaccine_list', [VaccineListController::class, 'index'])->name('vaccinelist_index');
    Route::post('/admin/vaccine_list', [VaccineListController::class, 'store'])->name('vaccinelist_store');

    Route::get('/admin/vaccination_schedule', [VaccinationScheduleController::class, 'index'])->name('vaccinationschedule_index');
    Route::post('/admin/vaccination_schedule', [VaccinationScheduleController::class, 'createsched'])->name('vaccinationschedule_createsched');
});

Route::get('/', function () {
    if(Auth::check()) {
        return redirect()->route('home');
    }
    else if(Auth::guard('patient')->check()) {
        return redirect()->route('patient_home');
    }
    else {
        return view('login_select');
    }
})->name('main');