<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Evaluasi Produktivitas') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #F5F7FA;
            /* warna abu lembut */
            font-family: 'Geist', sans-serif;
        }

        .header-clean {
            background: white;
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .page-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }

        .card-clean {
            background: white;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body>

    @include('layouts.navigation')

    @isset($header)
        <div class="header-clean">
            <div class="page-wrapper">
                {{ $header }}
            </div>
        </div>
    @endisset

    <main class="page-wrapper">
        {{ $slot }}
    </main>

</body>

</html>