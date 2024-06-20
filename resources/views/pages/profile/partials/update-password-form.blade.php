<section>
    <header>
        <h2 class="text-lg font-medium text-dark-900 dark:text-dark-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-dark-600 dark:text-dark-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>
    @if (session('status') === 'password-updated')
    <x-alert type="success" id="password-update" class="my-4">
        Password Updated Success !
    </x-alert>
    @endif
    <x-form method="post" action="{{ route('password.update') }}" novalidate>
        @method('put')

        <div>
            <x-form.input-label for="update_password_current_password">Current Password</x-form.input-label>
            <x-form.input id="update_password_current_password" name="current_password" type="password" placeholder=""
                autocomplete="current-password" class="max-w-lg" required />
            <x-form.input-error name="current_password" errorBag="updatePassword" />
        </div>

        <div>
            <x-form.input-label for="update_password_password">New Password</x-form.input-label>
            <x-form.input id="update_password_password" name="password" type="password" placeholder=""
                autocomplete="new-password" class="max-w-lg" required />
            <x-form.input-error name="password" errorBag="updatePassword" />
        </div>

        <div>
            <x-form.input-label for="update_password_password_confirmation">Confirm Password</x-form.input-label>
            <x-form.input id="update_password_password_confirmation" name="password_confirmation" type="password"
                placeholder="" autocomplete="new-password" class="max-w-lg" required />
            <x-form.input-error name="password_confirmation" errorBag="updatePassword" />
        </div>

        <x-button.index type="submit">Save</x-button.index>
    </x-form>
</section>