<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FleetManagement') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex">
        @include('layouts.sidebar')

        <div class="main-content flex-grow-1 d-flex flex-column min-vh-100">
            @include('layouts.navbar')

            <div class="container-fluid px-4 py-3">
                @if (isset($header))
                    <div class="mb-3">
                        {{ $header }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toasts = document.querySelectorAll('.toast');
            toasts.forEach(function (t) { new bootstrap.Toast(t).show(); });
        });
    </script>
</body>
</html>
