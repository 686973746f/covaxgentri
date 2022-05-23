@extends('layouts.app')

@section('content')
<form action="{{route('aefi_store', ['patient_id' => $data->id])}}" method="POST">
    @csrf
    <div class="container">
        <div class="card">
            <div class="card-header"><strong>Create NEW AEFI Case Investigation Form for {{ucwords(strtolower($data->getName()))}} (#{{$data->id}})</strong></div>
            <div class="card-body">
                <div class="alert alert-info" role="alert">
                    <p>For all AEFIs, regardless of seriousness, Item I. to IV. must be filled up. For identified serious AEFI cases, succeeding pages are mandatory. Immediately notify the Local Epidemiology Surveillance Unit (ESU). Please fill out all blanks and put a check mark on the appropriate box. Never leave an item blank (write N/A). Item with <strong>* (asterisk)</strong> are mandatory fields.</p>
                </div>
                <div class="alert alert-info" role="alert">
                    <p><strong>NOTE:</strong> According to Republic Act No. 11332 Revised IRR Rule VI Sec. 6, "The aforementioned details are crucial and indispensable for the formulation of appropriate policies and disease respponse activities. Hence, health professionals conducting the interview at point of first contact shall obtain such details from a suspect case, properly informing the data subject that the information sought to be obtained is being processed in accordance with Republic Act No. 10173, or the "Data Privacy Act of 2012," and that deliberately providing false or misleading personal information on the part of the person, or the next of kin in case of person's incapacity, may constitute as non-cooperation punishable under the Act or this IRR."</p>
                    <p>Information provided here is for surveillance and investigation use only in the context of detection of safety signals, addressing vaccine hesitancy, and potential claims from PHIC VICP.</p>
                    <p>Information submitted here may not be used for medico-legal purposes, or performance of medical or clinical audit to the management of the health care providers.</p>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>I. REPORTER'S INFORMATION</strong></div>
                    <div class="card-body">
                        <div>
                            <label for="vigiflow_id" class="form-label">VigiFlow ID <small><i>(If Applicable)</i></small></label>
                            <input type="text" class="form-control" name="vigiflow_id" id="vigiflow_id" value="{{old('vigiflow_id')}}">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                  <label for="p1_dru_name" class="form-label"><strong class="text-danger">*</strong>Name of Facility/Disease Reporting Unit (DRU)</label>
                                  <input type="text" class="form-control" name="p1_dru_name" id="p1_dru_name" value="{{old('p1_dru_name', 'CHO GENERAL TRIAS')}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="p1_dru_region" class="form-label"><strong class="text-danger">*</strong>Facility/DRU Region</label>
                                            <input type="text" class="form-control" name="p1_dru_region" id="p1_dru_region" value="{{old('p1_dru_region', 'IV-A')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="p1_dru_province" class="form-label"><strong class="text-danger">*</strong>Facility/DRU Province</label>
                                            <input type="text" class="form-control" name="p1_dru_province" id="p1_dru_province" value="{{old('p1_dru_province', 'CAVITE')}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="p1_dru_type" class="form-label"><strong class="text-danger">*</strong>Type of Facility/DRU</label>
                                    <input type="text" class="form-control" name="p1_dru_type" id="p1_dru_type" value="{{old('p1_dru_type', 'CITY HEALTH OFFICE')}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="p1_contactno" class="form-label"><strong class="text-danger">*</strong>Contact Number <small><i>(Landline or Mobile)</i></small></label>
                                    <input type="text" class="form-control" name="p1_contactno" id="p1_contactno" value="{{old('p1_contactno', '09190664324')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="p1_reporter_name" class="form-label"><strong class="text-danger">*</strong>Full Name of Reporter</label>
                                    <input type="text" class="form-control" name="p1_reporter_name" id="p1_reporter_name" value="{{old('p1_reporter_name')}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="p1_reporter_designation" class="form-label">Designation of Reporter</label>
                                    <input type="text" class="form-control" name="p1_reporter_designation" id="p1_reporter_designation" value="{{old('p1_reporter_designation')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="p1_reporter_prc" class="form-label">PRC Registration Number</label>
                                    <input type="text" class="form-control" name="p1_reporter_prc" id="p1_reporter_prc" value="{{old('p1_reporter_prc')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="p1_reporter_email" class="form-label">Email address</label>
                                    <input type="text" class="form-control" name="p1_reporter_email" id="p1_reporter_email" value="{{old('p1_reporter_email')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>II. PATIENT INFORMATION</strong></div>
                    <div class="card-body">

                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>III. VACCINATION DETAILS</strong></div>
                    <div class="card-body">

                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>IV. ADVERSE EVENTS (Check all that apply)</strong></div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="text-center table-light">
                                <tr>
                                    <th><strong class="text-danger">*</strong>Symptom</th>
                                    <th><strong class="text-danger">*</strong>Date of Onset</th>
                                    <th><strong class="text-danger">*</strong>Time of Onset</th>
                                </tr>
                            </thead>
                            <tbody class="sxList">
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="p4_chestpain_yn" name="p4_chestpain_yn">
                                            <label class="form-check-label" for="p4_chestpain_yn">
                                                Chest Pain
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="p4_chestpain_date" name="p4_chestpain_date" value="{{old('p4_chestpain_date')}}" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="p4_chestpain_time" value="{{old('p4_chestpain_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="p4_chills_yn" name="p4_chills_yn">
                                            <label class="form-check-label" for="p4_chills_yn">
                                                Chills
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="p4_chills_date" name="p4_chills_date"  value="{{old('p4_chills_date')}}" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="p4_chills_time"  name="p4_chills_time" value="{{old('p4_chills_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="p4_colds_yn" name="p4_colds_yn">
                                            <label class="form-check-label" for="p4_colds_yn">
                                                Colds
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="p4_colds_date" name="p4_colds_date"  value="{{old('p4_colds_date')}}" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="p4_colds_time" name="p4_colds_time"  value="{{old('p4_colds_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="p4_dizziness_yn" name="p4_dizziness_yn">
                                            <label class="form-check-label" for="p4_dizziness_yn">
                                                Dizziness
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="p4_dizziness_date" name="p4_dizziness_date"  value="{{old('p4_dizziness_date')}}" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="p4_dizziness_time" name="p4_dizziness_time"  value="{{old('p4_dizziness_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="p4_feelingunwell_yn" name="p4_feelingunwell_yn">
                                            <label class="form-check-label" for="p4_feelingunwell_yn">
                                                Feeling Unwell (malaise)
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="p4_feelingunwell_date" name="p4_feelingunwell_date" value="p4_feelingunwell_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="p4_feelingunwell_time" name="p4_feelingunwell_time"  value="{{old('p4_feelingunwell_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="p4_fever_yn" name="p4_fever_yn">
                                            <label class="form-check-label" for="p4_fever_yn">
                                                Fever ≥ 38C
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="p4_fever_date" name="p4_fever_date" value="p4_fever_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="p4_fever_time" name="p4_fever_time"  value="{{old('p4_fever_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="p4_headache_yn" name="p4_headache_yn">
                                            <label class="form-check-label" for="p4_headache_yn">
                                                Headache
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="p4_headache_date" name="p4_headache_date" value="p4_headache_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="p4_headache_time" name="p4_headache_time"  value="{{old('p4_headache_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="p4_itching_yn" name="p4_itching_yn">
                                            <label class="form-check-label" for="p4_itching_yn">
                                                Itching
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="p4_itching_date" name="p4_itching_date" value="p4_itching_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="p4_itching_time" name="p4_itching_time"  value="{{old('p4_itching_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Increased BP
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" name="p4_feelingunwell_date" value="p4_feelingunwell_date"max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1" name="p4_feelingunwell_time"  value="{{old('p4_feelingunwell_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Joint Pain
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" name="p4_feelingunwell_date" value="p4_feelingunwell_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1" name="p4_feelingunwell_time"  value="{{old('p4_feelingunwell_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Muscle or body aches
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" name="p4_feelingunwell_date" value="p4_feelingunwell_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1" name="p4_feelingunwell_time"  value="{{old('p4_feelingunwell_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Nausea
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" name="p4_feelingunwell_date" value="p4_feelingunwell_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1" name="p4_feelingunwell_time"  value="{{old('p4_feelingunwell_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Numbness
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" name="p4_feelingunwell_date" value="p4_feelingunwell_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1" name="p4_feelingunwell_time"  value="{{old('p4_feelingunwell_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Rash all over the body
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" name="p4_feelingunwell_date" value="p4_feelingunwell_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1" name="p4_feelingunwell_time"  value="{{old('p4_feelingunwell_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Tiredness
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" name="p4_feelingunwell_date" value="p4_feelingunwell_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1" name="p4_feelingunwell_time"  value="{{old('p4_feelingunwell_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Vaccination Site Pain
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" name="p4_feelingunwell_date" value="p4_feelingunwell_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1" name="p4_feelingunwell_time"  value="{{old('p4_feelingunwell_time')}}"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Vomiting
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" name="p4_feelingunwell_date" value="p4_feelingunwell_date" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1" name="p4_feelingunwell_time"  value="{{old('p4_feelingunwell_time')}}"></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead class="text-center table-light">
                                <tr>
                                    <th>Other Symptom/s</th>
                                    <th>Date of onset</th>
                                    <th>Time of onset</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" id="aefichoicetime1"></td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" id="aefichoicetime1"></td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mb-3">
                            <label class="form-label"><strong class="text-danger">*</strong>Outcome</label>
                            <select class="form-select" name="p4_outcome" id="p4_outcome" required>
                                <option value="" disabled {{(is_null(old('p4_outcome')) ? 'selected' : '')}}>Choose...</option>
                                <option value="Alive" {{(old('p4_outcome') == 'Alive')}}>Alive</option>
                                <option value="Died" {{(old('p4_outcome') == 'Died')}}>Died</option>
                            </select>
                        </div>
                        <div id="ifAlive" class="d-none">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="p4_outcome_alive_type">
                                    <option value="" disabled {{(is_null(old('p4_outcome_alive_type')) ? 'selected' : '')}}>Choose...</option>
                                    <option value="Recovering" {{(old('p4_outcome_alive_type') == 'Recovering') ? 'selected' : ''}}>Recovering</option>
                                    <option value="Fully Recovered" {{(old('p4_outcome_alive_type') == 'Fully Recovered') ? 'selected' : ''}}>Fully Recovered</option>
                                    <option value="With Permanent Disability" {{(old('p4_outcome_alive_type') == 'With Permanent Disability') ? 'selected' : ''}}>With Permanent Disability, Specify</option>
                                </select>
                                <label for="p4_outcome_alive_type"><strong class="text-danger">*</strong>If Alive, Select Condition</label>
                            </div>
                            <div id="ifAliveOthers" class="d-none">
                                <div class="mb-3">
                                    <label for="p4_outcome_alive_type_specify" class="form-label"><strong class="text-danger">*</strong>Please Specify Permanent Disability</label>
                                    <input type="text" class="form-control" name="p4_outcome_alive_type_specify" id="p4_outcome_alive_type_specify" value="{{old('p4_outcome_alive_type_specify')}}">
                                </div>
                            </div>
                        </div>
                        <div id="ifDead" class="d-none">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="p4_outcome_died_type">
                                    <option value="" disabled {{(is_null(old('p4_outcome_died_type')) ? 'selected' : '')}}>Choose...</option>
                                    <option value="Dead on Arrival" {{(old('p4_outcome_died_type') == 'Dead on Arrival') ? 'selected' : ''}}>Dead on Arrival</option>
                                    <option value="Died in the Health Facility" {{(old('p4_outcome_died_type') == 'Died in the Health Facility') ? 'selected' : ''}}>Died in the Health Facility</option>
                                    <option value="Died at Home" {{(old('p4_outcome_died_type') == 'Died at Home') ? 'selected' : ''}}>Died at Home</option>
                                </select>
                                <label for="p4_outcome_died_type"><strong class="text-danger">*</strong>If Died, Select Type of Death</label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong class="text-danger">*</strong>Date Died</label>
                                <input type="date" class="form-control" id="p4_outcome_died_date" name="p4_outcome_died_date" max="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header">Patient Management</div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label"><strong class="text-danger">*</strong>1. Date the patient was seen or went for a consult</label>
                                            <input type="date" class="form-control" id="p4_pm_dateconsult" name="p4_pm_dateconsult" max="{{date('Y-m-d')}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong class="text-danger">*</strong>2. Patient's Current Status</label>
                                            <select class="form-select" name="p4_pm_type" id="p4_pm_type" required>
                                                <option value="" disabled {{(is_null(old('p4_pm_type')) ? 'selected' : '')}}>Choose...</option>
                                                <option value="Received treatment and sent home" {{(old('p4_pm_type') == 'Received treatment and sent home')}}>Received treatment and sent home</option>
                                                <option value="Treated and went home against medical advice" {{(old('p4_pm_type') == 'Treated and went home against medical advice')}}>Treated and went home against medical advice</option>
                                                <option value="Currently Admitted" {{(old('p4_pm_type') == 'Currently Admitted')}}>Currently Admitted</option>
                                            </select>
                                        </div>
                                        <div id="p4_choice2" class="d-none">
                                            <div class="mb-3">
                                                <label class="form-label"><strong class="text-danger">*</strong>Date Discharged</label>
                                                <input type="date" class="form-control" id="p4_pm_datedischarged" name="p4_pm_datedischarged" value="{{old('p4_pm_datedischarged')}}" max="{{date('Y-m-d')}}">
                                            </div>
                                        </div>
                                        <div id="p4_choice3" class="d-none">
                                            <div class="mb-3">
                                                <label class="form-label"><strong class="text-danger">*</strong>Date of Admission</label>
                                                <input type="date" class="form-control" id="p4_pm_admitted_date" name="p4_pm_admitted_date" value="{{old('p4_pm_admitted_date')}}" max="{{date('Y-m-d')}}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"><strong class="text-danger">*</strong>Admitting Diagnosis</label>
                                                <input type="text" class="form-control" id="p4_pm_admitted_diagnosis" name="p4_pm_admitted_diagnosis" value="{{old('p4_pm_admitted_diagnosis')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><strong class="text-danger">*</strong>Serious Case</label>
                                    <select class="form-select" name="p4_seriouscase_yn" id="p4_seriouscase_yn" required>
                                        <option value="" disabled {{(is_null(old('p4_seriouscase_yn')) ? 'selected' : '')}}>Choose...</option>
                                        <option value="No" id="p4_seriouscase_yn_c1" {{(old('p4_seriouscase_yn') == 'No')}}>No</option>
                                        <option value="Yes" {{(old('p4_seriouscase_yn') == 'Yes')}}>Yes</option>
                                    </select>
                                </div>
                                <div id="ifSeriousCase" class="d-none">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="p4_seriouscase_ifyes_type">
                                            <option value="" disabled {{(is_null(old('p4_seriouscase_ifyes_type')) ? 'selected' : '')}}>Choose...</option>
                                            <option value="Death" {{(old('p4_seriouscase_ifyes_type') == 'Death') ? 'selected' : ''}}>Death</option>
                                            <option value="Life-threatening" id="p4_seriouscase_ifyes_type_c1" {{(old('p4_seriouscase_ifyes_type') == 'Life-threatening') ? 'selected' : ''}}>Life-threatening</option>
                                            <option value="Disability" id="p4_seriouscase_ifyes_type_c2" {{(old('p4_seriouscase_ifyes_type') == 'Disability') ? 'selected' : ''}}>Disability</option>
                                            <option value="Hospitalization" id="p4_seriouscase_ifyes_type_c3" {{(old('p4_seriouscase_ifyes_type') == 'Hospitalization') ? 'selected' : ''}}>Hospitalization</option>
                                            <option value="Congenital Anomaly" id="p4_seriouscase_ifyes_type_c4" {{(old('p4_seriouscase_ifyes_type') == 'Congenital Anomaly') ? 'selected' : ''}}>Congenital Anomaly</option>
                                            <option value="Other important medical event" id="p4_seriouscase_ifyes_type_c5" {{(old('p4_seriouscase_ifyes_type') == 'Other important medical event') ? 'selected' : ''}}>Other important medical event</option>
                                        </select>
                                        <label for="p4_seriouscase_ifyes_type"><strong class="text-danger">*</strong>If Serious Case, Specify Type</label>
                                    </div>
                                    <div class="mb-3 d-none" id="otherIMR">
                                        <label class="form-label"><strong class="text-danger">*</strong>Specify Other important medical event</label>
                                        <input type="text" class="form-control" id="p4_seriouscase_ifyes_other_specify" name="p4_seriouscase_ifyes_other_specify" value="{{old('p4_seriouscase_ifyes_other_specify')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info" role="alert">
                    <p><strong>Instructions:</strong> Items V. to XIII. of this Case Investigation Form shall be filled out by the attending physician. The Disease Surveillance Officer or any healthcare professional who attended to the patient shall fill out the form should the attending physician be unavailable.</p>
                    <p><strong>Note:</strong> The operational definition of serious AEFI cases is found in Appendix 2. Please be guided accordingly.</p>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>V. EXAMINATION DETAILS</strong></div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>VI. MODE OF EXAMINATION</strong></div>
                    <div class="card-body">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="p6_modeofexam_list">
                                <option value="" disabled {{(is_null(old('p6_modeofexam_list')) ? 'selected' : '')}}>Choose...</option>
                                <option value="Interview" {{(old('p6_modeofexam_list') == 'Interview') ? 'selected' : ''}}>Interview</option>
                                <option value="Medical Record/s" {{(old('p6_modeofexam_list') == 'Medical Record/s') ? 'selected' : ''}}>Medical Record/s</option>
                                <option value="Physical Examination" {{(old('p6_modeofexam_list') == 'Physical Examination') ? 'selected' : ''}}>Physical Examination</option>
                                <option value="Laboratory Result" {{(old('p6_modeofexam_list') == 'Laboratory Result') ? 'selected' : ''}}>Laboratory Result</option>
                                <option value="Other/s, specify" {{(old('p6_modeofexam_list') == 'Other/s, specify') ? 'selected' : ''}}>Other/s, specify</option>
                            </select>
                            <label for="p6_modeofexam_list"><strong class="text-danger">*</strong>Select Mode of Examination</label>
                        </div>
                        <div id="p7ifdied" class="d-none">
                            <div class="card">
                                <div class="card-header"><strong>If the patient DIED</strong></div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label"><strong class="text-danger">*</strong>1. Was autopsy recommended or suggested to the family or next of kin?</label>
                                        <select class="form-select" name="p6_ifdied_autopsyrecommended" id="p6_ifdied_autopsyrecommended">
                                            <option value="" disabled {{(is_null(old('p6_ifdied_autopsyrecommended')) ? 'selected' : '')}}>Choose...</option>
                                            <option value="No" {{(old('p6_ifdied_autopsyrecommended') == 'No')}}>No</option>
                                            <option value="Yes" {{(old('p6_ifdied_autopsyrecommended') == 'Yes')}}>Yes</option>
                                        </select>
                                    </div>
                                    <div id="p6_ifautopsy_yes" class="d-none">
                                        <div class="mb-3">
                                            <label class="form-label"><strong class="text-danger">*</strong>1. If <u>autopsy was recommended but not done</u>, please check all the reason/s why it was not done</label>
                                            <select class="form-select" name="p6_ifdied_autopsynotdone_list" id="p6_ifdied_autopsynotdone_list">
                                                <option value="" disabled {{(is_null(old('p6_ifdied_autopsynotdone_list')) ? 'selected' : '')}}>Choose...</option>
                                                <option value="Local unavailability of pathologist/NBI/PNP" {{(old('p6_ifdied_autopsynotdone_list') == 'Local unavailability of pathologist/NBI/PNP')}}>Local unavailability of pathologist/NBI/PNP</option>
                                                <option value="Financial challenge" {{(old('p6_ifdied_autopsynotdone_list') == 'Financial challenge')}}>Financial challenge</option>
                                                <option value="No consent" {{(old('p6_ifdied_autopsynotdone_list') == 'No consent')}}>No consent</option>
                                                <option value="Other reason/s" {{(old('p6_ifdied_autopsynotdone_list') == 'Other reason/s')}}>Other reason/s</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 d-none" id="p6_ifdied_autopsynotdone_othersdiv">
                                            <label for="p6_ifdied_autopsynotdone_other_specify" class="form-label"><strong class="text-danger">*</strong>Specify Other Reason/s</label>
                                            <input type="text" class="form-control" name="p6_ifdied_autopsynotdone_other_specify" id="p6_ifdied_autopsynotdone_other_specify" value="{{old('p6_ifdied_autopsynotdone_other_specify')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="p6_ifdied_verbalautopsy_name" class="form-label"><strong class="text-danger">*</strong>3.A If <u>verbal autopsy</u> was done; Source's Name</label>
                                            <input type="text" class="form-control" name="p6_ifdied_verbalautopsy_name" id="p6_ifdied_verbalautopsy_name" value="{{old('p6_ifdied_verbalautopsy_name')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="p6_ifdied_verbalautopsy_relationship" class="form-label"><strong class="text-danger">*</strong>3.A If <u>verbal autopsy</u> was done; Source's Relationship</label>
                                            <input type="text" class="form-control" name="p6_ifdied_verbalautopsy_relationship" id="p6_ifdied_verbalautopsy_relationship" value="{{old('p6_ifdied_verbalautopsy_relationship')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>VII. CLINICAL DETAILS</strong> - Attach copies of ALL available documents including case sheet/s, health screening form, copy of vaccination card, discharge summary, case notes, lab and autopsy reports, prescriptions, and others. Separate sheet/s may be attached to complete the information.</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="p7_item1" class="form-label">1. What is your complete diagnosis or problem list?</label>
                            <textarea class="form-control" id="p7_item1" rows="3">{{old('p7_item1')}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="p7_item2" class="form-label">2. Please narrate the chronology of the events, including the date and time</label>
                            <textarea class="form-control" id="p7_item2" rows="3">{{old('p7_item2')}}</textarea>
                            <small class="text-muted">You may also use a separate sheet or attach another document listing the complete diagnosis. Refer to the Brighton Collaboration, Clinical Practice Guidelines, or International Classification of Diseases for the diagnosis.</small>
                        </div>
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>History and PE</th>
                                    <th>What are the findings that support the diagnosis?*</th>
                                    <th>What are the findings that DO NOT support the diagnosis?*</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Review of Systems</td>
                                    <td><textarea class="form-control" id="p7_sxreview_support" rows="3">{{old('p7_sxreview_support')}}</textarea></td>
                                    <td><textarea class="form-control" id="p7_sxreview_notsupport" rows="3">{{old('p7_sxreview_notsupport')}}</textarea></td>
                                </tr>
                                <tr>
                                    <td>Past Medical History and OB-GYN History</td>
                                    <td><textarea class="form-control" id="p7_medobhistory_support" rows="3">{{old('p7_medobhistory_support')}}</textarea></td>
                                    <td><textarea class="form-control" id="p7_medobhistory_notsupport" rows="3">{{old('p7_medobhistory_notsupport')}}</textarea></td>
                                </tr>
                                <tr>
                                    <td>Family Medical History</td>
                                    <td><textarea class="form-control" id="p7_familyhistory_support" rows="3">{{old('p7_familyhistory_support')}}</textarea></td>
                                    <td><textarea class="form-control" id="p7_familyhistory_notsupport" rows="3">{{old('p7_familyhistory_notsupport')}}</textarea></td>
                                </tr>
                                <tr>
                                    <td>Personal Social History</td>
                                    <td><textarea class="form-control" id="p7_personalhistory_support" rows="3">{{old('p7_personalhistory_support')}}</textarea></td>
                                    <td><textarea class="form-control" id="p7_personalhistory_notsupport" rows="3">{{old('p7_personalhistory_notsupport')}}</textarea></td>
                                </tr>
                                <tr>
                                    <td>Physical Examination on first interaction</td>
                                    <td><textarea class="form-control" id="p7_physicalexam_support" rows="3">{{old('p7_physicalexam_support')}}</textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mb-3">
                            <label for="p7_item3" class="form-label">3. Based on your expertise, among the diagnoses mentioned in #1, which diagnosis do you think contributed the most or triggered the series of events towards hospitalization, disability, or death?</label>
                            <textarea class="form-control" id="p7_item3" rows="3">{{old('p7_item3')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>VIII. COURSE IN THE HOSPITALIZATION</strong> - You may opt to attach a medical abstract outlining the chronological course of hospitalization in SOAP format.</div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>IX. RELEVANT PATIENT INFORMATION PRIOR TO IMMUNIZATION</strong></div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>X. FOR THE HEALTH CARE PROVIDER</strong></div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>XI. CONSENT FROM THE PATIENT OR NEXT OF KIN</strong></div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>XII. CONSENT FROM THE HEALTH CARE PROVIDER</strong></div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>XIII. INVESTIGATION DETAILS</strong> - Please indicate whether the investigator is from the Hospital or Local ESU.</div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>XIV. IMMUNIZATION PRACTICES</strong></div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>XV. COLD CHAIN AND TRANSPORT</strong></div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong>XVI. VACCINE DETAILS</strong> (Indicate vaccines provided at the site linked to AEFI on the corresponding day)</div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <p>Privacy Statement</p>
                <p>Public health authorities, to which at the national level is the Department of Health, collects personal information and other necessary data relating to adverse events following immunization (AEFls) as stated in the Revised IRR of Republic Act No. 11332 or the "Mandatory Reporting of Notifiable Diseases and Health Events of Public Health Concern Act." The information collected in this report is used to assist in the surveillance and PCEt market monitoring of the safety of the COVID-19 vaccines. All reports of AEFls are assessed and encoded into the respective information system. The information may come from som eone other than the patient to whom the personal information relates. This is in consideration of cases where the patient may be unable to report the case or where the inform ation is from the next of kin/guardian or an entity other than the former mentioned.</p>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk me-2"></i>Save</button>
            </div>
        </div>
    </div>
</form>
<script>
    $('#p4_outcome').change(function (e) { 
        e.preventDefault();
        if($(this).val() == 'Alive') {
            $('#ifAlive').removeClass('d-none');
            $('#p4_outcome_alive_type').prop('required', true);

            $('#ifDead').addClass('d-none');
            $('#p4_outcome_died_type').prop('required', false);
            $('#p4_outcome_died_date').prop('required', false);

            $('#p4_seriouscase_yn').val('').change();
            $('#p4_seriouscase_ifyes_type').val('').change();

            $('#p4_seriouscase_ifyes_type_c1').removeClass('d-none');
            $('#p4_seriouscase_ifyes_type_c2').removeClass('d-none');
            $('#p4_seriouscase_ifyes_type_c3').removeClass('d-none');
            $('#p4_seriouscase_ifyes_type_c4').removeClass('d-none');
            $('#p4_seriouscase_ifyes_type_c5').removeClass('d-none');

            $('#p7ifdied').addClass('d-none');
            $('#p6_ifdied_autopsyrecommended').prop('required', false);
        }
        else if($(this).val() == 'Died') {
            $('#ifAlive').addClass('d-none');
            $('#p4_outcome_alive_type').prop('required', false);

            $('#ifDead').removeClass('d-none');
            $('#p4_outcome_died_type').prop('required', true);
            $('#p4_outcome_died_date').prop('required', true);

            $('#p4_seriouscase_yn').val('Yes').change();
            $('#p4_seriouscase_ifyes_type').val('Death').change();

            $('#p4_seriouscase_ifyes_type_c1').addClass('d-none');
            $('#p4_seriouscase_ifyes_type_c2').addClass('d-none');
            $('#p4_seriouscase_ifyes_type_c3').addClass('d-none');
            $('#p4_seriouscase_ifyes_type_c4').addClass('d-none');
            $('#p4_seriouscase_ifyes_type_c5').addClass('d-none');

            $('#p7ifdied').removeClass('d-none');
            $('#p6_ifdied_autopsyrecommended').prop('required', true);
        }
    }).trigger('change');

    $('#p4_outcome_alive_type').change(function (e) { 
        e.preventDefault();
        if($(this).val() == 'With Permanent Disability') {
            $('#p4_outcome_alive_type_specify').prop('required', true);
            $('#ifAliveOthers').removeClass('d-none');
        }
        else {
            $('#p4_outcome_alive_type_specify').prop('required', false);
            $('#ifAliveOthers').addClass('d-none');
        }
    });

    $('#p4_pm_type').change(function (e) { 
        e.preventDefault();
        if($(this).val() == 'Received treatment and sent home') {
            $('#p4_choice2').addClass('d-none');
            $('#p4_choice3').addClass('d-none');

            $('#p4_pm_datedischarged').prop('required', false);

            $('#p4_pm_admitted_date').prop('required', false);
            $('#p4_pm_admitted_diagnosis').prop('required', false);
        }
        else if($(this).val() == 'Treated and went home against medical advice') {
            $('#p4_choice2').removeClass('d-none');
            $('#p4_choice3').addClass('d-none');

            $('#p4_pm_datedischarged').prop('required', true);

            $('#p4_pm_admitted_date').prop('required', false);
            $('#p4_pm_admitted_diagnosis').prop('required', false);
        }
        else if($(this).val() == 'Currently Admitted') {
            $('#p4_choice2').addClass('d-none');
            $('#p4_choice3').removeClass('d-none');

            $('#p4_pm_datedischarged').prop('required', false);
            
            $('#p4_pm_admitted_date').prop('required', true);
            $('#p4_pm_admitted_diagnosis').prop('required', true);
        }
    });

    $('#p4_seriouscase_yn').change(function (e) { 
        e.preventDefault();
        if($(this).val() == 'Yes') {
            $('#ifSeriousCase').removeClass('d-none');
            $('#p4_seriouscase_ifyes_type').prop('required', true);
        }
        else {
            $('#ifSeriousCase').addClass('d-none');
            $('#p4_seriouscase_ifyes_type').prop('required', false);
        }
    });

    $('#p4_seriouscase_ifyes_type').change(function (e) { 
        e.preventDefault();
        if($(this).val() == 'Death') {
            if($('#p4_outcome').val() != 'Died') {
                $('#p4_outcome').val('Died').change();
            }

            $('#otherIMR').addClass('d-none');
            $('#p4_seriouscase_ifyes_other_specify').prop('required', false);
        }
        else if($(this).val() == 'Other important medical event') {
            $('#otherIMR').removeClass('d-none');
            $('#p4_seriouscase_ifyes_other_specify').prop('required', true);
        }
        else {
            $('#otherIMR').addClass('d-none');
            $('#p4_seriouscase_ifyes_other_specify').prop('required', false);
        }
    });

    $('#p6_ifdied_autopsynotdone_list').change(function (e) { 
        e.preventDefault();
        if($(this).val() == 'p6_ifdied_autopsynotdone_list') {
            
        }
    });
</script>
@endsection