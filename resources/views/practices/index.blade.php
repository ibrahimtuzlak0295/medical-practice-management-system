@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row mb-4 justify-content-left">
		<div class="col-md-12">
			<a href="{{ route('practices.create') }}" class="btn btn-primary" role="button" aria-pressed="true">{{ __('Create Practice') }}</a>
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
                            <th scope="col">Email</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Website</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($practices as $practice)
                            <tr>
                                <td><a href="{{ route('practices.show', ['practice' => $practice->id]) }}">{{ $practice->name }}</a></td>
                                <td>@if($practice->email){{ $practice->email }}@else-@endif</td>
                                <td>@if($practice->logo) <a target="_blank" href="{{ $practice->logo }}">{{ $practice->logo }}</a>@else-@endif</td>
                                <td>@if($practice->website)<a target="_blank" href="{{ $practice->website }}">{{ $practice->website }}</a>@else-@endif</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $practices->links() }}
            @else
            	<p class="alert alert-warning">No practices available. Click <a href="{{ route('practices.create') }}">here</a> to create a new practice.</p>
            @endif
        </div>
    </div>
</div>
@endsection
