<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\VaccineList;
use Illuminate\Http\Request;
use App\Models\VaccinationCenter;
use App\Models\VaccinationSchedule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PatientController extends Controller
{
    use AuthenticatesUsers;

    public function guard() {
        return Auth::guard('patient');
    }
    
    public function patient_home() {
        $vcenter_list = VaccinationCenter::orderBy('name', 'asc')->get();
        $vaccine_list = VaccineList::orderBy('vaccine_name', 'asc')->get();

        return view('home_patient', [
            'vcenter_list' => $vcenter_list,
            'vaccine_list' => $vaccine_list,
        ]);
    }

    public function findschedule_index() {
        if(request()->input('pref_vaccine') == 'Any') {
            $sched_list = VaccinationSchedule::where('vaccination_center_id', request()->input('pref_vcenter'))->get();
        }
        else {
            $sched_list = VaccinationSchedule::where('vaccination_center_id', request()->input('pref_vcenter'))
            ->where('vaccinelist_id', request()->input('pref_vaccine'))
            ->get();
        }

        return view('userpatient_findschedule_index', [
            'sched_list' => $sched_list,
        ]);
    }

    public function findschedule_verify($id) {
        $data = VaccinationSchedule::findOrFail($id);

        return view('userpatient_findschedule_confirm', [
            'data' => $data,
        ]);
    }
}
