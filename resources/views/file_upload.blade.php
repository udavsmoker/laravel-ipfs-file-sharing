@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Upload</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4 shadow-sm">
        <h2>Upload File</h2>
        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Choose file:</label>
                <input type="file" name="file" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (optional):</label>
                <input type="text" name="password" class="form-control" pattern="[A-Za-z0-9]+" placeholder="Enter password (alphanumeric)">
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>
@endsection
