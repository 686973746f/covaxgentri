<?php

namespace App\Http\Controllers;

use App\Models\VaccineList;
use Illuminate\Http\Request;
use App\Models\VaccinationCenter;

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

    public function vaccinationRegister() {
        return view('register');
    }
}
