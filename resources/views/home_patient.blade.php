@extends('layouts.app')

@section('content')
<div class="container" style="font-family: Arial, Helvetica, sans-serif">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Main Menu</div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#schedinit">Magpa-schedule na ng Bakuna laban sa COVID-19</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(auth()->guard('patient')->user()->ifHasPendingSchedule())
<div class="modal fade" id="schedinit" tabindex="-1" role="dialog" aria-labelledby="schedinit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-warning"><strong>Mayroon ka pang Pending Schedule</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Hindi ka na maaaring makapag-request ng panibagong schedule dahil mayroon ka nang schedule na kailangang puntahan.</p>
                <p>Pagdating mo sa Vaccination Site, ipakita lamang ang iyong Personal QR Code sa mga Staff bilang verification ng iyong schedule.</p>
                {!! QrCode::size(150)->generate(auth()->guard('patient')->user()->qr_id) !!}
                <hr>
                <p><strong>Account ID:</strong> {{auth()->guard('patient')->user()->id}}</p>
                <p><strong>Full Name:</strong> {{auth()->guard('patient')->user()->getName()}}</p>
                <p><i>(Maaari mo itong i-screenshot o i-print upang maging mas madali ang pag-proseso sa iyo ng mga Staff)</i></p>
            </div>
        </div>
    </div>
</div>
@elseif(auth()->guard('patient')->user()->getNextBakuna() == 'FINISHED')
<div class="modal fade" id="schedinit" tabindex="-1" role="dialog" aria-labelledby="schedinit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success"><strong>You are now fully Vaccinated</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Congratulations!</p>
                <p>Protektado ka na laban sa COVID-19 dahil kumpleto na ang iyong mga bakuna.</p>
                <p>Antabayanan ang ibang mga balita sa ating City Page at mga balita sa Telebisyon, Radio, atbp.</p>
            </div>
        </div>
    </div>
</div>
@elseif(auth()->guard('patient')->user()->ifNextDoseReady())
<form action="{{route('findschedule_index')}}" method="GET">
    <div class="modal fade" id="schedinit" tabindex="-1" aria-labelledby="schedinit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-info"><strong>Schedule your {{ucwords(strtolower(auth()->guard('patient')->user()->getNextBakuna()))}}</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="pref_vcenter" class="form-label">Pumili ng Vaccination Site na malapit sa iyo</label>
                    <select class="form-select" name="pref_vcenter" id="pref_vcenter" required>
                        <option value="" disabled {{(is_null(old('pref_vcenter'))) ? 'selected' : ''}}>Pumili...</option>
                        @foreach($vcenter_list as $vc)
                        <option value="{{$vc->id}}">{{ucwords(strtolower($vc->name))}} - {{ucwords(strtolower($vc->getAddress()))}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pref_vaccine" class="form-label">Pumili ng nais na Bakuna</label>
                    <select class="form-select" name="pref_vaccine" id="pref_vaccine" required>
                        @if(auth()->guard('patient')->user()->getNextBakuna() == '2ND DOSE')
                        <option value="{{auth()->guard('patient')->user()->getFirstBakunaDetails()->id}}">{{ucwords(strtolower(auth()->guard('patient')->user()->getFirstBakunaDetails()->vaccine_name))}}</option>
                        @else
                        <option value="" disabled {{(is_null(old('pref_vaccine'))) ? 'selected' : ''}}>Pumili...</option>
                        <option value="Any" {{(old('pref_vaccine') == 'Any') ? 'selected' : ''}}>Kahit anong bakuna / Ipakita lahat</option>
                        @foreach($vaccine_list as $vl)
                        <option value="{{$vl->id}}" {{(old('select_vaccine') == $vl->id) ? 'selected' : ''}}>{{ucwords(strtolower($vl->vaccine_name))}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if(auth()->guard('patient')->user()->getNextBakuna() == '2ND DOSE')
                    <p class="text-muted"><small>Note: Vaccine Selection was locked based on your First Dose Vaccine.</small></p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            </div>
        </div>
    </div>
</form>
@else
<div class="modal fade" id="schedinit" tabindex="-1" role="dialog" aria-labelledby="schedinit" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Unable to Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endif
@endsection