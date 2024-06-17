@extends('layouts.guest')
@section('content')
    <section class="bg-gray-100">
        <div class="py-32 bg-blend-overlay bg-backgroundDark opacity-65 justify-center items-center"
            style="background-image: url('image/9844313.jpg')">
            <h2 class="font-bold text-5xl text-center text-white justify-center items-center flex">Dashboard</h2>
        </div>

        <div class="container mx-auto py-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="rounded-xl bg-white p-8 border-l-primary border-l-4">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col space-y-2">
                            <h6 class="text-base text-gray-500">Total Booked Ticket</h6>
                            <p class="text-black text-4xl font-bold">0</p>
                        </div>
                        <div class="p-8 rounded-xl bg-primary"><img src="{{ asset('image/select.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="rounded-xl bg-white p-8 border-l-primary border-l-4">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col space-y-2">
                            <h6 class="text-base text-gray-500">Total Booked Ticket</h6>
                            <p class="text-black text-4xl font-bold">0</p>
                        </div>
                        <div class="p-8 rounded-xl bg-primary"><img src="{{ asset('image/select.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="rounded-xl bg-white p-8 border-l-primary border-l-4">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col space-y-2">
                            <h6 class="text-base text-gray-500">Total Booked Ticket</h6>
                            <p class="text-black text-4xl font-bold">0</p>
                        </div>
                        <div class="p-8 rounded-xl bg-primary"><img src="{{ asset('image/select.svg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
