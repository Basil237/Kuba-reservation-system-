@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Assign Vehicle</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Assigned Vehicles') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.assigned-vehicles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create New') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>{{ __('Trip') }}</th>
                                <th>{{ __('Vehicle\'s Nick Name') }}</th>
                                <th>{{ __('Reg. No.') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignedVehicles as $item)
                                <tr>
                                    <td data-label="{{ __('Trip') }}">
                                        {{ __($item->trip->title) }}
                                    </td>
                                    <td data-label="{{ __('Vehicle\'s Nick Name') }}">
                                        {{ __($item->vehicle->nick_name) }}
                                    </td>
                                    <td data-label__="{{ 'Reg. No.' }}">
                                        {{ __($item->vehicle->register_no) }}
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if ($item->status == 1)
                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.assigned-vehicles.edit', $item->id) }}" class="btn btn-primary"
                                            style="display: inline-block;"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('admin.assigned-vehicles.toggleStatus', $item->id) }}"
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
