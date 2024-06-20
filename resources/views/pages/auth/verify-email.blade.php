<x-guest-layout title="Email Verification">
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <x-card class="p-6 max-w-md">
                <div class="mb-4 text-dark-600 dark:text-dark-400">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by
                    clicking on
                    the
                    link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                <x-alert type="success" id="link-sent-success" :dismissible="true">
                    {{ __('A new verification link has been sent to the email address you provided during
                    registration.') }}
                </x-alert>
                @endif

                <div class="mt-6 flex items-center justify-between">
                    <x-form method="POST" action="{{ route('verification.send') }}" :space="false">
                        <div>
                            <x-button type="submit">
                                {{ __('Resend Verification Email') }}
                            </x-button>
                        </div>
                    </x-form>

                    <x-form method="POST" action="{{ route('logout') }}" :space="false">
                        <x-button type="submit" color="netral"> {{ __('Log Out') }}
                        </x-button>
                    </x-form>
                </div>
            </x-card>
        </div>
    </section>

</x-guest-layout>