<x-card class=" p-6 sm:p-8 space-y-4">
    <p class="text-lg text-dark-900 dark:text-light-500">Chart Campaign Report</p>
    @push('header')
        @apexchartsScripts
    @endpush
    {!! $chart->container() !!}
    {!! $chart->script() !!}
</x-card>
