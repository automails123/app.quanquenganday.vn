<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Quán Quen Gần Đây') }}</title>
<link rel="icon" href="{{ asset('cropped-quanquen-vn-32x32.webp') }}" sizes="32x32" type="image/webp" />
<link rel="icon" href="{{ asset('cropped-quanquen-vn-192x192.webp') }}" sizes="192x192" type="image/webp" />
<link rel="apple-touch-icon" href="{{ asset('cropped-quanquen-vn-180x180.webp') }}" type="image/webp" />


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
