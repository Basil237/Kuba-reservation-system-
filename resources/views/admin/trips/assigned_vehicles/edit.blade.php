@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Assign Vehicle') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Assign a vehicle') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.assigned-vehicles.update', $assignedVehicle->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('Trip') }}</label>
                        <select name="trip" id="" class="form-control select2">
                            @foreach ($trips as $item)
                                <option {{ $item->id === $assignedVehicle->trip_id ? 'selected' : '' }}
                                    value="{{ $item->id }}" data-vehicles="{{ $item->fleetType->activeVehicles }}">
                                    {{ __($item->title) }}</option>
                            @endforeach
                        </select>
                        @error('trips')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Vehicle') }}</label>
                        <select name="vehicle" id="" class="form-control select2">
                            @foreach ($vehicles as $item)
                                <option {{ $item->id === $assignedVehicle->vehicle_id ? 'selected' : '' }}
                                    value="{{ $item->id }}" data-vehicles="{{ $item->fleetType->activeVehicles }}">
                                    {{ __($item->nick_name) }} ({{ __($item->register_no) }})</option>
                            @endforeach
                        </select>
                        @error('vehicles')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                    <a href="{{ route('admin.assigned-vehicles.index') }}" class="btn btn-danger">Close</a>
                </form>
            </div>
        </div>
    </section>
@endsection
