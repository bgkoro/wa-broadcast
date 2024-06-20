<x-app-layout :$title>
     <div class="px-4 py-6 lg:py-8 space-y-6">
          {{-- @can('has-permission', 'manage_permissions') --}}
          <x-card class="p-6 sm:p-8 space-y-4">
               @include('pages.permission.partials.form-create')
          </x-card>
          {{-- @endcan --}}
          <x-card class="py-6 sm:py-8 space-y-4">
               @include('pages.permission.partials.table-header')
               @include('pages.permission.partials.table')
          </x-card>
     </div>
</x-app-layout>