@extends('layouts.guest')
@section('content')
    <div class="py-16 mt-8">
        <div class="container mx-auto">
            <div class="flex flex-wrap justify-center gap-6">
                <div class="w-full md:w-1/2 lg:w-1/3">
                    <div class="bg-white p-6 rounded shadow-md">
                        <form action="{{ route('trip.book', $trip->id) }}" method="POST" id="bookingForm" class="space-y-4">
                            @csrf
                            <input type="text" name="price" hidden>
                            <div class="w-full">
                                <div class="form-group">
                                    <label for="date_of_journey">@lang('Journey Date')</label>
                                    <label for="date_of_journey" class="relative flex">
                                        <input x-init="$el._x_flatpickr = flatpickr($el)"
                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="Choose date..." id="date_of_journey" name="date_of_journey"
                                            value="{{ Session::get('date_of_journey') ? Session::get('date_of_journey') : date('m/d/Y') }}"
                                            type="text" />
                                        <span
                                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 transition-colors duration-200" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="form-group">
                                    <label for="pickup_point" class="block text-gray-700">@lang('Pickup Point')</label>
                                    <select name="pickup_point" id="pickup_point"
                                        class="form-select rounded-lg mt-1 block w-full select2">
                                        <option value="">@lang('Select One')</option>
                                        @foreach ($stoppages as $item)
                                            <option value="{{ $item->id }}"
                                                @if (Session::get('pickup') == $item->id) selected @endif>
                                                {{ __($item->name) }} {{ __($item->location) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="form-group">
                                    <label for="dropping_point" class="block text-gray-700">@lang('Dropping Point')</label>
                                    <select name="dropping_point" id="dropping_point"
                                        class="form-select rounded-lg mt-1 block w-full select2">
                                        <option value="">@lang('Select One')</option>
                                        @foreach ($stoppages as $item)
                                            <option value="{{ $item->id }}"
                                                @if (Session::get('destination') == $item->id) selected @endif>
                                                {{ __($item->name) }} {{ __($item->location) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="block text-gray-700">@lang('Select Gender')</label>
                                <div class="flex flex-wrap justify-between">
                                    <div class="form-group flex items-center">
                                        <input id="male" type="radio" name="gender" value="1"
                                            class="form-radio">
                                        <label class="ml-2" for="male">@lang('Male')</label>
                                    </div>
                                    <div class="form-group flex items-center">
                                        <input id="female" type="radio" name="gender" value="2"
                                            class="form-radio">
                                        <label class="ml-2" for="female">@lang('Female')</label>
                                    </div>
                                    <div class="form-group flex items-center">
                                        <input id="other" type="radio" name="gender" value="3"
                                            class="form-radio">
                                        <label class="ml-2" for="other">@lang('Other')</label>
                                    </div>
                                </div>
                            </div>

                            <div class="booked-seat-details my-3 hidden">
                                <label>@lang('Selected Seats')</label>
                                <div class="list-group seat-details-animate">
                                    <span
                                        class="list-group-item flex justify-between bg-blue-500 text-white">@lang('Seat Details')<span>@lang('Price')</span></span>
                                    <div class="selected-seat-details"></div>
                                </div>
                            </div>
                            <input type="text" name="seats" hidden>
                            <div class="w-full">
                                <button type="submit" class="btn btn-primary">@lang('Continue')</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3">
                    <h6 class="text-lg font-semibold">@lang('Click on Seat to select or deselect')</h6>
                    @if ($trip->day_off)
                        <span class="text-sm">
                            @lang('Off Days') :
                            @foreach ($trip->day_off as $item)
                                <span class="badge bg-green-500 text-white">
                                    {{ __(showDayOff($item)) }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                </span>
                            @endforeach
                        </span>
                    @endif
                    @foreach ($trip->fleetType->deck_seats as $seat)
                        <div class="seat-plan-inner">
                            <div class="single">

                                @php
                                    echo $busLayout->getDeckHeader($loop->index);
                                @endphp

                                @php
                                    $totalRow = $busLayout->getTotalRow($seat);
                                    $lastRowSeat = $busLayout->getLastRowSit($seat);
                                    $chr = 'A';
                                    $deckIndex = $loop->index + 1;
                                    $seatlayout = $busLayout->sitLayouts();
                                    $rowItem = $seatlayout->left + $seatlayout->right;
                                @endphp
                                @for ($i = 1; $i <= $totalRow; $i++)
                                    @php
                                        if ($lastRowSeat == 1 && $i == $totalRow - 1) {
                                            break;
                                        }
                                        $seatNumber = $chr;
                                        $chr++;
                                        $seats = $busLayout->getSeats($deckIndex, $seatNumber);
                                    @endphp
                                    <div class="seat-wrapper">
                                        @php echo $seats->left; @endphp
                                        @php echo $seats->right; @endphp
                                    </div>
                                @endfor
                                @if ($lastRowSeat == 1)
                                    @php $seatNumber++ @endphp
                                    <div class="seat-wrapper justify-center">
                                        @for ($lsr = 1; $lsr <= $rowItem + 1; $lsr++)
                                            @php echo $busLayout->generateSeats($lsr,$deckIndex,$seatNumber); @endphp
                                        @endfor
                                    </div><!-- single-row end -->
                                @endif

                                @if ($lastRowSeat > 1)
                                    @php $seatNumber++ @endphp
                                    <div class="seat-wrapper justify-center">
                                        @for ($l = 1; $l <= $lastRowSeat; $l++)
                                            @php echo $busLayout->generateSeats($l,$deckIndex,$seatNumber); @endphp
                                        @endfor
                                    </div><!-- single-row end -->
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="seat-for-reserved">
                        <div class="seat-condition available-seat">
                            <span class="seat"><span></span></span>
                            <p>@lang('Available Seats')</p>
                        </div>
                        <div class="seat-condition selected-by-you">
                            <span class="seat"><span></span></span>
                            <p>@lang('Selected by You')</p>
                        </div>
                        <div class="seat-condition selected-by-gents">
                            <div class="seat"><span></span></div>
                            <p>@lang('Booked by Gents')</p>
                        </div>
                        <div class="seat-condition selected-by-ladies">
                            <div class="seat"><span></span></div>
                            <p>@lang('Booked by Ladies')</p>
                        </div>
                        <div class="seat-condition selected-by-others">
                            <div class="seat"><span></span></div>
                            <p>@lang('Booked by Others')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- confirmation modal --}}
    <div class="modal fade" id="bookConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Confirm Booking')</h5>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="las la-times"></i></button>
                </div>
                <div class="modal-body">
                    <strong class="text-dark">@lang('Are you sure to book these seats?')</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        @lang('Close')
                    </button>
                    <button type="submit" class="btn btn-success" id="btnBookConfirm">@lang('Confirm')
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- alert modal --}}
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <strong class="text-dark">@lang('You are about to book seats for ladies. Continue?')</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        @lang('No')
                    </button>
                    <button type="submit" class="btn btn-success" id="btnYes">@lang('Yes')
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- alert modal --}}
    <div class="modal fade" id="alertModalGents" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <strong class="text-dark">@lang('You are about to book seats for gents. Continue?')</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        @lang('No')
                    </button>
                    <button type="submit" class="btn btn-success" id="btnYesGents">@lang('Yes')
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- alert modal --}}
    <div class="modal fade" id="alertModalOthers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <strong class="text-dark">@lang('You are about to book seats for others. Continue?')</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        @lang('No')
                    </button>
                    <button type="submit" class="btn btn-success" id="btnYesOthers">@lang('Yes')
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        (function($) {
            "use strict";

            var date_of_journey =
                '{{ Session::get('
                                                                                                        date_of_journey ') }}';
            var pickup =
                '{{ Session::get('
                                                                                                    pickup ') }}';
            var destination =
                '{{ Session::get('
                                                                                                        destination ') }}';

            if (date_of_journey && pickup && destination) {
                showBookedSeat();
            }

            //reset all seats
            function reset() {
                $('.seat-wrapper .seat').removeClass('selected');
                $('.seat-wrapper .seat').parent().removeClass(
                    'seat-condition selected-by-ladies selected-by-gents selected-by-others disabled');
                $('.selected-seat-details').html('');
            }

            //click on seat
            $('.seat-wrapper .seat').on('click', function() {
                var pickupPoint = $('select[name="pickup_point"]').val();
                var droppingPoing = $('select[name="dropping_point"]').val();

                if (pickupPoint && droppingPoing) {
                    selectSeat();
                } else {
                    $(this).removeClass('selected');
                    notify('error', "@lang('Please select pickup point and dropping point before select any seat')")
                }
            });

            //select and booked seat
            function selectSeat() {
                let selectedSeats = $('.seat.selected');
                let seatDetails = ``;
                let price = $('input[name=price]').val();
                let subtotal = 0;
                let currency = 'FCFA';
                let seats = '';
                if (selectedSeats.length > 0) {
                    $('.booked-seat-details').removeClass('d-none');
                    $.each(selectedSeats, function(i, value) {
                        seats += $(value).data('seat') + ',';
                        seatDetails +=
                            `<span class="list-group-item d-flex justify-content-between">${$(value).data('seat')} <span>${price} ${currency}</span></span>`;
                        subtotal = subtotal + parseFloat(price);
                    });

                    $('input[name=seats]').val(seats);
                    $('.selected-seat-details').html(seatDetails);
                    $('.selected-seat-details').append(
                        `<span class="list-group-item d-flex justify-content-between">@lang('Sub total')<span>${subtotal} ${currency}</span></span>`
                    );
                } else {
                    $('.selected-seat-details').html('');
                    $('.booked-seat-details').addClass('d-none');
                }
            }

            //on change date, pickup point and destination point show available seats
            $(document).on('change',
                'select[name="pickup_point"], select[name="dropping_point"], input[name="date_of_journey"]',
                function(e) {
                    showBookedSeat();
                });

            //booked seat
            function showBookedSeat() {
                reset();
                var date = $('input[name="date_of_journey"]').val();
                var sourceId = $('select[name="pickup_point"]').find("option:selected").val();
                var destinationId = $('select[name="dropping_point"]').find("option:selected").val();

                if (sourceId == destinationId && destinationId != '') {
                    notify('error', "@lang('Source Point and Destination Point Must Not Be Same')");
                    $('select[name="dropping_point"]').val('').select2();
                    return false;
                } else if (sourceId != destinationId) {

                    var routeId = '{{ $trip->route->id }}';
                    var fleetTypeId = '{{ $trip->fleetType->id }}';

                    if (sourceId && destinationId) {
                        getprice(routeId, fleetTypeId, sourceId, destinationId, date)
                    }
                }
            }

            // check price, booked seat etc
            function getprice(routeId, fleetTypeId, sourceId, destinationId, date) {
                var data = {
                    "trip_id": '{{ $trip->id }}',
                    "vehicle_route_id": routeId,
                    "fleet_type_id": fleetTypeId,
                    "source_id": sourceId,
                    "destination_id": destinationId,
                    "date": date,
                }
                $.ajax({
                    type: "get",
                    url: "{{ route('trip.get-price') }}",
                    data: data,
                    success: function(response) {

                        if (response.error) {
                            var modal = $('#alertModal');
                            modal.find('.error-message').text(response.error);
                            modal.modal('show');
                            $('select[name="pickup_point"]').val('');
                            $('select[name="dropping_point"]').val('');
                        } else {
                            var stoppages = response.stoppages;

                            var reqSource = response.reqSource;
                            var reqDestination = response.reqDestination;

                            reqSource = stoppages.indexOf(reqSource.toString());
                            reqDestination = stoppages.indexOf(reqDestination.toString());

                            if (response.reverse == true) {
                                $.each(response.bookedSeats, function(i, v) {
                                    var bookedSource = v.pickup_point; //Booked
                                    var bookedDestination = v.dropping_point; //Booked

                                    bookedSource = stoppages.indexOf(bookedSource.toString());
                                    bookedDestination = stoppages.indexOf(bookedDestination
                                        .toString());

                                    if (reqDestination >= bookedSource || reqSource <=
                                        bookedDestination) {
                                        $.each(v.seats, function(index, val) {
                                            if (v.gender == 1) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().removeClass(
                                                        'seat-condition selected-by-gents disabled'
                                                    );
                                            }
                                            if (v.gender == 2) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().removeClass(
                                                        'seat-condition selected-by-ladies disabled'
                                                    );
                                            }
                                            if (v.gender == 3) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().removeClass(
                                                        'seat-condition selected-by-others disabled'
                                                    );
                                            }
                                        });
                                    } else {
                                        $.each(v.seats, function(index, val) {
                                            if (v.gender == 1) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().addClass(
                                                        'seat-condition selected-by-gents disabled'
                                                    );
                                            }
                                            if (v.gender == 2) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().addClass(
                                                        'seat-condition selected-by-ladies disabled'
                                                    );
                                            }
                                            if (v.gender == 3) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().addClass(
                                                        'seat-condition selected-by-others disabled'
                                                    );
                                            }
                                        });
                                    }
                                });
                            } else {
                                $.each(response.bookedSeats, function(i, v) {
                                    console.log(i, v);
                                    var bookedSource = v.pickup_point; //Booked
                                    var bookedDestination = v.dropping_point; //Booked

                                    bookedSource = stoppages.indexOf(bookedSource.toString());
                                    bookedDestination = stoppages.indexOf(bookedDestination
                                        .toString());


                                    if (reqDestination <= bookedSource || reqSource >=
                                        bookedDestination) {
                                        $.each(v.seats, function(index, val) {
                                            if (v.gender == 1) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().removeClass(
                                                        'seat-condition selected-by-gents disabled'
                                                    );
                                            }
                                            if (v.gender == 2) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().removeClass(
                                                        'seat-condition selected-by-ladies disabled'
                                                    );
                                            }
                                            if (v.gender == 3) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().removeClass(
                                                        'seat-condition selected-by-others disabled'
                                                    );
                                            }
                                        });
                                    } else {
                                        $.each(v.seats, function(index, val) {
                                            if (v.gender == 1) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().addClass(
                                                        'seat-condition selected-by-gents disabled'
                                                    );
                                            }
                                            if (v.gender == 2) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().addClass(
                                                        'seat-condition selected-by-ladies disabled'
                                                    );
                                            }
                                            if (v.gender == 3) {
                                                $(`.seat-wrapper .seat[data-seat="${val}"]`)
                                                    .parent().addClass(
                                                        'seat-condition selected-by-others disabled'
                                                    );
                                            }
                                        });
                                    }
                                });
                            }

                            if (response.price.error) {
                                var modal = $('#alertModal');
                                modal.find('.error-message').text(response.price.error);
                                modal.modal('show');
                            } else {
                                $('input[name=price]').val(response.price);
                            }
                        }
                    }
                });
            }

            //booking form submit
            $('#bookingForm').on('submit', function(e) {
                e.preventDefault();
                let selectedSeats = $('.seat.selected');
                if (selectedSeats.length > 0) {
                    var modal = $('#bookConfirm');
                    modal.modal('show');
                } else {
                    notify('error', 'Select at least one seat.');
                }
            });

            //confirmation modal
            $(document).on('click', '#btnBookConfirm', function(e) {
                var modal = $('#bookConfirm');
                modal.modal('hide');
                document.getElementById("bookingForm").submit();
            });

        })(jQuery);
    </script>
@endpush
