@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-4 justify-content-left">
        <div class="col-md-12">
            <div class="btn-group">
            <a href="{{ route('practices.edit', ['practice' => $practice->id]) }}" class="btn btn-primary" role="button" aria-pressed="true">{{ __('Edit Practice') }}</a>

                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" onclick="
                    event.preventDefault();
                    document.getElementById('delete-practice-form').submit()">Delete Practice</a>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('success'))
        <div class="row mb-4 justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    @elseif(Session::has('error'))
        <div class="row mb-4 justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            </div>
        </div>
    @endif
    
    @if('practice')
     <div class="row md-4 justify-content-left">
        <div class="col-md-12">
            <h2>{{ $practice->name }}</h2>
            <hr>
        </div>
    </div>
    <div class="row md-4 justify-content-center">
        <div class="col-md-6">
        <h4>Employees</h4>
            <hr>
            @forelse($practice->employees as $employee)
                <li><a href="{{ route('employees.show', ['employee' => $employee->id]) }}">{{ $employee->full_name }}</a></li>
            @empty
                <p class="alert alert-warning">No employees set.</p>
            @endforelse                
        </div>
        <div class="col-md-6">
            <h4>Fields Of Practice</h4>
            <hr>
            <select class="form-control input-large" disabled="" multiple="multiple" name="fields_of_practice[]" id="fields-of-practice">
                @foreach($fields_of_practice as $field_of_practice)
                    <option @if($practice->fieldsOfPractice->contains($field_of_practice)) selected @endif value="{{ $field_of_practice->id }}">{{ $field_of_practice->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    <form id="delete-practice-form" action="{{ route('practices.destroy', ['practice' => $practice]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection