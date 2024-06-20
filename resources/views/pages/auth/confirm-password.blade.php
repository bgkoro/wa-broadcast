<x-guest-layout :$title>
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <x-card class="w-full sm:max-w-md p-6 sm:p-8 space-y-4 md:space-y-6">

                <div class="text-dark-600 dark:text-dark-200">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.')
                    }}
                </div>

                <!-- Session Status -->
                @if (session('status'))
                <x-alert type="success" id="link-sent-success" :dismissible="true">
                    {{ session('status') }}
                </x-alert>
                @endif

                <x-form method="POST" action="{{ route('password.confirm') }}" novalidate>
                    <!-- Password -->
                    <div>
                        <x-form.input-label for="password">Password</x-form.input-label>
                        <x-form.input id="password" type="password" name="password" required autofocus />
                        <x-form.input-error name="password" />
                    </div>

                    <x-button type="submit" color="primary" class="w-full">Confirm</x-button>

                </x-form>
            </x-card>
        </div>
    </section>
</x-guest-layout>