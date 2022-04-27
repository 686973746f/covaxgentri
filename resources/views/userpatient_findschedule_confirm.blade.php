@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('findschedule_accept', ['vaccination_schedule_id' => $data->id])}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header"><strong>Kumpirmahin ang Napiling Schedule</strong></div>
                    <div class="card-body">
                        <p>Kapag pinindot ang <span class="text-success"><strong>[Ipagpatuloy]</strong></span> na button, ikaw ay sigurado nang makakapunta sa schedule na napili mo.</p>
                        <hr>
                        <p>Lugar ng Pagbabakunahan: </p>
                        <p>Lokasyon ng napiling Bakunahan: </p>
                        <p>Araw ng Schedule: </p>
                        <p>Bakunang Napili: </p>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{url()->previous()}}" class="btn btn-secondary">Bumalik</a>
                        <button type="submit" class="btn btn-success" onclick="return confirm('You will be placed in schedule after clicking the Submit Button. Click OK to Confirm.')">Magpatuloy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection