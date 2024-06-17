@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Trips</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Trips') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.trips.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create New') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('AC / Non-AC') }}</th>
                                <th>{{ __('Day Off') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trips as $item)
                                <tr>
                                    <td data-label="{{ __('Title') }}">
                                        {{ __($item->title) }}
                                    </td>
                                    <td data-label="{{ __('AC / Non-AC') }}">
                                        {{ __($item->fleetType->has_ac == 1 ? 'AC' : 'Non-Ac') }}
                                    </td>
                                    <td data-label__="{{ 'Day Off' }}">
                                        @if ($item->day_off)
                                            @foreach ($item->day_off as $day)
                                                {{ __(showDayOff($day)) }} @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        @else
                                            @lang('No Off Day')
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
                                        <a href="{{ route('admin.trips.edit', $item->id) }}" class="btn btn-primary"
                                            style="display: inline-block;"><i class="fas fa-edit"></i></a>
                                        <form method="POST"
                                            action="{{ route('admin.trips.toggleStatus', $item->id) }}"
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
