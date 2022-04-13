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
        ]);

        $request->user()->vaccinelist()->create([
            'vaccine_name' => mb_strtoupper($request->vaccine_name),
            'default_batchno' => mb_strtoupper($request->default_batchno),
            'default_lotno' => mb_strtoupper($request->default_lotno),
            'expiration_date' => $request->expiration_date,
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
