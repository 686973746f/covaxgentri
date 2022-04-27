@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white bg-success">Tagumpay!</div>
                <div class="card-body text-center">
                    <p>Naayos na ang iyong proseso ng iyong schedule.</p>
                    <p>Pagdating mo sa Vaccination Site, ipakita lamang ang iyong Personal QR Code sa mga Staff bilang verification ng iyong schedule. </p>
                    {!! QrCode::size(150)->generate(auth()->guard('patient')->user()->qr_id) !!}
                    <hr>
                    <p><strong>Account ID:</strong> {{auth()->guard('patient')->user()->id}}</p>
                    <p><strong>Full Name:</strong> {{auth()->guard('patient')->user()->getName()}}</p>
                    <p><i>(Maaari mo itong i-screenshot o i-print upang maging mas madali ang pag-proseso sa iyo ng mga Staff)</i></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection