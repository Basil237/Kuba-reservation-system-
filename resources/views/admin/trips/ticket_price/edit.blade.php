@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Ticket Prices') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Update Ticket Price') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($stoppages as $item)
                        @php
                            $inserted = false;
                        @endphp
                        @if ($item[0] != $item[1])
                            @php $sd = getStoppageInfo($item) @endphp
                            @foreach ($ticketPrice->prices as $ticket)
                                @if ($item[0] == $ticket->source_destination[0] && $item[1] == $ticket->source_destination[1])
                                    @php
                                        $inserted = true;
                                    @endphp
                                    <div class="col-md-4">
                                        <form action="{{ route('admin.ticket-price.update', $ticket->id) }}"
                                            class="update-form">
                                            @csrf
                                            <label
                                                for="point-{{ $loop->iteration }}">{{ $sd[0]->name . '-' . $sd[0]->location }}
                                                -
                                                {{ $sd[1]->name . '-' . $sd[1]->location }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="btn--light input-group-text">FCFA</span>
                                                </div>
                                                <input type="text" name="price" value=" {{ $ticket->price }}"
                                                    id="point-{{ $loop->iteration }}"
                                                    class="form-control prices-auto numeric-validation"
                                                    placeholder="@lang('Enter a price')" required />
                                                <div class="input-group-append">
                                                    <button type="submit"
                                                        class="btn btn-primary text-white input-group-text update-price">@lang('Update')</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endforeach
                            @if ($inserted == false)
                                <div class="col-md-4">
                                    <form action="{{ route('admin.ticket-price.update', 0) }}" class="update-form">
                                        @csrf
                                        <label
                                            for="point-{{ $loop->iteration }}">{{ $sd[0]->name . '-' . $sd[0]->location }}
                                            -
                                            {{ $sd[1]->name . '-' . $sd[1]->location }}</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="ticket_price" value="{{ $ticketPrice->id }}"
                                                hidden>
                                            <input type="text" name="source" value="{{ $item[0] }}" hidden>
                                            <input type="text" name="destination" value="{{ $item[1] }}" hidden>
                                            <div class="input-group-prepend">
                                                <span class="btn--light input-group-text">FCFA</span>
                                            </div>
                                            <input type="text" name="price" id="point-{{ $loop->iteration }}"
                                                class="form-control prices-auto numeric-validation"
                                                placeholder="@lang('Enter a price')" required />
                                            <div class="input-group-append">
                                                <button type="submit"
                                                    class="btn btn-primary input-group-text text-white update-price">@lang('Update')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
                <a href="{{ route('admin.ticket-price.index') }}" class="btn btn-danger">Close</a>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        'use strict';
        (function($) {
            $(".numeric-validation").keypress(function(e) {
                var unicode = e.charCode ? e.charCode : e.keyCode
                if (unicode != 8 && e.key != '.' && unicode != 45) {
                    if ((unicode < 2534 || unicode > 2543) && (unicode < 48 || unicode > 57)) {
                        return false;
                    }
                }
            });

            $(document).on('click', '.update-price', function(e) {
                e.preventDefault();
                var form = $(this).parents('.update-form');
                var data = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    method: "POST",
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toast(response.message, 'success')->width(350);
                        } else {
                            toast(response.message, 'error')->width(350);
                        }
                    }
                });
            });
        })(jQuery)
    </script>
@endpush