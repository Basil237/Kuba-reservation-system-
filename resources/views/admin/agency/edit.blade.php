@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Agencies') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Update Agency') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.agencies.update', $agency->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('Name') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ $agency->name }}" id="name"
                            placeholder="Enter Agency Name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('City') }}</label>
                        <input type="text" class="form-control" name="city" value="{{ $agency->city }}" id="city"
                            placeholder="Enter City Name">
                        @error('city')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Location') }}</label>
                        <input type="text" class="form-control" name="location" value="{{ $agency->location }}" id="location"
                            placeholder="Enter Location">
                        @error('location')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Mobile Number') }}</label>
                        <input type="tel" class="form-control phone-number" name="mobile" value="{{ $agency->mobile }}" id="mobile"
                            placeholder="Enter Mobile Number">
                        @error('mobile')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                    <a href="{{ route('admin.agencies.index') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                </form>
            </div>
        </div>
    </section>
@endsection
