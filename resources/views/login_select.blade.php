@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-grid gap-2">
                                <a href="{{route('login')}}" class="btn btn-lg btn-primary">Admin / Encoder Login</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-grid gap-2">
                                <a href="{{route('patient_login')}}" class="btn btn-lg btn-primary">Patient Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection