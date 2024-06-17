@extends('layouts.guest')
@section('content')
    <section class="bg-[#F3F4F6] mt-20">

        @php
            $agencies = App\Models\Agency::get();
        @endphp
        <div class="mt-20">
            <div class="container">
                <div class="bus-search-header">
                    <form action="{{ route('search') }}"
                        class="ticket-form ticket-form-two flex flex-row gap-3 justify-center">
                        <div class="col-md-4 col-lg-3">
                            <div class="form--group">
                                <i class="las la-location-arrow"></i>
                                <select name="pickup" class="form--control select2">
                                    <option value="">@lang('Pickup Point')</option>
                                    @foreach ($agencies as $agency)
                                        <option value="{{ $agency->id }}"
                                            @if (request()->pickup == $agency->id) selected @endif>{{ __($agency->name) }}
                                            {{ __($agency->location) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="form--group">
                                <i class="las la-map-marker"></i>
                                <select name="destination" class="form--control select2">
                                    <option value="">@lang('Dropping Point')</option>
                                    @foreach ($agencies as $agency)
                                        <option value="{{ $agency->id }}"
                                            @if (request()->destination == $agency->id) selected @endif>{{ __($agency->name) }}
                                            {{ __($agency->location) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="form--group">
                                <i class="las la-calendar-check"></i>
                                <input type="date" name="date_of_journey" class="form--control datepicker"
                                    placeholder="@lang('Date of Journey')" autocomplete="off"
                                    value="{{ request()->date_of_journey }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form--group">
                                <button>@lang('Find Tickets')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- shop wrapper -->
        <div class="container mx-auto grid md:grid-cols-4 gap-6 pt-4 pb-16 items-start">
            <!-- sidebar -->
            <!-- drawer init and toggle -->
            <div class="text-center md:hidden">
                <button
                    class="text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block md:hidden"
                    type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example"
                    aria-controls="drawer-example">
                    <ion-icon name="grid-outline"></ion-icon>
                </button>
            </div>

            <!-- drawer component -->
            <div id="drawer-example"
                class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
                tabindex="-1" aria-labelledby="drawer-label">
                <h5 id="drawer-label"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg
                        class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>Info</h5>
                <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close menu</span>
                </button>
                <div class="divide-y divide-gray-200 space-y-5">
                    <div>
                        <h3 class="text-xl text-gray-800 mb-3 font-bold">Categories</h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input type="checkbox" name="cat-1" id="cat-1"
                                    class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">Bedroom</label>
                                <div class="ml-auto text-gray-600 text-sm">(15)</div>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="cat-2" id="cat-2"
                                    class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="cat-2" class="text-gray-600 ml-3 cusror-pointer">Sofa</label>
                                <div class="ml-auto text-gray-600 text-sm">(9)</div>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="cat-3" id="cat-3"
                                    class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="cat-3" class="text-gray-600 ml-3 cusror-pointer">Office</label>
                                <div class="ml-auto text-gray-600 text-sm">(21)</div>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="cat-4" id="cat-4"
                                    class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="cat-4" class="text-gray-600 ml-3 cusror-pointer">Outdoor</label>
                                <div class="ml-auto text-gray-600 text-sm">(10)</div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <h3 class="text-xl text-gray-800 mb-3 font-bold">Brands</h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input type="checkbox" name="brand-1" id="brand-1"
                                    class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="brand-1" class="text-gray-600 ml-3 cusror-pointer">Cooking Color</label>
                                <div class="ml-auto text-gray-600 text-sm">(15)</div>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="brand-2" id="brand-2"
                                    class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="brand-2" class="text-gray-600 ml-3 cusror-pointer">Magniflex</label>
                                <div class="ml-auto text-gray-600 text-sm">(9)</div>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="brand-3" id="brand-3"
                                    class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="brand-3" class="text-gray-600 ml-3 cusror-pointer">Ashley</label>
                                <div class="ml-auto text-gray-600 text-sm">(21)</div>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="brand-4" id="brand-4"
                                    class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="brand-4" class="text-gray-600 ml-3 cusror-pointer">M&D</label>
                                <div class="ml-auto text-gray-600 text-sm">(10)</div>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="brand-5" id="brand-5"
                                    class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                                <label for="brand-5" class="text-gray-600 ml-3 cusror-pointer">Olympic</label>
                                <div class="ml-auto text-gray-600 text-sm">(10)</div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <h3 class="text-xl text-gray-800 mb-3 font-bold">Price</h3>
                        <div class="mt-4 flex items-center">
                            <input type="text" name="min" id="min"
                                class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                                placeholder="min">
                            <span class="mx-3 text-gray-500">-</span>
                            <input type="text" name="max" id="max"
                                class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                                placeholder="max">
                        </div>
                    </div>

                    <div class="pt-4">
                        <h3 class="text-xl text-gray-800 mb-3 font-bold">size</h3>
                        <div class="flex items-center gap-2">
                            <div class="size-selector">
                                <input type="radio" name="size" id="size-xs" class="hidden">
                                <label for="size-xs"
                                    class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XS</label>
                            </div>
                            <div class="size-selector">
                                <input type="radio" name="size" id="size-sm" class="hidden">
                                <label for="size-sm"
                                    class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">S</label>
                            </div>
                            <div class="size-selector">
                                <input type="radio" name="size" id="size-m" class="hidden">
                                <label for="size-m"
                                    class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">M</label>
                            </div>
                            <div class="size-selector">
                                <input type="radio" name="size" id="size-l" class="hidden">
                                <label for="size-l"
                                    class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">L</label>
                            </div>
                            <div class="size-selector">
                                <input type="radio" name="size" id="size-xl" class="hidden">
                                <label for="size-xl"
                                    class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XL</label>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <h3 class="text-xl text-gray-800 mb-3 font-bold">Color</h3>
                        <div class="flex items-center gap-2">
                            <div class="color-selector">
                                <input type="radio" name="color" id="red" class="hidden">
                                <label for="red"
                                    class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"
                                    style="background-color: #fc3d57;"></label>
                            </div>
                            <div class="color-selector">
                                <input type="radio" name="color" id="black" class="hidden">
                                <label for="black"
                                    class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"
                                    style="background-color: #000;"></label>
                            </div>
                            <div class="color-selector">
                                <input type="radio" name="color" id="white" class="hidden">
                                <label for="white"
                                    class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"
                                    style="background-color: #fff;"></label>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-2 gap-4">
                    <a href="#"
                        class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Learn
                        more</a>
                    <a href="#"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Get
                        access <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg></a>
                </div>
            </div>

            <!-- sidebar -->
            <form action="{{ route('search') }}" id="filterForm">
                <div class="col-span-1 bg-white px-4 py-4 shadow rounded-sm overflow-hiddenb hidden md:block">
                    <div class="divide-y divide-gray-200 space-y-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl text-gray-800 my-3 font-bold">Filter</h3>
                            <button type="reset" class="text-sm text-gray-800 my-3 font-semibold    ">Reset
                                All</button>
                        </div>
                        @if ($fleetType)
                            <div class="filter-item">
                                <h3 class="text-base text-gray-800 my-3 font-bold">Vehicle Type</h3>
                                <ul class="flex flex-col items-start justify-center">
                                    @foreach ($fleetType as $fleet)
                                        <li class=" space-x-4 space-y-2">
                                            <input name="fleetType[]" class="search ring-primary text-primary"
                                                value="{{ $fleet->id }}" id="{{ $fleet->name }}" type="checkbox"
                                                @if (request()->fleetType) @foreach (request()->fleetType as $item)
                                                    @if ($item == $fleet->id)
                                                    checked @endif
                                                @endforeach
                                    @endif
                                    >
                                    <label for="{{ $fleet->name }}" class="text-gray-600"><span><i
                                                class="las la-bus"></i>{{ __($fleet->name) }}</span></label>
                                    </li>
                        @endforeach
                        </ul>
                    </div>
                    @endif

                    @if ($routes)
                        <div class="filter-item">
                            <h3 class="text-base text-gray-800 my-3 font-bold">Routes</h3>
                            <ul class="flex flex-col items-start justify-center">
                                @foreach ($routes as $route)
                                    <li class=" space-x-4 space-y-2">
                                        <input name="routes[]" class="search ring-primary text-primary"
                                            value="{{ $route->id }}" id="route.{{ $route->id }}" type="checkbox"
                                            @if (request()->routes) @foreach (request()->routes as $item)
                                                    @if ($item == $route->id)
                                                    checked @endif
                                            @endforeach
                                @endif
                                >
                                <label for="route.{{ $route->id }}" class="text-gray-600"><span><i
                                            class="las la-bus"></i>{{ __($route->name) }}</span></label>
                                </li>
                    @endforeach
                    </ul>
                </div>
                @endif

                @if ($schedules)
                    <div class="filter-item">
                        <h3 class="text-base text-gray-800 my-3 font-bold">Schedules</h3>
                        <ul class="flex flex-col items-start justify-center">
                            @foreach ($schedules as $schedule)
                                <li class=" space-x-4 space-y-2">
                                    <input name="schedules[]" class="search ring-primary text-primary"
                                        value="{{ $schedule->id }}" id="schedule.{{ $schedule->id }}" type="checkbox"
                                        @if (request()->schedules) @foreach (request()->schedules as $item)
                                                    @if ($item == $schedule->id)
                                                    checked @endif
                                        @endforeach
                            @endif
                            >
                            <label for="schedule.{{ $schedule->id }}" class="text-gray-600"><span><i
                                        class="las la-bus"></i>{{ showDateTime($schedule->start_from, 'h:i a') . ' - ' . showDateTime($schedule->end_at, 'h:i a') }}
                                </span></label>
                            </li>
                @endforeach
                </ul>
        </div>
        @endif
        </div>
        </div>
        </form>
        <div class="col-span-3 space-y-8">
            @forelse ($trips as $trip)
                @php
                    $start = Carbon\Carbon::parse($trip->schedule->start_from);
                    $end = Carbon\Carbon::parse($trip->schedule->end_at);
                    $diff = $start->diff($end);
                    $ticket = App\Models\TicketPrice::where('fleet_type_id', $trip->fleetType->id)
                        ->where('vehicle_route_id', $trip->route->id)
                        ->first();
                @endphp

                <div
                    class="bg-white  shadow-xl shadow-gray-100 w-full sm:items-center  justify-between px-5 py-4 rounded-md">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-center justify-center">
                        <div>
                            <span class="text-primary text-sm">{{ $trip->agency->name ?? '' }}</span>
                            <h3 class="font-bold text-2xl mt-px">{{ __($trip->title) }}</h3>
                            <div class="flex items-center mt-2">
                                <p class="text-sm text-gray-500 mr-2">{{ __('Seat Layout - ') }}
                                    {{ __($trip->fleetType->seat_layout) }}</p>
                                <svg class="w-4 h-4 mr-1 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 2a3 3 0 0 0-2.1.9l-.9.9a1 1 0 0 1-.7.3H7a3 3 0 0 0-3 3v1.2c0 .3 0 .5-.2.7l-1 .9a3 3 0 0 0 0 4.2l1 .9c.2.2.3.4.3.7V17a3 3 0 0 0 3 3h1.2c.3 0 .5 0 .7.2l.9 1a3 3 0 0 0 4.2 0l.9-1c.2-.2.4-.3.7-.3H17a3 3 0 0 0 3-3v-1.2c0-.3 0-.5.2-.7l1-.9a3 3 0 0 0 0-4.2l-1-.9a1 1 0 0 1-.3-.7V7a3 3 0 0 0-3-3h-1.2a1 1 0 0 1-.7-.2l-.9-1A3 3 0 0 0 12 2Zm3.7 7.7a1 1 0 1 0-1.4-1.4L10 12.6l-1.3-1.3a1 1 0 0 0-1.4 1.4l2 2c.4.4 1 .4 1.4 0l5-5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-extrabold text-sm">{{ __($trip->fleetType->name) }}</span>
                            </div>
                        </div>
                        <div class="flex flex-row items-start md:items-center md:justify-center">
                            <div>
                                <h3 class="font-bold text-2xl mt-px">
                                    {{ showDateTime($trip->schedule->start_from, 'h:i A') }}</h3>
                                <span class="text-sm text-gray-500 -mt-[2px]">{{ __($trip->startFrom->name) }}
                                    {{ __($trip->startFrom->location) }}</span>
                            </div>
                            <div class="mx-4">
                                <svg class="w-6 h-6 text-pr dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-2xl mt-px">
                                    {{ showDateTime($trip->schedule->end_at, 'h:i A') }}
                                </h3>
                                <span class="text-sm text-gray-500 -mt-[2px]">{{ __($trip->endTo->name) }}
                                    {{ __($trip->endTo->location) }}</span>
                            </div>
                        </div>
                        <div class="space-y-3 text-center justify-center">
                            <h3 class="font-bold text-2xl mt-px">
                                {{ showAmount($ticket->price) }} FCFA</h3>
                            <div class="my-4">
                                @if ($trip->day_off)
                                    <p class="text-sm text-gray-500 mr-2">{{ __('Off Days:') }}
                                        @foreach ($trip->day_off as $item)
                                            <span
                                                class="bg-primary-100 text-primary rounded-full px-2 py-1 mr-2 text-sm">{{ __(showDayOff($item)) }}</span>
                                        @endforeach
                                    </p>
                                @else
                                    <p class="text-sm text-gray-500 mr-2">{{ __('Every day available') }}</p>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('trip.seats', [$trip->id, slug($trip->title)]) }}"
                                    class="bg-primary  text-white font-medium px-4 py-2 rounded-md -center">Select
                                    Seat
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                    @if ($trip->fleetType->facilities)
                        <div class="ticket-item-footer">
                            <div class="d-flex content-justify-center">
                                <span>
                                    <strong class="text-base font-bold text-gray-800">{{ __('Facilities - ') }}</strong>
                                    @foreach ($trip->fleetType->facilities as $item)
                                        <span
                                            class="bg-gray-100 text-gray-500 rounded-full px-2 py-1 mr-2 text-sm">{{ __($item) }}</span>
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <div class="ticket-item">
                    <h5>{{ __('There is no trip available') }}</h5>
                </div>
            @endforelse
            @if ($trips->hasPages())
                {{ paginateLinks($trips) }}
            @endif
        </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    @push('script')
        <script>
            (function($) {
                "use strict";
                $('.search').on('change', function() {
                    $('#filterForm').submit();
                });

                $('.reset-button').on('click', function() {
                    $('.search').attr('checked', false);
                    $('#filterForm').submit();
                })
            })(jQuery)
        </script>
    @endpush
@endsection
