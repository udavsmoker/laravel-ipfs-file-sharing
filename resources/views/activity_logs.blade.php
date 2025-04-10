@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Activity Logs</h1>

    @if ($logs->isEmpty())
        <p>No activities found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Activity Type</th>
                    <th>Description</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ ucfirst($log->activity_type) }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $logs->links() }}
    @endif
</div>
@endsection

@push('styles')
    <style>
        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        .table {
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #343a40;
            color: #ffffff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .pagination {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .page-link {
            border-radius: 20px;
            padding: 8px 15px;
            margin: 0 5px;
            color: #007bff;
            background-color: white;
            border: 1px solid #ddd;
        }

        .page-item.active .page-link {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .page-link:hover {
            background-color: #e9ecef;
            color: #007bff;
        }
    </style>
@endpush
