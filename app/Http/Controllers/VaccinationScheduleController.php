<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaccinationScheduleController extends Controller
{
    public function index() {
        return view('vaccination_schedule_index');
    }
}
