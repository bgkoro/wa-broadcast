<x-guest-layout :$title>
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <x-application-logo textSize="text-xl sm:text-3xl mb-8" />
            <x-card class="w-full sm:max-w-md p-6 sm:p-8 space-y-4 md:space-y-6">
                {{-- form header --}}
                <h1 class="text-xl font-bold leading-tight tracking-tight text-dark-900 md:text-2xl dark:text-light-50">
                    Login to your account
                </h1>
                <!-- Session Status -->
                @if (session('status'))
                <x-alert type="success" id="session-status" :dismissible="true">
                    {{ session('status') }}
                </x-alert>
                @endif
                <x-form method="POST" action="{{ route('login') }}" novalidate>
                    {{-- email --}}
                    <div>
                        <x-form.input-label for="usernameOrEmail">Username Or Email</x-form.input-label>
                        <x-form.input type="text" id="usernameOrEmail" name="usernameOrEmail"
                            placeholder="Username Or Email" value="{{ old('usernameOrEmail') }}" required autofocus />
                        <x-form.input-error name='usernameOrEmail' />
                    </div>
                    {{-- Password --}}
                    <div>
                        <x-form.input-label for="password">Password</x-form.input-label>
                        <x-form.input type="password" id="password" name="password" placeholder="••••••••" required />
                        <x-form.input-error name='password' />
                    </div>
                    {{-- Remember me --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <x-form.checkbox id="remember_me" aria-describedby="remember_me" name="remember_me">
                                Remember me</x-form.checkbox>
                            <x-form.input-error name="remember_me" />
                        </div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                            password?</a>
                        @endif
                    </div>
                    {{-- Submit btn --}}
                    <x-button type="submit" class="w-full">Login</x-button>
                </x-form>
            </x-card>
        </div>
    </section>
</x-guest-layout>