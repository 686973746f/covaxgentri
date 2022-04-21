@extends('layouts.app')

@section('content')
<form action="{{route('patient_action', ['id' => $data->id])}}" method="POST">
    @csrf
    <div class="container">
        <div class="card border-success">
            <div class="card-header bg-success text-white"><strong>View Patient</strong></div>
            <div class="card-body">
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
                                    <button type="button"  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectmodal">Reject</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectmodal" tabindex="-1" aria-labelledby="rejectmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger"><strong>Reject Patient</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="action_remarks">Input Reason</label>
                  <input type="text" class="form-control" name="action_remarks" id="action_remarks">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="action" value="reject" class="btn btn-primary">Reject</button>
            </div>
            </div>
        </div>
    </div>
</form>
@endsection