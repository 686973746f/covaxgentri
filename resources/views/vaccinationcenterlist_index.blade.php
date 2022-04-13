@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <strong>Manage Vaccination Centers</strong>
                </div>
                <div class="col text-end">
                    
                </div>
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
        </div>
    </div>
</div>
@endsection