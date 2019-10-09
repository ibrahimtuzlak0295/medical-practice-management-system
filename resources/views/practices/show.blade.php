@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-4 justify-content-left">
        <div class="col-md-12">
            <div class="btn-group">
            <a href="{{ route('practices.edit', $practice) }}" class="btn btn-primary" role="button" aria-pressed="true">{{ __('Edit Practice') }}</a>

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
            @if($practice->logo)<img width="100" alt="{{ $practice->name }}" src="{{ $practice->logo}}">@endif

            <hr>
            <p>Name: {{ $practice->name }}</p>
            <p>Email: @if($practice->email)<a href="mailto:{{ $practice->email }}">{{ $practice->email }}</a>@else-@endif</p>
            <p>Logo: @if($practice->logo)<a target="_blank" href="{{ $practice->logo }}">{{ $practice->logo }}</a>@else-@endif</p>
            <p>Website: @if($practice->website)<a href="mailto:{{ $practice->website }}">{{ $practice->website }}</a>@else-@endif</p>
        </div>
    </div>
    <div class="row md-4 justify-content-center">
        <div class="col-md-6">
        <h4>Employees</h4>
            <hr>
            @forelse($practice->employees as $employee)
                <li><a href="{{ route('employees.show', $employee) }}">{{ $employee->full_name }}</a></li>
            @empty
                <p class="alert alert-warning">No employees set.</p>
            @endforelse                
        </div>
        <div class="col-md-6">
            <h4>Fields Of Practice</h4>
            <hr>
            <select class="form-control input-large" disabled="" multiple="multiple" name="fields_of_practice[]" id="fields-of-practice">
                @foreach($fieldsOfPractice as $field)
                    <option @if($practice->fieldsOfPractice->contains($field)) selected @endif value="{{ $field->id }}">{{ $field->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    <form id="delete-practice-form" action="{{ route('practices.destroy', $practice) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection