@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col"><strong>List of Vaccines</strong></div>
                <div class="col text-end"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addmodal">Add</button></div>
            </div>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <p>{{Str::plural('Error', $errors->count())}} detected while processing your request:</p>
                <hr>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
            @endif
            @if(session('msg'))
            <div class="alert alert-{{session('msgtype')}}" role="alert">
                {{session('msg')}}
            </div>
            @endif
            <table class="table table-striped table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Vaccine Name</th>
                        <th>Batch #</th>
                        <th>Lot #</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $item)
                    <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td><a href="">{{$item->vaccine_name}}</a></td>
                        <td>{{$item->default_batchno}}</td>
                        <td>{{}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="{{route('vaccinelist_store')}}" method="POST">
    @csrf
    <div class="modal fade" id="addmodal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Vaccinator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="vaccine_name" class="form-label"><span class="text-danger font-weight-bold">*</span>Name of Vaccine</label>
                    <input type="text" class="form-control" name="vaccine_name" id="vaccine_name" value="{{old('vaccine_name')}}" required>
                </div>
                <div class="mb-3">
                    <label for="default_batchno" class="form-label"><span class="text-danger font-weight-bold">*</span>Default Batch Number</label>
                    <input type="text" class="form-control" name="default_batchno" id="default_batchno" value="{{old('default_batchno')}}" required>
                </div>
                <div class="mb-3">
                    <label for="default_lotno" class="form-label"><span class="text-danger font-weight-bold">*</span>Default Lot Number</label>
                    <input type="text" class="form-control" name="default_lotno" id="default_lotno" value="{{old('default_lotno')}}" required>
                </div>
                <div class="mb-3">
                    <label for="expiration_date" class="form-label">Expiration Date</label>
                    <input type="date" class="form-control" name="expiration_date" id="expiration_date" value="{{old('expiration_date')}}" min="{{date('Y-m-d', strtotime('+1 Day'))}}" max="{{date('Y-12-31', strtotime('+1 Year'))}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
    </div>
</form>
@endsection