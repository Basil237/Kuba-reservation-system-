@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Facilities') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Update Facility') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('Title') }}</label>
                        <input type="text" class="form-control" name="title" id="title"
                            value="{{ $facility->title }}" placeholder="Enter Title">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Details') }}</label>
                        <input class="form-control" name="details" id="details" value="{{ $facility->details }}"
                            placeholder="Enter Facility Details">
                        @error('details')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Icon') }}</label>
                        <input type="text" class="form-control icon-name" readonly name="icon" id="icon"
                            placeholder="Select an Icon below" hidden value="{{ $facility->icon }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary iconPicker" data-icon="fas fa-home"
                                role="iconpicker"></button>
                        </div>
                        @error('icon')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                    <a href="{{ route('admin.facilities.index') }}" class="btn btn-danger">Close</a>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.iconPicker').iconpicker({
                align: 'center', // Only in div tag
                arrowClass: 'btn-danger',
                arrowPrevIconClass: 'fas fa-angle-left',
                arrowNextIconClass: 'fas fa-angle-right',
                cols: 10,
                footer: true,
                header: true,
                icon: 'fas fa-bomb',
                iconset: 'fontawesome5',
                labelHeader: '{0} of {1} pages',
                labelFooter: '{0} - {1} of {2} icons',
                placement: 'bottom', // Only in button tag
                rows: 5,
                search: false,
                searchText: 'Search icon',
                selectedClass: 'btn--success',
                unselectedClass: ''
            }).on('change', function(e) {
                $(this).parent().siblings('.icon-name').val(`<i class="${e.icon}"></i>`);
            });
        })(jQuery);
    </script>
@endpush
