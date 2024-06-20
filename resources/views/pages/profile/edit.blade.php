<x-app-layout>
    <div class="px-4 py-6 lg:py-8 space-y-6">
        <x-card class="p-6 sm:p-8">
            @include('pages.profile.partials.update-profile-information-form')
        </x-card>

        <x-card class="p-6 sm:p-8">
            @include('pages.profile.partials.update-password-form')
        </x-card>

        <x-card class="p-6 sm:p-8">
            @include('pages.profile.partials.delete-user-form')
        </x-card>
    </div>
</x-app-layout>