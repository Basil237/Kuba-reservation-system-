@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Facilities</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Facilities') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create New') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>{{ __('S.N') }}</th>
                                <th>{{ __('Icon') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Detail') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        @foreach ($facilities as $facility)
                            <tr>
                                <td data-label="@lang('S.N.')">
                                    {{ $facility->current_page - 1 * $facility->per_page + $loop->iteration }}
                                </td>
                                <td data-label="Icon">{!! $facility->icon !!}</td>
                                <td data-label="Title">{{ $facility->title }}</td>
                                <td data-label="Detail">{{ $facility->details }}</td>
                                <td>
                                    <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="btn btn-primary"
                                        style="display: inline-block;"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('admin.facilities.destroy', $facility->id) }}"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
