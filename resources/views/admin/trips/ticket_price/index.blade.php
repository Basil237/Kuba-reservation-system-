@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ticket Prices</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Ticket Prices') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.ticket-price.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create New') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>{{ __('Fleet Type') }}</th>
                                <th>{{ __('Route') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prices as $item)
                                <tr>
                                    <td data-label="@lang('Fleet Type')">
                                        {{ __($item->fleetType->name) }}
                                    </td>
                                    <td data-label="@lang('Route')">
                                        {{ __($item->route->name) }}
                                    </td>
                                    <td data-label="@lang('Price')">
                                        <span class="font-weight-bold text-muted">{{ __(showAmount($item->price)) }}
                                            {{ __('FCFA') }}</span>
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.ticket-price.edit', $item->id) }}" class="btn btn-primary"
                                            style="display: inline-block;"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('admin.ticket-price.destroy', $item->id) }}"
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
