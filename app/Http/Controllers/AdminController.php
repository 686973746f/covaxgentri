<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function pending_list() {
        $list = Patient::where('is_approved', 0)
        ->orderBy('created_at', 'asc')
        ->paginate(10);

        return view('patient_index', [
            'list' => $list,
        ]);
    }

    public function patient_view($id) {
        $data = Patient::findOrFail($id);

        return view('patient_view', [
            'data' => $data,
        ]);
    }

    public function patient_action() {
        
    }
}
