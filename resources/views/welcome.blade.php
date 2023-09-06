<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TestMaker</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased mx-auto w-10/12">
    <header class="">
        <div class="row flex sm:justify-end">
                <x-auth-bar />
        </div>
        <div class="row">
            <x-nav-bar />
        </div>
    </header>
    @livewireScripts
</body>
</html>
