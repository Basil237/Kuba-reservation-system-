@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vehicles</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Vehicles') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create New') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>{{ __('Vehicle Name') }}</th>
                                <th>{{ __('Fleet Type') }}</th>
                                <th>{{ __('Reg. No.') }}</th>
                                <th>{{ __('Engine No.') }}</th>
                                <th>{{ __('Chasis No.') }}</th>
                                <th>{{ __('Model No.') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $item)
                                <tr>
                                    <td data-label="@lang('Vehicle Name')">
                                        {{ __($item->nick_name) }}
                                    </td>
                                    <td data-label="@lang('Fleet Type')">
                                        {{ __($item->fleetType->name) }}
                                    </td>
                                    <td data-label="@lang('Reg. No.')">
                                        {{ __($item->register_no) }}
                                    </td>
                                    <td data-label="@lang('Engine No.')">
                                        {{ __($item->engine_no) }}
                                    </td>
                                    <td data-label="@lang('Chasis No.')">
                                        {{ __($item->chasis_no) }}
                                    </td>
                                    <td data-label="@lang('Model No.')">
                                        {{ __($item->model_no) }}
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if ($item->status == 1)
                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.vehicles.edit', $item->id) }}" class="btn btn-primary"
                                            style="display: inline-block;"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('admin.vehicles.toggleStatus', $item->id) }}"
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
