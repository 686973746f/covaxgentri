<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaccinationCenter;

class VaccinationCenterController extends Controller
{
    public function index() {
        $list = VaccinationCenter::paginate(10);

        return view('vaccinationcenterlist_index', [
            'list' => $list,
        ]);
    }

    public function store(Request $request) {
        $request->validate([

        ]);

        if($request->is_mobile_vaccination == 'Yes') {
            $is_mobile = 1;
        }
        else {
            $is_mobile = 0;
        }

        $request->user()->vaccinationcenter()->create([
            'name' => mb_strtoupper($request->name),
            'card_prefix' => mb_strtoupper($request->card_prefix),
            'vaccinationsite_location' => mb_strtoupper($request->vaccinationsite_location),
            'vaccinationsite_country' => 'PHILIPPINES',
            'vaccinationsite_region' => $request->address_region_text,
            'vaccinationsite_region_code' => $request->address_region_code,
            'vaccinationsite_province' => $request->address_province_text,
            'vaccinationsite_province_code' => $request->address_province_code,
            'vaccinationsite_citymun' => $request->address_muncity_text,
            'vaccinationsite_citymun_code' => $request->address_muncity_code,
            'vaccinationsite_brgy' => $request->address_brgy_text,
            'vaccinationsite_brgy_code' => $request->address_brgy_text,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'is_mobile_vaccination' => $is_mobile,
            'notes' => $request->notes,
        ]);

        return redirect()->route('vaccinationcenters_index')
        ->with('msg', 'Vaccination Center '.$request->name.' has been added successfully.')
        ->with('msgtype', 'success');
    }

    public function edit() {
        
    }

    public function update() {
        
    }
}