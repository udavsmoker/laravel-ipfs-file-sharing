@extends('layouts.app')

@section('title', 'How It Works')

@section('content')
    <div class="how-it-works container mt-5">
        <h1 class="text-center mb-4">How It Works</h1>

        <section class="mb-5">
            <h2>Welcome to Our Secure File Sharing Service</h2>
            <p>Our platform allows you to securely upload, store, and share files with ease. Whether you're sharing a document or storing something sensitive, we ensure your files are encrypted and accessible only by you. Here's how it works:</p>
        </section>

        <section class="mb-5">
            <h2>How It Works</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4 how-it-works-card">
                        <img src="{{ asset('images/upload-icon.png') }}" class="card-img-top" alt="Upload Files">
                        <div class="card-body">
                            <h5 class="card-title">Step 1: Upload Files</h5>
                            <p class="card-text">Upload your files easily through our intuitive interface. You can either choose to encrypt the file or leave it unencrypted depending on your needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4 how-it-works-card">
                        <img src="{{ asset('images/encrypt-icon.png') }}" class="card-img-top" alt="Encryption">
                        <div class="card-body">
                            <h5 class="card-title">Step 2: Secure Encryption</h5>
                            <p class="card-text">All files are encrypted with strong encryption methods to ensure only you have access to them. You can choose to add a password for extra security.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4 how-it-works-card">
                        <img src="{{ asset('images/share-icon.png') }}" class="card-img-top" alt="Share Files">
                        <div class="card-body">
                            <h5 class="card-title">Step 3: Share Securely</h5>
                            <p class="card-text">Once uploaded and encrypted, you can securely share your files with anyone, knowing that they are protected with encryption and a passphrase.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <h2>Security You Can Trust</h2>
            <p>Our service employs state-of-the-art encryption algorithms (AES-256) to ensure your files are securely stored. With optional password protection and encrypted storage, your data is safe from unauthorized access.</p>
            <p>We never store your password—only a hashed version of it. This ensures that even if someone gains unauthorized access to our servers, your data remains secure and inaccessible to them.</p>
        </section>

        <section class="mb-5">
            <h2>File Retention Policy</h2>
            <p>Your uploaded files are stored temporarily on our servers. After a certain period, the files will be automatically deleted to free up space, ensuring optimal performance for all users.</p>
            <p>However, if you need to keep your files safe for a longer period, we offer the option to <strong>pin your files</strong> to the node permanently by upgrading to a Pro account. This ensures that your files will remain accessible for as long as you need them.</p>
        </section>
        <section class="mb-5">
            <h2>Upgrade to Pro for Permanent File Retention</h2>
            <p>Switching to Pro gives you the ability to pin your files to the node indefinitely. No matter how long you need access to them, they'll remain securely stored and accessible.</p>
            <p>With a Pro account, you can also enjoy other benefits, including:</p>
            <ul>
                <li>Unlimited file uploads</li>
                <li>Advanced encryption options</li>
                <li>Priority support</li>
            </ul>
            <p><a href="#" class="btn btn-primary">Upgrade to Pro</a></p>
        </section>
    </div>
@endsection
