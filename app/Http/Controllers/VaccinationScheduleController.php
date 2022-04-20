<?php

namespace App\Http\Controllers;

use App\Models\VaccineList;
use Illuminate\Http\Request;
use App\Models\VaccinationCenter;

class VaccinationScheduleController extends Controller
{
    public function index() {
        $vclist = VaccinationCenter::get();
        $vaccine_list = VaccineList::get();
        
        return view('vaccination_schedule_index', [
            'vclist' => $vclist,
            'vaccine_list' => $vaccine_list,
        ]);
    }

    public function createsched(Request $request) {
        $request->validate([
        ]);

        $request->user()->vaccinationschedule()->create([
            'for_date' => $request->for_date,
            'vaccinelist_id' => $request->vaccinelist_id,
            'sched_type' => $request->sched_type,
            'is_active' => 1,
            'is_adult' => ($request->is_adult == 'Yes') ? 1 : 0,
            'is_pedia' => ($request->is_pedia == 'Yes') ? 1 : 0,
            'sched_timestart' => $request->sched_timestart,
            'sched_timeend' => $request->sched_timeend,
            'max_slots' => $request->max_slots,
            'vaccination_center_id' => $request->vaccination_center_id,
        ]);


        return redirect()->route('vaccinationschedule_index')
        ->with('msg', 'Vaccination Schedule has been created successfully.')
        ->with('msgtype', 'success');
    }
}
