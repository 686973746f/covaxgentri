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
                                    <input type="text" class="form-control" name="p1_dru_type" id="p1_dru_type" value="{{old('p1_dru_type', 'TYPE')}}" required>
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
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
                                            <label class="form-check-label" for="aefichoice1">
                                                Chest Pain
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="date" class="form-control" id="aefichoicedate1" max="{{date('Y-m-d')}}"></td>
                                    <td><input type="time" class="form-control" id="aefichoicetime1"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="aefichoice1">
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
                        <div id="ifAlive">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="p4_outcome_alive_type">
                                    <option value="" disabled {{(is_null(old('p4_outcome_alive_type')) ? 'selected' : '')}}>Choose...</option>
                                    <option value="Recovering" {{(old('p4_outcome_alive_type') == 'Recovering') ? 'selected' : ''}}>Recovering</option>
                                    <option value="Fully Recovered" {{(old('p4_outcome_alive_type') == 'Fully Recovered') ? 'selected' : ''}}>Fully Recovered</option>
                                    <option value="With Permanent Disability" {{(old('p4_outcome_alive_type') == 'With Permanent Disability') ? 'selected' : ''}}>With Permanent Disability, Specify</option>
                                </select>
                                <label for="p4_outcome_alive_type">If Alive, Select Condition</label>
                            </div>
                        </div>
                        <div id="ifDead">
                            <div class="mb-3">
                                <label class="form-label"><strong class="text-danger">*</strong>Date Died</label>
                                <input type="date" class="form-control" id="datedied" max="{{date('Y-m-d')}}">
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
@endsection