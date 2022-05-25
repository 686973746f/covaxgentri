@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('patientscan_process')}}" method="POST" autocomplete="off">
                @csrf
                <div class="card">
                    <div class="card-header"><i class="fa-solid fa-qrcode me-2"></i>Search Patient by QR Code</div>
                    <div class="card-body">
                        @if(session('msg'))
                        <div class="alert alert-{{session('msgtype')}} text-center" role="alert">
                            {{session('msg')}}
                        </div>
                        @endif
                        <div class="form-group">
                          <label for="qr_id" class="form-label">Scan the QR Code here</label>
                          <input type="text" class="form-control" id="qr_id" name="qr_id" required autofocus>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass-arrow-right me-2"></i>Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection