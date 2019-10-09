@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-4 justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ route('practices.destroy', $practice) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">{{ __('Delete Practice') }}</button>
            </form>

        </div>
    </div>

    @if(Session::has('success'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    @elseif(Session::has('error'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Practice') }}</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('practices.update', $practice) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $practice->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $practice->email }}" autocomplete="current-email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>

                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" autocomplete="current-file">

                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $practice->website }}"s autocomplete="website">

                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">

                            <label for="fields-of-practice" class="col-md-4 col-form-label text-md-right">{{ __('Fields Of Practice') }}</label>
                            
                            <div class="col-md-6">
                                <select class="form-control @error('fields_of_practice') is-invalid @enderror" multiple="multiple" name="fields_of_practice[]" id="fields-of-practice" size="6">
                                    @foreach($fieldsOfPractice as $field)
                                        <option @if($practice->fieldsOfPractice->contains($field)) selected @endif value="{{ $field->id}}">{{ $field->name }}</option>
                                    @endforeach
                                </select>

                                @error('fieldsOfPractice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection