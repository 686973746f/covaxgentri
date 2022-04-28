@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><strong>Welcome</strong></div>
        <div class="card-body">
            @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
            @endif
            <div class="d-grid gap-2">
                <a href="{{route('patient_view_index')}}" class="btn btn-lg btn-primary">Patient Registration</a>
                <a class="btn btn-lg btn-primary" data-bs-toggle="collapse" href="#ecol" role="button">Encode Vaccination</a>
                <div class="collapse" id="ecol">
                    <form action="{{route('encodevaccination_index')}}" method="GET">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="for_date" class="form-label">Schedule Date</label>
                                          <input type="date" class="form-control" name="for_date" id="for_date" value="{{old('for_date', date('Y-m-d'))}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="vaccination_center_id" class="form-label">Select Vaccination Center</label>
                                          <select class="form-select" name="vaccination_center_id" id="vaccination_center_id" required>
                                            <option value="" disabled {{(is_null(old('vaccination_center_id'))) ? 'selected' : ''}}>Choose...</option>
                                            @foreach($vcenter_list as $vc)
                                            <option value="{{$vc->id}}" {{(old('vaccination_center_id') == $vc->id) ? 'selected' : ''}}>{{$vc->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                  <label for="vaccinelist_id" class="form-label">Select Vaccine</label>
                                  <select class="form-select" name="vaccinelist_id" id="vaccinelist_id" required>
                                      <option value="" disabled {{(is_null(old('vaccinelist_id'))) ? 'selected' : ''}}>Choose</option>
                                      <option value="All" {{(old('vaccinelist_id') == 'All') ? 'selected' : ''}}>Show All</option>
                                      @foreach($vaccine_list as $vl)
                                      <option value="{{$vl->id}}" {{(old('vaccinelist_id') == $vl->id) ? 'selected' : ''}}>{{$vl->vaccine_name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Go</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <a class="btn btn-lg btn-primary" data-bs-toggle="collapse" href="#rcol" role="button">Reports</a>
                <div class="collapse" id="rcol">
                    <div class="card card-body">
                        <div class="d-grid gap-2">
                        </div>
                    </div>
                </div>
                <a href="" class="btn btn-lg btn-primary">Options</a>
                <hr>
                <a class="btn btn-lg btn-primary" data-bs-toggle="collapse" href="#apcol" role="button">Admin Panel</a>
                <div class="collapse" id="apcol">
                    <div class="card card-body">
                        <div class="d-grid gap-2">
                            <a href="{{route('vaccinationschedule_index')}}" class="btn btn-primary">Manage Vaccination Schedules</a>
                            <a href="{{route('vaccinationcenters_index')}}" class="btn btn-primary">Manage Vaccination Centers</a>
                            <a href="{{route('vaccinelist_index')}}" class="btn btn-primary">List of Vaccines</a>
                            <a href="{{route('vaccinators_index')}}" class="btn btn-primary">List of Vaccinators</a>
                            <hr>
                            <a href="" class="btn btn-primary">List of System Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
