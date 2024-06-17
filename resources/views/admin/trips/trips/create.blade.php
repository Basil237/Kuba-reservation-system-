@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Trips') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Add Trip') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.trips.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ __('Title') }}</label>
                        <input type="text" class="form-control" name="title" id="title"
                            placeholder="Enter Trip's Name">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Fleet Type') }}</label>
                        <select name="fleet_type" id="" class="form-control select2">
                            @foreach ($fleetTypes as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->name }}">{{ __($item->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('fleetTypes')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Route') }}</label>
                        <select name="route" id="" class="form-control select2">
                            @foreach ($routes as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->name }}">{{ __($item->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('routes')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Schedule') }}</label>
                        <select name="schedule" id="" class="form-control select2">
                            @foreach ($schedules as $item)
                                @php
                                    $start = Carbon\Carbon::parse($item->start_from);
                                    $end = Carbon\Carbon::parse($item->end_at);
                                @endphp
                                <option value="{{ $item->id }}"
                                    data-name="{{ showDateTime($item->start_from, 'h:i a') . ' - ' . showDateTime($item->end_at, 'h:i a') }}">
                                    {{ showDateTime($item->start_from, 'h:i a') . ' - ' . showDateTime($item->end_at, 'h:i a') }}
                                </option>
                            @endforeach
                        </select>
                        @error('schedules')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Start From') }}</label>
                        <select name="start_from" id="" class="form-control select2">
                            @foreach ($stoppages as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->name }}">{{ __($item->name) }}
                                    {{ __($item->location) }}
                                </option>
                            @endforeach
                        </select>
                        @error('start_from')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('End To') }}</label>
                        <select name="end_to" id="" class="form-control select2">
                            @foreach ($stoppages as $item)
                                <option value="{{ $item->id }}" data-name="{{ $item->name }}">{{ __($item->name) }}
                                    {{ __($item->location) }}
                                </option>
                            @endforeach
                        </select>
                        @error('end_to')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Day Off') }}</label>
                        <select name="day_off[]" id="day_off" multiple="multiple" required class="form-control select2">
                            <option value="0">{{ __('Sunday') }}</option>
                            <option value="1">{{ __('Monday') }}</option>
                            <option value="2">{{ __('Tuesday') }}</option>
                            <option value="3">{{ __('Wednesday') }}</option>
                            <option value="4">{{ __('Thursday') }}</option>
                            <option value="5">{{ __('Friday') }}</option>
                            <option value="6">{{ __('Saturday') }}</option>
                        </select>
                        @error('day_off')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Create') }}</button>
                    <a href="{{ route('admin.trips.index') }}" class="btn btn-danger">Close</a>
                </form>
            </div>
        </div>
    </section>
@endsection
