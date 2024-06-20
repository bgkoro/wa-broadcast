<x-app-layout :$title>
    <div class="px-4 py-6 lg:py-8 space-y-6">
        <x-card class="py-6 sm:py-8 space-y-4">
            @include('pages.campaign.partials.table-header')
            @include('pages.campaign.partials.table')
        </x-card>
    </div>
</x-app-layout>
