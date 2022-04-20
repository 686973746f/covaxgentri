@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <strong>Manage Vaccination Schedules</strong>
                </div>
                <div class="col text-end"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsched">Add</button></div>
            </div>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <p>{{Str::plural('Error', $errors->count())}} detected while processing your request:</p>
                <hr>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
            @endif
            @if(session('msg'))
            <div class="alert alert-{{session('msgtype')}}" role="alert">
                {{session('msg')}}
            </div>
            @endif
        </div>
    </div>
</div>

<form action="{{route('vaccinationschedule_createsched')}}" method="POST">
    @csrf
    <div class="modal fade" id="addsched" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Vaccination Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                  <label for="vaccination_center_id" class="form-label"><span class="text-danger font-weight-bold">*</span>Select Vaccination Center</label>
                  <select class="form-select" name="vaccination_center_id" id="vaccination_center_id" required>
                      <option value="" disabled {{(is_null(old('vaccination_center_id'))) ? 'selected' : ''}}>Choose...</option>
                      @foreach($vclist as $v)
                      <option value="{{$v->id}}" {{(old('vaccination_center_id') == $v->id) ? 'selected' : ''}}>{{$v->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="mb-3">
                    <label for="vaccinelist_id" class="form-label"><span class="text-danger font-weight-bold">*</span>Select Vaccine</label>
                    <select class="form-select" name="vaccinelist_id" id="vaccinelist_id" required>
                        <option value="" disabled {{(is_null(old('vaccinelist_id'))) ? 'selected' : ''}}>Choose...</option>
                        @foreach($vaccine_list as $vl)
                        <option value="{{$vl->id}}" {{(old('vaccinelist_id') == $vl->id) ? 'selected' : ''}}>{{$vl->vaccine_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="for_date" class="form-label"><span class="text-danger font-weight-bold">*</span>For Date</label>
                    <input type="date" class="form-control" name="for_date" id="for_date" value="{{old('for_date')}}" min="{{date('Y-m-d')}}" max="{{date('Y-12-31')}}" required>
                </div>
                <div class="mb-3">
                    <label for="sched_type" class="form-label"><span class="text-danger font-weight-bold">*</span>Schedule Type</label>
                    <select class="form-select" name="sched_type" id="sched_type" required>
                        <option value="" disabled {{(is_null(old('sched_type'))) ? 'selected' : ''}}>Choose...</option>
                        <option value="1ST DOSE" {{(old('sched_type') == '1ST DOSE') ? 'selected' : ''}}>1st Dose</option>
                        <option value="2ND DOSE" {{(old('sched_type') == '2ND DOSE') ? 'selected' : ''}}>2nd Dose</option>
                        <option value="BOOSTER" {{(old('sched_type') == 'BOOSTER') ? 'selected' : ''}}>Booster</option>
                        <option value="1 AND 2" {{(old('sched_type') == '1 AND 2') ? 'selected' : ''}}>1st & 2nd Dose</option>
                        <option value="1 AND 2 AND 3" {{(old('sched_type') == '1 AND 2 AND 3') ? 'selected' : ''}}>1st & 2nd & Booster Dose</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="is_adult" class="form-label"><span class="text-danger font-weight-bold">*</span>Is Adult?</label>
                    <select class="form-select" name="is_adult" id="is_adult" required>
                        <option value="" disabled {{(is_null(old('is_adult'))) ? 'selected' : ''}}>Choose...</option>
                        <option value="Yes" {{(old('is_adult') == 'Yes') ? 'selected' : ''}}>Yes</option>
                        <option value="No" {{(old('is_adult') == 'No') ? 'selected' : ''}}>No</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="is_pedia" class="form-label"><span class="text-danger font-weight-bold">*</span>Is Pedia?</label>
                    <select class="form-select" name="is_pedia" id="is_pedia" required>
                        <option value="" disabled {{(is_null(old('is_pedia'))) ? 'selected' : ''}}>Choose...</option>
                        <option value="Yes" {{(old('is_pedia') == 'Yes') ? 'selected' : ''}}>Yes</option>
                        <option value="No" {{(old('is_pedia') == 'No') ? 'selected' : ''}}>No</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sched_timestart" class="form-label"><span class="text-danger font-weight-bold">*</span>Time Start</label>
                            <input type="time" class="form-control" name="sched_timestart" id="sched_timestart" value="{{old('sched_timestart')}}" min="{{date('Y-m-d', strtotime('+1 Day'))}}" max="{{date('Y-12-31', strtotime('+1 Year'))}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sched_timeend" class="form-label"><span class="text-danger font-weight-bold">*</span>Time End</label>
                            <input type="time" class="form-control" name="sched_timeend" id="sched_timeend" value="{{old('sched_timeend')}}" min="{{date('Y-m-d', strtotime('+1 Day'))}}" max="{{date('Y-12-31', strtotime('+1 Year'))}}">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="max_slots" class="form-label"><span class="text-danger font-weight-bold">*</span>Max Slots</label>
                    <input type="number" class="form-control" name="max_slots" id="max_slots" value="{{old('max_slots')}}" min="1" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
    </div>
</form>
@endsection