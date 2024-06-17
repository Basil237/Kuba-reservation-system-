@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Agencies</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Agencies') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.agencies.create') }}" class="btn btn-primary">
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
                                <th>{{ __('Mobile Number') }}</th>
                                <th>{{ __('City') }}</th>
                                <th>{{ __('Location') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($agencies as $agency)
                                <tr>
                                    <td data-label="@lang('S.N.')">
                                        {{ $agency->current_page - 1 * $agency->per_page + $loop->iteration }}
                                    </td>
                                    <td data-label="Name">{{ $agency->name }}</td>
                                    <td data-label="Mobile Number">{{ $agency->mobile }}</td>
                                    <td data-label="City">{{ $agency->city }}</td>
                                    <td data-label="Location">{{ $agency->location }}</td>
                                    <td data-label="Status">
                                        @if ($agency->status == 1)
                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.agencies.edit', $agency->id) }}" class="btn btn-primary"
                                            style="display: inline-block;"><i class="fas fa-edit"></i></a>
                                        <form method="POST"
                                            action="{{ route('admin.agencies.toggleStatus', $agency->id) }}"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger">
                                                @if ($agency->status)
                                                    <i class="fas fa-eye"></i>
                                                @else
                                                    <i class="fas fa-eye-slash"></i>
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">No Agency Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
