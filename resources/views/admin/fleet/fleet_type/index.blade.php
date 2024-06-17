@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Fleet Type</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Fleet Type') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.fleet_type.create') }}" class="btn btn-primary">
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
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Seat Layout') }}</th>
                                <th>{{ __('No of Deck') }}</th>
                                <th>{{ __('Total Seat') }}</th>
                                <th>{{ __('Facilities') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fleetType as $item)
                                <tr>
                                    <td data-label="@lang('S.N.')">
                                        {{ $item->current_page - 1 * $item->per_page + $loop->iteration }}
                                    </td>
                                    <td data-label="@lang('Name')">
                                        {{ __($item->name) }}
                                    </td>
                                    <td data-label="@lang('Seat Layout')">
                                        {{ __($item->seat_layout) }}
                                    </td>
                                    <td data-label="@lang('No of Deck')">
                                        {{ __($item->deck) }}
                                    </td>
                                    <td data-label="@lang('Total Seat')">
                                        {{ array_sum($item->deck_seats) }}
                                    </td>
                                    <td data-label="@lang('Facilities')">
                                        @if ($item->facilities)
                                            {{ __(implode(',', $item->facilities)) }}
                                        @else
                                            @lang('No facilities')
                                        @endif
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if ($item->status == 1)
                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.fleet_type.edit', $item->id) }}" class="btn btn-primary"
                                            style="display: inline-block;"><i class="fas fa-edit"></i></a>
                                        <form method="POST"
                                            action="{{ route('admin.fleet_type.toggleStatus', $item->id) }}"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger">
                                                @if ($item->status)
                                                    <i class="fas fa-eye"></i>
                                                @else
                                                    <i class="fas fa-eye-slash"></i>
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
