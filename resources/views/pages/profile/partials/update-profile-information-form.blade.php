<section>
    <header>
        <h2 class="text-lg font-medium text-dark-900 dark:text-dark-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-dark-600 dark:text-dark-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    @if (session('status') === 'profile-updated')
    <x-alert type="success" id="password-update" class="my-4">
        Profile Updated Success !
    </x-alert>
    @endif
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <x-form method="post" action="{{ route('profile.update') }}" novalidate>
        @method('patch')

        <div>
            <x-form.input-label for="name">{{ __('Name') }}</x-form.input-label>
            <x-form.input type="text" id="name" name="name" placeholder="Your Name" :value="old('name', $user->name)"
                required autocomplete="name" class="max-w-lg" />
            <x-form.input-error name="name" />
        </div>

        <div>
            <x-form.input-label for="email">{{ __('Email') }}</x-form.input-label>
            <x-form.input type="email" id="email" name="email" placeholder="yourmail@company.com"
                :value="old('email', $user->email)" required autocomplete="username" class="max-w-lg" />
            <x-form.input-error name="email" />
        </div>
        <x-button type="submit">SAVE</x-button>
    </x-form>
</section>