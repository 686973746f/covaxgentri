@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success text-white">
            <div class="d-flex justify-content-between">
                <div><strong><i class="fa-solid fa-person me-2"></i>List of Pending Patients</strong></div>
                <div><a href="{{route('walkin_create')}}" class="btn btn-primary"><i class="fa-solid fa-person-circle-plus me-2"></i>Add Walk-in Patient</a></div>
            </div>
        </div>
        <div class="card-body">
            @if(session('msg'))
            <div class="alert alert-{{session('msgtype')}}" role="alert">
                {{session('msg')}}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table1">
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
                        @forelse($list as $item)
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
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No data available in table.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination justify-content-center mt-3">
                {{$list->appends(request()->input())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection