<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ClubFit AI') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-slate-950 text-slate-100">
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950">
    @include('layouts.navigation')
    @isset($header)
        <header class="border-b border-slate-800 bg-slate-900/70 backdrop-blur">
            <div class="mx-auto max-w-7xl px-4 py-6">{{ $header }}</div>
        </header>
    @endisset
    <main class="mx-auto max-w-7xl px-4 py-6">{{ $slot }}</main>
</div>
</body>
</html>
