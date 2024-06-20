<x-guest-layout :$title>
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <x-application-logo textSize="text-xl sm:text-3xl mb-8" />
            <x-card class="w-full sm:max-w-md p-6 sm:p-8 space-y-4 md:space-y-6">
                <x-form method="POST" action="{{ route('password.store') }}" novalidate>

                    {{-- Password Reset Token --}}
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <x-form.input-label for="email">Email</x-form.input-label>
                        <x-form.input id="email" type="email" placeholder="yourmail@company.com" name="email"
                            :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-form.input-error name="email" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-form.input-label for="password">Password</x-form.input-label>
                        <x-form.input id="password" type="password" placeholder="••••••••" name="password" required
                            autocomplete="new-password" />
                        <x-form.input-error name="password" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-form.input-label for="password_confirmation">Confirm Password</x-form.input-label>

                        <x-form.input id="password_confirmation" placeholder="••••••••" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-form.input-error name="password_confirmation" />
                    </div>
                    <x-button type="submit" class="w-full">Reset My Password</x-button>
                </x-form>
            </x-card>
        </div>
    </section>

</x-guest-layout>