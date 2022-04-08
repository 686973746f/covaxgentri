@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-success">
        <div class="card-header bg-success text-white"><strong>View Patient</strong></div>
        <div class="card-body">
            
            <form action="{{route('patient_action', ['id' => $data->id])}}" method="POST">
                <div class="card">
                    <div class="card-header text-center"><strong>Actions</strong></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-grid gap-2">
                                    <button type="submit" name="action" value="accept" class="btn btn-success">Accept</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-grid gap-2">
                                    <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection