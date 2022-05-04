@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><strong>Patient Records</strong> (Total Count: {{$list->total()}})</div>
            <div class="card-body">
                <form action="{{route('patient_existing_index')}}" method="GET">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="q" value="{{request()->input('q')}}" placeholder="Search by Name / ID" required>
                                <div class="input-group-append">
                                  <button class="btn btn-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if(session('msg'))
                <div class="alert alert-{{session('msgtype')}}" role="alert">
                    {{session('msg')}}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Birthdate</th>
                                <th>Age / Sex</th>
                                <th>Address</th>
                                <th>Contact No.</th>
                                <th>Email</th>
                                <th>Priority Group</th>
                                <th>Date Registered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($list as $item)
                            <tr>
                                <td class="text-center">{{$item->id}}</td>
                                <td><a href="{{route('patient_view', ['id' => $item->id])}}">{{$item->getName()}}</a></td>
                                <td class="text-center">{{date('m/d/Y', strtotime($item->bdate))}}</td>
                                <td class="text-center">{{$item->getAge().' / '.$item->sex}}</td>
                                <td class="text-center"><small>{{$item->getAddress()}}</small></td>
                                <td class="text-center">{{$item->contactno}}</td>
                                <td class="text-center">{{!is_null($item->email) ? $item->email : 'N/A'}}</td>
                                <td class="text-center">{{$item->priority_group}}</td>
                                <td class="text-center">{{date('m/d/Y H:i:s', strtotime($item->created_at))}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No data available in table.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection