@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Vehicles') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Add Vehicle') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.vehicles.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ __('Name') }}</label>
                        <input type="text" class="form-control" name="nick_name" id="nick_name"
                            placeholder="Enter vehicle's name">
                        @error('Name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Fleet Type') }}</label>
                        <select name="fleet_type" id="" class="form-control select2">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($fleetType as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('fleet_type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Register No.') }}</label>
                        <input type="text" class="form-control" name="register_no" id="register_no"
                            placeholder="Enter Reg. No.">
                        @error('register_no')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Engine No.') }}</label>
                        <input type="text" class="form-control" name="engine_no" id="engine_no"
                            placeholder="Enter Eng. No.">
                        @error('engine_no')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Chasis No.') }}</label>
                        <input type="text" class="form-control" name="chasis_no" id="chasis_no"
                            placeholder="Enter Chasis No.">
                        @error('chasis_no')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Model No.') }}</label>
                        <input type="text" class="form-control" name="model_no" id="model_no"
                            placeholder="Enter Model No.">
                        @error('model_no')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Create') }}</button>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-danger">Close</a>
                </form>
            </div>
        </div>
    </section>
@endsection
