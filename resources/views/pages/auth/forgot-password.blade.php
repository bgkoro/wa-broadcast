<x-guest-layout :$title>
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <x-application-logo textSize="text-xl sm:text-3xl mb-8" />
            <x-card class="w-full sm:max-w-md p-6 sm:p-8 space-y-4 md:space-y-6">

                <div class="text-dark-600 dark:text-dark-200">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a
                    password
                    reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                @if (session('status'))
                <x-alert type="success" id="link-sent-success" :dismissible="true">
                    {{ session('status') }}
                </x-alert>
                @endif

                <x-form method="POST" action="{{ route('password.email') }}" novalidate>

                    <!-- Email Address -->
                    <div>
                        <x-form.input-label for="email">Email</x-form.input-label>
                        <x-form.input id="email" type="email" name="email" placeholder="yourmail@company.com"
                            :value="old('email')" required autofocus />
                        <x-form.input-error name="email" />
                    </div>

                    <x-button type="submit" color="primary" class="w-full">Send Password Reset Link</x-button>

                </x-form>
            </x-card>
        </div>
    </section>
</x-guest-layout>