@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-black text-white">
            <h1 class="h4 mb-0">{{ __('messages.audit_log_details') }}</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th class="bg-light">{{ __('messages.id') }}</th>
                        <td>{{ $audit->id }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">{{ __('messages.user') }}</th>
                        <td>{{ $audit->user->name ?? __('messages.system') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">{{ __('messages.event') }}</th>
                        <td>
                            <span class="badge badge-{{ $audit->event === 'created' ? 'success' : ($audit->event === 'updated' ? 'warning' : 'danger') }}">
                                {{ __("messages.{$audit->event}") }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">{{ __('messages.auditable_type') }}</th>
                        <td>{{ $audit->auditable_type }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">{{ __('messages.old_values') }}</th>
                        <td>
                            <pre class="p-3 bg-light rounded">{{ json_encode($audit->old_values, JSON_PRETTY_PRINT) }}</pre>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">{{ __('messages.new_values') }}</th>
                        <td>
                            <pre class="p-3 bg-light rounded">{{ json_encode($audit->new_values, JSON_PRETTY_PRINT) }}</pre>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">{{ __('messages.url') }}</th>
                        <td>{{ $audit->url }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">{{ __('messages.date') }}</th>
                        <td>{{ $audit->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <a href="{{ route('audits.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_logs') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection