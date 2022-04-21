@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success text-white">
            <div class="d-flex justify-content-between">
                <div><strong>List of Pending Patients</strong></div>
                <div><a href="" class="btn btn-primary">Add Walk-in Patient</a></div>
            </div>
        </div>
        <div class="card-body">
            @if(session('msg'))
            <div class="alert alert-{{session('msgtype')}}" role="alert">
                {{session('msg')}}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>#</th>
                            <th>Date Submitted</th>
                            <th>Priority Group</th>
                            <th>Name</th>
                            <th>Birthdate</th>
                            <th>Age / Sex</th>
                            <th>Address</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{date('m/d/Y H:i:s', strtotime($item->created_at))}}</td>
                            <td class="text-center">{{$item->priority_group}}</td>
                            <td><a href="{{route('patient_view', ['id' => $item->id])}}">{{$item->getName()}}</a></td>
                            <td class="text-center">{{date('m/d/Y', strtotime($item->bdate))}}</td>
                            <td class="text-center">{{$item->getAge().' / '.$item->sex}}</td>
                            <td class="text-center">{{$item->getAddress()}}</td>
                            <td class="text-center">{{$item->contactno}}</td>
                            <td class="text-center">{{!is_null($item->email) ? $item->email : 'N/A'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection