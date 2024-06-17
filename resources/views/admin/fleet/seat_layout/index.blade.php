@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Seat Layout</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Seat Layouts') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.seat_layouts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create New') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>{{ __('S.N.') }}</th>
                                <th>{{ __('Layout') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($layouts as $layout)
                                <tr>
                                    <td data-label="@lang('S.N.')">
                                        {{ $layout->current_page - 1 * $layout->per_page + $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $layout->layout }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.seat_layouts.edit', $layout->id) }}"
                                            class="btn btn-primary" style="display: inline-block;"><i
                                                class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('admin.seat_layouts.destroy', $layout->id) }}"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">No Seat Layout Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
