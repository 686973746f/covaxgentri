@extends('layouts.app')

@section('content')
<form action="{{route('patient_action', ['id' => $data->id])}}" method="POST">
    @csrf
    <div class="container">
        <div class="card border-success">
            <div class="card-header bg-success text-white"><strong>View Patient Details</strong></div>
            <div class="card-body">
                <div class="card mb-3">
                    <div class="card-header"><strong><i class="fa-solid fa-circle-user me-2"></i>Personal Information</strong></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="lname" class="form-label"><span class="text-danger font-weight-bold">*</span>Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="lname" value="{{old('lname', $data->lname)}}" maxlength="50" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="fname" class="form-label"><span class="text-danger font-weight-bold">*</span>First Name</label>
                                    <input type="text" class="form-control" name="fname" id="fname" value="{{old('fname', $data->fname)}}" maxlength="50" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="mname" class="form-label">Middle Name <i><small>(If Applicable)</small></i></label>
                                    <input type="text" class="form-control" name="mname" id="mname" value="{{old('mname', $data->mname)}}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="suffix" class="form-label">Suffix <i><small>(If Applicable)</small></i></label>
                                    <input type="text" class="form-control" name="suffix" id="suffix" value="{{old('suffix', $data->suffix)}}" maxlength="3" placeholder="e.g JR, SR, III, IV">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                  <label for="bdate" class="form-label"><span class="text-danger font-weight-bold">*</span>Birthdate</label>
                                  <input type="date" class="form-control" name="bdate" id="bdate" value="{{old('bdate', $data->bdate)}}" min="1900-01-01" max="{{date('Y-m-d', strtotime('yesterday'))}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="sex" class="form-label"><span class="text-danger font-weight-bold">*</span>Gender</label>
                                    <select class="form-select" name="sex" id="sex" required>
                                        <option value="MALE" {{(old('sex', $data->sex) == 'MALE') ? 'selected' : ''}}>Male</option>
                                        <option value="FEMALE" {{(old('sex' , $data->sex) == 'FEMALE') ? 'selected' : ''}}>Female</option>
                                    </select>
                                </div>
                                <div id="if_female" class="d-none">
                                    <div class="mb-3">
                                        <label for="if_female_pregnant" class="form-label"><span class="text-danger font-weight-bold">*</span>Are you Pregnant?</label>
                                        <select class="form-select" name="if_female_pregnant" id="if_female_pregnant">
                                            <option value="" disabled {{(is_null(old('if_female_pregnant', $data->if_female_pregnant))) ? 'selected' : ''}}>Choose...</option>
                                            <option value="0" {{(old('if_female_pregnant', $data->if_female_pregnant) == 0) ? 'selected' : ''}}>No</option>
                                            <option value="1" {{(old('if_female_pregnant', $data->if_female_pregnant) == 1) ? 'selected' : ''}}>Yes</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="if_female_lactating" class="form-label"><span class="text-danger font-weight-bold">*</span>Lactating?</label>
                                        <select class="form-select" name="if_female_lactating" id="if_female_lactating">
                                          <option value="" disabled {{(is_null(old('if_female_lactating', $data->if_female_lactating))) ? 'selected' : ''}}>Choose...</option>
                                          <option value="0" {{(old('if_female_lactating', $data->if_female_lactating) == 0) ? 'selected' : ''}}>No</option>
                                          <option value="1" {{(old('if_female_lactating', $data->if_female_lactating) == 1) ? 'selected' : ''}}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="cs" class="form-label"><span class="text-danger font-weight-bold">*</span>Civil Status</label>
                                    <select class="form-select" id="cs" name="cs" required>
                                        <option value="" disabled {{(is_null(old('cs', $data->cs))) ? 'selected' : ''}}>Choose...</option>
                                        <option value="SINGLE" {{(old('cs', $data->cs) == 'SINGLE') ? 'selected' : ''}}>Single</option>
                                        <option value="MARRIED" {{(old('cs', $data->cs) == 'MARRIED') ? 'selected' : ''}}>Married</option>
                                        <option value="WIDOWED" {{(old('cs', $data->cs) == 'WIDOWED') ? 'selected' : ''}}>Widowed</option>
                                        <option value="N/A" {{(old('cs', $data->cs) == 'N/A') ? 'selected' : ''}}>N/A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="nationality" class="form-label"><span class="text-danger font-weight-bold">*</span>Nationality</label>
                                    <select class="form-select" id="nationality" name="nationality" required>
                                        <option value="Filipino" {{(old('nationality', $data->nationality) == 'Filipino') ? 'selected' : ''}}>Filipino</option>
                                        <option value="Foreign" {{(old('nationality', $data->nationality) == 'Foreign') ? 'selected' : ''}}>Foreign</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="contactno" class="form-label"><span class="text-danger font-weight-bold">*</span>Contact Number (Mobile)</label>
                                    <input type="text" class="form-control" id="contactno" name="contactno" value="{{old('contactno', $data->contactno)}}" pattern="[0-9]{11}" placeholder="09xxxxxxxxx" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address <i><small>(If Applicable)</small></i></label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{old('email', $data->email)}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="philhealth" class="form-label">Philhealth Number <i><small>(If Applicable)</small></i></label>
                                    <input type="text" class="form-control" id="philhealth" name="philhealth" value="{{old('philhealth', $data->philhealth)}}" pattern="[0-9]{12}">
                                    <small class="text-muted">Note: Input the Complete Philhealth Number (12 Digits, No Dashes)</small>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tbody class="text-center">
                                <tr>
                                    <td>Submitted ID</td>
                                    <td><a href="{{storage_path('registration/'.$data->requirement_id_filepath)}}" class="btn btn-primary"><i class="fa-solid fa-id-card me-2"></i>View Submitted ID</a></td>
                                </tr>
                                <tr>
                                    <td>Selfie</td>
                                    <td><a href="{{storage_path('registration/'.$data->requirement_selfie)}}" class="btn btn-primary" target="_blank"><i class="fa-solid fa-image-portrait me-2"></i>View Patient Selfie</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong><i class="fa-solid fa-house me-2"></i>Current Address</strong></div>
                    <div class="card-body">
                        <div id="address_text" class="d-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" id="address_region_text" name="address_region_text" readonly>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="address_province_text" name="address_province_text" readonly>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="address_muncity_text" name="address_muncity_text" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label for="address_region_code" class="form-label"><span class="text-danger font-weight-bold">*</span>Region</label>
                                  <select class="form-select" name="address_region_code" id="address_region_code" required>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address_province_code" class="form-label"><span class="text-danger font-weight-bold">*</span>Province</label>
                                    <select class="form-select" name="address_province_code" id="address_province_code" required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address_muncity_code" class="form-label"><span class="text-danger font-weight-bold">*</span>City/Municipality</label>
                                    <select class="form-select" name="address_muncity_code" id="address_muncity_code" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address_brgy_text" class="form-label"><span class="text-danger font-weight-bold">*</span>Barangay</label>
                                    <select class="form-select" name="address_brgy_text" id="address_brgy_text" required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address_houseno" class="form-label"><span class="text-danger font-weight-bold">*</span>House No./Lot/Building</label>
                                    <input type="text" class="form-control" id="address_houseno" name="address_houseno" style="text-transform: uppercase;" value="{{old('address_houseno', $data->address_houseno)}}" pattern="(^[a-zA-Z0-9 ]+$)+" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address_street" class="form-label"><span class="text-danger font-weight-bold">*</span>Street/Subdivision/Purok/Sitio</label>
                                    <input type="text" class="form-control" id="address_street" name="address_street" style="text-transform: uppercase;" value="{{old('address_street', $data->address_street)}}" pattern="(^[a-zA-Z0-9 ]+$)+" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header"><strong><i class="fa-solid fa-shield-virus me-2"></i>Vaccination Details</strong></div>
                    <div class="card-body">
                        @if(!is_null($data->firstdose_schedule_id))
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="bg-light"><strong>FIRST DOSE</strong></td>
                                </tr>
                                <tr>
                                    <td>First (1st) Dose Date</td>
                                    <td class="text-center">{{date('m/d/Y - l', strtotime($data->getFirstDoseData()->for_date))}}</td>
                                </tr>
                                <tr>
                                    <td>First (1st) Dose Vaccination Center</td>
                                    <td class="text-center">{{$data->getFirstDoseData()->vaccinationcenter->name}}</td>
                                </tr>
                                <tr>
                                    <td>First (1st) Dose Vaccine Name</td>
                                    <td class="text-center">{{$data->getFirstDoseData()->vaccinelist->vaccine_name}}</td>
                                </tr>
                                <tr>
                                    <td>First (1st) Dose Status</td>
                                    <td class="text-center">{{($data->firstdose_is_attended == 1) ? 'Finished' : 'Pending'}}</td>
                                </tr>
                                <tr>
                                    <td>First (1st) Dose Schedule ID / Date Scheduled</td>
                                    <td class="text-center">#{{$data->firstdose_schedule_id}} / {{date('m-d-Y h:i A - l', strtotime($data->firstdose_schedule_date_by_user))}}</td>
                                </tr>
                                @if($data->firstdose_is_attended == 1)
                                <tr>
                                    <td>Vaccinator</td>
                                    <td class="text-center">{{$data->firstdose_vaccinator_name}}</td>
                                </tr>
                                <tr>
                                    <td>Batch / Lot Number</td>
                                    <td class="text-center">{{$data->firstdose_batchno}} / {{$data->firstdose_lotno}}</td>
                                </tr>
                                <tr>
                                    <td>Injection Site</td>
                                    <td class="text-center">{{$data->firstdose_site_injection}}</td>
                                </tr>
                                @endif
                                @if(!is_null($data->seconddose_schedule_id))
                                <tr>
                                    <td colspan="2" class="bg-light"><strong>SECOND (2ND) DOSE</strong></td>
                                </tr>
                                <tr>
                                    <td>Second (2nd) Dose Date</td>
                                    <td class="text-center">{{date('m/d/Y - l', strtotime($data->getSecondDoseData()->for_date))}}</td>
                                </tr>
                                <tr>
                                    <td>Second (2nd) Dose Vaccination Center</td>
                                    <td class="text-center">{{$data->getSecondDoseData()->vaccinationcenter->name}}</td>
                                </tr>
                                <tr>
                                    <td>Second (2nd) Dose Vaccine Name</td>
                                    <td class="text-center">{{$data->getSecondDoseData()->vaccinelist->vaccine_name}}</td>
                                </tr>
                                <tr>
                                    <td>Second (2nd) Dose Status</td>
                                    <td class="text-center">{{($data->seconddose_is_attended == 1) ? 'Finished' : 'Pending'}}</td>
                                </tr>
                                <tr>
                                    <td>Second (2nd) Dose Schedule ID / Date Scheduled</td>
                                    <td class="text-center">#{{$data->seconddose_schedule_id}} / {{date('m-d-Y h:i A - l', strtotime($data->seconddose_schedule_date_by_user))}}</td>
                                </tr>
                                    @if($data->seconddose_is_attended == 1)
                                    <tr>
                                        <td>Vaccinator</td>
                                        <td class="text-center">{{$data->seconddose_vaccinator_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Batch / Lot Number</td>
                                        <td class="text-center">{{$data->seconddose_batchno}} / {{$data->seconddose_lotno}}</td>
                                    </tr>
                                    <tr>
                                        <td>Injection Site</td>
                                        <td class="text-center">{{$data->seconddose_site_injection}}</td>
                                    </tr>
                                    @endif
                                @endif
                                @if(!is_null($data->booster_schedule_id))
                                <tr>
                                    <td colspan="2" class="bg-light"><strong>BOOSTER DOSE</strong></td>
                                </tr>
                                <tr>
                                    <td>Booster Dose Date</td>
                                    <td class="text-center">{{date('m/d/Y - l', strtotime($data->getBoosterData()->for_date))}}</td>
                                </tr>
                                <tr>
                                    <td>Booster Dose Vaccination Center</td>
                                    <td class="text-center">{{$data->getBoosterData()->vaccinationcenter->name}}</td>
                                </tr>
                                <tr>
                                    <td>Booster Dose Vaccine Name</td>
                                    <td class="text-center">{{$data->getBoosterData()->vaccinelist->vaccine_name}}</td>
                                </tr>
                                <tr>
                                    <td>Booster Dose Status</td>
                                    <td class="text-center">{{($data->booster_is_attended == 1) ? 'Finished' : 'Pending'}}</td>
                                </tr>
                                <tr>
                                    <td>Booster Dose Schedule ID / Date Scheduled</td>
                                    <td class="text-center">#{{$data->booster_schedule_id}} / {{date('m-d-Y h:i A - l', strtotime($data->booster_schedule_date_by_user))}}</td>
                                </tr>
                                    @if($data->booster_is_attended == 1)
                                    <tr>
                                        <td>Vaccinator</td>
                                        <td class="text-center">{{$data->booster_vaccinator_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Batch / Lot Number</td>
                                        <td class="text-center">{{$data->booster_batchno}} / {{$data->booster_lotno}}</td>
                                    </tr>
                                    <tr>
                                        <td>Injection Site</td>
                                        <td class="text-center">{{$data->booster_site_injection}}</td>
                                    </tr>
                                    @endif
                                @endif
                                @if(!is_null($data->boostertwo_schedule_id))
                                <tr>
                                    <td colspan="2" class="bg-light"><strong>SECOND BOOSTER DOSE</strong></td>
                                </tr>
                                <tr>
                                    <td>Second Booster Dose Date</td>
                                    <td class="text-center">{{date('m/d/Y - l', strtotime($data->getBoosterTwoData()->for_date))}}</td>
                                </tr>
                                <tr>
                                    <td>Second Booster Dose Vaccination Center</td>
                                    <td class="text-center">{{$data->getBoosterTwoData()->vaccinationcenter->name}}</td>
                                </tr>
                                <tr>
                                    <td>Second Booster Dose Vaccine Name</td>
                                    <td class="text-center">{{$data->getBoosterTwoData()->vaccinelist->vaccine_name}}</td>
                                </tr>
                                <tr>
                                    <td>Second Booster Dose Status</td>
                                    <td class="text-center">{{($data->boostertwo_is_attended == 1) ? 'Finished' : 'Pending'}}</td>
                                </tr>
                                <tr>
                                    <td>Second Booster Dose Schedule ID / Date Scheduled</td>
                                    <td class="text-center">#{{$data->boostertwo_schedule_id}} / {{date('m-d-Y h:i A - l', strtotime($data->boostertwo_schedule_date_by_user))}}</td>
                                </tr>
                                    @if($data->boostertwo_is_attended == 1)
                                    <tr>
                                        <td>Vaccinator</td>
                                        <td class="text-center">{{$data->boostertwo_vaccinator_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Batch / Lot Number</td>
                                        <td class="text-center">{{$data->boostertwo_batchno}} / {{$data->boostertwo_lotno}}</td>
                                    </tr>
                                    <tr>
                                        <td>Injection Site</td>
                                        <td class="text-center">{{$data->boostertwo_site_injection}}</td>
                                    </tr>
                                    @endif
                                @endif
                            </tbody>
                        </table>
                        @else
                        <p class="text-center">No Schedule Found.</p>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Adverse Events Following Immunization (AEFI)</strong>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{route('aefi_create', ['patient_id' => $data->id])}}" class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>New AEFI CIF</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <div class="d-grid gap-2">
                    <button type="submit" name="action" value="update" class="btn btn-primary mx-5"><i class="fa-solid fa-floppy-disk me-2"></i>Update</button>
                </div>
                @if($data->is_approved != 1)
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-grid gap-2">
                            <button type="submit" name="action" value="accept" class="btn btn-success">Accept</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-grid gap-2">
                            <button type="button"  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectmodal">Reject</button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    @if($data->is_approved != 1)
    <div class="modal fade" id="rejectmodal" tabindex="-1" aria-labelledby="rejectmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger"><strong>Reject Patient</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="action_remarks">Input Reason</label>
                  <input type="text" class="form-control" name="action_remarks" id="action_remarks">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="action" value="reject" class="btn btn-primary">Reject</button>
            </div>
            </div>
        </div>
    </div>
    @endif
</form>

<script>
    var default_region = '{{$data->address_region_code}}';
    var default_province = '{{$data->address_province_code}}';
    var default_muncity = '{{$data->address_muncity_code}}';
    var default_brgy = '{{$data->address_brgy_text}}';

    //Region Select Initialize
    $.getJSON("{{asset('json/refregion.json')}}", function(data) {
        var sorted = data.sort(function(a, b) {
            if (a.regDesc > b.regDesc) {
                return 1;
            }
            if (a.regDesc < b.regDesc) {
                return -1;
            }

            return 0;
        });

        $.each(sorted, function(key, val) {
            $('#address_region_code').append($('<option>', {
                value: val.regCode,
                text: val.regDesc,
                selected: (val.regCode == default_region) ? true : false, //default is Region IV-A
            }));
        });
    });

    $('#address_region_code').change(function (e) { 
        e.preventDefault();
        //Empty and Disable
        $('#address_province_code').empty();
        $("#address_province_code").append('<option value="" selected disabled>Choose...</option>');

        $('#address_muncity_code').empty();
        $("#address_muncity_code").append('<option value="" selected disabled>Choose...</option>');

        //Re-disable Select
        $('#address_muncity_code').prop('disabled', true);
        $('#address_brgy_text').prop('disabled', true);

        //Set Values for Hidden Box
        $('#address_region_text').val($('#address_region_code option:selected').text());

        $.getJSON("{{asset('json/refprovince.json')}}", function(data) {
            var sorted = data.sort(function(a, b) {
                if (a.provDesc > b.provDesc) {
                return 1;
                }
                if (a.provDesc < b.provDesc) {
                return -1;
                }
                return 0;
            });

            $.each(sorted, function(key, val) {
                if($('#address_region_code').val() == val.regCode) {
                    $('#address_province_code').append($('<option>', {
                        value: val.provCode,
                        text: val.provDesc,
                        selected: (val.provCode == default_province) ? true : false, //default for Cavite
                    }));
                }
            });
        });
    }).trigger('change');

    $('#address_province_code').change(function (e) {
        e.preventDefault();
        //Empty and Disable
        $('#address_muncity_code').empty();
        $("#address_muncity_code").append('<option value="" selected disabled>Choose...</option>');

        //Re-disable Select
        $('#address_muncity_code').prop('disabled', false);
        $('#address_brgy_text').prop('disabled', true);

        //Set Values for Hidden Box
        $('#address_province_text').val($('#address_province_code option:selected').text());

        $.getJSON("{{asset('json/refcitymun.json')}}", function(data) {
            var sorted = data.sort(function(a, b) {
                if (a.citymunDesc > b.citymunDesc) {
                    return 1;
                }
                if (a.citymunDesc < b.citymunDesc) {
                    return -1;
                }
                return 0;
            });
            $.each(sorted, function(key, val) {
                if($('#address_province_code').val() == val.provCode) {
                    $('#address_muncity_code').append($('<option>', {
                        value: val.citymunCode,
                        text: val.citymunDesc,
                        selected: (val.citymunCode == default_muncity) ? true : false, //default for General Trias
                    })); 
                }
            });
        });
    }).trigger('change');

    $('#address_muncity_code').change(function (e) {
        e.preventDefault();
        //Empty and Disable
        $('#address_brgy_text').empty();
        $("#address_brgy_text").append('<option value="" selected disabled>Choose...</option>');

        //Re-disable Select
        $('#address_muncity_code').prop('disabled', false);
        $('#address_brgy_text').prop('disabled', false);

        //Set Values for Hidden Box
        $('#address_muncity_text').val($('#address_muncity_code option:selected').text());

        $.getJSON("{{asset('json/refbrgy.json')}}", function(data) {
            var sorted = data.sort(function(a, b) {
                if (a.brgyDesc > b.brgyDesc) {
                return 1;
                }
                if (a.brgyDesc < b.brgyDesc) {
                return -1;
                }
                return 0;
            });
            $.each(sorted, function(key, val) {
                if($('#address_muncity_code').val() == val.citymunCode) {
                    $('#address_brgy_text').append($('<option>', {
                        value: val.brgyDesc.toUpperCase(),
                        text: val.brgyDesc.toUpperCase(),
                        selected: (val.brgyDesc.toUpperCase() == default_brgy) ? true : false,
                    }));
                }
            });
        });
    }).trigger('change');

    $('#address_region_text').val('REGION IV-A (CALABARZON)');
    $('#address_province_text').val('CAVITE');
    $('#address_muncity_text').val('GENERAL TRIAS');
</script>
@endsection