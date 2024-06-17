@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Agencies') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Add Agency') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.agencies.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ __('Name') }}</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Enter Agency Name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('City') }}</label>
                        <input type="text" class="form-control" name="city" id="city"
                            placeholder="Enter City Name">
                        @error('city')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Location') }}</label>
                        <input type="text" class="form-control" name="location" id="location"
                            placeholder="Enter Location">
                        @error('location')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Mobile Number') }}</label>
                        <input type="tel" class="form-control phone-number" name="mobile" id="mobile"
                            placeholder="Enter Mobile Number">
                        @error('mobile')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Create') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
