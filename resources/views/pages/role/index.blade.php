<x-app-layout :$title>
     <div class="px-4 py-6 lg:py-8 space-y-6">
          @can('has-permission', 'manage_roles')
          <x-card class="p-6 sm:p-8 space-y-4">
               @include('pages.role.partials.form-create')
          </x-card>
          @endcan
          <x-card class="py-6 sm:py-8 space-y-4">
               @include('pages.role.partials.table-header')
               @include('pages.role.partials.table')
          </x-card>
     </div>
</x-app-layout>