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
        
    }

    public function edit() {
        
    }

    public function update() {
        
    }
}