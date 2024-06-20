<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Dofir Fauzi">
    @stack('header')
    <title>{{ !empty($title) ? $title . ' | ' . config('app.name') : config('app.name')}}</title>
    <x-theme />
    @vite('resources/css/app.css')
</head>

<body class="bg-light-100 dark:bg-dark-950 antialiased">

    <div class="w-64 h-64 fixed -z-10 top-72 -start-24 rounded-full bg-primary-700  dark:opacity-25 blur-[200px]">
    </div>

    {{ $slot }}

    <div class="w-64 h-64 fixed -z-10 bottom-0 -right-24 rounded-full bg-secondary-500 dark:opacity-25 blur-[200px]">
    </div>

    @vite('resources/js/app.js')
    @stack('footer')
</body>

</html>