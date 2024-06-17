@extends('layouts.guest')
@section('content')
    <!-- hearo Section -->
    <section class="bg-white">
        <div class="grid max-w-screen-xl px-4 py-20 mt-16 mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Book Your <span class="text-primary">Bus Seat</span> Anytime, Anywhere</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">Tired of long queues
                    and last-minute hassles when booking your bus seat? Say goodbye to inconvenience with our
                    intuitiveBus Seat Reservations System. Now, you can book your seat from the comfort of your home or
                    on the go, hassle-free!</p>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary hover:bg-secondary focus:ring-4">
                    Get started
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <div x-data="{ modelOpen: false }" x-init="modelOpen = false;" class="inline-flex items-center justify-center">
                    <button @click="modelOpen = true"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        <span>Search For Bus</span>
                    </button>

                    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
                        role="dialog" aria-modal="true" aria-hidden="true">
                        <div
                            class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                            <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                                x-transition:enter="transition ease-out duration-300 transform"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200 transform"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true">
                            </div>

                            <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="transition ease-in duration-200 transform"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 ">Search for buses available</h1>

                                    <button @click="modelOpen = false"
                                        class="text-gray-600 focus:outline-none hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <p class="mt-2 text-sm text-gray-500 ">
                                    Before Buying Tickets, Please have a look at
                                    <button class="underline font-medium" type="button" data-modal-toggle="default-modal">
                                        How to book?
                                    </button>
                                </p>
                                <form class="mt-5">
                                    <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                                        <label for="datepicker"
                                            class="block text-sm text-gray-700 capitalize dark:text-gray-200">Select
                                            Date</label>
                                        <div class="relative">
                                            <input type="hidden" name="date" x-ref="date">
                                            <input type="text" readonly x-model="datepickerValue"
                                                @click="showDatepicker = !showDatepicker"
                                                @keydown.escape="showDatepicker = false"
                                                class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                                placeholder="Select date">

                                            <div class="absolute top-0 right-0 px-3 py-2">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>

                                            <div class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0"
                                                style="width: 17rem" x-show.transition="showDatepicker"
                                                @click.away="showDatepicker = false">

                                                <div class="flex justify-between items-center mb-2">
                                                    <div>
                                                        <span x-text="MONTH_NAMES[month]"
                                                            class="text-lg font-bold text-gray-800"></span>
                                                        <span x-text="year"
                                                            class="ml-1 text-lg text-gray-600 font-normal"></span>
                                                    </div>
                                                    <div>
                                                        <button type="button"
                                                            class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                            :class="{ 'cursor-not-allowed opacity-25': month == 0 }"
                                                            :disabled="month == 0 ? true : false"
                                                            @click="month--; getNoOfDays()">
                                                            <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M15 19l-7-7 7-7" />
                                                            </svg>
                                                        </button>
                                                        <button type="button"
                                                            class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                            :class="{ 'cursor-not-allowed opacity-25': month == 11 }"
                                                            :disabled="month == 11 ? true : false"
                                                            @click="month++; getNoOfDays()">
                                                            <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M9 5l7 7-7 7" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="flex flex-wrap mb-3 -mx-1">
                                                    <template x-for="(day, index) in DAYS" :key="index">
                                                        <div style="width: 14.26%" class="px-1">
                                                            <div x-text="day"
                                                                class="text-gray-800 font-medium text-center text-xs">
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>

                                                <div class="flex flex-wrap -mx-1">
                                                    <template x-for="blankday in blankdays">
                                                        <div style="width: 14.28%"
                                                            class="text-center border p-1 border-transparent text-sm">
                                                        </div>
                                                    </template>
                                                    <template x-for="(date, dateIndex) in no_of_days"
                                                        :key="dateIndex">
                                                        <div style="width: 14.28%" class="px-1 mb-1">
                                                            <div @click="getDateValue(date)" x-text="date"
                                                                class="cursor-pointer text-center text-sm  rounded-full leading-loose transition ease-in-out duration-100"
                                                                :class="{
                                                                    'bg-primary text-white': isToday(date) ==
                                                                        true,
                                                                    'text-gray-700 hover:bg-primary': isToday(
                                                                        date) == false
                                                                }">
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>

                                        </div>
                                        <script>
                                            const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                                                'October', 'November', 'December'
                                            ];
                                            const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

                                            function app() {
                                                return {
                                                    showDatepicker: false,
                                                    datepickerValue: '',

                                                    month: '',
                                                    year: '',
                                                    no_of_days: [],
                                                    blankdays: [],
                                                    days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                                                    initDate() {
                                                        let today = new Date();
                                                        this.month = today.getMonth();
                                                        this.year = today.getFullYear();
                                                        this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                                                    },

                                                    isToday(date) {
                                                        const today = new Date();
                                                        const d = new Date(this.year, this.month, date);

                                                        return today.toDateString() === d.toDateString() ? true : false;
                                                    },

                                                    getDateValue(date) {
                                                        let selectedDate = new Date(this.year, this.month, date);
                                                        this.datepickerValue = selectedDate.toDateString();

                                                        this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + selectedDate.getMonth()).slice(-2) +
                                                            "-" + ('0' + selectedDate.getDate()).slice(-2);

                                                        console.log(this.$refs.date.value);

                                                        this.showDatepicker = false;
                                                    },

                                                    getNoOfDays() {
                                                        let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                                                        // find where to start calendar day of week
                                                        let dayOfWeek = new Date(this.year, this.month).getDay();
                                                        let blankdaysArray = [];
                                                        for (var i = 1; i <= dayOfWeek; i++) {
                                                            blankdaysArray.push(i);
                                                        }

                                                        let daysArray = [];
                                                        for (var i = 1; i <= daysInMonth; i++) {
                                                            daysArray.push(i);
                                                        }

                                                        this.blankdays = blankdaysArray;
                                                        this.no_of_days = daysArray;
                                                    }
                                                }
                                            }
                                        </script>
                                    </div>

                                    <div class="mt-4">
                                        <label for="origin"
                                            class="block text-sm text-gray-700 capitalize dark:text-gray-200">From</label>
                                        <input placeholder="Origin" type="text"
                                            class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-primary focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-40">
                                    </div>
                                    <div class="mt-4">
                                        <label for="destination"
                                            class="block text-sm text-gray-700 capitalize dark:text-gray-200">To</label>
                                        <input placeholder="Destination" type="text"
                                            class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-primary focus:outline-none focus:ring focus:ring-primary focus:ring-opacity-40">
                                    </div>

                                    <div class="flex justify-end mt-6">
                                        <button type="button"
                                            class="px-8 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-primary focus:outline-none focus:bg-primary focus:ring rounded-lg focus:ring-opacity-50">
                                            Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="image/9844313.jpg" alt="mockup">
            </div>
        </div>
    </section>
    <!-- ====== Cards Section Start -->
    <section class="pt-20 pb-10 lg:pb-20 bg-[#F3F4F6]">
        <div class="container mx-auto">
            <h2 class="mb-4 text-4xl tracking-tight text-center font-extrabold text-gray-900 dark:text-white">
                How it works?</h2>
            <p class="text-gray-500 mb-10 sm:text-xl text-center dark:text-gray-400">Your Ticket to Effortless and
                Secure Bus Travel,
                Explore the Exceptional Features of Bus Seat Reservations System</p>
            <div class="flex flex-wrap mx-4">
                <div class="w-full md:w-1/2 xl:w-1/3 px-4">
                    <div class="bg-white rounded-lg overflow-hidden mb-10">
                        <img src="{{ asset('image/search.svg') }}" alt="image" class="w-full h-auto" />
                        <div class="p-8 sm:p-9 md:p-7 xl:p-9 text-center">
                            <h3>
                                <a href="javascript:void(0)"
                                    class="
                     font-semibold
                     text-dark text-xl
                     sm:text-[22px]
                     md:text-xl
                     lg:text-[22px]
                     xl:text-xl
                     2xl:text-[22px]
                     mb-4
                     block
                     hover:text-primary
                     ">
                                    Search
                                </a>
                            </h3>
                            <p class="text-base text-gray-500 leading-relaxed mb-7">
                                Utilize our user-friendly interface to input your destination, preferred travel date,
                                and specific preferences
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 px-4">
                    <div class="bg-white rounded-lg overflow-hidden mb-10">
                        <img src="{{ asset('image/select.svg') }}" alt="image" class="w-full" />
                        <div class="p-8 sm:p-9 md:p-7 xl:p-9 text-center">
                            <h3>
                                <a href="javascript:void(0)"
                                    class="
                     font-semibold
                     text-dark text-xl
                     sm:text-[22px]
                     md:text-xl
                     lg:text-[22px]
                     xl:text-xl
                     2xl:text-[22px]
                     mb-4
                     block
                     hover:text-primary
                     ">
                                    Select
                                </a>
                            </h3>
                            <p class="text-base text-gray-500 leading-relaxed mb-7">
                                Browse through a list of buses and agencies, each with detailed schedules, amenities,
                                and pricing information.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 px-4">
                    <div class="bg-white rounded-lg overflow-hidden mb-10">
                        <img src="{{ asset('image/book.svg') }}" alt="image" class="w-full" />
                        <div class="p-8 sm:p-9 md:p-7 xl:p-9 text-center">
                            <h3>
                                <a href="javascript:void(0)"
                                    class="
                     font-semibold
                     text-dark text-xl
                     sm:text-[22px]
                     md:text-xl
                     lg:text-[22px]
                     xl:text-xl
                     2xl:text-[22px]
                     mb-4
                     block
                     hover:text-primary
                     ">
                                    Book
                                </a>
                            </h3>
                            <p class="text-base text-gray-500 leading-relaxed mb-7">
                                Once you've found the perfect bus and agency for your trip, securely book your seat with
                                confidence.
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ====== Cards Section End -->
    <!-- why choose us -->
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Why Choose Bus Seat Reservations System?</h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">Your Ticket to Effortless and Secure Bus Travel,
                    Explore the Exceptional Features of Bus Seat Reservations System</p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-primary lg:w-6 lg:h-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm11-4a1 1 0 1 0-2 0v4c0 .3.1.5.3.7l3 3a1 1 0 0 0 1.4-1.4L13 11.6V8Z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Convenience</h3>
                    <p class="text-gray-500 dark:text-gray-400">Book your bus seat online with just a few clicks. No
                        more waiting in long lines or rushing to the bus station.</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary lg:w-6 lg:h-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4.9 3C3.9 3 3 3.8 3 4.9V9c0 1 .8 1.9 1.9 1.9H9c1 0 1.9-.8 1.9-1.9V5c0-1-.8-1.9-1.9-1.9H5Zm10 0c-1 0-1.9.8-1.9 1.9V9c0 1 .8 1.9 1.9 1.9H19c1 0 1.9-.8 1.9-1.9V5c0-1-.8-1.9-1.9-1.9h-4Zm-10 10c-1 0-1.9.8-1.9 1.9V19c0 1 .8 1.9 1.9 1.9H9c1 0 1.9-.8 1.9-1.9v-4c0-1-.8-1.9-1.9-1.9H5ZM18 14a1 1 0 1 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0-2h-2v-2Z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Choice</h3>
                    <p class="text-gray-500 dark:text-gray-400">Browse through a wide selection of buses and agencies,
                        and choose the one that best fits your travel needs and preferences.</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary lg:w-6 lg:h-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.6 3h.8l7 2.7c.3.2.6.6.6 1a17.7 17.7 0 0 1-7.4 14.1 1 1 0 0 1-1.2 0A17.4 17.4 0 0 1 4 6.7c0-.4.3-.8.6-1l7-2.6Zm4 7.3a1 1 0 0 0-1.3-1.6l-3.3 3-.8-1a1 1 0 0 0-1.4 1.5l1.5 1.5c.4.4 1 .4 1.4 0l4-3.4Z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Security</h3>
                    <p class="text-gray-500 dark:text-gray-400">Your privacy and security are our top priorities. Our
                        platform utilizes state-of-the-art security measures to safeguard your personal information and
                        payment details.</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary lg:w-6 lg:h-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 2a3 3 0 0 0-2.1.9l-.9.9a1 1 0 0 1-.7.3H7a3 3 0 0 0-3 3v1.2c0 .3 0 .5-.2.7l-1 .9a3 3 0 0 0 0 4.2l1 .9c.2.2.3.4.3.7V17a3 3 0 0 0 3 3h1.2c.3 0 .5 0 .7.2l.9 1a3 3 0 0 0 4.2 0l.9-1c.2-.2.4-.3.7-.3H17a3 3 0 0 0 3-3v-1.2c0-.3 0-.5.2-.7l1-.9a3 3 0 0 0 0-4.2l-1-.9a1 1 0 0 1-.3-.7V7a3 3 0 0 0-3-3h-1.2a1 1 0 0 1-.7-.2l-.9-1A3 3 0 0 0 12 2Zm3.7 7.7a1 1 0 1 0-1.4-1.4L10 12.6l-1.3-1.3a1 1 0 0 0-1.4 1.4l2 2c.4.4 1 .4 1.4 0l5-5Z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Reliability</h3>
                    <p class="text-gray-500 dark:text-gray-400"> With real-time updates and notifications, you can rest
                        assured that your seat reservation is confirmed and ready for your journey.</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary lg:w-6 lg:h-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.7 7.7A7.1 7.1 0 0 0 5 10.8M18 4v4h-4m-7.7 8.3A7.1 7.1 0 0 0 19 13.2M6 20v-4h4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Flexibility</h3>
                    <p class="text-gray-500 dark:text-gray-400"> Modify or cancel your seat reservation with ease,
                        giving you the flexibility to adapt to changing travel plans.</p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary lg:w-6 lg:h-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 2a7 7 0 0 0-7 7 3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1c.6 0 1-.4 1-1V9a5 5 0 1 1 10 0v7a3 3 0 0 1-3 3 2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v1c0 1.1.9 2 2 2h1a2 2 0 0 0 1.7-1h.4a5 5 0 0 0 4.8-4h.1a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3 7 7 0 0 0-7-7Zm1.5 3.3a4 4 0 0 0-4.4 1 1 1 0 0 0 1.4 1.3 2 2 0 0 1 2.9 0A1 1 0 1 0 14.8 6a4 4 0 0 0-1.3-.8Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Customer Support</h3>
                    <p class="text-gray-500 dark:text-gray-400">Our dedicated customer support team is available around
                        the clock to assist you with any inquiries or issues you may encounter.</p>
                </div>
            </div>
    </section>

    {{-- bus listing --}}
    <section class="bg-[#F3F4F6]">
        <div class="container mx-auto py-12 px-2">
            <div class="my-4 align-baseline justify-between items-center flex">
                <h2 class="text-2xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Available Trips</h2>
                <div class="items-center">
                    <button type="button" class="btn btn-light mr-2" data-toggle="collapse" data-target="#filters"><svg
                            class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M5 3a2 2 0 0 0-1.5 3.3l5.4 6v5c0 .4.3.9.6 1.1l3.1 2.3c1 .7 2.5 0 2.5-1.2v-7.1l5.4-6C21.6 5 20.7 3 19 3H5Z" />
                        </svg>
                    </button>
                    <input type="text" class=" border-[1px] px-2 rounded-lg" placeholder="Search for Trips..."
                        id="search-filter">
                </div>
            </div>
            <div class="space-y-8">
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
                                <div class="mt-8 ">
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
                                        <strong
                                            class="text-base font-bold text-gray-800">{{ __('Facilities - ') }}</strong>
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

    <x-newsletter />

@endsection
