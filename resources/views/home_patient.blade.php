@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Welcome</div>
        <div class="card-body">
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#schedinit">Schedule Your Vaccination Now</button>
            </div>
        </div>
    </div>
</div>

@if(auth()->guard('patient')->user()->ifNextDoseReady())
<form action="{{route('findschedule_index')}}" method="GET">
    <div class="modal fade" id="schedinit" tabindex="-1" aria-labelledby="schedinit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Schedule your {{ucwords(auth()->guard('patient')->user()->getNextBakuna())}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="pref_vcenter" class="form-label">Select Preferred Vaccination Center</label>
                    <select class="form-select" name="pref_vcenter" id="pref_vcenter">
                        <option value="" disabled {{(is_null(old('pref_vcenter'))) ? 'selected' : ''}}>Choose...</option>
                        @foreach($vcenter_list as $vc)
                        <option value="{{$vc->id}}">{{$vc->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pref_vaccine" class="form-label">Select Preferred Vaccine</label>
                    <select class="form-select" name="pref_vaccine" id="pref_vaccine">
                        <option value="" disabled {{(is_null(old('pref_vaccine'))) ? 'selected' : ''}}>Choose...</option>
                        <option value="Any" {{(old('pref_vaccine') == 'Any') ? 'selected' : ''}}>Any Vaccine</option>
                        @foreach($vaccine_list as $vl)
                        <option value="{{$vl->id}}" {{(old('select_vaccine') == $vl->id) ? 'selected' : ''}}>{{$vl->vaccine_name}}</option>
                        @endforeach
                    </select>
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
                <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Cannot Schedule Yet
            </div>
        </div>
    </div>
</div>
@endif
@endsection