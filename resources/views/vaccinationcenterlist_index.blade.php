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

            <table class="table table-striped table-bordered">
                <thead class="text-center">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
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
                    <label for="vaccine_name" class="form-label"><span class="text-danger font-weight-bold">*</span>Name of Vaccination Center</label>
                    <input type="text" class="form-control" name="vaccine_name" id="vaccine_name" value="{{old('vaccine_name')}}" required>
                </div>
                <div class="mb-3">
                    <label for="default_batchno" class="form-label"><span class="text-danger font-weight-bold">*</span>Prefix</label>
                    <input type="text" class="form-control" name="default_batchno" id="default_batchno" value="{{old('default_batchno')}}" required>
                </div>
                <div class="mb-3">
                    <label for="default_lotno" class="form-label"><span class="text-danger font-weight-bold">*</span>Location</label>
                    <input type="text" class="form-control" name="default_lotno" id="default_lotno" value="{{old('default_lotno')}}" required>
                </div>
                <div class="mb-3">
                    <label for="expiration_date" class="form-label">Expiration Date</label>
                    <input type="date" class="form-control" name="expiration_date" id="expiration_date" value="{{old('expiration_date')}}" min="{{date('Y-m-d', strtotime('+1 Day'))}}" max="{{date('Y-12-31', strtotime('+1 Year'))}}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="expiration_date" class="form-label">Time Start</label>
                            <input type="time" class="form-control" name="expiration_date" id="expiration_date" value="{{old('expiration_date')}}" min="{{date('Y-m-d', strtotime('+1 Day'))}}" max="{{date('Y-12-31', strtotime('+1 Year'))}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="expiration_date" class="form-label">Time Start</label>
                            <input type="time" class="form-control" name="expiration_date" id="expiration_date" value="{{old('expiration_date')}}" min="{{date('Y-m-d', strtotime('+1 Day'))}}" max="{{date('Y-12-31', strtotime('+1 Year'))}}">
                        </div>
                    </div>
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
                <div class="form-group">
                  <label for=""></label>
                  <select class="form-select" name="" id="">
                    <option></option>
                    <option></option>
                    <option></option>
                  </select>
                </div>
                <div class="mb-3">
                    <label for="default_lotno" class="form-label"><span class="text-danger font-weight-bold">*</span>Notes</label>
                    <input type="text" class="form-control" name="default_lotno" id="default_lotno" value="{{old('default_lotno')}}" required>
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