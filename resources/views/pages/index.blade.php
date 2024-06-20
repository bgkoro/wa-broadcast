<x-public-layout :$title>
    @push('header')
    <meta name="description" content="Laravel starter application with tailwindcss and flowbite components">
    <meta name="keywords" content="laravel, laravel starter pack, tailwindcss, flowbite,">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}">
    <meta property="og:description" content="Website Penerimaan Santri Baru Pesantren Modern Daarul 'Uluum Lido">
    <meta property="og:image" content="https://psb.daarululuumlido.com//img/front_image.png">
    @endpush
    <section>
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
            {{-- Image illustrator --}}
            <img src="/assets/img/programming.svg" class="max-w-md mx-auto mb-4" alt="programming illustration">
            {{-- Heading --}}
            <h1 class="mb-4 text-4xl font-extrabold leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Welcome to laravel starter app</h1>
            {{-- Sub Heading --}}
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">
                This is laravel starter pack for application with breeze, tailwindcss and flowbite components, modified
                by <a href="https://dofirfauzi.com" class="font-bold hover:text-primary-600">Dofir Fauzi</a>
            </p>

            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                @auth
                {{-- Dashboard btn --}}
                <x-button href="{{ route('dashboard') }}" size="large">Dashboard</x-button>
                @endauth
                @guest
                {{-- Login btn --}}
                <x-button href="{{ route('login') }}" size="large" class="grow-0">Login</x-button>
                {{-- Register btn --}}
                <x-button href="{{ route('register') }}" color="netral" size="large" class="sm:ms-4">Register
                </x-button>
                @endguest
            </div>
        </div>
    </section>
</x-public-layout>