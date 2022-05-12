<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Support\Str;
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
            'ifpedia_requirements' => ($request->priority_group == 'ROPP') ? 'required|mimes:jpg,png,jpeg,pdf|max:10240' : 'nullable',
            'requirement_id_filepath' => 'required|mimes:jpg,png,jpeg,pdf|max:10240',
            'requirement_selfie' => 'required|mimes:jpg,png,jpeg|max:10240',
        ]);

        $checker1 = Patient::ifDuplicateFound($request->lname, $request->fname, $request->mname, $request->bdate);

        if(!($checker1)) {
            $sexf = substr($request->sex, 0, 1);

            if($request->priority_group == 'ROPP') {
                $pediafile = time().Str::random(20).'.'.$request->ifpedia_requirements->getClientOriginalExtension();
                $pediaupload = $request->ifpedia_requirements->move(public_path('registration'), $pediafile);
            }

            $requirement_file = time().Str::random(20).'.'.$request->requirement_id_filepath->getClientOriginalExtension();
            $pediaupload = $request->requirement_id_filepath->move(public_path('registration'), $requirement_file);

            $selfie_file = time().Str::random(20).'.'.$request->requirement_selfie->getClientOriginalExtension();
            $selfieupload = $request->requirement_selfie->move(public_path('registration'), $selfie_file);

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

                'ifpedia_guardian_lname' => ($request->priority_group == 'ROPP') ? $request->ifpedia_guardian_lname : NULL,
                'ifpedia_guardian_fname' => ($request->priority_group == 'ROPP') ? $request->ifpedia_guardian_fname : NULL,
                'ifpedia_guardian_mname' => ($request->priority_group == 'ROPP' && $request->filled('ifpedia_guardian_mname')) ? $request->ifpedia_guardian_mname : NULL,
                'ifpedia_guardian_suffix' => ($request->priority_group == 'ROPP' && $request->filled('ifpedia_guardian_suffix')) ? $request->ifpedia_guardian_suffix : NULL,

                'ifpedia_requirements' => ($request->priority_group == 'ROPP') ? $pediafile : NULL,

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

                'requirement_id_filepath' => $requirement_file,
                'requirement_selfie' => $selfie_file,

                'comorbid_list' => implode(',', $request->comorbid_list),
                'comorbid_others' => (in_array('Others', $request->comorbid_list)) ? $request->comorbid_others : NULL,
                'allergy_list' => $request->allergy_list,
            ]);

            return view('register_complete');
        }
        else {
            return redirect()->back()
            ->with('msg', 'Your record already ')
            ->with('msgtype', 'warning');
        }
    }
}
