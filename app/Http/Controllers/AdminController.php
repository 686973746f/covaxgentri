<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Support\Str;
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

    public function existing_list() {
        $list = Patient::where('is_approved', 1)
        ->orderBy('lname', 'ASC')
        ->paginate(10);

        return view('patient_completed_index', [
            'list' => $list,
        ]);
    }

    public function patient_view($id) {
        $data = Patient::findOrFail($id);

        return view('patient_view', [
            'data' => $data,
        ]);
    }

    public function patient_action(Request $request, $id) {
        $patient = Patient::findOrFail($id);

        $patient->date_processed = date('Y-m-d H:i:s');

        if($request->action == 'accept') {
            $foundunique = false;

            while(!$foundunique) {
                $for_qr = Str::random(20);
                
                $search = Patient::where('qr_id', $for_qr)->first();
                if($search->count() == 0) {
                    $foundunique = true;
                }
            }
            
            $patient->is_approved = 1;
            $patient->qr_id = $for_qr;
            $patient->created_by = auth()->user()->id;

            $patient->save();

            return redirect()->route('patient_view_index')
            ->with('msg', 'Patient '.$patient->getName().' (ID #'.$patient->id.') has been successfully approved.')
            ->with('msgtype', 'success');
        }
        else if($request->action == 'reject') {
            $patient->action_remarks = $request->action_remarks;
            $patient->save();

            return redirect()->route('patient_view_index')
            ->with('msg', 'Patient '.$patient->getName().' (ID #'.$patient->id.') has been successfully rejected.')
            ->with('msgtype', 'success');
        }
        else if($request->action == 'update') {
        
        }
    }

    public function walkin_create() {

    }

    public function walkin_store(Request $request) {

    }

    public function patient_viewprofile($id) {

    }

    public function patient_editprofile($id) {

    }
    
    public function patient_updateprofile($id) {

    }
}
