@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Seat Layout') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Add Seat Layout') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.seat_layouts.update', $layout->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('Layout') }}</label>
                        <input type="text" class="form-control" value="{{ $layout->layout }}" name="layout" id="layout"
                            placeholder="2 X 3">
                        <small>{{ __('Just type left and right value, a seperator (X) will be added automatically') }}</small>
                        @error('layout')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                    <a href="{{ route('admin.seat_layouts.index') }}" class="btn btn-danger">Close</a>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        (function ($) {
            "use strict";

            $(document).on('keypress', 'input[name=layout]', function(e){
                var layout = $(this).val();
                if(layout != ''){
                    if(layout.length > 0 && layout.length <= 1)
                        $(this).val(`${layout} X `);

                    if(layout.length > 4) {
                        return false;
                    }
                }
            });

            $(document).on('keyup', 'input[name=layout]', function(e){
                var key = e.keyCode || e.charCode;
                if( key == 8 || key == 46 ){
                    $(this).val($(this).val().replace(/ X /g,''));
                }
            });

        })(jQuery);
    </script>
@endpush
