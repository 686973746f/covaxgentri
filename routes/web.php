<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Auth;
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



Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['guest']], function() {
    Route::get('/vaccination/register', [PatientController::class, 'register'])->name('vaccination.register');
    Route::post('/vaccination/register', [PatientController::class, 'register_store'])->name('vaccination_register_store');
});

Route::get('/', function () {
    return view('auth.login');
})->name('main');