@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-4 justify-content-left">
        <div class="col-md-10">
            <div class="btn-group">
            <a href="{{ route('employees.edit', ['employee' => $employee]) }}" class="btn btn-primary" role="button" aria-pressed="true">{{ __('Edit Employee') }}</a>

                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" onclick="
                    event.preventDefault();
                    document.getElementById('delete-employee-form').submit()">Delete Employee</a>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('success'))
        <div class="row mb-4 justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    @elseif(Session::has('error'))
        <div class="row mb-4 justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            </div>
        </div>
    @endif
    
    @if('employee')
     <div class="row md-4 justify-content-left">
        <div class="col-md-5">
            <h2>{{ $employee->full_name }}</h2>
            <hr>
        </div>
    </div>
    <div class="row md-4 justify-content-left">
        <div class="col-md-5">
            <p> First Name: {{ $employee->first_name }} </p>
            <p> Last Name: {{ $employee->last_name }} </p>
            <p> Email: @if($employee->email)<a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>@else-@endif </p>
            <p> Phone: @if($employee->phone)<a href="tel:{{ $employee->phone }}">{{ $employee->phone }}</a>@else-@endif </p>
            <p> Practice: @if($employee->practice_id)<a href="{{ route('practices.show', ['practice' => $employee->practice]) }}">{{ $employee->practice->name}}</a>@else-@endif </p>
        </div>
    </div>
    @endif


    <form id="delete-employee-form" action="{{ route('employees.destroy', ['employee' => $employee]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection