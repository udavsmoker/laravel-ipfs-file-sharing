@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Download</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="card p-4 shadow-sm">
            <h2>Download File by IPFS Hash</h2>
            <form action="{{ route('download') }}" method="GET">
                <div class="mb-3">
                    <label for="ipfsHash" class="form-label">Enter IPFS Hash:</label>
                    <input type="text" id="ipfsHash" name="hash" class="form-control" placeholder="Enter IPFS Hash"
                        required>
                </div>

                <div class="mb-3">
                    <label for="downloadPassword" class="form-label">Password (optional):</label>
                    <input type="text" id="downloadPassword" name="password" class="form-control" pattern="[A-Za-z0-9]+"
                        placeholder="Enter password (alphanumeric)">
                </div>

                <button type="submit" class="btn btn-primary">Download</button>
            </form>
        </div>
    </div>
@endsection
