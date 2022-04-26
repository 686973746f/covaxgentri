@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">View Vaccination Details</div>
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#acceptmodal">Accept</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defermodal">Defer</button>
        </div>
    </div>
</div>

<form action="{{route('encodevaccination_actions', ['patient_id' => $data->id, 'vaccinationschedule_id' => $vschedule->id])}}" method="POST">
    @csrf
    <div class="modal fade" id="acceptmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Accept Vaccination</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="site_injection" class="form-label"><span class="text-danger font-weight-bold">*</span>Injection Site</label>
                        <select class="form-control" name="site_injection" id="site_injection" required>
                            <option value="" disabled {{is_null(old('site_injection')) ? 'selected' : ''}}>Choose...</option>
                            <option value="LEFT ARM" {{(old('site_injection') == "LEFT ARM") ? 'selected' : ''}}>Left Arm</option>
                            <option value="RIGHT ARM" {{(old('site_injection') == "RIGHT ARM") ? 'selected' : ''}}>Right Arm</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"><span class="text-danger font-weight-bold">*</span>Vaccine Name</label>
                        <input type="text" class="form-control" value="{{$vschedule->vaccinelist->vaccine_name}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="batchno" class="form-label">Batch No. <small><i>(Optional, Will use Default Values if Left Blank)</i></small></label>
                        <input type="text" class="form-control" name="batchno" id="batchno" value="{{old('batchno')}}">
                    </div>
                    <div class="mb-3">
                        <label for="lotno" class="form-label">Lot No. <small><i>(Optional, Will use Default Values if Left Blank)</i></small></label>
                        <input type="text" class="form-control" name="lotno" id="lotno" value="{{old('lotno')}}">
                    </div>
                    <div class="mb-3">
                        <label for="adverse_events" class="form-label">Adverse Events <small><i>(If Applicable)</i></small></label>
                        <input type="text" class="form-control" name="adverse_events" id="adverse_events" value="{{old('adverse_events')}}">
                    </div>
                    <div class="mb-3">
                        <label for="vaccinator_name" class="form-label"><span class="text-danger font-weight-bold">*</span>Vaccinator</label>
                        <select class="form-control" name="vaccinator_name" id="vaccinator_name" required>
                            <option value="" disabled {{is_null(old('vaccinator_name')) ? 'selected' : ''}}>Choose...</option>
                            @foreach($vaccinator_list as $v)
                            <option value="{{$v->getName()}}" {{(old('vaccinator_name')) ? 'selected' : ''}}>{{$v->getName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="accept" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{route('encodevaccination_actions', ['patient_id' => $data->id, 'vaccinationschedule_id' => $vschedule->id])}}" method="POST">
    <div class="modal fade" id="defermodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Defer Patient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="deferred_reason" class="form-lable">Defer Reason</label>
                      <input type="text" class="form-control" name="deferred_reason" id="deferred_reason" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="defer" class="btn btn-danger">Proceed</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection