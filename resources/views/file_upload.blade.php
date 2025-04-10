@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Upload</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('password'))
    <div class="alert alert-warning" style="background-color: #ffeb3b; color: #000;">
        <strong>Warning!</strong> Your password: {{ session('password') }}. {{ session('warning') }}
    </div>
@endif


    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card p-4 shadow-sm">
        <h2>Upload File</h2>
        <form id="uploadForm" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Choose file:</label>
                <input type="file" id="file" name="file" class="form-control" required>
                <small class="text-muted">Maximum file size: 20 MB</small>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (optional):</label>
                <input type="text" id="password" name="password" class="form-control" pattern="[A-Za-z0-9]+" placeholder="Enter password (alphanumeric)">
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
    <div id="loadingSpinner" class="d-none text-center mt-3">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Uploading...</span>
        </div>
        <p class="mt-2">Uploading file, please wait...</p>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/upload.js') }}"></script>
@endpush
@endsection
