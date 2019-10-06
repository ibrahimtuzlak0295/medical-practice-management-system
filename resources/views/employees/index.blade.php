@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row mb-4 justify-content-left">
		<div class="col-md-10">
			<a href="{{ route('employees.create') }}" class="btn btn-primary" role="button" aria-pressed="true">{{ __('Create Employee') }}</a>
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
            @if('employees')
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Full Name</th>
                            <th scope="col">Practice</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td><a href="{{ route('employees.show', ['employee' => $employee]) }}">{{ $employee->full_name }}</a></td>
                                <td><a href="{{ route('practices.show', ['practice' => $employee->practice]) }}">{{ $employee->practice->name }}</a></td>
                                <td><a href="mailto:{{ $employee->email }}">{{ $employee->email }}</td>
                                <td><a href="tel:{{ $employee->phone }}">{{ $employee->phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $employees->links() }}
            @else
            	<p class="alert alert-warning">No employees available. Click <a href="{{ route('employees.create') }}">here</a> to create a new practice.</p>
            @endif
        </div>
    </div>
</div>
@endsection
