<?php

namespace App\Http\Controllers;

use App\Models\VaccineList;
use Illuminate\Http\Request;

class VaccineListController extends Controller
{
    public function index() {
        //Route Name: vaccinelist_index
        $list = VaccineList::paginate(10);

        return view('vaccinelist_index', [
            'list' => $list,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'vaccine_name' => 'required',
        ]);

        $request->user()->vaccinelist()->create([
            'vaccine_name' => mb_strtoupper($request->vaccine_name),
            'short_name' => mb_strtoupper($request->short_name),
            'default_batchno' => mb_strtoupper($request->default_batchno),
            'default_lotno' => mb_strtoupper($request->default_lotno),
            'expiration_date' => $request->expiration_date,
            'seconddose_nextdosedays' => $request->seconddose_nextdosedays,
            'booster_nextdosedays' => $request->booster_nextdosedays,
            'is_singledose' => $request->is_singledose,
        ]);

        return redirect()->route('vaccinelist_index')
        ->with('msg', 'Vaccine data has been added successfully.')
        ->with('msgtype', 'success');
    }

    public function edit() {
        
    }

    public function update() {

    }
}
