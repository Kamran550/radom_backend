<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document Verification - {{ config('app.name', 'RADOM') }}</title>
    
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect fill='%230e7490' width='32' height='32' rx='6'/%3E%3Ctext x='16' y='22' text-anchor='middle' fill='white' font-family='Georgia,serif' font-size='17' font-weight='bold'%3ER%3C/text%3E%3C/svg%3E">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-white antialiased">
    <main>
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>

