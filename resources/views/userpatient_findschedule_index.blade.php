@extends('layouts.app')

@section('content')
<style>
    .fc-event-time, .fc-event-title {
        padding: 0 1px;
        white-space: normal;
    }
</style>
<div class="container" style="font-family: Arial, Helvetica, sans-serif">
    <div class="card">
        <div class="card-header"><strong>Schedule Lookup</strong></div>
        <div class="card-body">
            @if(session('msg'))
            <div class="alert alert-{{session('msgtype')}}" role="alert">
                {{session('msg')}}
            </div>
            @endif
            <div class="alert alert-info" role="alert">
                <p class="h4">Showing Vaccination Schedule on</p>
                <p class="h5">Vaccination Site: <u><strong>{{$vcenter->name}}</strong></u></p>
                <p class="h5">Vaccine: <u><strong>{{$for_vaccine}}</strong></u></p>
                <hr>
                <p><strong class="text-danger">Note:</strong> Pumili ng schedule na naaayon sa araw na siguradong makakapunta ka.</p>
            </div>
            <div id='calendar'></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
        validRange: {
            start: "{{date('Y-m-d')}}",
            end: "{{date('Y-12-31')}}",
        },
        initialView: 'dayGridMonth',
        events: [
        @foreach($sched_list as $sc)
        {
            title: '{{$sc->vaccinelist->vaccine_name}} | Slot: {{$sc->current_slots}}/{{$sc->max_slots}}',
            start: '{{$sc->for_date}}',
            url: "{{route('findschedule_verify', ['vaccination_schedule_id' => $sc->id])}}",
        },
        @endforeach
        ]
        });
        calendar.render();
    });
</script>
@endsection