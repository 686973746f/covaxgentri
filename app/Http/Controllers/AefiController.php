<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class AefiController extends Controller
{
    public function index() {

    }

    public function create($patient_id) {
        $data = Patient::findOrFail($patient_id);

        return view('aefi_create', [
            'data' => $data,
        ]);
    }

    public function store($patient_id, Request $request) {

    }

    public function edit($aefi_id) {

    }

    public function update($aefi_id, Request $request) {

    }
}
