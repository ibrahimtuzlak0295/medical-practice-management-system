@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-4 justify-content-left">
        <div class="col-md-12">
            <div class="btn-group">
            <a href="{{ route('fields-of-practice.edit', $fieldsOfPractice) }}" class="btn btn-primary" role="button" aria-pressed="true">{{ __('Edit Field Of Practice') }}</a>

                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" onclick="
                    event.preventDefault();
                    document.getElementById('delete-field-of-practice-form').submit()">Delete Field Of Practice</a>
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
    
    @if('fieldsOfPractice')
     <div class="row md-4 justify-content-left">
        <div class="col-md-12">
            <h2>{{ $fieldsOfPractice->name }}</h2>
            <hr>
        </div>
    </div>
    <div class="row md-4 justify-content-center">
        <div class="col-md-12">
        <h4>Practices</h4>
            <hr>
            @forelse($fieldsOfPractice->practices as $practice)
                <li><a href="{{ route('practices.show', $practice) }}">{{ $practice->name }}</a></li>
            @empty
                <p class="alert alert-warning">{{ __('No practices set.')}}</p>
            @endforelse
        
        </div>
    </div>
    @endif

    <form id="delete-field-of-practice-form" action="{{ route('fields-of-practice.destroy', $fieldsOfPractice) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection