@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Encode Vaccination</div>
        <div class="card-body">
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