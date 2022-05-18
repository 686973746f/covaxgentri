@extends('layouts.app')

@section('content')
<form action="{{route('aefi_store', ['patient_id' => $data->id])}}" method="POST">
    @csrf
    <div class="container">
        <div class="card">
            <div class="card-header"><strong>Create NEW AEFI Case Investigation Form for {{ucwords(strtolower($data->getName()))}} (#{{$data->id}})</strong></div>
            <div class="card-body">
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
                                            <input class="form-check-input" type="checkbox" value="" id="p4_chestpain_yn" name="aefisx[]">
                                            <label class="form-check-label" for="p4_chestpain_yn">
                                                Chest Pain
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" name="aefichoicedate1" value="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1" value=""></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Chills
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Colds
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Dizziness
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Feeling Unwell (malaise)
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Fever ≥ 38C
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Headache
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1" name="aefisx[]">
                                            <label class="form-check-label" for="aefichoice1">
                                                Itching
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
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
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
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
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
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
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
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
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
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
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
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
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
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
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
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
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
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
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
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
                                        <option value="No" {{(old('p4_seriouscase_yn') == 'No')}}>No</option>
                                        <option value="Yes" {{(old('p4_seriouscase_yn') == 'Yes')}}>Yes</option>
                                    </select>
                                </div>
                                <div id="ifSeriousCase" class="d-none">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="p4_seriouscase_ifyes_type">
                                            <option value="" disabled {{(is_null(old('p4_seriouscase_ifyes_type')) ? 'selected' : '')}}>Choose...</option>
                                            <option value="Death" {{(old('p4_seriouscase_ifyes_type') == 'Death') ? 'selected' : ''}}>Death</option>
                                            <option value="Life-threatening" {{(old('p4_seriouscase_ifyes_type') == 'Life-threatening') ? 'selected' : ''}}>Life-threatening</option>
                                            <option value="Disability" {{(old('p4_seriouscase_ifyes_type') == 'Disability') ? 'selected' : ''}}>Disability</option>
                                            <option value="Hospitalization" {{(old('p4_seriouscase_ifyes_type') == 'Hospitalization') ? 'selected' : ''}}>Hospitalization</option>
                                            <option value="Congenital Anomaly" {{(old('p4_seriouscase_ifyes_type') == 'Congenital Anomaly') ? 'selected' : ''}}>Congenital Anomaly</option>
                                            <option value="Other important medical event" {{(old('p4_seriouscase_ifyes_type') == 'Other important medical event') ? 'selected' : ''}}>Other important medical event</option>
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
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk me-2"></i>Save</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $(function(){
            var requiredCheckboxes = $('.sxList :checkbox[required]');
            requiredCheckboxes.change(function(){
                if(requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                } else {
                    requiredCheckboxes.attr('required', 'required');
                }
            }).trigger('change');
        });
    });

    $('#p4_outcome').change(function (e) { 
        e.preventDefault();
        if($(this).val() == 'Alive') {
            $('#ifAlive').removeClass('d-none');
            $('#p4_outcome_alive_type').prop('required', true);

            $('#ifDead').addClass('d-none');
            $('#p4_outcome_died_type').prop('required', false);
            $('#p4_outcome_died_date').prop('required', false);
        }
        else if($(this).val() == 'Died') {
            $('#ifAlive').addClass('d-none');
            $('#p4_outcome_alive_type').prop('required', false);

            $('#ifDead').removeClass('d-none');
            $('#p4_outcome_died_type').prop('required', true);
            $('#p4_outcome_died_date').prop('required', true);
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
        if($(this).val() == 'Other important medical event') {
            $('#otherIMR').removeClass('d-none');
            $('#p4_seriouscase_ifyes_other_specify').prop('required', true);
        }
        else {
            $('#otherIMR').addClass('d-none');
            $('#p4_seriouscase_ifyes_other_specify').prop('required', false);
        }
    });
</script>
@endsection