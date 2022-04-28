@extends('layouts.app')

@section('content')
<div class="container-fluid">
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
                <div class="col-md-6"><p>Pending Patients Count: <strong>{{$pending_list->count()}}</strong></p></div>
                <div class="col-md-6"><p>Completed Patients Count: <strong>{{$completed_list->count()}}</strong></p></div>
            </div>
            <p>Total: </p>
        </div>
        <div class="card-body">
            @if(session('msg'))
            <div class="alert alert-{{session('msgtype')}}" role="alert">
                {{session('msg')}}
            </div>
            @endif
            <div class="card mb-3">
                <div class="card-header">Pending List</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display row-border cell-border stripe" style="width:100%" id="table1">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Age/Sex</th>
                                    <th>Mobile Number</th>
                                    <th>Brgy</th>
                                    <th>City/Province</th>
                                    <th>Priority Group</th>
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
                                    <td class="text-center">{{$item->getAge()}}/{{substr($item->sex,0,1)}}</td>
                                    <td class="text-center">{{$item->contactno}}</td>
                                    <td class="text-center">{{$item->address_brgy_text}}</td>
                                    <td class="text-center">{{$item->address_muncity_text.', '.$item->address_province_text}}</td>
                                    <td class="text-center">{{$item->priority_group}}</td>
                                    <td class="text-center">{{date('m/d/Y', strtotime($item->getCurrentSchedData()->for_date))}}</td>
                                    <td class="text-center">{{$item->getCurrentSchedData()->vaccinelist->vaccine_name}}</td>
                                    <td class="text-center">{{$item->getCurrentSchedData()->sched_type}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Completed List</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display row-border cell-border stripe" style="width:100%" id="table2">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Age/Sex</th>
                                    <th>Mobile Number</th>
                                    <th>Brgy</th>
                                    <th>City/Province</th>
                                    <th>Priority Group</th>
                                    <th>Vaccination Date</th>
                                    <th>Vaccine</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completed_list as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td><a href="{{route('encodevaccination_viewpatient', ['patient_id' => $item->id, 'get_date' => request()->input('for_date')])}}">{{$item->getName()}}</a></td>
                                    <td class="text-center">{{$item->getAge()}}/{{substr($item->sex,0,1)}}</td>
                                    <td class="text-center">{{$item->contactno}}</td>
                                    <td class="text-center">{{$item->address_brgy_text}}</td>
                                    <td class="text-center">{{$item->address_muncity_text.', '.$item->address_province_text}}</td>
                                    <td class="text-center">{{$item->priority_group}}</td>
                                    <td class="text-center">{{date('m/d/Y', strtotime($item->getCurrentSchedData()->for_date))}}</td>
                                    <td class="text-center">{{$item->getCurrentSchedData()->vaccinelist->vaccine_name}}</td>
                                    <td class="text-center">{{$item->getCurrentSchedData()->sched_type}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#table1, #table2').DataTable();
    });
</script>
@endsection