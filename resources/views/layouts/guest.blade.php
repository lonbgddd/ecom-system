<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'EduCourse') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
    </style>
</head>

<body class="font-sans bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    {{-- HEADER --}}
    <header class="bg-white sticky top-0 z-50 shadow">
                   @include('layouts.navigation_user')

    </header>

    {{-- MAIN --}}
    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-100 py-8 text-center text-sm text-gray-500">
        © {{ date('Y') }} EduCourse Platform. All rights reserved.
    </footer>

</body>
</html>
