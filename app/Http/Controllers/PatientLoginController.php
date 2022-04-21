<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PatientLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function guard() {
        return Auth::guard('patient');
    }

    public function patient_login() {
        return view('patient_login');
    }

    public function username() {
        return 'username';
    }
    
    public function authenticate(Request $request) {
        $credentials = $request->only('username', 'password');
        
        if (Auth::guard('patient')->attempt($credentials)) {
            $user = Patient::where('username', $request->username)->first();

            if($user->is_approved == 1) {
                Auth::guard('patient')->login($user);
                return redirect()->intended(route('patient_home'));
            }
            else {
                return back()->with('msg', 'Your account is not yet Activated by the Staff. Please come back later.')
                ->with('msgtype', 'warning');
            }
        }
        else {
            $un = Patient::where('username', $request->username)->first();

            if($un) {
                return back()->with('msg', 'Invalid Password. Please try again.')
                ->with('msgtype', 'danger');
            }
            else {
                return back()->with('msg', 'Username does not exist on this server.')
                ->with('msgtype', 'danger');
            }
        }
    }
}
