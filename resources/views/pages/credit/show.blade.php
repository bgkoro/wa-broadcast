<x-app-layout :$title>
     <div class="px-4 lg:px-8 py-6 lg:py-8 space-y-6">
          @can('has-permission', 'manage_credits')
          <x-card class="p-6 sm:p-8 space-y-4">
               @include('pages.credit.partials.form-update-credit')
          </x-card>
          @endcan
          <x-card class="py-6 sm:py-8 space-y-4">
               @include('pages.credit.partials.user-credit-table-header')
               @include('pages.credit.partials.user-credit-table')
          </x-card>
     </div>
</x-app-layout>