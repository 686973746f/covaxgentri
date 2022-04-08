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
                <a href="" class="btn btn-lg btn-primary">Patient Registration</a>
                <a class="btn btn-lg btn-primary" data-bs-toggle="collapse" href="#ecol" role="button">Encode Vaccination</a>
                <div class="collapse" id="ecol">
                    <div class="card card-body">
                        <div class="d-grid gap-2">
                        </div>
                    </div>
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
