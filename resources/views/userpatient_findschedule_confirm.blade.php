@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('findschedule_accept')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">Confirm</div>
            <div class="card-body">
                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection