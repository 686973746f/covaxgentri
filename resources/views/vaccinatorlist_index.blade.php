@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col"><strong>List of Vaccinators</strong></div>
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
                        <th>Name</th>
                        <th>Date Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$item->getName()}}</td>
                        <td class="text-center">{{date('m/d/Y H:i', strtotime($item->created_at))}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="{{route('vaccinators_store')}}" method="POST">
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
                    <label for="lname" class="form-label"><span class="text-danger font-weight-bold">*</span>Last Name</label>
                    <input type="text" class="form-control" name="lname" id="lname" value="{{old('lname')}}" maxlength="50" required>
                </div>
                <div class="mb-3">
                    <label for="fname" class="form-label"><span class="text-danger font-weight-bold">*</span>First Name</label>
                    <input type="text" class="form-control" name="fname" id="fname" value="{{old('fname')}}" maxlength="50" required>
                </div>
                <div class="mb-3">
                    <label for="mname" class="form-label">Middle Name <i><small>(If Applicable)</small></i></label>
                    <input type="text" class="form-control" name="mname" id="mname" value="{{old('mname')}}" maxlength="50">
                </div>
                <div class="mb-3">
                    <label for="suffix" class="form-label">Suffix <i><small>(If Applicable)</small></i></label>
                    <input type="text" class="form-control" name="suffix" id="suffix" value="{{old('suffix')}}" maxlength="3" placeholder="e.g JR, SR, III, IV">
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