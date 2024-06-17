@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Schedules') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Add Schedule') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.schedule.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ __('Start From') }}</label>
                        <div class="input-group clockpicker">
                            <input type="text" class="form-control" placeholder="--:--" name="start_from"
                                autocomplete="off">
                        </div>
                        @error('start_from')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('End At') }}</label>
                        <div class="input-group clockpicker">
                            <input type="text" class="form-control" placeholder="--:--" name="end_at"
                                autocomplete="off">
                        </div>
                        @error('end_at')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Create') }}</button>
                    <a href="{{ route('admin.schedule.index') }}" class="btn btn-danger">Close</a>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        (function($) {
            "use strict";

            $('.clockpicker').clockpicker({
                placement: 'bottom',
                align: 'left',
                donetext: 'Done',
                autoclose: true,
            });
        })(jQuery);
    </script>
@endpush
