@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <p><strong>Encode Vaccination for {{date('m/d/Y - D', strtotime(session('session_for_date')))}}</strong></p>
            <hr>
            <div class="row">
                <div class="col-md-6"><p>Selected Vaccination Site:</p></div>
                <div class="col-md-6"><p>Selected Vaccine:</p></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6"><p>Pending Patients Count:</p></div>
                <div class="col-md-6"><p>Completed Patients Count:</p></div>
            </div>
            <p>Total: </p>
        </div>
        <div class="card-body">
            @if(session('msg'))
            <div class="alert alert-{{session('msgtype')}}" role="alert">
                {{session('msg')}}
            </div>
            @endif
            <table class="table table-bordered table-striped">
                <thead class="bg-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Age/Sex</th>
                        <th>Mobile Number</th>
                        <th>Vaccination Date</th>
                        <th>Vaccine</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pending_list as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td><a href="{{route('encodevaccination_viewpatient', ['patient_id' => $item->id, 'get_date' => request()->input('for_date')])}}">{{$item->getName()}}</a></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection