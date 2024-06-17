@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Vehicles') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Update Vehicle') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('Name') }}</label>
                        <input type="text" class="form-control" name="nick_name" id="nick_name"
                            placeholder="Enter vehicle's name" value="{{ $vehicle->nick_name }}">
                        @error('Name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Fleet Type') }}</label>
                        <select name="fleet_type" id="" class="form-control select2">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach ($fleetType as $item)
                                <option {{ $item->id === $vehicle->fleet_type_id ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('fleet_type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Register No.') }}</label>
                        <input type="text" class="form-control" name="register_no" id="register_no"
                            placeholder="Enter Reg. No." value="{{ $vehicle->register_no }}">
                        @error('register_no')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Engine No.') }}</label>
                        <input type="text" class="form-control" name="engine_no" id="engine_no"
                            placeholder="Enter Eng. No." value="{{ $vehicle->engine_no }}">
                        @error('engine_no')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Chasis No.') }}</label>
                        <input type="text" class="form-control" name="chasis_no" id="chasis_no"
                            placeholder="Enter Chasis No." value="{{ $vehicle->chasis_no }}">
                        @error('chasis_no')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Model No.') }}</label>
                        <input type="text" class="form-control" name="model_no" id="model_no"
                            placeholder="Enter Model No." value="{{ $vehicle->model_no }}">
                        @error('model_no')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-danger">Close</a>
                </form>
            </div>
        </div>
    </section>
@endsection
