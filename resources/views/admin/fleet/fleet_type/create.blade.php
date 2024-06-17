@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Fleet Type') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Add Fleet Type') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.fleet_type.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ __('Name') }}</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Enter Fleet Name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Seat Layout') }}</label>
                        <select name="seat_layout" id="" class="form-control select2">
                            @foreach ($seatLayouts as $item)
                                <option value="{{ $item->layout }}">{{ $item->layout }}</option>
                            @endforeach
                        </select>
                        @error('layout')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('No of Deck') }}</label>
                        <input type="number" min="0" class="form-control" name="deck" id="deck"
                            placeholder="Enter Number of Deck">
                        @error('deck')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="showSeat"></div>
                    <div class="form-group">
                        <label for="">{{ __('Facilities') }}</label>
                        <select class="form-control select2 select2-auto-tokenize" name="facilities[]" id="facilities"
                            multiple="">
                            @foreach ($facilities as $item)
                                <option value="{{ $item->title }}" selected>{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('layout')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('AC Status') }}</label>
                        <select name="has_ac" id="" class="form-control select2">
                            <option value="1">{{ __('AC') }}</option>
                            <option value="0">{{ __('Non AC') }}</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Create') }}</button>
                    <a href="{{ route('admin.fleet_type.index') }}" class="btn btn-danger">Close</a>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.select2-auto-tokenize').select2({
                tags: true,
                tokenSeparators: [',']
            });


            $('input[name=deck]').on('input', function() {
                $('.showSeat').empty();
                for (var deck = 1; deck <= $(this).val(); deck++) {
                    $('.showSeat').append(`
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> Seats of Deck - ${deck} </label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Number of Seat')" name="deck_seats[]" required>
                        </div>
                    `);
                }
            })

        })(jQuery);
    </script>
@endpush
