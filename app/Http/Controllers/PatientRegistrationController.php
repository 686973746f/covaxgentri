<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientRegistrationController extends Controller
{
    public function register() {
        return view('register');
    }

    public function register_store(Request $request) {
        $request->validate([
            'username' => 'unique:patients,username',
            'password' => 'required|confirmed',
        ]);

        $sexf = substr($request->sex, 0, 1);

        Patient::create([
            'registration_type' => 'registration',
            'is_approved' => 0,
            'priority_group' => $request->priority_group,
            'is_pwd' => $request->is_pwd,
            'is_indigenous' => $request->is_indigenous,
            
            'lname' => mb_strtoupper($request->lname),
            'fname' => mb_strtoupper($request->fname),
            'mname' => $request->filled('mname') ? mb_strtoupper($request->mname) : NULL,
            'suffix' => $request->filled('suffix') ? mb_strtoupper($request->suffix) : NULL,
            'bdate' => $request->bdate,
            'sex' => $sexf,
            'if_female_pregnant' => ($sexf == 'F') ? $request->if_female_pregnant : 0,
            'if_female_lactating' => ($sexf == 'F') ? $request->if_female_lactating : 0,
            'cs' => $request->cs,
            'nationality' => mb_strtoupper($request->nationality),
            'contactno' => $request->contactno,
            'email' => $request->email,
            'philhealth' => $request->philhealth,

            'address_region_text' => $request->address_region_text,
            'address_province_text' => $request->address_province_text,
            'address_muncity_text' => $request->address_muncity_text,

            'address_region_code' => $request->address_region_code,
            'address_province_code' => $request->address_province_code,
            'address_muncity_code' => $request->address_muncity_code,
            'address_brgy_code' => $request->address_brgy_text,
            'address_brgy_text' => $request->address_brgy_text,

            'address_houseno' => mb_strtoupper($request->address_houseno),
            'address_street' => mb_strtoupper($request->address_street),

            'username' => $request->username,
            'password' => Hash::make($request->password),

            'ipadd' => request()->ip(),
        ]);

        return view('register_complete');
    }
}
