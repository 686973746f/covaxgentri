<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PatientController extends Controller
{
    use AuthenticatesUsers;

    public function guard() {
        return Auth::guard('patient');
    }
    
    public function patient_home() {
        return view('home_patient');
    }
}
