<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sharey</title>

        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #f8f9fa;
                color: #333;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .container {
                max-width: 960px;
                padding: 20px;
                margin-top: 20px;
                flex: 1
            }

            h1.display-4 {
                font-size: 3rem;
                font-weight: bold;
                color: #007bff;
            }

            p.lead {
                font-size: 1.25rem;
                color: #6c757d;
            }

            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }

            .btn-secondary {
                background-color: #6c757d;
                border-color: #6c757d;
            }

            .btn:hover {
                opacity: 0.9;
            }

            footer {
                background-color: #f1f1f1;
                padding: 10px 0;
                text-align: center;
                width: 100%;
            }

            footer p {
                color: #6c757d;
            }

            @media (max-width: 768px) {
                h1.display-4 {
                    font-size: 2.5rem;
                }

                p.lead {
                    font-size: 1.1rem;
                }

                .btn {
                    width: 100%;
                    margin-bottom: 10px;
                }
            }
            </style>
    </head>
    <body>
        <div class="container my-5">
            <div class="text-center">
                <h1 class="display-4">Welcome to Sharey</h1>
                <p class="lead">Your secure file upload and download platform powered by IPFS.</p>
            </div>

            <div class="d-flex justify-content-center mt-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('home') }}" class="btn btn-primary mx-2">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary mx-2">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-secondary mx-2">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <footer>
            <p class="text-muted">&copy; {{ date('Y') }} Sharey. All rights reserved.</p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
