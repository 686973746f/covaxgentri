<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\VaccineList;
use Illuminate\Http\Request;
use App\Models\VaccinationCenter;
use App\Models\VaccinationSchedule;
use Illuminate\Support\Facades\Auth;
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
            $sched_list = VaccinationSchedule::whereDate('for_date', '>=', date('Y-m-d'))
            ->where('vaccination_center_id', request()->input('pref_vcenter'))
            ->get();
        }
        else {
            $sched_list = VaccinationSchedule::whereDate('for_date', '>=', date('Y-m-d'))
            ->where('vaccination_center_id', request()->input('pref_vcenter'))
            ->where('vaccinelist_id', request()->input('pref_vaccine'))
            ->get();
        }

        $vcenter = VaccinationCenter::findOrFail(request()->input('pref_vcenter'));
        if(request()->input('pref_vaccine') == 'Any') {
            $for_vaccine = 'Any Vaccine';
        }
        else {
            $for_vaccine = VaccineList::where('id', request()->input('pref_vaccine'))->value('vaccine_name');
        }

        return view('userpatient_findschedule_index', [
            'sched_list' => $sched_list,
            'vcenter' => $vcenter,
            'for_vaccine' => $for_vaccine,
        ]);
    }

    public function findschedule_verify($id) {
        $data = VaccinationSchedule::findOrFail($id);

        $yournextbakuna = auth()->guard('patient')->user()->getNextBakuna();

        if($yournextbakuna != 'FINISHED') {
            if($data->sched_type == $yournextbakuna) {
                if($data->current_slots != $data->max_slots) {
                    return view('userpatient_findschedule_confirm', [
                        'data' => $data,
                    ]);
                }
                else {
                    return redirect()->route('findschedule_index', [
                        'pref_vcenter' => $data->vaccination_center_id,
                        'pref_vaccine' => $data->vaccinelist_id,
                    ])
                    ->with('msg', 'That particular schedule you selected is now full. Please seek other schedule and try again.')
                    ->with('msgtype', 'warning');
                }
            }
            else {
                return abort(401);
            }
        }
        else {
            return abort(401);
        }
    }

    public function findschedule_accept($id) {
        $patient = Patient::findOrFail(auth()->guard('patient')->user()->id);
        $data = VaccinationSchedule::findOrFail($id);

        $yournextbakuna = auth()->guard('patient')->user()->getNextBakuna();

        if($yournextbakuna != 'FINISHED') {
            if($data->sched_type == $yournextbakuna) {
                if($data->current_slots != $data->max_slots) {
                    if($data->sched_type == '1ST DOSE') {
                        $patient->firstdose_schedule_id = $data->id;
                        $patient->firstdose_schedule_date_by_user = date('Y-m-d');
                        $patient->firstdose_original_date = $data->for_date;
                    }
                    else if($data->sched_type == '2ND DOSE') {
                        $patient->seconddose_schedule_id = $data->id;
                        $patient->seconddose_schedule_date_by_user = date('Y-m-d');
                        $patient->seconddose_original_date = $data->for_date;
                    }
                    else if($data->sched_type == 'BOOSTER') {
                        $patient->booster_schedule_id  = $data->id;
                        $patient->booster_schedule_date_by_user = date('Y-m-d');
                        $patient->booster_original_date = $data->for_date;
                    }
    
                    $data->current_slots = $data->current_slots + 1;
    
                    $data->save();
    
                    $patient->save();
    
                    return view('userpatient_findschedule_success', [
                        'data' => $data,
                    ]);
                }
                else {
                    return redirect()->route('findschedule_index', [
                        'pref_vcenter' => $data->vaccination_center_id,
                        'pref_vaccine' => $data->vaccinelist_id,
                    ])
                    ->with('msg', 'That particular schedule you selected is now full. Please seek other schedule and try again.')
                    ->with('msgtype', 'warning');
                }
            }
            else {
                return abort(401);
            }
        }
        else {
            return abort(401);
        }
    }

    public function currentsched_view() {
        return view('userpatient_currentsched_index');
    }

    public function currentsched_cancel() {
        //Vaccination Schedule should not be cancelled on the stated date
    }
}
