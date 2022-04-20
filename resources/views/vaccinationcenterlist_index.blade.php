@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <strong>Manage Vaccination Centers</strong>
                </div>
                <div class="col text-end"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addmodal">Add</button></div>
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

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Name of Vaccination Site</th>
                            <th>Prefix</th>
                            <th>Location</th>
                            <th>Region</th>
                            <th>Time Start</th>
                            <th>Time End</th>
                            <th>Is Mobile Vaccination</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->card_prefix}}</td>
                            <td>{{$item->getAddress()}}</td>
                            <td>{{$item->vaccinationsite_region}}</td>
                            <td>{{$item->time_start}}</td>
                            <td>{{$item->time_end}}</td>
                            <td>{{$item->is_mobile_vaccination}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form action="{{route('vaccinationcenters_store')}}" method="POST">
    @csrf
    <div class="modal fade" id="addmodal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Vaccination Center</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label"><span class="text-danger font-weight-bold">*</span>Name of Vaccination Center</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" required>
                </div>
                <div class="mb-3">
                    <label for="card_prefix" class="form-label"><span class="text-danger font-weight-bold">*</span>Prefix</label>
                    <input type="text" class="form-control" name="card_prefix" id="card_prefix" value="{{old('card_prefix')}}" max="10" required>
                </div>
                <div class="mb-3">
                    <label for="vaccinationsite_location" class="form-label"><span class="text-danger font-weight-bold">*</span>Location</label>
                    <input type="text" class="form-control" name="vaccinationsite_location" id="vaccinationsite_location" value="{{old('vaccinationsite_location')}}" required>
                </div>
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
                            <label for="time_start" class="form-label"><span class="text-danger font-weight-bold">*</span>Time Start</label>
                            <input type="time" class="form-control" name="time_start" id="time_start" value="{{old('time_start')}}" min="{{date('Y-m-d', strtotime('+1 Day'))}}" max="{{date('Y-12-31', strtotime('+1 Year'))}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="time_end" class="form-label"><span class="text-danger font-weight-bold">*</span>Time End</label>
                            <input type="time" class="form-control" name="time_end" id="time_end" value="{{old('time_end')}}" min="{{date('Y-m-d', strtotime('+1 Day'))}}" max="{{date('Y-12-31', strtotime('+1 Year'))}}">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                  <label for="is_mobile_vaccination" class="form-label"><span class="text-danger font-weight-bold">*</span>Is Mobile Vaccination</label>
                  <select class="form-select" name="is_mobile_vaccination" id="is_mobile_vaccination" required>
                      <option value="" disabled {{(is_null(old('is_mobile_vaccination'))) ? 'selected' : ''}}>Choose...</option>
                      <option value="Yes" {{(old('is_mobile_vaccination') == 'Yes') ? 'selected' : ''}}>Yes</option>
                      <option value="No" {{(old('is_mobile_vaccination') == 'No') ? 'selected' : ''}}>No</option>
                  </select>
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Notes <small>(If Applicable)</small></label>
                    <input type="text" class="form-control" name="notes" id="notes" value="{{old('notes')}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
    </div>
</form>

<script>
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
                selected: (val.regCode == '04') ? true : false, //default is Region IV-A
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
                        selected: (val.provCode == '0421') ? true : false, //default for Cavite
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
                        selected: (val.citymunCode == '042108') ? true : false, //default for General Trias
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