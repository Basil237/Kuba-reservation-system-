@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Ticket Prices') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Add Ticket Price') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.ticket-price.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">{{ __('Fleet Type') }}</label>
                                <select name="fleet_type" id="" class="form-control select2">
                                    <option value="">{{ __('Select an option') }}</option>
                                    @foreach ($fleetTypes as $item)
                                        <option value="{{ $item->id }}">
                                            {{ __($item->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fleet_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">{{ __('Route') }}</label>
                                <select name="route" id="" class="form-control select2">
                                    <option value="">{{ __('Select an option') }}</option>
                                    @foreach ($routes as $item)
                                        <option value="{{ $item->id }}">
                                            {{ __($item->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('route')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">{{ __('Price For Source To Destination') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            FCFA
                                        </div>
                                    </div>
                                    <input type="text" name="main_price" class="form-control currency"
                                        placeholder="Enter a price">
                                </div>
                                @error('main_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 price-error-message">
                        </div>
                        <div class="price-wrapper col-md-12">
                        </div>
                    </div>
                        <button class="btn btn-primary submit-button" type="submit">{{ __('Create') }}</button>
                        <a href="{{ route('admin.ticket-price.index') }}" class="btn btn-danger">Close</a>
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

            $(document).on('change', 'select[name=fleet_type], select[name=route]', function() {
                var routeId = $('select[name="route"]').find("option:selected").val();
                var fleetTypeId = $('select[name="fleet_type"]').find("option:selected").val();

                if (routeId && fleetTypeId) {
                    var data = {
                        'vehicle_route_id': routeId,
                        'fleet_type_id': fleetTypeId
                    };
                    $.ajax({
                        url: "{{ route('admin.ticket-price.get_route_data') }}",
                        method: "get",
                        data: data,
                        success: function(result) {
                            if (result.error) {
                                $('.price-error-message').html(
                                    `<h5 class="text--danger">${result.error}</h5>`
                                );
                                $('.price-wrapper').html('');
                                $('.submit-button').attr('disabled', 'disabled');
                            } else {
                                $('.price-error-message').html(``);
                                $('.submit-button').removeAttr('disabled');
                                $('.price-wrapper').html(result);
                            }
                        }
                    });
                } else {
                    $('.price-wrapper').html('');
                }
            });
        })(jQuery);
    </script>
@endpush


