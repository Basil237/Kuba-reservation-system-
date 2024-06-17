@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Routes') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Update Route') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.route.update', $route->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter Name" value="{{ $route->name }}">
                                @error('Name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('Start From') }}</label>
                                <select name="start_from" id="" class="form-control select2">
                                    <option value="">{{ __('Select an option') }}</option>
                                    @foreach ($allStoppages as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($route->start_from == $item->id) selected @endif>
                                            {{ __($item->name) . '-' . __($item->location) }}</option>
                                    @endforeach
                                </select>
                                @error('start_from')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group mt-2">
                                    <div class="custom-control custom-checkbox form-check-primary">
                                        <input type="checkbox" class="custom-control-input" id="has-stoppage"
                                            {{ count($stoppages) > 0 ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="has-stoppage">@lang('Has More Stoppage')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('End To') }}</label>
                                <select name="end_to" id="" class="form-control select2">
                                    <option value="">{{ __('Select an option') }}</option>
                                    @foreach ($allStoppages as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($route->end_to == $item->id) selected @endif>
                                            {{ __($item->name) . '-' . __($item->location) }}</option>
                                    @endforeach
                                </select>
                                @error('end_to')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="stoppages-wrapper col-md-12">
                            <div class="row stoppages-row">
                                @if (count($stoppages) == 0)
                                    <div></div>
                                @else
                                    @foreach ($stoppages as $item)
                                        <div class=" col-md-4">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ $loop->iteration }}</span>
                                                </div>
                                                <select class="select2 form-control w-auto"
                                                    name="stoppages[{{ $loop->iteration }}]" required>
                                                    <option value="" selected>@lang('Select Stoppage')</option>
                                                    @foreach ($allStoppages as $stoppage)
                                                        <option value="{{ $stoppage->id }}"
                                                            {{ $item->id == $stoppage->id ? 'selected' : '' }}>
                                                            {{ $stoppage->name }} - {{ $stoppage->location }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger remove-stoppage"><i
                                                            class="fas fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-sm btn-primary add-stoppage-btn mb-1"><i
                                    class="fas fa-plus"></i> @lang('Next Stoppage')</button> <span class="text-warning">
                                @lang('Make sure that you are adding stoppages serially followed by the starting point')</span>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">{{ __('Time Duration') }}</label>
                                <input type="text" class="form-control" name="time" id="time"
                                    placeholder="Enter Approximate time duration of the trip" value="{{ $route->time }}">
                                <small class="text-info">@lang('Keep space between value & unit')</small>
                                @error('Time')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">{{ __('Distance') }}</label>
                                <input type="text" class="form-control" name="distance" id="distance"
                                    placeholder="Enter Distance" value="{{ $route->distance }}">
                                <small class="text-info">@lang('Keep space between value & unit')</small>
                                @error('Distance')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                    <a href="{{ route('admin.route.index') }}" class="btn btn-danger">Close</a>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        "use strict";

        (function($) {
            $('.select2').select2({
                dropdownParent: $('.card-body')
            });

            $('#has-stoppage').on('click', function() {
                if (this.checked) {
                    var stps =
                        `<div class="row stoppages-row">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('1')</span>
                                    </div>
                                    <select class="select2 form-control w-auto" name="stoppages[1]" required >
                                        <option value="" selected>@lang('Select Stoppage')</option>
                                        @foreach ($allStoppages as $stoppage)
                                        <option value="{{ $stoppage->id }}">{{ $stoppage->name . '-' . $stoppage->location }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-stoppage"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary add-stoppage-btn mb-1"><i class="fas fa-plus"></i>@lang('Next Stoppage')</button> <span class="text-warning"> @lang('Make sure that you are adding stoppages serially followed by the starting point')</span>

                        `;
                    $('.stoppages-wrapper').prepend(stps);
                    $('.select2').select2({
                        dropdownParent: $('.stoppages-wrapper')

                    });
                } else {
                    itr = 2;
                    $('.stoppages-wrapper').html('');
                }
            });

            var itr = 2;
            $(document).on('click', '.add-stoppage-btn', function() {
                var elements = $('.stoppages-row .col-md-4');
                $(elements).each(function(index, element) {
                    $(element).find('.select2').attr('name', `stoppages[${index+1}]`);

                });
                var itr = elements.length;

                var stps = `<div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">${itr+1}</span>
                                </div>
                                <select class="select2 form-control w-auto" name="stoppages[${itr}]">
                                    <option value="" selected>@lang('Select Stoppage')</option>
                                    @foreach ($allStoppages as $stoppage)
                                        <option value="{{ $stoppage->id }}">{{ $stoppage->name . '-' . $stoppage->location }}</option>
                                        @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger remove-stoppage"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>`;

                $('.stoppages-row').append(stps);

                $('.select2').select2({
                    dropdownParent: $('.stoppages-wrapper'),
                });
                itr++;
            });

            $(document).on('click', '.remove-stoppage', function() {
                $(this).closest('.col-md-4').remove();
                var elements = $('.stoppages-row .col-md-4').find();

                $($('.stoppages-row .col-md-4')).each(function(index, element) {

                    $(element).find('.input-group-prepend > .input-group-text').text(index + 1);
                    $(element).find('.select2').attr('name', `stoppages[${index+1}]`);

                });
            });
        })(jQuery)
    </script>
@endpush
