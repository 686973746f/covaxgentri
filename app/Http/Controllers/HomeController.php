<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\VaccineList;
use Illuminate\Http\Request;
use App\Models\VaccinatorNames;
use App\Models\VaccinationCenter;
use App\Models\VaccinationSchedule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vcenter_list = VaccinationCenter::orderBy('name', 'asc')->get();
        $vaccine_list = VaccineList::orderBy('vaccine_name', 'asc')->get();

        return view('home', [
            'vcenter_list' => $vcenter_list,
            'vaccine_list' => $vaccine_list,
        ]);
    }

    public function encodevaccination_index() {
        if(request()->input('vaccinelist_id') == 'All') {
            $sched_list = VaccinationSchedule::where('is_active', 1)
            ->where('for_date', request()->input('for_date'))
            ->where('vaccination_center_id', request()->input('vaccination_center_id'))
            ->pluck('id')->toArray();
        }
        else {
            $sched_list = VaccinationSchedule::where('is_active', 1)
            ->where('for_date', request()->input('for_date'))
            ->where('vaccination_center_id', request()->input('vaccination_center_id'))
            ->where('vaccinelist_id', request()->input('vaccinelist_id'))
            ->pluck('id')->toArray();
        }

        session([
            'session_vaccinelist_id' => request()->input('vaccinelist_id'),
            'session_for_date' => request()->input('for_date'),
            'session_vaccination_center_id' => request()->input('vaccination_center_id')
        ]);

        //Should be also filtered by Vaccine Type soon
        $pending_list = Patient::where(function ($q) use ($sched_list) {
            $q->where(function ($r) use ($sched_list) {
                $r->whereIn('firstdose_schedule_id', $sched_list)
                ->where('firstdose_is_attended', 0);
            })
            ->orWhere(function ($r) use ($sched_list) {
                $r->whereIn('seconddose_schedule_id', $sched_list)
                ->where('seconddose_is_attended', 0);
            })
            ->orWhere(function ($r) use ($sched_list) {
                $r->whereIn('booster_schedule_id', $sched_list)
                ->where('booster_is_attended', 0);
            });
        })
        ->where('is_approved', 1)
        ->get();

        return view('encodevaccination_index', [
            'pending_list' => $pending_list,
        ]);
    }

    public function encodevaccination_viewpatient($id, $get_date) {
        $data = Patient::findOrFail($id);

        if($data->firstdose_original_date == $get_date) {
            $get_vaccinationschedule_id = $data->firstdose_schedule_id;
        }
        else if($data->seconddose_schedule_id == $get_date) {
            $get_vaccinationschedule_id = $data->seconddose_schedule_id;
        }
        else if($data->booster_schedule_id == $get_date) {
            $get_vaccinationschedule_id = $data->booster_schedule_id;
        }

        $vschedule = VaccinationSchedule::findOrFail($get_vaccinationschedule_id);
        $vaccinator_list = VaccinatorNames::orderBy('lname', 'ASC')->get();

        return view('encodevaccination_view', [
            'data' => $data,
            'vschedule' => $vschedule,
            'vaccinator_list' => $vaccinator_list,
        ]);
    }

    public function encodevaccination_actions(Request $request, $id, $vaccinationschedule_id) {
        $patient = Patient::findOrFail($id);
        $vschedule = VaccinationSchedule::findOrFail($vaccinationschedule_id);

        if($request->submit == 'accept') {
            if($patient->getNextBakuna() == $vschedule->sched_type) {
                if($vschedule->sched_type == '1ST DOSE') {
                    $patient->firstdose_is_deferred = 0;
                    $patient->firstdose_is_attended = 1;
                    $patient->firstdose_date = date('Y-m-d H:i:s');
                    $patient->firstdose_location = $vschedule->vaccinationcenter->name;
                    $patient->firstdose_site_injection = $request->site_injection;
                    $patient->firstdose_vaccine_id = $vschedule->vaccinelist_id;
                    $patient->firstdose_name = $vschedule->vaccinelist->vaccine_name;
                    $patient->firstdose_batchno = (!is_null($request->batchno)) ? $request->batchno : $vschedule->vaccinelist->default_batchno;
                    $patient->firstdose_lotno = (!is_null($request->lotno)) ? $request->lotno : $vschedule->vaccinelist->default_lotno;
                    $patient->firstdose_adverse_events = $request->adverse_events;
                    $patient->firstdose_vaccinator_name = $request->vaccinator_name;
                }
                else if($vschedule->sched_type == '2ND DOSE') {
                    $patient->seconddose_is_deferred = 0;
                    $patient->seconddose_is_attended = 1;
                    $patient->seconddose_date = date('Y-m-d H:i:s');
                    $patient->seconddose_location = $vschedule->vaccinationcenter->name;
                    $patient->seconddose_site_injection = $request->site_injection;
                    $patient->seconddose_vaccine_id = $vschedule->vaccinelist_id;
                    $patient->seconddose_name = $vschedule->vaccinelist->vaccine_name;
                    $patient->seconddose_batchno = (!is_null($request->batchno)) ? $request->batchno : $vschedule->vaccinelist->default_batchno;
                    $patient->seconddose_lotno = (!is_null($request->lotno)) ? $request->lotno : $vschedule->vaccinelist->default_lotno;
                    $patient->seconddose_adverse_events = $request->adverse_events;
                    $patient->seconddose_vaccinator_name = $request->vaccinator_name;
                }
                else if($vschedule->sched_type == 'BOOSTER') {
                    $patient->booster_is_deferred = 0;
                    $patient->booster_is_attended = 1;
                    $patient->booster_date = date('Y-m-d H:i:s');
                    $patient->booster_location = $vschedule->vaccinationcenter->name;
                    $patient->booster_site_injection = $request->site_injection;
                    $patient->booster_vaccine_id = $vschedule->vaccinelist_id;
                    $patient->booster_name = $vschedule->vaccinelist->vaccine_name;
                    $patient->booster_batchno = (!is_null($request->batchno)) ? $request->batchno : $vschedule->vaccinelist->default_batchno;
                    $patient->booster_lotno = (!is_null($request->lotno)) ? $request->lotno : $vschedule->vaccinelist->default_lotno;
                    $patient->booster_adverse_events = $request->adverse_events;
                    $patient->booster_vaccinator_name = $request->vaccinator_name;
                }
                else if($vschedule->sched_type == 'BOOSTER2') {
                    $patient->boostertwo_is_deferred = 0;
                    $patient->boostertwo_is_attended = 1;
                    $patient->boostertwo_date = date('Y-m-d H:i:s');
                    $patient->boostertwo_location = $vschedule->vaccinationcenter->name;
                    $patient->boostertwo_site_injection = $request->site_injection;
                    $patient->boostertwo_schedule_id = $vschedule->vaccinelist_id;
                    $patient->boostertwo_name = $vschedule->vaccinelist->vaccine_name;
                    $patient->boostertwo_batchno = (!is_null($request->batchno)) ? $request->batchno : $vschedule->vaccinelist->default_batchno;
                    $patient->boostertwo_lotno = (!is_null($request->lotno)) ? $request->lotno : $vschedule->vaccinelist->default_lotno;
                    $patient->boostertwo_adverse_events = $request->adverse_events;
                    $patient->boostertwo_vaccinator_name = $request->vaccinator_name;
                }

                $patient->save();
                
                return redirect()->route('encodevaccination_index', [
                    'for_date' => session('session_for_date'),
                    'vaccination_center_id' => session('session_vaccination_center_id'),
                    'vaccinelist_id' => session('vaccinelist_id'),
                ])
                ->with('msg', 'Patient has been accepted successfully.')
                ->with('msgtype', 'success');
            }
            else {
                return abort(401);
            }
        }
        else {
            if($patient->getNextBakuna() == $vschedule->sched_type) {
                if($vschedule->sched_type == '1ST DOSE') {
                    $patient->firstdose_is_deferred = 1;
                    $patient->firstdose_deferred_reason = $request->deferred_reason;
                    $patient->firstdose_deferred_date = date('Y-m-d H:i:s');
                }
                else if($vschedule->sched_type == '2ND DOSE') {
                    $patient->seconddose_is_deferred = 1;
                    $patient->seconddose_deferred_reason = $request->deferred_reason;
                    $patient->seconddose_deferred_date = date('Y-m-d H:i:s');
                }
                else if($vschedule->sched_type == 'BOOSTER') {
                    $patient->booster_is_deferred = 1;
                    $patient->booster_deferred_reason = $request->deferred_reason;
                    $patient->booster_deferred_date = date('Y-m-d H:i:s');
                }
                else if($vschedule->sched_type == 'BOOSTER2') {
                    $patient->boostertwo_is_deferred = 1;
                    $patient->boostertwo_deferred_reason = $request->deferred_reason;
                    $patient->boostertwo_deferred_date = date('Y-m-d H:i:s');
                }

                $patient->save();

                return redirect()->route('encodevaccination_index', [
                    'for_date' => session('session_for_date'),
                    'vaccination_center_id' => session('session_vaccination_center_id'),
                    'vaccinelist_id' => session('vaccinelist_id'),
                ])
                ->with('msg', 'Patient was rejected.')
                ->with('msgtype', 'success');
            }
            else {
                return abort(401);
            }
        }
    }

    public function vaccinationRegister() {
        return view('register');
    }
}
