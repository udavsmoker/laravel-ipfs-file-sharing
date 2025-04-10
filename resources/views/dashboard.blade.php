@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@push('styles')
<style>
    .dashboard-actions {
        position: sticky;
        bottom: 0;
        background-color: white;
        padding: 1rem 0;
        z-index: 100;
        box-shadow: 0 -2px 6px rgba(0,0,0,0.05);
    }
</style>
@endpush

<div class="container mt-5">
    <h2 class="mb-4">Welcome, {{ Auth::user()->name }} 👋</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Files</h5>
                    <p class="display-6">{{ $fileStats['total'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Active Files</h5>
                    <p class="display-6">{{ $fileStats['active'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Last Upload</h5>
                    <p class="display-6">{{ $fileStats['lastUpload'] ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h4>Your Uploaded Files</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Extension</th>
                    <th>IPFS Hash</th>
                    <th>Uploaded At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($files as $file)
                <tr>
                    <td>{{ $file->filename }}</td>
                    <td>{{ $file->extension }}</td>
                    <td>
                        <button class="btn btn-sm copy-hash" data-clipboard-text="{{ $file->ipfs_hash }}">
                            <code>{{ $file->ipfs_hash }}</code>
                        </button>
                    </td>
                    <td>{{ $file->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No files uploaded yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="dashboard-actions d-flex gap-3 justify-content-center border-top mt-5 pt-3">
        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#proModal">🚀 Switch to Pro</a>
        <a href="{{route("howitworks")}}" class="btn btn-outline-secondary">💡 How It Works</a>
        <a href="{{route("activitylogs")}}" class="btn btn-outline-dark">📈 Activity Logs</a>
        <a href="mailto:ilham.nabiyev@yahoo.com?subject=File Removal Request" class="btn btn-outline-danger">📧 Contact Us for File Removal</a>
        <a href="mailto:ilham.nabiyev@yahoo.com?subject=Dashboard Feedback" class="btn btn-outline-success">📬 Feedback</a>
        <a href="{{route("password.change")}}" class="btn btn-outline-secondary">🔒 Change Password</a>
    </div>
</div>

<!-- Modal for "Switch to Pro" -->
<div class="modal fade" id="proModal" tabindex="-1" aria-labelledby="proModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proModalLabel">Get Pro Features</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>To unlock pro features, contact us via one of the following options:</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="https://t.me/ohw911" class="btn btn-outline-primary" target="_blank">Telegram</a>
                    <a href="https://wa.me/+994507176633" class="btn btn-outline-success" target="_blank">WhatsApp</a>
                    <a href="mailto:ilham.nabiyev@yahoo.com?subject=Pro Features Inquiry" class="btn btn-outline-danger" target="_blank">Email</a>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var clipboard = new ClipboardJS('.copy-hash');

        clipboard.on('success', function(e) {
            alert('IPFS hash copied to clipboard!');
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            alert('Failed to copy the IPFS hash.');
        });
    });
</script>
@endpush
@endsection
