@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('findschedule_accept', ['vaccination_schedule_id' => $data->id])}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">Confirm</div>
            <div class="card-body">
                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" onclick="return confirm('You will be placed in schedule after clicking the Submit Button. Click OK to Confirm.')">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection