<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaccinatorNames;

class VaccinatorNameController extends Controller
{
    public function index() {
        //Route name: vaccinators_index
        $list = VaccinatorNames::paginate(10);

        return view('vaccinatorlist_index', [
            'list' => $list,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'lname' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
    		'fname' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
    		'mname' => 'nullable|regex:/^[\pL\s\-]+$/u|max:50',
            'suffix' => 'nullable|regex:/^[\pL\s\-]+$/u|max:4',
        ]);

        $request->user()->vaccinatorname()->create([
           'lname' => mb_strtoupper($request->lname),
           'fname' => mb_strtoupper($request->fname),
           'mname' => $request->filled('mname') ? mb_strtoupper($request->mname) : NULL,
           'suffix' => $request->filled('suffix') ? mb_strtoupper($request->suffix) : NULL,
        ]);

        return redirect()->route('vaccinators_index')
        ->with('msg', 'Vaccinator has been added successfully.')
        ->with('msgtype', 'success');
    }

    public function edit() {

    }

    public function update() {

    }
}
