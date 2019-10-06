@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 justify-content-left">
        <div class="col-md-12">
            <a href="{{ route('fields-of-practice.create') }}" class="btn btn-primary" role="button" aria-pressed="true">{{ __('Create Field Of Practice') }}</a>
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

    <div class="row justify-content-left">
        <div class="col-md-12">
            @if('practices')
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fields_of_practice as $field_of_practice)
                            <tr>
                                <td><a href="{{ route('fields-of-practice.show', ['field_of_practice' => $field_of_practice->id]) }}">{{ $field_of_practice->name }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $fields_of_practice->links() }}
            @else
                <p class="alert alert-warning">No fields of practice available. Click <a href="{{ route('fields-of-practice.create') }}">here</a> to create a new field practice.</p>
            @endif
        </div>
    </div>
</div>
@endsection
