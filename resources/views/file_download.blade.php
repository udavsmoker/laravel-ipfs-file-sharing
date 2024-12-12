@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Download</h1>
    <div class="card p-4 shadow-sm">
        <h2>Download File by IPFS Hash</h2>
        <form id="downloadForm" action="{{ route('download', ':hash') }}" method="GET">
            <div class="mb-3">
                <label for="ipfsHash" class="form-label">Enter IPFS Hash:</label>
                <input type="text" id="ipfsHash" name="hash" class="form-control" placeholder="Enter IPFS Hash" required>
            </div>

            <div class="mb-3">
                <label for="downloadPassword" class="form-label">Password (optional):</label>
                <input type="text" name="password" class="form-control" pattern="[A-Za-z0-9]+" placeholder="Enter password (alphanumeric)">
            </div>

            <button type="submit" class="btn btn-primary">Download</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('downloadForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const hash = document.getElementById('ipfsHash').value;
        const password = document.querySelector('[name="password"]').value;

        if (hash) {
            this.action = this.action.replace(':hash', hash);

            if (password) {
                const passwordInput = document.createElement('input');
                passwordInput.type = 'hidden';
                passwordInput.name = 'password';
                passwordInput.value = password;
                this.appendChild(passwordInput);
            }

            this.submit();
        } else {
            alert('Please enter a valid IPFS hash.');
        }
    });
</script>
@endsection
