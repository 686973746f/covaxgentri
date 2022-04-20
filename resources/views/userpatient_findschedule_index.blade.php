@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Schedule Lookup</div>
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
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