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
        //Second Dose Validation
        if(auth()->guard('patient')->user()->getNextBakuna() == '2ND DOSE') {
            if(request()->input('pref_vaccine') != auth()->guard('patient')->user()->getFirstBakunaDetails()->id) {
                return abort(401);
            }
        }

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

        if($sched_list->count() != 0) {
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
        else {
            return redirect()->route('patient_home')
            ->with('msg', 'Walang schedule na nakita base sa hinahanap mo.')
            ->with('msgtype', 'warning');
        }
    }

    public function findschedule_verify($id) {
        $data = VaccinationSchedule::findOrFail($id);

        //Second Dose Validation
        if(auth()->guard('patient')->user()->getNextBakuna() == '2ND DOSE') {
            if($data->vaccinelist_id != auth()->guard('patient')->user()->getFirstBakunaDetails()->id) {
                return abort(401);
            }
        }

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

        //Second Dose Validation
        if(auth()->guard('patient')->user()->getNextBakuna() == '2ND DOSE') {
            if($data->vaccinelist_id != auth()->guard('patient')->user()->getFirstBakunaDetails()->id) {
                return abort(401);
            }
        }

        $yournextbakuna = auth()->guard('patient')->user()->getNextBakuna();

        if($yournextbakuna != 'FINISHED') {
            if($data->sched_type == $yournextbakuna) {
                if($data->current_slots != $data->max_slots) {
                    if($data->sched_type == '1ST DOSE') {
                        $patient->firstdose_schedule_id = $data->id;
                        $patient->firstdose_schedule_date_by_user = date('Y-m-d H:i:s');
                        $patient->firstdose_original_date = $data->for_date;
                    }
                    else if($data->sched_type == '2ND DOSE') {
                        $patient->seconddose_schedule_id = $data->id;
                        $patient->seconddose_schedule_date_by_user = date('Y-m-d H:i:s');
                        $patient->seconddose_original_date = $data->for_date;
                    }
                    else if($data->sched_type == 'BOOSTER') {
                        $patient->booster_schedule_id  = $data->id;
                        $patient->booster_schedule_date_by_user = date('Y-m-d H:i:s');
                        $patient->booster_original_date = $data->for_date;
                    }
                    else if($data->sched_type == 'BOOSTER2') {
                        $patient->boostertwo_schedule_id  = $data->id;
                        $patient->boostertwo_schedule_date_by_user = date('Y-m-d H:i:s');
                        $patient->boostertwo_original_date = $data->for_date;
                    }
    
                    $data->current_slots = $data->current_slots + 1;
    
                    $data->save();
    
                    $patient->save();
    
                    return view('userpatient_findschedule_success', [
                        'data' => $data,
                        'patient' => $patient,
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
        $patient = Patient::findOrFail(auth()->guard('patient')->user()->id);

        //Vaccination Schedule should not be cancelled on the stated date
        if($patient->getNextBakuna() == '1ST DOSE') {
            $getsched_id = $patient->firstdose_schedule_id;

            $patient->firstdose_schedule_id = NULL;
            $patient->firstdose_schedule_date_by_user = NULL;
            $patient->firstdose_original_date = NULL;
        }
        else if($patient->getNextBakuna() == '2ND DOSE') {
            $getsched_id = $patient->seconddose_schedule_id;

            $patient->seconddose_schedule_id = NULL;
            $patient->seconddose_schedule_date_by_user = NULL;
            $patient->seconddose_original_date = NULL;
        }
        else if($patient->getNextBakuna() == 'BOOSTER') {
            $getsched_id = $patient->booster_schedule_id;

            $patient->booster_schedule_id = NULL;
            $patient->booster_schedule_date_by_user = NULL;
            $patient->booster_original_date = NULL;
        }
        else if($patient->getNextBakuna() == 'BOOSTER2') {
            $getsched_id = $patient->boostertwo_schedule_id;

            $patient->boostertwo_schedule_id  = NULL;
            $patient->boostertwo_schedule_date_by_user = NULL;
            $patient->boostertwo_original_date = NULL;
        }
        else {
            return abort(401);
        }

        $vschedule = VaccinationSchedule::findOrFail($getsched_id);

        if(strtotime(date('Y-m-d')) > strtotime(auth()->guard('patient')->user()->getCurrentSchedData()->for_date)) {
            $vschedule->current_slots = $vschedule->current_slots - 1;

            $vschedule->save();
        }
        
        $patient->save();

        return redirect()->route('patient_home')
        ->with('msg', 'Your schedule has been successfully cancelled. You may pick another new schedule.')
        ->with('msgtype', 'success');
    }

    public function profile_index() {
        $data = Patient::findOrFail(auth()->guard('patient')->user()->id);
        return view('userpatient_profile', [
            'data' => $data,
        ]);
    }
}
