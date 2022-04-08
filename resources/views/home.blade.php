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
                <a href="{{route('patient_pending_list')}}" class="btn btn-lg btn-primary">Patient Registration</a>
                <a class="btn btn-lg btn-primary" data-bs-toggle="collapse" href="#ecol" role="button">Encode Vaccination</a>
                <div class="collapse" id="ecol">
                    <form action="" method="GET">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="scheddate" class="form-label">Schedule Date</label>
                                          <input type="date" class="form-control" name="scheddate" id="scheddate" value="{{old('scheddate', date('Y-m-d'))}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="vaccination_center_id" class="form-label">Select Vaccination Center</label>
                                          <select class="form-select" name="vaccination_center_id" id="vaccination_center_id">
                                          </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                  <label for="select_vaccine" class="form-label">Select Vaccine</label>
                                  <select class="form-select" name="select_vaccine" id="select_vaccine">
                                        <option value=""></option>
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
                            <a href="" class="btn btn-lg btn-primary">Manage Vaccination Schedules</a>
                            <a href="" class="btn btn-lg btn-primary">Manage Vaccination Centers</a>
                            <a href="" class="btn btn-lg btn-primary">List of Vaccines</a>
                            <a href="{{route('vaccinators_index')}}" class="btn btn-lg btn-primary">List of Vaccinators</a>
                            <hr>
                            <a href="" class="btn btn-lg btn-primary">List of System Users</a>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
        </div>
    </div>
</div>
@endsection
