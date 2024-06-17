@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Schedules</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Schedules') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.schedule.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create New') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>{{ __('Start From') }}</th>
                                <th>{{ __('End To') }}</th>
                                <th>{{ __('Duration') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $item)
                                @php
                                    $start = Carbon\Carbon::parse($item->start_from);
                                    $end = Carbon\Carbon::parse($item->end_at);
                                    $diff = $start->diff($end);
                                @endphp
                                <tr>
                                    <td data-label="@lang('Start From')">
                                        {{ showDateTime($item->start_from, 'h:i a') }}
                                    </td>
                                    <td data-label="@lang('End At')">
                                        {{ showDateTime($item->end_at, 'h:i a') }}
                                    </td>
                                    <td data-label="@lang('Duration')">
                                        {{ __($diff->format('%h hours %i minutes')) }}
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if ($item->status == 1)
                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.schedule.edit', $item->id) }}" class="btn btn-primary"
                                            style="display: inline-block;"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('admin.schedule.toggleStatus', $item->id) }}"
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
