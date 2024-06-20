<x-app-layout :$title>
    <div class="px-4 py-6 lg:py-8 space-y-6">
        @include('pages.dashboard.partials.heading')
        <div class="flex flex-col lg:flex-row">
            <div class="basis-full lg:basis-4/12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
                @can('has-permission', 'view_credits')
                @include('pages.dashboard.partials.credit-balance-card')
                @endcan
                @include('pages.dashboard.partials.campaign-card')
                @include('pages.dashboard.partials.sms-submitted-card')
                @include('pages.dashboard.partials.sms-delivered-card')
                @include('pages.dashboard.partials.sms-undelivered-card')
                @include('pages.dashboard.partials.sms-rejected-card')

            </div>
            <div class="basis-full lg:basis-8/12 mt-4 lg:mt-0 lg:ms-4">
                @include('pages.dashboard.partials.chart')
            </div>
        </div>
    </div>
</x-app-layout>
