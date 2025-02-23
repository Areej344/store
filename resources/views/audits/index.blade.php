@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-black text-white">
            <h1 class="h4 mb-0">{{ __('messages.audit_logs') }}</h1>
        </div>
        <div class="card-body">
            <!-- Search Form -->
            <form action="{{ route('audits.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="{{ __('messages.search_logs_placeholder') }}" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-black">
                            <i class="fas fa-search"></i> {{ __('messages.search') }}
                        </button>
                    </div>
                </div>
            </form>

            <!-- Audit Logs Table -->
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('messages.id') }}</th>
                            <th scope="col">{{ __('messages.user') }}</th>
                            <th scope="col">{{ __('messages.event') }}</th>
                            <th scope="col">{{ __('messages.date') }}</th>
                            <th scope="col">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($audits as $audit)
                            <tr>
                                <td>{{ $audit->id }}</td>
                                <td>{{ $audit->user->name ?? __('messages.system') }}</td>
                                <td>
                                    <span class="badge badge-{{ $audit->event === 'created' ? 'success' : ($audit->event === 'updated' ? 'warning' : 'danger') }}">
                                        {{ __("messages.{$audit->event}") }}
                                    </span>
                                </td>
                                <td>{{ $audit->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('audits.show', $audit) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> {{ __('messages.view') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $audits->links() }}
            </div>
        </div>
    </div>
</div>
@endsection