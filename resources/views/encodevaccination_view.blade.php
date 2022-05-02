@extends('layouts.app')

@section('content')
<div class="container" style="font-family: Arial, Helvetica, sans-serif">
    <div class="card">
        <div class="card-header"><strong>View Patient Vaccination Details</strong></div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="bg-light text-info">
                    <tr>
                        <th colspan="2">Patient Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-end"><strong>Full Name</strong></td>
                        <td>{{$data->getName()}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Age/Sex</strong></td>
                        <td >{{$data->getAge()}}/{{$data->sg()}}</td>
                    </tr>
                    @if($data->sg() == 'F')
                    <tr>
                        <td class="text-end"><strong>Is Pregnant</strong></td>
                        <td>{{($data->if_female_pregnant == 1) ? 'YES' : 'NO'}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Is Lactating</strong></td>
                        <td>{{($data->if_female_lactating == 1) ? 'YES' : 'NO'}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="text-end"><strong>Birthdate</strong></td>
                        <td>{{date('m/d/Y', strtotime($data->bdate))}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Civil Status / Nationality</strong></td>
                        <td>{{$data->cs}} / {{$data->nationality}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Philhealth No.</strong></td>
                        <td>{{(!is_null($data->philhealth)) ? $data->philhealth : 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Contact No.</strong></td>
                        <td>{{$data->contactno}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Email Address</strong></td>
                        <td>{{(!is_null($data->email)) ? $data->email : 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Address</strong></td>
                        <td>{{$data->getAddress()}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead class="bg-light text-info">
                    <tr>
                        <th colspan="2">Vaccination Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-end"><strong>Priority Group</strong></td>
                        <td>{{$data->priority_group}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Is PWD?</strong></td>
                        <td>{{($data->is_pwd == 1) ? 'YES' : 'NO'}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Is Indigenous People?</strong></td>
                        <td>{{($data->is_indigenous == 1) ? 'YES' : 'NO'}}</td>
                    </tr>
                    @if($data->getCurrentSchedData()->sched_type == '1ST DOSE')
                    <tr>
                        <td class="text-end"><strong>Currently Scheduled for</strong></td>
                        <td>1ST DOSE</td>
                    </tr>
                    @elseif($data->getCurrentSchedData()->sched_type == '2ND DOSE')
                    <tr>
                        <td class="text-end"><strong>Currently Scheduled for</strong></td>
                        <td>2ND DOSE</td>
                    </tr>
                    @elseif($data->getCurrentSchedData()->sched_type == 'BOOSTER')
                    <tr>
                        <td class="text-end"><strong>Currently Scheduled for</strong></td>
                        <td>BOOSTER</td>
                    </tr>
                    @elseif($data->getCurrentSchedData()->sched_type == 'BOOSTER2')
                    <tr>
                        <td class="text-end"><strong>Currently Scheduled for</strong></td>
                        <td>BOOSTER2</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="text-end"><strong>Date of Vaccination</strong></td>
                        <td>{{date('m/d/Y - l', strtotime($data->getCurrentSchedData()->for_date))}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Name of Vaccine</strong></td>
                        <td>{{$data->getCurrentSchedData()->vaccinelist->vaccine_name}}</td>
                    </tr>
                    @if($data->getCurrentSchedData()->sched_type != '1ST DOSE')
                    <!-- EXTRA TABLE FOR SEPARATOR -->
                    <tr>
                        <td class="text-end">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    @endif
                    @if($data->getCurrentSchedData()->sched_type == '2ND DOSE')
                    <tr>
                        <td class="text-end"><strong>First Dose Date</strong></td>
                        <td>{{date('m/d/Y - l', strtotime($data->firstdose_date))}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>First Dose Vaccine Name</strong></td>
                        <td>{{$data->getFirstDoseData()->vaccinelist->vaccine_name}}</td>
                    </tr>
                    @elseif($data->getCurrentSchedData()->sched_type == 'BOOSTER')
                    <tr>
                        <td class="text-end"><strong>First Dose Date</strong></td>
                        <td>{{date('m/d/Y - l', strtotime($data->firstdose_date))}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>First Dose Vaccine Name</strong></td>
                        <td>{{$data->getFirstDoseData()->vaccinelist->vaccine_name}}</td>
                    </tr>
                        @if($data->is_singledose != 1)
                        <tr>
                            <td class="text-end"><strong>Second Dose Date</strong></td>
                            <td>{{date('m/d/Y - l', strtotime($data->firstdose_date))}}</td>
                        </tr>
                        <tr>
                            <td class="text-end"><strong>Second Dose Vaccine Name</strong></td>
                            <td>{{$data->getSecondDoseData()->vaccinelist->vaccine_name}}</td>
                        </tr>
                        @endif
                    @elseif($data->getCurrentSchedData()->sched_type == 'BOOSTER2')
                    <tr>
                        <td class="text-end"><strong>First Dose Date</strong></td>
                        <td>{{date('m/d/Y - l', strtotime($data->firstdose_date))}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>First Dose Vaccine Name</strong></td>
                        <td>{{$data->getFirstDoseData()->vaccinelist->vaccine_name}}</td>
                    </tr>
                        @if($data->is_singledose != 1)
                        <tr>
                            <td class="text-end"><strong>Second Dose Date</strong></td>
                            <td>{{date('m/d/Y - l', strtotime($data->firstdose_date))}}</td>
                        </tr>
                        <tr>
                            <td class="text-end"><strong>Second Dose Vaccine Name</strong></td>
                            <td>{{$data->getSecondDoseData()->vaccinelist->vaccine_name}}</td>
                        </tr>
                        @endif
                    <tr>
                        <td class="text-end"><strong>Booster Date</strong></td>
                        <td>{{$data->getBoosterData()->vaccinelist->vaccine_name}}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Booster Vaccine Name</strong></td>
                        <td>{{$data->getBoosterData()->vaccinelist->vaccine_name}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptmodal"><i class="fa fa-check-circle me-2" aria-hidden="true"></i>Accept</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#defermodal"><i class="fa fa-times-circle me-2" aria-hidden="true"></i>Defer</button>
            </div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <select class="form-select" name="vaccinator_name" id="vaccinator_name" required>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

<script>
    $('#vaccinator_name').select2({
        dropdownParent: $("#acceptmodal"),
        theme: 'bootstrap',
    });
</script>
@endsection